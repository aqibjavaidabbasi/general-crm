<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('media:id,url','author:id,name','categories')->get();

        return view('blog.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get(['id', 'name']);
        $parentCategories = Category::where('position', 0)
            ->where('status', 1)->get(['id', 'name']);
        $tags = Tag::where('published', 1)->get(['id', 'name']);
        return view('blog.create', compact('categories', 'parentCategories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        $content = $validatedData['content'];

        if (!is_null($content)) {

            $dom = new \DomDocument();
            $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');
            if (!is_null($images)) {

                foreach ($images as $key => $img) {
                    $src = $img->getAttribute('src');
                    if (strpos($src, 'http') === 0) {
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $src);
                    } else {
                        $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                        $image_name = time() . $key . '.png';

                        $currentYear = date('Y');
                        $currentMonth = date('m');
                        $blogName = str_replace(' ', '_', $validatedData['name']);
                        $directory = "$currentYear/{$currentMonth}/blog-images/{$blogName}";

                        if (!Storage::exists($directory)) {
                            Storage::makeDirectory($directory);
                        }
                        Storage::put("{$directory}/{$image_name}", $data);

                        $img->removeAttribute('src');
                        $img->setAttribute('src', "/storage/{$currentYear}/{$currentMonth}/blog-images/{$blogName}/{$image_name}");
                    }
                }
            }
            $validatedData['content'] = $dom->saveHTML();
        }

        if(is_null($validatedData['published_date_time'])){
            $validatedData['published_date_time'] = now();
        }

        if(is_null($validatedData['protection-password'])) {
            if($validatedData['visibility'] == 'Public') {
                if(isset($validatedData['front-page-blog']) && $validatedData['front-page-blog'] == 'on'){
                    $validatedData['front_page_blog'] = true;
                }
                $validatedData['visibility'] = 'public';
            } else if($validatedData['visibility'] == 'Private'){
                $validatedData['visibility'] = 'private';
            }
        } else if($validatedData['visibility'] == 'Password Protected' && !is_null($validatedData['protection-password']) ){
            $validatedData['visibility'] = 'password-protected';
            $validatedData['protection_password'] = bcrypt($validatedData['protection-password']);
        }

        if(!is_null($validatedData['blog-media-id'])){
            $validatedData['blog_media_id'] = $validatedData['blog-media-id'];
        }
        $validatedData['user_id'] = Auth::user()->id;
        $blog = Blog::create($validatedData);
        if (!is_null($blog)) {
            if(isset($validatedData['category_ids']) && !is_null($validatedData['category_ids'])){
                $categories = $validatedData['category_ids'];
                foreach($categories as $category){
                    BlogCategory::create(['category_id' => $category, 'blog_id' => $blog->id]);
                }
            }
            return response()->json(['message' => 'Blog Created Successfully!'], 200);
        }

        return response()->json(['message' => 'Error Occurred While Creating Blog!'], 500);


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
    public function destroy(Blog $blog)
    {
        dd($blog);
        if (!is_null($blog)) {
            if($blog->delete()){
                return response()->json(['message' => "Blog Deleted Successfilly"], 200);
            }
        }
        return response()->json(['message' => "Blog Not Found"], 404);
    }

    public function getBlogByCategory($slug)
    {
        dd("Have To Design Page For User");
    }

    public function searchBlogs(Request $request)
    {
        // dd($request->all());
        $searchText = $request->input('searchText');
        $filter = $request->input('filter');
        $query = Blog::query();
        // if (empty($searchText)) {
        //     $query->with('parentCategory')->get();
        // } else {
        //     $query->whereAny(['name', 'description', 'meta_description', 'meta_title'], 'LIKE', '%' . $searchText . '%');
        // }
        // if (empty($searchText)) {
        //     $query->with('parentCategory')->get();
        // } else {
        //     $query->whereAny(['name', 'description', 'meta_description', 'meta_title'], 'LIKE', '%' . $searchText . '%');
        // }

        if (!empty($filter)) {
            if ($filter === 'featured') {
                $query->where('featured', true);
        }}
        $blogs = $query->with('author')->get();
        dd($blogs);

        return view('blog.filtered-blog')->with(['blogs' => $blogs]);
    }

    public function updateFeaturedStatus(Request $request)
    {
        $blogId = $request->id;
        $blog = Blog::findOrFail($blogId);

        if (!is_null($blog)) {
            if ($request->has('toggleStatus')) {
                $blog->update(['featured' => $request->boolean('toggleStatus')]);
            }

            return response()->json(['message' => 'Status Updated Successfully'], 200);
        }

    }
}
