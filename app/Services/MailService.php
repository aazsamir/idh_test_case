<?php

namespace App\Services;

use App\Services\Interfaces\MailServiceInterface;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

/**
 * Service for mail sending
 */
class MailService implements MailServiceInterface
{
    public function send(string|array $to, Mailable $mail)
    {
        // Mail::to($to)->send($mail);
    }
}
