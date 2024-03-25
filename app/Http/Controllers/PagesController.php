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
        // $pages = Pages::orderBy("id","desc")->paginate(10);
        $pages = Pages::get();
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
        //   $data->status = $request->category_id;
        $data->save();
        return redirect()->back()
        ->with('success', 'Created successfully s s s s!');

        //  Alert::warning('Success Title', 'Success qwerty');
        //  $pages = Pages::get();
        //   return view("pages/index", compact("pages"));

    }

    /**
     * Display the specified resource.
     */
    public function show(Pages $pages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pages $pages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pages $pages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pages $pages)
    {
        //
    }
    // image upload
    public function uploadimage(Request $request)
    {

       if($request->hasFile('upload')){
       $originName = $request->file('upload')->getClientOrigninalName();
       $fileName = pathinfo($originName,PATHINFO_FILENAME);
       $extension = $request->file('upload')->getClientOriginalExtension();
       $fileName = $fileName .'_'. time() .'.'. $extension;
       $request->file('upload')->move(public_path('media'),$fileName);
       $url = asset('media/' . $fileName);
       return response()->json(['fileName'=>$fileName,'uploaded'=>1,'url'=>$url]);
       }
    }
    // --------------update status
    public function update_status(Request $request,$id,$slug = null)
    {
        // dd("yo zan or bal slug",$id,$slug);
        if($slug == 'homepage')
        {
            $data = Pages::find($id);
            if($data->make_homepage == 1)
            {
                $data->make_homepage = 0;
            }else{
                $data->make_homepage = 1;
            }
            $data->save();
        }
        return redirect()->back()->with('success','Status has been updated');
    }
}