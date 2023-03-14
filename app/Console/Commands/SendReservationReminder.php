<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ReservationReminderMail;

class SendReservationReminder extends Command
{
    protected $signature = 'reservation:reminder';
    protected $description = 'リマインダー';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $reserves = Reserve::where('date', Carbon::today())->get();

        foreach ($reserves as $reserve) {
            Mail::to($reserve->user->email)->send(new ReservationReminderMail($reserve));
        }
    }
}
