<?php

namespace SujanSht\AdminMaster\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use SujanSht\AdminMaster\Models\Admin\Role;
use SujanSht\AdminMaster\Http\Requests\UserRequest;
use SujanSht\AdminMaster\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    // User Index
    public function indexUser()
    {
        $users = Cache::has('users') ? Cache::get('users') : Cache::rememberForever('users', function () {
            return User::latest()->get();
        });

        return compact('users');
    }

    // User Create
    public function createUser()
    {
        $roles = Role::all();
        return compact('roles');
    }

    // User Store
    public function storeUser(UserRequest $request)
    {
        $request->validated();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->role);
        $this->uploadImage($user);


    }

    // User Show
    public function showUser(User $user)
    {
        return compact('user');
    }

    // User Edit
    public function editUser(User $user)
    {
        $roles = Role::all();
        return compact('user','roles');
    }

    // User Update
    public function updateUser(UserRequest $request, User $user)
    {
        if($request->password){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $user->password,
            ]);
        }

        $user->roles()->sync($request->role);
    }

    // User Destroy
    public function destroyUser(User $user)
    {
        if($user->delete()){
            $user->roles()->detach();
        }
    }


    // Upload Image
    private function uploadImage(User $user)
    {
        if (request()->has('image')) {
            $user
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }
    }
}
