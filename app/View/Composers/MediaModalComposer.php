<?php

namespace App\View\Composers;

use App\Models\Media;
use Illuminate\View\View;
use App\Repositories\UserRepository;

class MediaModalComposer
{
    /**
     * Create a new profile composer.
     */


    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $files = Media::with('user:id,name')->get();
        $fileTypes = $files->pluck('extension')->unique();
        $dates = Media::orderBy('created_at')->pluck('created_at')->unique()->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('F - Y');
        })->unique();
        $modalOpenedFlag = false;

        $view->with(['files' => $files, 'fileTypes' => $fileTypes, 'dates' => $dates, 'modalOpenedFlag' => $modalOpenedFlag]);
    }
}
