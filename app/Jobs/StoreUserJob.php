<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Exception;
use DB;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StoreUserJob implements ShouldQueue
{
    use Queueable;
    private $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        #$password = Str::random(12);                                           mail with password to user test
        #$data['password'] = Hash::make($password);                             mail with password to user test
        $this->data['password'] = Hash::make($this->data['password']);
          
        $role_ids = $this->data['role_ids'];
        unset($data['role_ids']);
        $user = User::firstOrCreate(['email' => $this->data['email']], $this->data);
        $user->roles()->attach($role_ids);

        event(new Registered($user));                           #verify email test
        #Mail::to($data['email'])->send(new PasswordMail($password));       mail with password to user test
    }
}
