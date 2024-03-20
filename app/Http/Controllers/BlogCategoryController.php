<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogCategoryRequest;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BlogCategory::with('parentCategory:id,name')
        ->get(['id', 'name', 'status', 'featured', 'parent_id']);
        // dd($categories);
        return view('blog.category.index',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::where('position',0)->get(['id','name']);
        return view('blog.category.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['position'] = $validatedData['parent_id'] == null ? 0 : 1;

        if(BlogCategory::create($validatedData)){
            return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blog_category)
    {
        if($blog_category){
            $blog_category->delete();
            return response()->json(['message' => "Blog Category Delteed"],200);
        }

        return response()->json(['message' => "Blog Category Not Found"],404);
    }

    public function massDeleteCategories(Request $request)
    {
        $ids = $request->ids;
        $categories = BlogCategory::findOrfail($ids);

        foreach($categories as $category){
            $category->delete();
        }
        return response()->json(['message' => "Deleted Successfully"]);
    }

    public function updateStatus(Request $request)
    {
        $categoryId = $request->id;
        $category = BlogCategory::findOrFail($categoryId);

        if(!is_null($category)){
            if($request->status ){
                $category->update(['status' => $request->status]);
            } else if($request->toggleStatus){
                $category->update(['featured' => $request->toggleStatus]);
            }

            return response()->json(['message' => 'Status Updated Successfully'],200);
        }

    }
}
