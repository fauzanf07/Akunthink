<?php

namespace App\Services;   // <-- THIS was missing

use App\Services\GoogleClientService;

class BlogService
{
    public function listDocuments()
    {
        $drive = GoogleClientService::drive();

        $files = $drive->files->listFiles([
            'q' => "'" . env('GOOGLE_DRIVE_FOLDER_ID') . "' in parents and mimeType='application/vnd.google-apps.document'",
            'fields' => 'files(id, name)',
        ]);

        return $files->files;
    }

    public function getDocumentHtml($fileId)
    {
        $drive = GoogleClientService::drive();

        $response = $drive->files->export($fileId, 'text/html', [
            'alt' => 'media',
        ]);

        return $response->getBody()->getContents();
    }
}
