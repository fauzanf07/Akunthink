<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Client;

class GenerateGoogleToken extends Command
{
    protected $signature = 'google:generate-token';
    protected $description = 'Generate Google OAuth token and save it to storage/app/google/token.json';

    public function handle()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/public/app/google/credential-akunthink-oauth.json'));
        $client->setScopes([
            \Google\Service\Drive::DRIVE_FILE,
            \Google\Service\Drive::DRIVE,
        ]);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        // Get auth URL
        $client->setRedirectUri('http://127.0.0.1:8000'); // 👈 Add this line
        $authUrl = $client->createAuthUrl();
        $this->info("Open the following link in your browser:\n" . $authUrl);

        // Ask for authorization code
        $authCode = $this->ask('Enter the authorization code here');

        // Exchange authorization code for access token
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

        // Save token
        $tokenPath = storage_path('app/google/token.json');
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($accessToken));

        $this->info("✅ Token saved successfully at: " . $tokenPath);
    }
}
