<?php


use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\{BlogCategoryController,PagesController, TagController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('auth.login');
});
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('home');
        Route::resource('media', MediaController::class);
        Route::post('media/destroy', [MediaController::class, 'deleteMediaFiles'])->name('admin.media.delete');
        Route::post('check-file', [MediaController::class, 'checkExistingFile'])->name('admin.check-file');
        Route::post('delete-existing-file', [MediaController::class, 'deleteExistingFile'])->name('admin.delete-existing-file');
        Route::get('filter-files', [MediaController::class, 'filterFiles'])->name('admin.filter-file');

        Route::get('profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
        Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::prefix('blog')->group(function () {
            Route::resource('add-blog', BlogController::class);
            Route::resource('blog-category', BlogCategoryController::class);
            Route::post('blog-category/delete', [BlogCategoryController::class, 'massDeleteCategories'])->name('blog.category.mass-delete');
            Route::post('blog-category/update-status', [BlogCategoryController::class, 'updateStatus'])->name('blog.category.update-status');
            Route::post('blog-category/search-blog-categories', [BlogCategoryController::class, 'searchBlogCategories'])->name('blog.category.search-blog-categories');

            // Tags Routes

            Route::resource('tag',TagController::class);
            Route::post('tag/search-tags', [TagController::class, 'searchTags'])->name('blog.tag.search-tags');
            Route::post('tag/delete', [TagController::class, 'massDeleteTags'])->name('blog.tag.mass-delete');
            Route::post('tag/update-status', [TagController::class, 'updateStatus'])->name('blog.tag.update-status');

        });
        Route::post('save-theme-preference', [ProfileController::class, 'saveTheme'])->name('theme.save');
        Route::get('blog/category/{slug}',[BlogController::class,'getBlogByCategory'])->name('blog-by-category');
        Route::get('blog/tag/{slug}',[BlogController::class,'getBlogByCategory'])->name('blog-by-tag');
    });
});

Auth::routes(['register' => false]);


Route::resource('pages',PagesController::class);
Route::get('pages/makehomepage/{id}/{slug?}',[PagesController::class,'update_status'])->name('pages.update-status');

