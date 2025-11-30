<?php

namespace App\Livewire\App\CvBuilder;

use OpenAI;
use App\Models\Cv;
use Livewire\Component;
use App\Models\Template;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout; // Import ini

#[Layout('components.layouts.focused')]
#[Title('Lengkapi CV Anda')]
class Form extends Component
{
    use WithFileUploads;

    public bool $isSubmitted = false;


    // Wizard state
    public $currentStep = 1;
    public $totalSteps = 6;

    // Data Utama
    public $template_id;
    public $cv_photo;
    public $existingPhoto; // URL foto lama untuk preview

    // Field Data Diri
    public $first_name, $last_name, $job_title, $address, $birthdate;
    public $phone, $marital_status, $gender, $email, $summary;
    public $website_link, $portfolio_link;

    // Data Relasi (Array)
    public $educations = [];
    public $experiences = [];
    public $hardSkills = [];
    public $softSkills = [];
    public $languages = [];
    public $achievements = [];
    public $certifications = [];
    public $references = [];
    public $socialMedia = [];
    public $seaExperiences = [];
    public $documents = [];

    // --- 3. PROPERTI AI REVIEWER ---
    public $aiAnalysis = null;
    public $isAnalyzing = false;

    // --- 4. COMPUTED PROPERTY (Fix Error Template) ---
    public function getActiveTemplateProperty()
    {
        return Template::find($this->template_id);
    }

    public function mount()
    {
        $cv = auth()->user()->cv()->with([
            'educations',
            'experiences',
            'hardSkills',
            'softSkills',
            'languages',
            'achievements',
            'certifications',
            'references',
            'socialMedia',
            'seaExperiences',
            'documents'
        ])->first();

        if ($cv) {
            $this->existingPhoto = $cv->cv_photo;
            $this->template_id = $cv->template_id;
            $this->fill($cv->only([
                'first_name',
                'last_name',
                'job_title',
                'address',
                'birthdate',
                'phone',
                'marital_status',
                'gender',
                'email',
                'summary',
                'website_link',
                'portfolio_link'
            ]));

            // Load Relasi ke Array dan pastikan handle null
            $this->educations = $cv->educations->toArray();
            $this->experiences = $cv->experiences->toArray();
            $this->hardSkills = $cv->hardSkills->toArray();
            $this->softSkills = $cv->softSkills->toArray();
            $this->languages = $cv->languages->toArray();
            $this->achievements = $cv->achievements->toArray();
            $this->certifications = $cv->certifications->toArray();
            $this->references = $cv->references->toArray();
            $this->socialMedia = $cv->socialMedia->toArray();
            $this->seaExperiences = $cv->seaExperiences->toArray();
            $this->documents = $cv->documents->toArray();
        } else {
            // Inisialisasi minimal 1 row kosong untuk UX yang lebih baik (Opsional)
            $this->template_id = 1;
            $this->addEducation();
            $this->addExperience();
        }
    }

    // --- 6. AI ANALYSIS LOGIC ---
    public function analyzeCv()
    {
        $this->isAnalyzing = true;
        $this->aiAnalysis = null; // Reset hasil sebelumnya

        // Data yang dikirim ke AI (pilih yang penting saja)
        $cvData = [
            'job_title' => $this->job_title,
            'summary' => $this->summary,
            'experiences' => $this->experiences,
            'educations' => $this->educations,
            'skills' => array_merge($this->hardSkills, $this->softSkills),
            'achievements' => $this->achievements
        ];

        // Prompt Engineering
        $prompt = "Act as a professional HR Recruiter. Analyze this CV JSON data.
        Return ONLY raw JSON format (no markdown, no backticks) with this structure in bahasa inggris gen-z:
        {
            \"score\": (integer 0-100),
            \"summary_feedback\": (string brief feedback),
            \"strengths\": (array of strings),
            \"weaknesses\": (array of strings),
            \"suggestions\": (array of strings actionable advice)
        }
        Data: " . json_encode($cvData);

        try {

            $client = OpenAI::client(env('OPENAI_API_KEY'));

            $result = $client->chat()->create([
                'model' => 'gpt-4.1-mini', // Gunakan 'gpt-4o-mini' jika punya akses (lebih cepat & pintar)
                'messages' => [['role' => 'user', 'content' => $prompt]],
                'temperature' => 0.8,
            ]);

            $content = $result->choices[0]->message->content;

            // Bersihkan jika AI memberikan format Markdown ```json
            $cleanJson = str_replace(['```json', '```'], '', $content);

            $this->aiAnalysis = json_decode($cleanJson, true);

        } catch (\Exception $e) {
            // Tampilkan error sebagai notifikasi
            $this->dispatch('notify', message: 'AI Error: ' . $e->getMessage());
        }

        $this->isAnalyzing = false;
    }

