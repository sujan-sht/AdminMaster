<?php

namespace SujanSht\LaraAdmin\Contracts;

use SujanSht\LaraAdmin\Http\Requests\UserRequest;
use App\Models\User;

interface UserRepositoryInterface
{
    public function indexUser();

    public function createUser();

    public function storeUser(UserRequest $request);

    public function showUser(User $user);

    public function editUser(User $user);

    public function updateUser(UserRequest $request, User $user);

    public function destroyUser(User $user);
}
