<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    public function index()
    {
        return view('short_url');
    }

    public function shortenUrl(Request $request)
    {
        $request->validate([
            'main_url' => 'required|active_url|url'
        ]);

        $shortUrl = $this->generateshortcode(10);
        Url::create([
            'main_url' => $request->input('main_url'),
            'shortened_url' => $shortUrl,
            'user_id' => Auth::id() ?: null,
        ]);
        return redirect()->back()->with('url', [
            'short_url' => $shortUrl,
            'main_url' => $request->input('main_url')
        ]);
    }
    // redirect to main url
    public function redirectUrl(Request $request)
    {
        $url = $request->url;
        $data = Url::where('shortened_url', $url)->first();
        if (!$data) {
            return redirect()->back()->withErrors(['url' => 'Shortened URL not found.']);
        }
        $data->increment('click_count');
        return redirect($data->main_url);
    }

    // show clicked
    public function stats()
    {
        $data = Url::where('user_id', Auth::id())->get(['id', 'main_url', 'shortened_url', 'click_count']);
        return view('dashboard', ['data' => $data]);
    }
    // generate short code
    public function generateshortcode($lenght = 6)
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $lenght);
    }
}
