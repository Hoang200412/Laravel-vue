<?php

namespace App\Http\Controllers;

use App\Models\Proof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getSignedUrl(Proof $proof)
    {
        $file_path = $proof->file_path;
        if (!Storage::disk('public')->exists($file_path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $viewUrl = URL::temporarySignedRoute(
            'view.file',
            now()->addMinutes(5),
            ['file_path' => $file_path]
        );

        $downloadUrl = URL::temporarySignedRoute(
            'download.file',
            now()->addMinutes(5),
            ['file_path' => $file_path]
        );

        return response()->json([
            'view_url' => $viewUrl,
            'download_url' => $downloadUrl,
        ]);
    }

    public function downloadFile(Request $request, $file_path)
    {
        if (!$request->hasValidSignature()) {
            abort(401, 'Invalid signature');
        }
        if (!Storage::disk('public')->exists($file_path)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        return Storage::disk('public')->download($file_path);
    }

    public function viewFile(Request $request, $file_path)
    {
        if (!$request->hasValidSignature()) {
            abort(401, 'Invalid signature');
        }

        if (!Storage::disk('public')->exists($file_path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $mimeType = Storage::disk('public')->mimeType($file_path);
        $fileContent = Storage::disk('public')->get($file_path);

        return response($fileContent, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="'.basename($file_path).'"');
    }
    

}
