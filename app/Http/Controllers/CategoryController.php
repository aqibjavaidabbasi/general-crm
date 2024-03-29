<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parentCategory:id,name')
            ->select(['id', 'name', 'status', 'featured', 'parent_id'])->get();

        // dd($categories);
        // $allCount = Category::count();
        // $featuredCount = Category::where('featured', 1)->count();
        // $stats = [
        //     'all_count' => $allCount,
        //     'featured_count' => $featuredCount,
        // ];
        // dd($stats);

        // return view('blog.category.index', ['categories' => $categories,'stats' => $stats]);
        return view('blog.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('position', 0)->get(['id', 'name']);
        return view('blog.category.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['position'] = $validatedData['parent_id'] == null ? 0 : 1;
        if (Category::create($validatedData)) {
            return response()->json(['message' => "Category Created successfully"]);
        } else {
            return response()->json(['message' => "Category Not Created successfully"], 500);
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
    public function edit(Category $category)
    {
        if (!is_null($category)) {
            $category->load('media');
            $categories = Category::where('position', 0)->get(['id', 'name']);
            return view('blog.category.create', compact('category', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();
        $validatedData['position'] = $validatedData['parent_id'] == null ? 0 : 1;

        if ($category->update($validatedData)) {
            return response()->json(['message' => "Category Updated successfully"]);
        } else {
            return response()->json(['message' => "Blog Category Not Updated successfully"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!is_null($category)) {
            if($category->delete()){
                return response()->json(['message' => "Blog Category Deleted"], 200);
            }
        }
        return response()->json(['message' => "Blog Category Not Found"], 404);
    }

    public function massDeleteCategories(Request $request)
    {
        $ids = $request->ids;
        $categories = Category::findOrfail($ids);

        foreach ($categories as $category) {
            $category->delete();
        }
        return response()->json(['message' => "Deleted Successfully"]);
    }

    public function updateStatus(Request $request)
    {
        $categoryId = $request->id;
        $category = Category::findOrFail($categoryId);

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
        $searchText = $request->input('searchText');
        $filter = $request->input('filter');
        $query = Category::query();
        if (empty($searchText)) {
            $query->with('parentCategory')->get();
        } else {
            $query->whereAny(['name', 'description', 'meta_description', 'meta_title'], 'LIKE', '%' . $searchText . '%');
        }

        if (!empty($filter)) {
            if ($filter === 'featured') {
                $query->where('featured', true);
            }
        }
        $categories = $query->get();

        return view('blog.category.filtered-blog_categories')->with(['categories' => $categories]);
    }

}
