<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    public function create(Request $request): View
    {
        return view('users.auth-link');
    }
    public function store(StoreUserRequest $request, User $user): View
    {
        $user->fill($request->validated())->save();
        $userLink = $user->userLinks()->create([
            'lifetime' => now()->addDays(7),
            'url' => Str::random(20),
        ]);
        return view('users.show-link', [
            'link' => $userLink,
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->back();
    }
}