    // ========== WIZARD ==========
    public function nextStep()
    {
        $this->validateStep($this->currentStep);
        if ($this->currentStep < $this->totalSteps)
            $this->currentStep++;
    }

    public function previousStep()
    {
        if ($this->currentStep > 1)
            $this->currentStep--;
    }

    public function goToStep($step)
    {
        // Validasi step saat ini sebelum lompat (agar data tersimpan di state valid)
        if ($step > $this->currentStep) {
            $this->validateStep($this->currentStep);
        }
        $this->currentStep = $step;
    }

    private function validateStep($step)
    {
        if ($step == 1) {
            $this->validate([
                'first_name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'cv_photo' => 'nullable|image|max:2048',
            ]);
        }
        // Tambahkan validasi per step lain jika perlu
        // Contoh Step 2 (Education):
        /*
        elseif ($step == 2) {
            $this->validate([
                'educations.*.school' => 'required|string',
                'educations.*.year_start' => 'required',
            ]);
        }
        */
    }

    // ========== DYNAMIC INPUT ACTIONS ==========

    // Generic Add Function (Bisa digunakan untuk mengurangi duplikasi code)
    public function addItem($arrayName, $structure)
    {
        $this->$arrayName[] = $structure;
    }

    // Specific wrappers (tetap ada agar wire:click di blade jelas)
    // ========== EDUCATION ==========
    public function addEducation()
    {
        $this->educations[] = [
            'school' => '',
            'degree' => '',
            'location' => '',
            'year_start' => '',
            'year_end' => '',
        ];
    }

    public function removeEducation($index)
    {
        unset($this->educations[$index]);
        $this->educations = array_values($this->educations);
    }

    // ========== EXPERIENCE ==========
    public function addExperience()
    {
        $this->experiences[] = [
            'company' => '',
            'job_title' => '',
            'location' => '',
            'start_date' => '',
            'end_date' => '',
            'job_desk' => '',
            'is_present' => false,
        ];
    }

    public function removeExperience($index)
    {
        unset($this->experiences[$index]);
        $this->experiences = array_values($this->experiences);
    }

    // ========== HARD SKILL ==========
    public function addHardSkill()
    {
        $this->hardSkills[] = [
            'skill_name' => '',
            'level' => '',
            'scale' => '',
        ];
    }

    public function removeHardSkill($index)
    {
        unset($this->hardSkills[$index]);
        $this->hardSkills = array_values($this->hardSkills);
    }

    // ========== SOFT SKILL ==========
    public function addSoftSkill()
    {
        $this->softSkills[] = [
            'skill_name' => '',
            'level' => '',
            'scale' => '',
        ];
    }

    public function removeSoftSkill($index)
    {
        unset($this->softSkills[$index]);
        $this->softSkills = array_values($this->softSkills);
    }

    // ========== LANGUAGE ==========
    public function addLanguage()
    {
        $this->languages[] = [
            'language' => '',
            'level' => '',
        ];
    }

    public function removeLanguage($index)
    {
        unset($this->languages[$index]);
        $this->languages = array_values($this->languages);
    }

    // ========== ACHIEVEMENT ==========
    public function addAchievement()
    {
        $this->achievements[] = [
            'name' => '',
            'vendor' => '',
            'year' => '',
        ];
    }

    public function removeAchievement($index)
    {
        unset($this->achievements[$index]);
        $this->achievements = array_values($this->achievements);
    }

    // ========== CERTIFICATE ==========
    public function addCertificate()
    {
        $this->certifications[] = [
            'name' => '',
            'vendor' => '',
            'year' => '',
        ];
    }

    public function removeCertificate($index)
    {
        unset($this->certifications[$index]);
        $this->certifications = array_values($this->certifications);
    }

