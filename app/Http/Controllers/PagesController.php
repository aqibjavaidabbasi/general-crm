<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

use Session;
class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  Alert::warning('Success Title', 'Success Message');
        //
        // $pages = Pages::where('status',1)->orderBy("id","desc")->paginate(10);
        $pages = Pages::orderBy("id","desc")->paginate(10);
        // $pages = Pages::get();
        return view("pages/index", compact("pages"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        //
         return view("pages/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        //
        $data = new Pages();
        $data->category_id = $request->category_id;
        //   $data->user_id = auth()->user()->id;
        //   $data->parent_page = $request->parent_page;
        $data->page_title = $request->page_title;
        $data->page_description = $request->page_description;
        $data->content = $request->content;
        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;
        $data->togle_status = '1';
        $data->published_status = '1';
        $data->featured_image_link = $request->featured_image_link;
        $data->make_homepage = '1';
        $data->visibility = $request->visibility;
        $data->published_date_time = $request->published_date_time;
          $data->status = $request->category_id;
        $data->save();

        Alert::success('Success', 'Page inserted successfully');
        $pages = Pages::get();
        return view("pages/index", compact("pages"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = Pages::find($id);
        return view("pages/edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $data = Pages::find($id);
        $data->category_id = $request->category_id;
        // $data->user_id = auth()->user()->id;
        // $data->parent_page = $request->parent_page;
        $data->page_title = $request->page_title;
        $data->page_description = $request->page_description;
        $data->content = $request->content;
        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;
        $data->togle_status = '1';
        $data->published_status = '1';
        $data->featured_image_link = $request->featured_image_link;
        $data->make_homepage = '1';
        $data->visibility = $request->visibility;
        $data->published_date_time = $request->published_date_time;
        $data->status = $request->category_id;
        $data->save();
        Alert::success('Success', 'Page updated  successfully');
        $pages = Pages::get();
        return view("pages/index", compact("pages"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trash($id)
    {
        //
        $data = Pages::find($id);
        $data->status = 0;
        $data->save();
        return redirect()->route('pages.index');
        // return view('showpage',compact('data'));
    }
    public function destroy(Pages $pages)
    {
        $data = Pages::find($id);
        $data->status = 0;
        $data->delete();
        return redirect()->route('pages.index');
    }
    // image upload using CKEditor
    public function uploadimage(Request $request)
    {

        try {
        if (!$request->hasFile('upload')) {
        throw new \Exception('No file uploaded.');
        }

        $uploadedFile = $request->file('upload');

        if (!$uploadedFile->isValid()) {
        throw new \Exception('Invalid file.');
        }

        // Generate a unique file name
        $fileName = \Illuminate\Support\Str::random(20) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

        // Move the uploaded file to the 'media' directory
        $uploadedFile->move(public_path('media'), $fileName);

        // Generate the URL for the uploaded file
        $url = asset('media/' . $fileName);

        // Log success message
        \Log::info('File uploaded successfully: ' . $url);

        // Return a JSON response with the file information
        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        } catch (\Exception $e) {
        // Log exception message
        \Log::error('Exception: ' . $e->getMessage());

        // Return a JSON response with the error message
        return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // --------------update status
    public function update_status(Request $request,$id,$slug = null)
    {

       $data = Pages::find($id);

       // Determine the new values for make_homepage and published_status based on $slug
       $new_make_homepage = ($slug == 'homepage') ? !$data->make_homepage : !$data->make_homepage;
       $new_published_status = 1;

       // Update the properties
       $data->make_homepage = $new_make_homepage;
       $data->published_status = $new_published_status;

       // Save the changes
       $data->save();

       return redirect()->back()->with('success', 'Status has been updated');
    }
}