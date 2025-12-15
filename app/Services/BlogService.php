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
            'fields' => 'files(id, name, modifiedTime)',
            'orderBy' => 'modifiedTime desc', // latest modified first
        ]);

        return $files->files;
    }

    public function getDocumentHtml($fileId)
    {
        $drive = GoogleClientService::drive();

        /** 1️⃣ Get metadata */
        $file = $drive->files->get($fileId, [
            'fields' => 'id, name, modifiedTime',
        ]);

        /** 2️⃣ Export HTML */
        $response = $drive->files->export($fileId, 'text/html', [
            'alt' => 'media',
        ]);

        $html = $response->getBody()->getContents();

        /** 3️⃣ Return both */
        return response()->json([
            'html' => $html,
            'modifiedTime' => $file->modifiedTime,
        ]);
    }
}
