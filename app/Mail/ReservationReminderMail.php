<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Reserve;
use App\Models\User;

class ReservationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reserve;

    public function __construct(Reserve $reserve)
    {
        $this->reserve = $reserve;
    }

    public function build()
    {
        return $this->view('emails.reservationreminder')->subject('リマインダー');
    }
}
