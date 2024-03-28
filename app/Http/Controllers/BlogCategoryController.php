<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BlogCategory::with('parentCategory:id,name')
            ->get(['id', 'name', 'status', 'featured', 'parent_id']);


        $allCount = BlogCategory::count();
        $featuredCount = BlogCategory::where('featured', 1)->count();
        $stats = [
            'all_count' => $allCount,
            'featured_count' => $featuredCount,
        ];
        // dd($stats);

        return view('blog.category.index', ['categories' => $categories,'stats' => $stats]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::where('position', 0)->get(['id', 'name']);
        return view('blog.category.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['position'] = $validatedData['parent_id'] == null ? 0 : 1;
        if (BlogCategory::create($validatedData)) {
            return response()->json(['message' => "Blog Category Created successfully"]);
        } else{
            return response()->json(['message' => "Blog Category Not Created successfully"],500);
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
    public function edit(BlogCategory $blogCategory)
    {
        if (!is_null($blogCategory)) {
            $blogCategory->load('media');
            $categories = BlogCategory::where('position', 0)->get(['id', 'name']);
            return view('blog.category.create', compact('blogCategory', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory)
    {
        $validatedData = $request->validated();
        $validatedData['position'] = $validatedData['parent_id'] == null ? 0 : 1;

        if ($blogCategory->update($validatedData)) {
            return response()->json(['message' => "Blog Category Updated successfully"]);
        } else{
            return response()->json(['message' => "Blog Category Not Updated successfully"],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blog_category)
    {
        if ($blog_category) {
            $blog_category->delete();
            return response()->json(['message' => "Blog Category Deleted"], 200);
        }

        return response()->json(['message' => "Blog Category Not Found"], 404);
    }

    public function massDeleteCategories(Request $request)
    {
        $ids = $request->ids;
        $categories = BlogCategory::findOrfail($ids);

        foreach ($categories as $category) {
            $category->delete();
        }
        return response()->json(['message' => "Deleted Successfully"]);
    }

    public function updateStatus(Request $request)
    {
        $categoryId = $request->id;
        $category = BlogCategory::findOrFail($categoryId);

        if (!is_null($category)) {
            if ($request->has('status')) {
                $category->update(['status' => $request->boolean('status')]);
            } else if ($request->has('toggleStatus')) {
                $category->update(['featured' => $request->boolean('toggleStatus')]);
            }

            return response()->json(['message' => 'Status Updated Successfully'], 200);
        }

    }

    public function searchBlogCategories(Request $request)
    {
        // dd($request->all());
        $searchText = $request->input('searchText');
        $filter = $request->input('filter');
        $query = BlogCategory::query();
        if (empty($searchText)) {
            $query->with('parentCategory')->get();
        } else {
            $query->whereAny(['name', 'description', 'meta_description', 'meta_title'], 'LIKE', '%' . $searchText . '%');
        }

        if (!empty($filter)) {
            if ($filter === 'featured') {
                $query->where('featured', true);
        }}
        $categories = $query->get();

        return view('blog.category.filtered-blog_categories')->with(['categories' => $categories]);
    }

}
