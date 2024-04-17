<?php

namespace App\Http\Controllers;

use App\Enums\ImageSizes;
use App\Http\Requests\UpdateMediaRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MediaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:show_media', ['only' => ['create', 'filterModalFiles', 'filterFiles']]);
        $this->middleware('permission:create_media', ['only' => ['store', 'checkExistingFile']]);
        $this->middleware('permission:edit_media', ['only' => ['update', 'updateFeaturedStatus']]);
        $this->middleware('permission:delete_media', ['only' => ['destroy', 'checkExistingFile', 'deleteExistingFile', 'deleteMediaFiles']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $files = Media::with('user:id,name')->get();
        $fileTypes = $files->pluck('extension')->unique();
        $dates = Media::orderBy('created_at')->pluck('created_at')->unique()->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('F - Y');
        })->unique();
        return view('media.create', compact('files', 'fileTypes', 'dates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fileDetailsArray = [];
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $fileSize = round($file->getSize() / 1024, 2);
        $fileType = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();

        $folderName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExisting = Media::where('name', $file->getClientOriginalName())->exists();
        $fileExistsIndicator = $fileExisting ? true : false;
        $path = uploadFile($file, $folderName, $fileExistsIndicator);

        $fileDetails = [
            'name' => $originalName,
            'url' => $path,
            'type' => $fileType,
            'extension' => $extension,
            'size' => $fileSize,
            'user_id' => Auth::user()->id,
        ];

        $fileCreated = Media::create($fileDetails);

        if (Str::startsWith($fileCreated->type, 'image')) {
            $manager = new ImageManager(new Driver());
            $imagePath = public_path('storage/' . $fileCreated->url);
            $image = $manager->read($file);

            foreach (ImageSizes::map() as $size) {
                list($width, $height) = explode('x', $size);
                $resizedImage = $image->resize($width, $height);
                $filenameWithoutExtension = pathinfo($fileCreated->name, PATHINFO_FILENAME);
                $newFilename = "{$filenameWithoutExtension}-{$size}.{$extension}";
                $folderPath = dirname($fileCreated->url);
                $resizedImage->save(public_path("storage/{$folderPath}/{$newFilename}"));
            }
        }

        return to_route('media.create');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $request, Media $medium)
    {
        $validatedData = $request->validated();
        $medium->update($validatedData);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $file = Media::findOrFail($id);
        if ($file) {
            deleteFiles($file);
            $file->delete();
        }
        session()->flash('alert', ['message' => 'Post successfully created', 'type' => 'success']);
        return redirect()->back();
    }

    public function checkExistingFile(Request $request)
    {
        $file = $request->file('file');
        $existingFile = Media::where('name', $file->getClientOriginalName())->exists();

        return response()->json(['exists' => $existingFile]);
    }

    public function deleteExistingFile(Request $request)
    {
        $fileName = $request->filename;
        if ($fileName) {
            $existingFiles = Media::where('name', $fileName)->get();
            if ($existingFiles) {
                foreach ($existingFiles as $existingFile) {
                    deleteFiles($existingFile);
                    $existingFile->delete();
                }
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'File not found'], 404);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Filename not provided'], 400);
        }
    }

    public function filterFiles(Request $request)
    {
        $query = Media::query();

        if ($request->fileType !== 'all') {
            $query->where('extension', $request->fileType);
        }

        if ($request->date && $request->date !== 'all') {
            $selectedDate = \Carbon\Carbon::createFromFormat('F - Y', $request->date);
            $query->whereMonth('created_at', $selectedDate->month)
                ->whereYear('created_at', $selectedDate->year);
        }

        if ($request->searchText && $request->searchText !== '') {
            $query->whereAny(['name', 'type', 'size', 'extension', 'title', 'alt', 'caption', 'description'], 'LIKE', '%' . $request->searchText . '%');
        }

        $files = $query->paginate(10);

        return view('media.filtered-files')->with('files', $files);
    }

    public function filterModalFiles(Request $request)
    {
        $query = Media::query();

        if ($request->fileType !== 'all') {
            $query->where('extension', $request->fileType);
        }

        if ($request->date && $request->date !== 'all') {
            $selectedDate = \Carbon\Carbon::createFromFormat('F - Y', $request->date);
            $query->whereMonth('created_at', $selectedDate->month)
                ->whereYear('created_at', $selectedDate->year);
        }

        if ($request->searchText && $request->searchText !== '') {
            $query->whereAny(['name', 'type', 'size', 'extension', 'title', 'alt', 'caption', 'description'], 'LIKE', '%' . $request->searchText . '%');
        }

        $files = $query->get();

        return view('components.filtered-files')->with('files', $files);
    }

    public function deleteMediaFiles(Request $request)
    {
        $fileIds = $request->input('files');
        foreach ($fileIds as $fileId) {
            $file = Media::findOrFail($fileId);
            if ($file) {
                deleteFiles($file);
                $file->delete();
            }
        }
        return response()->json(['message' => "Files Deleted Successfully"], 200);
    }

}
