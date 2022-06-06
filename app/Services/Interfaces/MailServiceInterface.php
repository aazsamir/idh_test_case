<?php

namespace App\Services\Interfaces;

use Illuminate\Mail\Mailable;

/**
 * Service for mail sending
 */
interface MailServiceInterface
{
    /**
     * Send mail
     */
    public function send(string|array $to, Mailable $mail);
}
