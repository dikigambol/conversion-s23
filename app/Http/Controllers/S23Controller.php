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
        $zipPath = public_path("zip_files/$zipFilename");
        copy($uploadedFile->path(), $zipPath);

        $extractPath = public_path('extracted_files');

        $zip = new ZipArchive();

        if ($zip->open($zipPath) === TRUE) {
            if ($zip->extractTo($extractPath)) {
                $zip->close();
                // unlink($zipPath);
                return response()->json(['message' => 'Berhasil Diubah dan Diekstrak.']);
            } else {
                $zip->getStatusString();
                $zip->close();
                // unlink($zipPath);
                return response()->json(['message' => "Gagal mengekstrak file"]);
            }
        } else {
            $zip->getStatusString();
            $zip->close();
            // unlink($zipPath);
            return response()->json(['message' => "Gagal membuka file zip untuk diekstrak"]);
        }
    }

    public function extractS23(Request $request)
    {
        $s23FilePath = $request->file('file');

        $extractedFolderPath = public_path('s23-extracted');

        $zip = new ZipArchive;

        if ($zip->open($s23FilePath) === TRUE) {
            $zip->extractTo($extractedFolderPath);
            $zip->close();
            return "File berhasil diekstrak";
        } else {
            $zip->getStatusString();
        }
    }
}
