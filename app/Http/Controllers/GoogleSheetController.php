<?php

namespace App\Http\Controllers;

use App\Models\User;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class GoogleSheetController extends Controller
{
    public function dashboard()
    {
        if(!isset(Auth::user()->sheet_file_id)){
            $companyName = Auth::user()->company_name;
            $fileId = '1FADO-UwLDyainmudVKuXSJVAa-8it6xWJCGYz86l_lE'; // Source Spreadsheet ID
            $newName = $companyName. ' - ' . now()->format('Y-m-d ');
    
            // Initialize Google Client
            $client = new Client();
            $client->setAuthConfig(storage_path('app/public/app/google/credential-akunthink-oauth.json')); // ✅ make sure this path is correct
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
                $email = Auth::user()->email;
                User::where('email','=',$email)->update([
                    'sheet_file_id' => $copiedFile->id
                ]);
                return Inertia::render('Dashboard',[
                    'sheetId' => $copiedFile->id
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to copy file: ' . $e->getMessage(),
                ], 500);
            }
        }else{
            return Inertia::render('Dashboard',[
                'sheetId' => Auth::user()->sheet_file_id,
                'idUser' => Auth::user()->id_user
            ]);
        }
    }
}
