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
            if ($response->status() == 403 && $response->header('X-RateLimit-Remaining') == 0) {
                $rateLimitReset = $response->header('X-RateLimit-Reset');
                
                $resetTime = \Carbon\Carbon::createFromTimestamp($rateLimitReset)
                    ->setTimezone('Europe/Berlin') 
                    ->toDateTimeString();
    
                $commits = [
                    'error' => 'GitHub rate limit exceeded. Please try again after: ' . $resetTime
                ];
            } else {
                abort(403, 'GitHub unknown error');
                // $error = $response->json()['error'] ?? 'Unknown error';
                // $commits = ['error' => $error];
            }
        }
    
        return view('dashboard', compact('commits'));
    }

    public function getCommits()
    {
        $owner = 'poegim';
        $repo = 'laravel-multi-store-system-management';

        $url = "https://api.github.com/repos/{$owner}/{$repo}/commits";

        $response = Http::get($url, [
            'per_page' => 10,
        ]);

        return $response;
    }
}
