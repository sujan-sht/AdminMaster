<?php

namespace SujanSht\LaraAdmin\Http\Controllers\Admin;

use SujanSht\LaraAdmin\Contracts\UserRepositoryInterface;
use SujanSht\LaraAdmin\Http\Controllers\Controller;
use SujanSht\LaraAdmin\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lara-admin::admin.user.index',$this->userRepositoryInterface->indexUser());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lara-admin::admin.user.create',$this->userRepositoryInterface->createUser());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->userRepositoryInterface->storeUser($request);
        return redirect(adminRedirectRoute('users'))->with('message','Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('lara-admin::admin.user.show',$this->userRepositoryInterface->showUser($user));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('lara-admin::admin.user.edit',$this->userRepositoryInterface->editUser($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {

        $this->userRepositoryInterface->updateUser($request, $user);
        return redirect(adminRedirectRoute('users'))->with('info','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userRepositoryInterface->destroyUser($user);
        return redirect(adminRedirectRoute('users'))->with('error','Deleted Successfully');
    }
}
