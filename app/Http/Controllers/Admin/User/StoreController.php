<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Jobs\StoreUserJob;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Exception;
use DB;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request){
        $data = $request->validated();
        

        try{
            DB::beginTransaction();

            #$password = Str::random(12);                                           mail with password to user test
            #$data['password'] = Hash::make($password);                             mail with password to user test
            $data['password'] = Hash::make($data['password']);
            
            $role_ids = $data['role_ids'];
            unset($data['role_ids']);
            $user = User::firstOrCreate(['email' => $data['email']], $data);
            $user->roles()->attach($role_ids);

            DB::commit();

            #event(new Registered($user));                           #verify email test
            #Mail::to($data['email'])->send(new PasswordMail($password));       mail with password to user test

            #StoreUserJob::dispatch($data)->onQueue("high");                    test jobs and queue(in that i case i dont need 26-39 lines here
        }catch(Exception $exception){                                           # except line 35, its required)
            DB::rollBack();
            abort(500);
        }
        return redirect()->route("admin.user.index");
    }
}
