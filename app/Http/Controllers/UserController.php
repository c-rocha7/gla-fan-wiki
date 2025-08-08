<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return response()->json($users);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->updateUser($id, $request->validated());

        return response()->json($user);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return response()->noContent();
    }
}
