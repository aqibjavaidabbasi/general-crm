<?php

namespace App\Http\Controllers;

use App\Models\ShareOption;
use Illuminate\Http\Request;

class ShareOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shareOptions = ShareOption::all();
        return view('blog.settings.share-options.index', ['shareOptions' => $shareOptions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, ShareOption $blogShareOption)
    {
        if (!is_null($blogShareOption)) {
            if ($request->has('toggleStatus')) {
                $blogShareOption->update(['status' => $request->boolean('toggleStatus')]);
            }

            return response()->json(['message' => 'Status Updated Successfully'], 200);
        }

        return response()->json(['message' => 'Some Error Occured While Updating Status'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
