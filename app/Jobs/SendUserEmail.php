<?php

namespace App\Jobs;

use App\Mail\AccountInformation;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendUserEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::chunk(100, function ($users) {
            foreach($users as $user) {
                $info = [
                    'name' => $user->name,
                    'email' => $user->email,
                ];
                Mail::to($user->email) 
                    ->queue(new AccountInformation($info));
            }
        });
    }
}
