<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('media');
        $folder = uniqid() . '-' . now()->timestamp;
        $filename = hexdec(uniqid()) . '.' . $file->extension();
        $path = 'public/temporary/' . $folder . '/' . $filename;
        $file->storeAs('public/temporary/' . $folder, $filename);
        TemporaryFile::create([
            'path' => $path,
        ]);
        return response()->json([
            'path' => $path,
        ]);
    }

    public function destroy(Request $request)
    {
        $filePath = $request->getContent();
        $filePath = json_decode($filePath)->path;

        $temporaryImage = TemporaryFile::where('path', 'like', '%' . $filePath . '%')->first();

        if (!$temporaryImage) {
            return response()->json(['message' => 'File not found'], 404);
        }

        $path = $temporaryImage->path;
        $folder = explode('/', $path);

        File::delete(storage_path('app/' . $path));

        $temporaryImage->delete();

        $returnPath = $path;

        if (TemporaryFile::where('path', $path)->count() == 0) {
            File::deleteDirectory(storage_path('app/public/temporary/' . $folder[2]));
        }

        if ($temporaryImage) {
            return response()->json([
                'status' => 'success',
                'message' => 'File deleted successfully',
                'path' => $returnPath,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'File failed to delete',
            ]);
        }
    }
}
