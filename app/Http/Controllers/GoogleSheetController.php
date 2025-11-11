<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Drive\Drive;
use Illuminate\Http\Request;

class GoogleSheetController extends Controller
{
    public function copySpreadsheet()
    {
        $fileId = 'FADO-UwLDyainmudVKuXSJVAa-8it6xWJCGYz86l_lE';
        $newName = 'Copied Spreadsheet';

        // Initialize Google Client
        $client = new Client();
        $client->setAuthConfig(storage_path('app/public/app/google/credentials.json'));
        $client->addScope(\Google\Service\Drive::DRIVE);

        $service = new Drive($client);

        // Create new copy metadata
        $fileMetadata = new Drive\DriveFile([
            'name' => $newName
        ]);

        // Copy the file
        $copiedFile = $service->files->copy($fileId, $fileMetadata);

        return response()->json([
            'message' => 'File copied successfully!',
            'file_id' => $copiedFile->id,
            'file_link' => 'https://docs.google.com/spreadsheets/d/' . $copiedFile->id,
        ]);
    }
}
