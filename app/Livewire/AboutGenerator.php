<?php

namespace App\Livewire;

use OpenAI;
use Livewire\Component;

class AboutGenerator extends Component
{


   public $inputText = '';
    public $resultText = '';
    public $loading = false;

    public function generate()
    {
        $this->loading = true;
        $this->resultText = '';

        try {
            $client = OpenAI::client(env('OPENAI_API_KEY'));

            $response = $client->chat()->create([
                'model' => 'gpt-4.1-mini',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "buatkan teks 'About Me' yang profesional untuk cv berdasarkan ini balikan respon about me nya saja tanpa promp ai jangan respon di luar dari konteks about me: " . $this->inputText
                    ],
                ],
            ]);

            $this->resultText = $response->choices[0]->message->content;
        } catch (\Exception $e) {
            $this->resultText = "Terjadi kesalahan: " . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.about-generator');
    }
}
