<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait MediaUploadingTrait
{
    public function storeMedia(Request $request)
    {
        // Step 1: Validate the uploaded file
        $this->validate($request, [
            'file' => 'required|file|mimes:jpeg,png,jpg|max:5120', // Only images, max 5MB
        ]);

        // Step 2: Additional check to verify it's an image
        $file = $request->file('file');
        $imageInfo = getimagesize($file->getPathname());

        if ($imageInfo === false) {
            return response()->json(['error' => 'Uploaded file is not a valid image.'], 400);
        }

        // Step 3: Sanitize file name
        $name = uniqid() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

        // Step 4: Secure file path (outside public directory)
        $path = storage_path('tmp/uploads'); // Store outside public

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create directory'], 500);
        }

        // Step 5: Move file to secure location
        $file->move($path, $name);

        // Step 6: Set appropriate file permissions
        chmod($path . '/' . $name, 0644); // Read and write for owner, read for others

        // Step 7: Return response with file information
        return response()->json([
            'name'          => "asdf",
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
