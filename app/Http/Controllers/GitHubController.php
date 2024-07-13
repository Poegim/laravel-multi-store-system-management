<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GitHubController extends Controller
{
    public function index()
    {
        $response = $this->getCommits();

        if ($response->successful()) {
            $commits = $response->json();
        } else {
            $error = $response->json()['error'] ?? 'Unknown error';
            $commits = ['error' => $error];
        }

        return view('dashboard', compact('commits'));
    }

    public function getCommits()
    {
        $owner = 'poegim';
        $repo = 'laravel-multi-store-system-management';

        $url = "https://api.github.com/repos/{$owner}/{$repo}/commits";

        $response = Http::get($url);

        return $response;
    }
}
