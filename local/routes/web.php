<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('/')->group(function () {
    Route::name('site.')->group(function () {
        Route::get('/', [
            'uses'  =>  'MainController@home',
            'as'    =>  'home'
        ]);
        Route::get('/students', [
            'uses'  =>  'MainController@students',
            'as'    =>  'students'
        ]);
        Route::get('/lecturers', [
            'uses'  =>  'MainController@lecturers',
            'as'    =>  'lecturers'
        ]);
        Route::get('/customers', [
            'uses'  =>  'MainController@customers',
            'as'    =>  'customers'
        ]);
        Route::get('/library', [
            'uses'  =>  'DownloadController@index',
            'as'    =>  'downloads.index'
        ]);
        Route::get('/library/{id}-{title}', [
            'uses'  =>  'DownloadController@show',
            'as'    =>  'downloads.show'
        ]);
        Route::get('/library/cat/{slug}', [
            'uses'  =>  'DownloadController@category',
            'as'    =>  'downloads.category'
        ]);
        Route::post('/library/download', [
            'uses'  =>  'DownloadController@download',
            'as'    =>  'downloads.file'
        ]);
        Route::get('/articles', [
            'uses'  =>  'ArticleController@index',
            'as'    =>  'articles.index'
        ]);
        Route::get('/articles/{id}-{title}', [
            'uses'  =>  'ArticleController@show',
            'as'    =>  'articles.show'
        ]);
        Route::get('/articles/cat/{slug}', [
            'uses'  =>  'ArticleController@category',
            'as'    =>  'articles.category'
        ]);
        Route::get('/testimonials', [
            'uses'  =>  'TestimonialController@index',
            'as'    =>  'testimonials.index'
        ]);
        Route::get('/testimonials/{id}', [
            'uses'  =>  'TestimonialController@show',
            'as'    =>  'testimonials.show'
        ]);
        Route::get('/news', [
            'uses'  =>  'NewsController@index',
            'as'    =>  'news.index'
        ]);
        Route::get('/news/{id}-{title}', [
            'uses'  =>  'NewsController@show',
            'as'    =>  'news.show'
        ]);
        Route::get('/courses', [
            'uses'  =>  'CourseController@index',
            'as'    =>  'courses.index'
        ]);
        Route::get('/courses/all', [
            'uses'  =>  'CourseController@all',
            'as'    =>  'courses.all'
        ]);
        Route::get('/courses/search', [
            'uses'  =>  'CourseController@search',
            'as'    =>  'courses.search'
        ]);
        Route::get('/courses/department/{slug}', [
            'uses'  =>  'CourseController@department',
            'as'    =>  'courses.department'
        ]);
        Route::get('/courses/{slug}', [
            'uses'  =>  'CourseController@show',
            'as'    =>  'courses.show'
        ]);
        Route::get('/jobs', [
            'uses'  =>  'JobController@index',
            'as'    =>  'jobs.index'
        ]);
        Route::get('/jobs/cat/{slug}', [
            'uses'  =>  'JobController@category',
            'as'    =>  'jobs.category'
        ]);
        Route::get('/jobs/{id}-{title}', [
            'uses'  =>  'JobController@show',
            'as'    =>  'jobs.show'
        ]);
        Route::get('/about', [
            'uses'  =>  'MainController@about',
            'as'    =>  'about'
        ]);
        Route::get('/contact', [
            'uses'  =>  'MainController@contact',
            'as'    =>  'contact'
        ]);
        Route::get('/about', [
            'uses'  =>  'MainController@about',
            'as'    =>  'about'
        ]);
        Route::get('/about/{slug}', [
            'uses'  =>  'MainController@aboutin',
            'as'    =>  'aboutin'
        ]);
        Route::get('/search', [
            'uses'  =>  'SearchController@search',
            'as'    =>  'search'
        ]);
        Route::get('/oldcourses', [
            'uses'  =>  'OldCourseController@index',
            'as'    =>  'oldcourses.index'
        ]);
        Route::get('/oldcourses/search', [
            'uses'  =>  'OldCourseController@search',
            'as'    =>  'oldcourses.search'
        ]);
        Route::get('/page/{slug}', [
            'uses'  =>  'PageController@show',
            'as'    =>  'page'
        ]);
        Route::post('/advice', [
            'uses'  =>  'MainController@advice',
            'as'    =>  'advice'
        ]);
        Route::post('/contact', [
            'uses'  =>  'MainController@message',
            'as'    =>  'message'
        ]);
        Route::get('/moshavere', [
            'uses'  =>  'MainController@moshavere',
            'as'    =>  'moshavere',
        ]);
        Route::post('/moshavere', [
            'uses'  =>  'MainController@moshavereSubmit',
            'as'    =>  'moshavere.submit',
        ]);
        Route::get('/insta', [
            'uses'  =>  'MainController@insta',
            'as'    =>  'insta',
        ]);
        Route::post('/insta', [
            'uses'  =>  'MainController@instaSubmit',
            'as'    =>  'insta.submit',
        ]);
        Route::get('/karbaran', [
            'uses'  =>  'SignalController@karbaran',
            'as'    =>  'signal.login',
        ]);
        Route::post('/karbaran', [
            'uses'  =>  'SignalController@cheked',
            'as'    =>  'signal.store',
        ]);
        Route::get('/signal', [
            'uses'  =>  'SignalController@create',
            'as'    =>  'signal.create',
        ]);
        Route::post('/signal', [
            'uses'  =>  'SignalController@signal',
            'as'    =>  'signal.sabt',
        ]);
        Route::get('/signal-list', [
            'uses'  =>  'SignalController@list',
            'as'    =>  'signal.list',
        ]);
        Route::post('/area-ajax', [
            'uses'  => 'Admin\KarbaranController@jsonarealist',
            'as'    =>  'area.jsonlist'
        ]);
        Route::get('/signal-moshaver/{id?}', [
            'uses'  =>  'SignalController@moshaver',
            'as'    =>  'signal.moshaver',
        ]);
        Route::post('/signal-moshaver', [
            'uses'  =>  'SignalController@sabtmoshaver',
            'as'    =>  'signal.moshaver.sabt',
        ]);
        Route::post('/signal-olduser', [
            'uses'  =>  'SignalController@olduser',
            'as'    =>  'signal.olduser',
        ]);
        Route::post('/signal-oldsignals', [
            'uses'  =>  'SignalController@oldsignals',
            'as'    =>  'signal.oldsignals',
        ]);
        Route::get('/amar', [
            'uses'  =>  'SignalController@amar',
            'as'    =>  'signal.amar',
        ]);
        Route::get('/amarkarbaran', [
            'uses'  =>  'SignalController@amarkarbaran',
            'as'    =>  'signal.amar.karbaran',
        ]);
        Route::post('/ajaxmoshavereh', [
            'uses'  =>  'SignalController@ajaxMoshaver',
            'as'    =>  'signal.ajax.moshaver',
        ]);
        Route::post('/single-date', [
            'uses'  =>  'SignalController@singleDate',
            'as'    =>  'signal.ajax.single.date',
        ]);
        Route::post('/single-date-fromto', [
            'uses'  =>  'SignalController@singleDateFromto',
            'as'    =>  'signal.ajax.single.date.fromto',
        ]);
    });
});

