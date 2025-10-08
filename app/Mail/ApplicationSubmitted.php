<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;
    public $user;
    public $files;
    public $pdfPath;

    public function __construct($data, $user, $files = [], $pdfPath = null)
    {
        $this->data = $data;
        $this->user = $user;
        $this->files = $files;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        $email = $this->subject('New Application Received')
            ->view('emails.application_submitted')
            ->with([
                'data' => $this->data,
                'user' => $this->user,
            ]);

        if ($this->pdfPath && file_exists($this->pdfPath)) {
            $email->attach($this->pdfPath, [
                'as' => 'Application.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        foreach ($this->files as $file) {
            $email->attach(storage_path("app/public/$file"));
        }

        return $email;
    }
}
