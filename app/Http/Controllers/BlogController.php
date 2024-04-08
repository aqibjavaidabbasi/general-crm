<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('permission:show_blog', ['only' => ['index', 'searchBlogs']]);
        $this->middleware('permission:create_blog', ['only' => ['store', 'create']]);
        $this->middleware('permission:edit_blog', ['only' => ['edit', 'update', 'updateFeaturedStatus']]);
        $this->middleware('permission:delete_media', ['only' => ['destroy', 'massDeleteBlogs']]);
    }

    public function index()
    {
        $blogs = Blog::with('media:id,url', 'author:id,name', 'categories')->get();

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

        if (is_null($validatedData['published_date_time'])) {
            $validatedData['published_date_time'] = now();
        }

        // dd($validatedData['published_date_time']->format('d-m-Y h:i A'));

        if (is_null($validatedData['protection-password'])) {
            if ($validatedData['visibility'] == 'Public') {
                if (isset($validatedData['front-page-blog']) && $validatedData['front-page-blog'] == 'on') {
                    $validatedData['front_page_blog'] = true;
                }
                $validatedData['visibility'] = 'public';
            } else if ($validatedData['visibility'] == 'Private') {
                $validatedData['visibility'] = 'private';
            }
        } else if ($validatedData['visibility'] == 'Password Protected' && !is_null($validatedData['protection-password'])) {
            $validatedData['visibility'] = 'password-protected';
            $validatedData['protection_password'] = bcrypt($validatedData['protection-password']);
        }
        $validatedData['user_id'] = Auth::user()->id;
        $blog = Blog::create($validatedData);
        if (!is_null($blog)) {
            if (isset($validatedData['category_ids']) && !is_null($validatedData['category_ids'])) {
                $categories = $validatedData['category_ids'];
                foreach ($categories as $category) {
                    BlogCategory::create(['category_id' => $category, 'blog_id' => $blog->id]);
                }
            }

            if (isset($validatedData['tag_ids']) && !is_null($validatedData['tag_ids'])) {
                $tags = $validatedData['tag_ids'];
                foreach ($tags as $tag) {
                    BlogTag::create(['tag_id' => $tag, 'blog_id' => $blog->id]);
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
    public function edit(Blog $addBlog)
    {
        if (!is_null($addBlog)) {

            $addBlog->load(['media:id,url', 'author:id,name', 'categories:id,name', 'tags:id,name']);
            $categories = Category::where('status', 1)->get(['id', 'name']);
            $parentCategories = Category::where('position', 0)
                ->where('status', 1)->get(['id', 'name']);
            $tags = Tag::where('published', 1)->get(['id', 'name']);

            return view('blog.create', compact('addBlog', 'categories', 'parentCategories', 'tags'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $addBlog)
    {
        $validatedData = $request->validated();
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
                        $srcParts = explode(';', $src);
                        if (count($srcParts) > 1) {
                            $dataParts = explode(',', $srcParts[1]);
                            if (count($dataParts) > 1) {
                                $data = base64_decode($dataParts[1]);
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
                }
            }
            $validatedData['content'] = $dom->saveHTML();
        }

        if (is_null($validatedData['published_date_time'])) {
            $validatedData['published_date_time'] = now();
        }

        if (is_null($validatedData['protection-password'])) {
            if ($validatedData['visibility'] == 'Public') {
                if (isset($validatedData['front-page-blog']) && $validatedData['front-page-blog'] == 'on') {
                    $validatedData['front_page_blog'] = true;
                }
                $validatedData['visibility'] = 'public';
            } else if ($validatedData['visibility'] == 'Private') {
                $validatedData['visibility'] = 'private';
            }
        } else if ($validatedData['visibility'] == 'Password Protected' && !is_null($validatedData['protection-password'])) {
            $validatedData['visibility'] = 'password-protected';
            $validatedData['protection_password'] = bcrypt($validatedData['protection-password']);
        }
        $validatedData['user_id'] = Auth::user()->id;

        $addBlog->update($validatedData);

        if (isset($validatedData['category_ids'])) {
            $addBlog->categories()->sync($validatedData['category_ids']);
        }

        if (isset($validatedData['tag_ids'])) {
            $addBlog->tags()->sync($validatedData['tag_ids']);
        }

        return response()->json(['message' => 'Blog Updated Successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $addBlog)
    {
        if (!is_null($addBlog)) {
            if ($addBlog->delete()) {
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
        $filter = $request->input('filter');
        $query = Blog::query();

        if (!empty($filter)) {
            if ($filter === 'featured') {
                $query->where('featured', true);
            } elseif ($filter === 'draft') {
                $query->where('status', 'draft');
            } elseif ($filter === 'pending') {
                $query->where('status', 'pending');
            } elseif ($filter === 'scheduled') {
                $query->where('status', 'scheduled');
            } elseif ($filter === 'mine') {
                $query->where('user_id', Auth::user()->id);
            } elseif ($filter === 'published') {
                $query->where('status', 'published');
            }

        }
        $blogs = $query->with('author')->get();

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

    public function massDeleteBlogs(Request $request)
    {
        $ids = $request->ids;
        $categories = Blog::findOrfail($ids);

        foreach ($categories as $category) {
            $category->delete();
        }
        return response()->json(['message' => "Deleted Successfully"]);
    }
}
