<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentSetting;
use App\Http\Requests\UpdateCommentSettingRequest;

class CommentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = CommentSetting::first();
        return view('blog.settings.comment-settings.index', ['settings' => $settings]);
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
    public function update(UpdateCommentSettingRequest $request, CommentSetting $commentSetting)
    {
        // dd($request->validated(), $commentSetting);
        $data = $request->validated();

        $checkboxes = [
            'allow_comments',
            'require_name_email',
            'require_registration',
            'close_comments_for_old_blogs',
            'email_on_comment',
            'moderation',
            'manual_approval',
            'previous_approval',
            'display_avatars',
        ];

        foreach ($checkboxes as $checkbox) {
            if (!isset($data[$checkbox])) {
                $data[$checkbox] = 0;
            }
        }

        if ($commentSetting->update($data)) {
            return response()->json(['message' => 'Settings Updated Successfully', 'settings' => $commentSetting]);
        } else {
            return response()->json(['message' => 'Error Occured While Updating Settings!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
