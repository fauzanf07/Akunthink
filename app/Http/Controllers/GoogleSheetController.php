<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\Request;

class GoogleSheetController extends Controller
{
    public function copySpreadsheet()
    {
        $fileId = '1FADO-UwLDyainmudVKuXSJVAa-8it6xWJCGYz86l_lE'; // Source Spreadsheet ID
        $newName = 'Copied Spreadsheet - ' . now()->format('Y-m-d H:i:s');

        // Initialize Google Client
        $client = new Client();
        $client->setAuthConfig(storage_path('app/public/app/google/credentials.json')); // ✅ make sure this path is correct
        $client->setScopes([Drive::DRIVE_FILE, Drive::DRIVE]);
        $client->setAccessType('offline');

        // ✅ Load the saved access token
        $tokenPath = storage_path('app/google/token.json');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        } else {
            return response()->json([
                'error' => 'Access token not found. Please authenticate first.',
            ], 400);
        }

        // ✅ Refresh token if expired
        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            } else {
                return response()->json(['error' => 'Refresh token missing. Re-authenticate required.'], 401);
            }
        }

        // ✅ Create Drive service
        $service = new Drive($client);

        // ✅ Create new file metadata
        $fileMetadata = new DriveFile([
            'name' => $newName,
        ]);

        // ✅ Copy the file
        try {
            $copiedFile = $service->files->copy($fileId, $fileMetadata);
            return response()->json([
                'message' => 'File copied successfully!',
                'file_id' => $copiedFile->id,
                'file_link' => 'https://docs.google.com/spreadsheets/d/' . $copiedFile->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to copy file: ' . $e->getMessage(),
            ], 500);
        }
    }
}
