<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function __construct(protected UserService $userService){}
    public function create()
    {
        return view('Front.users.register');
    }
    public function store(UserRegisterRequest $request)
    {
        try {
            $this->userService->store($request->validated());
        } catch (UserException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
