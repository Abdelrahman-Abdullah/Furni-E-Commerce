<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Http\Requests\UserLoginRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserSessionController extends Controller
{
    public function __construct(protected UserService $userService){}

    public function create()
    {
        return view('Front.users.login');
    }
    public function store(UserLoginRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $this->userService->login($request->validated());
            return redirect()->route('home');
        } catch (UserException $e) {
            return back()->withErrors([
                'password' => $e->getMessage(),
            ]);
        }
    }
public function destroy(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate(); // Flush the session data and regenerate the ID
        $request->session()->regenerateToken(); // Regenerate the CSRF token value...

        return redirect()->route('home');
    }

}