Route::prefix('/panel')->group(function() {
    Route::name('admin.')->group(function() {
        Route::get('/', [
            'uses'  =>  'Admin\AdminController@dashboard',
            'as'    =>  'dashboard'
        ])->middleware('auth');
        Route::resource('/menu', 'Admin\MenuController')->middleware('auth');
        Route::resource('/students', 'Admin\StudentController')->middleware('auth');
        Route::resource('/lecturers', 'Admin\LecturerController')->middleware('auth');
        Route::resource('/customers', 'Admin\CustomerController')->middleware('auth');
        Route::resource('/downloads', 'Admin\DownloadController')->middleware('auth');
        Route::resource('/downloadscat', 'Admin\DownloadCatController')->middleware('auth');
        Route::resource('/articles', 'Admin\ArticleController')->middleware('auth');
        Route::resource('/articlescat', 'Admin\ArticleCatController')->middleware('auth');
        Route::resource('/testimonials', 'Admin\TestimonialController')->middleware('auth');
        Route::resource('/abouts', 'Admin\AboutController')->middleware('auth');
        Route::resource('/messages', 'Admin\MessageController')->middleware('auth');
        Route::resource('/departments', 'Admin\DepartmentController')->middleware('auth');
        Route::resource('/courses', 'Admin\CourseController')->middleware('auth');
        Route::resource('/news', 'Admin\NewsController')->middleware('auth');
        Route::resource('/jobs', 'Admin\JobController')->middleware('auth');
        Route::resource('/jobscat', 'Admin\JobCatController')->middleware('auth');
        Route::resource('/newsletters', 'Admin\NewsletterController')->middleware('auth');
        Route::resource('/oldcourses', 'Admin\OldCourseController')->middleware('auth');
        Route::resource('/sliders', 'Admin\SliderController')->middleware('auth');
        Route::resource('/settings', 'Admin\SettingController')->middleware('auth');
        Route::resource('/numbers', 'Admin\NumberController')->middleware('auth');
        Route::resource('/seo', 'Admin\SeoController')->middleware('auth');
        Route::resource('/user', 'Admin\UserController')->middleware('auth');
        Route::resource('/banner', 'Admin\BannerController')->middleware('auth');
        Route::resource('/pages', 'Admin\PageController')->middleware('auth');
        Route::resource('/methods', 'Admin\MethodController')->middleware('auth');
        Route::resource('/favs', 'Admin\FavController')->middleware('auth');

        Route::resource('/moshaveres', 'Admin\MoshavereController')->middleware('auth');
        Route::resource('/karbaran', 'Admin\KarbaranController')->middleware('auth');
        Route::resource('/ashnaee', 'Admin\ashnaeeController')->middleware('auth');
        Route::resource('/sarnakh', 'Admin\sarnakhController')->middleware('auth');
        Route::post('/oldkarbar',[
            'uses'  => 'Admin\KarbaranController@oldKarbar',
            'as'    => 'karbal.old',
        ])->middleware('auth');
        Route::resource("/doreha",'Admin\DorehaController')->middleware('auth');
        Route::get('/area', [
            'uses'  => 'Admin\KarbaranController@arealist',
            'as'    =>  'area.list'
            ])->middleware('auth');
        Route::post('/area', [
            'uses'  => 'Admin\KarbaranController@areacreate',
            'as'    =>  'area.store'
            ])->middleware('auth');
        Route::put('/area/{id}', [
            'uses'  => 'Admin\KarbaranController@areaupdate',
            'as'    =>  'area.update'
        ])->middleware('auth');
        Route::delete('/areadelete/{id}', [
            'uses'  => 'Admin\KarbaranController@areadelete',
            'as'    =>  'area.delete'
        ])->middleware('auth');
        Route::post('/area-ajax', [
            'uses'  => 'Admin\KarbaranController@jsonarealist',
            'as'    =>  'area.jsonlist'
        ])->middleware('auth');
        Route::get('/signal-list',[
            'uses'  => 'Admin\KarbaranController@signallist',
            'as'    =>  'signal.list'
            ])->middleware('auth');
            
        Route::post('/signal-list',[
            'uses'  => 'Admin\KarbaranController@signalliststore',
            'as'    =>  'signal.list.store'
            ])->middleware('auth');
        Route::get('/signal-list/edit',[
            'uses'  => 'Admin\KarbaranController@signallistedit',
            'as'    =>  'signal.list.edit'
            ])->middleware('auth');
        Route::put('/signal-list/update/{id}',[
            'uses'  => 'Admin\KarbaranController@signallistupdate',
            'as'    =>  'signal.list.update'
            ])->middleware('auth');

        Route::delete('/signal-list/delete/{id}',[
            'uses'  => 'Admin\KarbaranController@signallistdelete',
            'as'    =>  'signal.list.delete'
            ])->middleware('auth');


    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
});


Route::auth();
