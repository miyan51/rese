<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ReservationReminderMail;

class ReservationReminder extends Command
{
    protected $signature = 'reservation:reminder';
    protected $description = 'リマインダー';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $reservations = reserve::where('date', Carbon::tomorrow()->toDateString())
            ->get();

        foreach ($reservations as $reservation) {
            $email = $reservation->user->email;
            $date = $reservation->date;
            $time = $reservation->time;

            Mail::to($email)->send(new ReservationReminderMail($date, $time));
        }
    }
}
