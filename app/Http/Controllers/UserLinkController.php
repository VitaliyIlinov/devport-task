<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserLinkRequest;
use App\Models\UserLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserLinkController extends Controller
{

    public function index(Request $request): View
    {
        return view('links.list', [
            'links' => UserLink::query()->where('user_id', $request->user()->id)->withTrashed()->get()->sortByDesc(
                'created_at'
            ),
        ]);
    }

    public function resolve(Request $request, UserLink $url): RedirectResponse|View
    {
        if ($url->isLifeTimeExpired()) {
            return view('404');
        }
        Auth::login($url->user);

        return redirect()->action([self::class, 'index']);
    }

    public function store(StoreUserLinkRequest $request): RedirectResponse
    {
        UserLink::create([
            'lifetime' => now()->addDays(7),
            'url' => Str::random(20),
            'user_id' => $request->user()->id,
        ]);
        return redirect()->action([self::class, 'index']);
    }

    public function deactivate(Request $request, UserLink $userLink): RedirectResponse
    {
        $userLink->delete();
        return redirect()->action([self::class, 'index']);
    }

    public function activate(Request $request, UserLink $userLink): RedirectResponse
    {
        $userLink->restore();
        return redirect()->action([self::class, 'index']);
    }
}
