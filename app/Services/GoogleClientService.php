<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;

class GoogleClientService
{
    public static function drive()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/public/app/google/credentials.json'));
        $client->addScope(Drive::DRIVE_READONLY);

        return new Drive($client);
    }
}
