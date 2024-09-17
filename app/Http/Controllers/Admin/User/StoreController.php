<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Exception;
use DB;
use Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request){
        $data = $request->validated();
        #$password = Str::random(12);                                           mail to user test
        #$data['password'] = Hash::make($password);                             mail to user test
        $data['password'] = Hash::make($data['password']);

        try{
            DB::beginTransaction();


            $role_ids = $data['role_ids'];
            unset($data['role_ids']);
            $user = User::firstOrCreate(['email' => $data['email']], $data);
            $user->roles()->attach($role_ids);

            DB::commit();

            #Mail::to($data['email'])->send(new PasswordMail($password));       mail to user test
        }catch(Exception $exception){
            DB::rollBack();
            abort(500);
        }
        return redirect()->route("admin.user.index");
    }
}
