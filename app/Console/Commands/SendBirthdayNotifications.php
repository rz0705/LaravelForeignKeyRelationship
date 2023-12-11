<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Notifications\BirthdayNotification;

class SendBirthdayNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday notification to user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // logger("send Birthdate");
        $users = User::whereMonth('birthdate', now()->format('m'))
                    ->whereDay('birthdate', now()->format('d'))
                    ->get();

        foreach ($users as $user) {
            $user->notify(new BirthdayNotification());
        }

        $this->info('Birthday notifications sent successfully.');
    }
}
