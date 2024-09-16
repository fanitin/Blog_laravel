<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Exception;
use DB;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user){
        $data = $request->validated();
        $user->update($data);
        try{
            DB::beginTransaction();

            $role_ids = $data['role_ids'];
            unset($data['role_ids']);
            $user->update($data);
            $user->roles()->sync($role_ids);

            DB::commit();
        }catch(Exception $exception){
            DB::rollBack();
            abort(500);
        }

        return view("admin.user.show", ["user" => $user]);
    }
}
