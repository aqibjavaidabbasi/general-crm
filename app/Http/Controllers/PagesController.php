<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        //
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