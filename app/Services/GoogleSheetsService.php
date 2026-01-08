<?php
namespace App\Services;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetsService
{
    public static function get()
    {
        $client = new Client();
        $client->setApplicationName('Laravel Google Sheets');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig(storage_path('app/public/app/google/credentials.json'));
        $client->setAccessType('offline');

        return new Sheets($client);
    }
}

?>