    // ========== REFERENCE ==========
    public function addReference()
    {
        $this->references[] = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'company' => '',
            'relation' => '',
        ];
    }

    public function removeReference($index)
    {
        unset($this->references[$index]);
        $this->references = array_values($this->references);
    }

    // ========== SOCIAL MEDIA ==========
    public function addSocialMedia()
    {
        $this->socialMedia[] = [
            'platform' => '',
            'name' => '',
            'link' => '',
        ];
    }

    public function removeSocialMedia($index)
    {
        unset($this->socialMedia[$index]);
        $this->socialMedia = array_values($this->socialMedia);
    }

    // ========== SEA EXPERIENCE ==========
    public function addSeaExperience()
    {
        $this->seaExperiences[] = [
            'vessel_name' => '',
            'vessel_type' => '',
            'gross_tonnage' => '',
            'engine_type' => '',
            'engine_power' => '',
            'rank' => '',
            'company' => '',
            'contract_type' => '',
            'sign_on' => '',
            'sign_off' => '',
            'is_current' => false,
            'sailing_area' => '',
            'duties' => '',
            'notes' => '',
        ];
    }

    public function removeSeaExperience($index)
    {
        unset($this->seaExperiences[$index]);
        $this->seaExperiences = array_values($this->seaExperiences);
    }

    // ========== DOCUMENT ==========
    public function addDocument()
    {
        $this->documents[] = [
            'name' => '',
            'country' => '',
            'expiration_date' => '',
        ];
    }

    public function removeDocument($index)
    {
        unset($this->documents[$index]);
        $this->documents = array_values($this->documents);
    }

    // ... (Lanjutkan pola add/remove yang sama untuk skill, languages, dll seperti kode asli Anda) ...
    // Saya menyingkatnya disini agar muat, tapi logika Anda sebelumnya sudah benar untuk bagian add/remove.


    // ========== SAVE LOGIC (OPTIMIZED) ==========
    public function save()
    {
        $this->validateStep($this->currentStep); // Validasi step terakhir

        // 1. Handle Photo Upload
        $photoPath = $this->existingPhoto;
        if ($this->cv_photo) {
            if ($this->existingPhoto) {
                Storage::disk('public')->delete($this->existingPhoto);
            }
            $photoPath = $this->cv_photo->store('cv-photos', 'public');
        }

        // Gunakan Transaction agar data konsisten
        DB::transaction(function () use ($photoPath) {

            // 2. Update/Create Main CV
            $cv = Cv::updateOrCreate(
                ['user_id' => auth()->id()],
                [
                    'cv_photo' => $photoPath,
                    'template_id' => $this->template_id,
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'job_title' => $this->job_title,
                    'address' => $this->address,
                    'birthdate' => $this->birthdate,
                    'phone' => $this->phone,
                    'marital_status' => $this->marital_status,
                    'gender' => $this->gender,
                    'email' => $this->email,
                    'summary' => $this->summary,
                    'website_link' => $this->website_link,
                    'portfolio_link' => $this->portfolio_link,
                ]
            );

            // 3. Sync Relations (Hapus Lama -> Insert Baru Bersih)
            $this->syncData($cv->educations(), $this->educations, 'school');
            $this->syncData($cv->experiences(), $this->experiences, 'company');
            $this->syncData($cv->hardSkills(), $this->hardSkills, 'skill_name');
            $this->syncData($cv->softSkills(), $this->softSkills, 'skill_name');
            $this->syncData($cv->languages(), $this->languages, 'language');
            $this->syncData($cv->achievements(), $this->achievements, 'name');
            $this->syncData($cv->certifications(), $this->certifications, 'name');
            $this->syncData($cv->references(), $this->references, 'name');
            $this->syncData($cv->socialMedia(), $this->socialMedia, 'platform');
            $this->syncData($cv->seaExperiences(), $this->seaExperiences, 'vessel_name');
            $this->syncData($cv->documents(), $this->documents, 'name');
        });

        $this->isSubmitted = true;
        session()->flash('status', 'CV berhasil disimpan!');
    }

    /**
     * Helper sakti untuk sync data relasi
     * $relation: Query builder (misal $cv->educations())
     * $items: Array data dari Livewire (misal $this->educations)
     * $requiredField: Field penentu apakah baris ini valid/tidak kosong
     */
    private function syncData($relation, $items, $requiredField)
    {
        // 1. Hapus data lama
        $relation->delete();

        // 2. Bersihkan data dari ID dan Timestamps agar createMany berhasil
        $cleanItems = collect($items)
            ->filter(fn($item) => !empty($item[$requiredField])) // Hanya ambil yang ada isinya
            ->map(function ($item) {
                // Buang ID, created_at, updated_at agar database membuat baru
                return Arr::except($item, ['id', 'created_at', 'updated_at']);
            })
            ->toArray();

        // 3. Bulk Insert (Jauh lebih cepat)
        if (!empty($cleanItems)) {
            $relation->createMany($cleanItems);
        }
    }

    public function updated($propertyName)
    {
        $this->isSubmitted = false;
    }
    public function render()
    {
        // 1. Definisi Data Steps (Logic dipindah ke sini)
        $steps = [
            1 => ['label' => 'Identity', 'icon' => 'user'],
            2 => ['label' => 'Education', 'icon' => 'book-open'],
            3 => ['label' => 'Skills', 'icon' => 'cpu'],
            4 => ['label' => 'Achievements', 'icon' => 'award'],
            5 => ['label' => 'Experience', 'icon' => 'anchor'],
            6 => ['label' => 'Finalize', 'icon' => 'check-square'],
        ];

        // 2. Logika Matematika Progress
        $totalSteps = count($steps);

        // Mencegah pembagian dengan nol jika steps < 1
        $percentage = $totalSteps > 1
            ? round((($this->currentStep - 1) / ($totalSteps - 1)) * 100)
            : 0;

        return view('livewire.app.cv-builder.form', [
            'steps' => $steps,
            'totalSteps' => $totalSteps,
            'percentage' => $percentage,
        ]);
    }
}
