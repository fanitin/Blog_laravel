<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;
use Exception;
use DB;
use Hash;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request){
          $data = $request->validated();
          $data['password'] = Hash::make($data['password']);

        try{
            DB::beginTransaction();


            $role_ids = $data['role_ids'];
            unset($data['role_ids']);
            $user = User::firstOrCreate(['email' => $data['email']], $data);
            $user->roles()->attach($role_ids);

            DB::commit();
        }catch(Exception $exception){
            DB::rollBack();
            abort(500);
        }
        return redirect()->route("admin.user.index");
    }
}
