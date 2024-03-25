<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('blog.tag.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $validatedData = $request->validated();

        if (Tag::create($validatedData)) {
            session()->flash('alert', ['message' => 'Tag Successfully Created', 'type' => 'success']);
            return to_route('tag.index');
        }
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
    public function edit(Tag $tag)
    {
        if(!is_null($tag)){
            return view('blog.tag.create',compact('tag'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $validatedData = $request->validated();

        if ($tag->update($validatedData)) {
            session()->flash('alert', ['message' => 'Tag Successfully Updated', 'type' => 'success']);
            return to_route('tag.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if(!is_null($tag)){
            if($tag->delete()){
                return response()->json(['message' => "Tag has been Deleted"], 200);
            }
        }
    }

    public function searchTags(Request $request)
    {
        $searchText = $request->input('searchText');
        $query = Tag::query();
        if (empty($searchText)) {
            $query->get();
        } else {
            $query->whereAny(['name', 'meta_description', 'meta_title'], 'LIKE', '%' . $searchText . '%');
        }
        $tags = $query->get();

        return view('blog.tag.filtered-tags')->with(['tags' => $tags]);
    }

    public function updateStatus(Request $request)
    {
        $tagId = $request->id;
        $tag = Tag::findOrFail($tagId);

        if (!is_null($tag)) {
            if ($request->has('toggleStatus')) {
                $tag->update(['published' => $request->boolean('toggleStatus')]);
            }

            return response()->json(['message' => 'Status Updated Successfully'], 200);
        }

    }

    public function massDeleteTags(Request $request)
    {
        $ids = $request->ids;
        $tags = Tag::findOrfail($ids);

        foreach ($tags as $category) {
            $category->delete();
        }
        return response()->json(['message' => "Deleted Successfully"]);
    }
}
