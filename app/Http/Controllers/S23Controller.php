<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class S23Controller extends Controller
{
    public function convertAndExtract(Request $request)
    {
        $uploadedFile = $request->file('file');

        if ($uploadedFile->getClientOriginalExtension() !== 's23') {
            return response()->json(['message' => 'File bukan format .s23.']);
        }

        $zipFilename = time() . '.zip';
        $zipPath = storage_path("app/public/zip_files/$zipFilename");

        $zip = new ZipArchive();
        if ($zip->open($zipPath) === TRUE) {
            $numFiles = $zip->numFiles;
            for ($i = 0; $i < $numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                echo "File $i: $filename\n";
            }
            $zip->close();
        } else {
            echo "Gagal membuka arsip ZIP: " . $zip->getStatusString();
        }

        $extractPath = public_path('extracted_files');

        $zip = new ZipArchive();
        if ($zip->open($zipPath) === TRUE) {
            $zip->extractTo($extractPath);
            $zip->close();
            return response()->json(['message' => 'Berhasil Diubah dan Diekstrak.']);
        } else {
            return response()->json(['message' => 'Gagal mengekstrak file ZIP.']);
        }
    }
}
