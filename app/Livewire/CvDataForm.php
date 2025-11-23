<?php

namespace App\Livewire;

use App\Models\Cv;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class CvDataForm extends Component
{

    use WithFileUploads;

    public bool $isSubmitted = false;


    // Wizard state
    public $currentStep = 1;
    public $totalSteps = 6;

    // data CV utama
    public $template = ['simple', 'modern'];
    public $selectedTemplate = 'modern'; // default template


    public $cv_photo;
    public $first_name;
    public $last_name;
    public $job_title;
    public $address;
    public $birthdate;
    public $phone;
    public $marital_status;
    public $gender;
    public $email;
    public $summary;
    public $website_link;
    public $portfolio_link;

    // Data relasi (array)
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

    // Temporary photo untuk preview
    public $existingPhoto;
    public $tempSelectedTemplate;            // untuk dropdown sementara


    public function applyTemplate()
    {
        $this->selectedTemplate = $this->tempSelectedTemplate;
        session()->flash('template');


    }

    public function mount()
    {
        $cv = auth()->user()->cv;

        if ($cv) {
            // Load data CV utama
            $this->existingPhoto = $cv->cv_photo;
            $this->first_name = $cv->first_name;
            $this->last_name = $cv->last_name;
            $this->job_title = $cv->job_title;
            $this->address = $cv->address;
            $this->birthdate = $cv->birthdate;
            $this->phone = $cv->phone;
            $this->marital_status = $cv->marital_status;
            $this->gender = $cv->gender;
            $this->email = $cv->email;
            $this->summary = $cv->summary;
            $this->website_link = $cv->website_link;
            $this->portfolio_link = $cv->portfolio_link;

            // Load relasi
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
        }
    }

    // ========== WIZARD NAVIGATION ==========
    public function nextStep()
    {
        $this->validateCurrentStep();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function goToStep($step)
    {
        // Langsung lompat ke step yang diminta tanpa batasan
        $this->currentStep = $step;
    }

    private function validateCurrentStep()
    {
        if ($this->currentStep == 1) {
            // Step 1: Personal Information
            $this->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'cv_photo' => 'nullable|image|max:2048',
            ], [
                'first_name.required' => 'Nama depan wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'phone.required' => 'Nomor telepon wajib diisi',
            ]);
        } elseif ($this->currentStep == 2) {
            // Step 2: Education & Experience - tidak wajib, skip validasi
        } elseif ($this->currentStep == 3) {
            // Step 3: Skills & Languages - tidak wajib
        } elseif ($this->currentStep == 4) {
            // Step 4: Achievements & Certifications - tidak wajib
        } elseif ($this->currentStep == 5) {
            // Step 5: Sea Experience & Documents - tidak wajib
        }
        // Step 6 adalah review, tidak perlu validasi
    }

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

    // ========== SAVE ==========
    public function save()
    {

        $this->validateCurrentStep();

        // Handle photo upload
        $photoPath = $this->existingPhoto;
        if ($this->cv_photo) {
            // Delete old photo if exists
            if ($this->existingPhoto) {
                Storage::disk('public')->delete($this->existingPhoto);
            }
            $photoPath = $this->cv_photo->store('cv-photos', 'public');
        }

        // Simpan atau update CV
        $cv = Cv::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'cv_photo' => $photoPath,
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

        // Sync semua relasi
        $this->syncRelations($cv);

        session()->flash('status', $cv->wasRecentlyCreated ? 'CV berhasil dibuat.' : 'CV berhasil diperbarui.');

        // return redirect()->route('home'); // Sesuaikan route
        $this->isSubmitted = true; // tandai sudah submit

    }

    public function updated($propertyName)
    {
        // ini akan dipanggil setiap ada perubahan field
        $this->isSubmitted = false;
    }

    private function syncRelations($cv)
    {
        // Education
        $cv->educations()->delete();
        foreach ($this->educations as $education) {
            if (!empty($education['school'])) {
                $cv->educations()->create($education);
            }
        }

        // Experience
        $cv->experiences()->delete();
        foreach ($this->experiences as $experience) {
            if (!empty($experience['company'])) {
                $cv->experiences()->create($experience);
            }
        }

        // Hard Skills
        $cv->hardSkills()->delete();
        foreach ($this->hardSkills as $skill) {
            if (!empty($skill['skill_name'])) {
                $cv->hardSkills()->create($skill);
            }
        }

        // Soft Skills
        $cv->softSkills()->delete();
        foreach ($this->softSkills as $skill) {
            if (!empty($skill['skill_name'])) {
                $cv->softSkills()->create($skill);
            }
        }

        // Languages
        $cv->languages()->delete();
        foreach ($this->languages as $language) {
            if (!empty($language['language'])) {
                $cv->languages()->create($language);
            }
        }

        // Achievements
        $cv->achievements()->delete();
        foreach ($this->achievements as $achievement) {
            if (!empty($achievement['name'])) {
                $cv->achievements()->create($achievement);
            }
        }

        // Certifications
        $cv->certifications()->delete();
        foreach ($this->certifications as $certification) {
            if (!empty($certification['name'])) {
                $cv->certifications()->create($certification);
            }
        }

        // References
        $cv->references()->delete();
        foreach ($this->references as $reference) {
            if (!empty($reference['name'])) {
                $cv->references()->create($reference);
            }
        }

        // Social Media
        $cv->socialMedia()->delete();
        foreach ($this->socialMedia as $sm) {
            if (!empty($sm['platform'])) {
                $cv->socialMedia()->create($sm);
            }
        }

        // Sea Experiences
        $cv->seaExperiences()->delete();
        foreach ($this->seaExperiences as $seaExperience) {
            if (!empty($seaExperience['vessel_name'])) {
                $cv->seaExperiences()->create($seaExperience);
            }
        }

        // Documents
        $cv->documents()->delete();
        foreach ($this->documents as $document) {
            if (!empty($document['name'])) {
                $cv->documents()->create($document);
            }
        }
    }


    public function render()
    {
        return view('livewire.cv-data-form');
    }


}
