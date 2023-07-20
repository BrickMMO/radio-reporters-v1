<?php

use App\Models\Project;
use App\Models\Segment;
use App\Http\Controllers\InternalSystemsController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReporterRegController;
use App\Http\Controllers\SegmentTypesController;
use App\Http\Controllers\SegmentFieldsController;
use App\Http\Controllers\SubSegmentTypesController;
use App\Http\Controllers\SegmentsController;
use App\Http\Controllers\SegmentFormController;
use App\Http\Controllers\HostsController;
use Illuminate\Support\Facades\Route;



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


/* Routes restrict users who are signed in with a user id of 'reporter' to only access
crud on segments (the dynamically rendered forms) people with admin role can see and edit
all the tables. 
ps people who register via the reporter portal are forced to register with a humbermail.ca account
and are auto assigned the restricted 'reporter' role */

//welcome page segment results

Route::get('/', function () {
    $segments = Segment::latest()->take(3)->get();
    return view('welcome', compact('segments'));
});


Route::get('/project/{project:slug}', function (Project $project) {
    return view('project', [
        'project' => $project,
    ]);
})->where('project', '[A-z\-]+');

Route::get('/console/logout', [ConsoleController::class, 'logout'])->middleware('auth');
Route::get('/console/login', [ConsoleController::class, 'loginForm'])->middleware('guest');
Route::post('/console/login', [ConsoleController::class, 'login'])->middleware('guest');
Route::get('/console/dashboard', [ConsoleController::class, 'dashboard'])->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/console/segment_forms/list', [SegmentFormController::class, 'list'])->name('segment_forms.list');
    Route::get('/console/segment_forms/add', [SegmentFormController::class, 'addForm'])->name('segment_forms.add')->middleware('auth');
    Route::post('/console/segment_forms/store', [SegmentFormController::class, 'store'])->name('segment_forms.store')->middleware('auth');

    Route::get('/console/segment_forms/edit/{segment}', [SegmentFormController::class, 'editForm'])->name('segment_forms.edit_form')
        ->where('segment', '[0-9]+')
        ->middleware('auth');
    Route::post('/console/segment_forms/edit/{segment}', [SegmentFormController::class, 'edit'])->name('segment_forms.edit')
        ->where('segment', '[0-9]+')
        ->middleware('auth');
    Route::get('/console/segment_forms/delete/{segment:id}', [SegmentFormController::class, 'delete'])->name('segment_forms.delete')
        ->where('segment', '[0-9]+')
        ->middleware('auth');
    Route::get('/console/segment_forms/image/{segment:id}', [SegmentFormController::class, 'imageForm'])->name('segment_forms.image_form')
        ->where('segment', '[0-9]+')
        ->middleware('auth');
    Route::post('/console/segment_forms/image/{segment:id}', [SegmentFormController::class, 'image'])->name('segment_forms.image')
        ->where('segment', '[0-9]+')
        ->middleware('auth');
});

    //reporter user registration

    Route::get('/console/reporter_reg', function () {
        return view('console.reporter_reg');
    });

    Route::post('/console/reporter/add', [ReporterRegController::class, 'add']);

  // Routes that should be restricted for "Reporter" role users

    Route::group(['middleware' => 'restrict.reporter'], function () {
      
    Route::get('/console/segments/list', [SegmentsController::class, 'list'])->middleware('auth'); 
    Route::get('/console/segments/add', [SegmentsController::class, 'addForm'])->middleware('auth');
    Route::post('/console/segments/add', [SegmentsController::class, 'add'])->middleware('auth');
    Route::get('/console/segments/edit/{segment:id}', [SegmentsController::class, 'editForm'])->where('segment', '[0-9]+')->middleware('auth');
    Route::post('/console/segments/edit/{segment:id}', [SegmentsController::class, 'edit'])->where('segment', '[0-9]+')->middleware('auth');
    Route::get('/console/segments/delete/{segment:id}', [SegmentsController::class, 'delete'])->where('segment', '[0-9]+')->middleware('auth');
    Route::get('/console/segments/image/{segment:id}', [SegmentsController::class, 'imageForm'])->where('segment', '[0-9]+')->middleware('auth');
    Route::post('/console/segments/image/{segment:id}', [SegmentsController::class, 'image'])->where('segment', '[0-9]+')->middleware('auth');

    Route::get('/console/hosts/list', [HostsController::class, 'list'])->middleware('auth'); 
    Route::get('/console/hosts/add', [HostsController::class, 'addForm'])->middleware('auth');
    Route::post('/console/hosts/add', [HostsController::class, 'add'])->middleware('auth');
    Route::get('/console/hosts/edit/{host:id}', [HostsController::class, 'editForm'])->where('host', '[0-9]+')->middleware('auth');
    Route::post('/console/hosts/edit/{host:id}', [HostsController::class, 'edit'])->where('host', '[0-9]+')->middleware('auth');
    Route::get('/console/hosts/delete/{host:id}', [HostsController::class, 'delete'])->where('host', '[0-9]+')->middleware('auth');
    Route::get('/console/hosts/image/{host:id}', [HostsController::class, 'imageForm'])->where('host', '[0-9]+')->middleware('auth');
    Route::post('/console/hosts/image/{host:id}', [HostsController::class, 'image'])->where('host', '[0-9]+')->middleware('auth');
        
    Route::get('/console/projects/list', [ProjectsController::class, 'list'])->middleware('auth');
    Route::get('/console/projects/add', [ProjectsController::class, 'addForm'])->middleware('auth');
    Route::post('/console/projects/add', [ProjectsController::class, 'add'])->middleware('auth');
    Route::get('/console/projects/edit/{project:id}', [ProjectsController::class, 'editForm'])->where('project', '[0-9]+')->middleware('auth');
    Route::post('/console/projects/edit/{project:id}', [ProjectsController::class, 'edit'])->where('project', '[0-9]+')->middleware('auth');
    Route::get('/console/projects/delete/{project:id}', [ProjectsController::class, 'delete'])->where('project', '[0-9]+')->middleware('auth');
    Route::get('/console/projects/image/{project:id}', [ProjectsController::class, 'imageForm'])->where('project', '[0-9]+')->middleware('auth');
    Route::post('/console/projects/image/{project:id}', [ProjectsController::class, 'image'])->where('project', '[0-9]+')->middleware('auth');

    Route::get('/console/users/list', [UsersController::class, 'list'])->middleware('auth');
    Route::get('/console/users/add', [UsersController::class, 'addForm'])->middleware('auth');
    Route::post('/console/users/add', [UsersController::class, 'add'])->middleware('auth');
    Route::get('/console/users/edit/{user:id}', [UsersController::class, 'editForm'])->where('user', '[0-9]+')->middleware('auth');
    Route::post('/console/users/edit/{user:id}', [UsersController::class, 'edit'])->where('user', '[0-9]+')->middleware('auth');
    Route::get('/console/users/delete/{user:id}', [UsersController::class, 'delete'])->where('user', '[0-9]+')->middleware('auth');

    Route::get('/console/types/list', [TypesController::class, 'list'])->middleware('auth');
    Route::get('/console/types/add', [TypesController::class, 'addForm'])->middleware('auth');
    Route::post('/console/types/add', [TypesController::class, 'add'])->middleware('auth');
    Route::get('/console/types/edit/{type:id}', [TypesController::class, 'editForm'])->where('type', '[0-9]+')->middleware('auth');
    Route::post('/console/types/edit/{type:id}', [TypesController::class, 'edit'])->where('type', '[0-9]+')->middleware('auth');
    Route::get('/console/types/delete/{type:id}', [TypesController::class, 'delete'])->where('type', '[0-9]+')->middleware('auth');

    Route::get('/console/segment_types/list', [SegmentTypesController::class, 'list'])->middleware('auth'); 
    Route::get('/console/segment_types/add', [SegmentTypesController::class, 'addForm'])->middleware('auth');
    Route::post('/console/segment_types/add', [SegmentTypesController::class, 'add'])->middleware('auth');
    Route::get('/console/segment_types/edit/{segment_type:id}', [SegmentTypesController::class, 'editForm'])->where('segment_type', '[0-9]+')->middleware('auth');
    Route::post('/console/segment_types/edit/{segment_type:id}', [SegmentTypesController::class, 'edit'])->where('segment_type', '[0-9]+')->middleware('auth');
    Route::get('/console/segment_types/delete/{segment_type:id}', [SegmentTypesController::class, 'delete'])->where('segment_type', '[0-9]+')->middleware('auth');

    Route::get('/console/segment_fields/list', [SegmentFieldsController::class, 'list'])->middleware('auth'); 
    Route::get('/console/segment_fields/add', [SegmentFieldsController::class, 'addForm'])->middleware('auth');
    Route::post('/console/segment_fields/add', [SegmentFieldsController::class, 'add'])->middleware('auth');
    Route::get('/console/segment_fields/edit/{segment_field:id}', [SegmentFieldsController::class, 'editForm'])->where('segment_field', '[0-9]+')->middleware('auth');
    Route::post('/console/segment_fields/edit/{segment_field:id}', [SegmentFieldsController::class, 'edit'])->where('segment_field', '[0-9]+')->middleware('auth');
    Route::get('/console/segment_fields/delete/{segment_field:id}', [SegmentFieldsController::class, 'delete'])->where('segment_field', '[0-9]+')->middleware('auth');

    Route::get('/console/sub_segment_types/list', [SubSegmentTypesController::class, 'list'])->middleware('auth'); 
    Route::get('/console/sub_segment_types/add', [SubSegmentTypesController::class, 'addForm'])->middleware('auth');
    Route::post('/console/sub_segment_types/add', [SubSegmentTypesController::class, 'add'])->middleware('auth');
    Route::get('/console/sub_segment_types/edit/{sub_segment_type:id}', [SubSegmentTypesController::class, 'editForm'])->where('sub_segment_type', '[0-9]+')->middleware('auth');
    Route::post('/console/sub_segment_types/edit/{sub_segment_type:id}', [SubSegmentTypesController::class, 'edit'])->where('sub_segment_type', '[0-9]+')->middleware('auth');
    Route::get('/console/sub_segment_types/delete/{sub_segment_type:id}', [SubSegmentTypesController::class, 'delete'])->where('sub_segment_type', '[0-9]+')->middleware('auth');

    Route::get('/console/internal_systems/list', [InternalSystemsController::class, 'list'])->middleware('auth'); 
    Route::get('/console/internal_systems/add', [InternalSystemsController::class, 'addForm'])->middleware('auth');
    Route::post('/console/internal_systems/add', [InternalSystemsController::class, 'add'])->middleware('auth');
    Route::get('/console/internal_systems/edit/{internal_system:id}', [InternalSystemsController::class, 'editForm'])->where('internal_system', '[0-9]+')->middleware('auth');
    Route::post('/console/internal_systems/edit/{internal_system:id}', [InternalSystemsController::class, 'edit'])->where('internal_system', '[0-9]+')->middleware('auth');
    Route::get('/console/internal_systems/delete/{internal_system:id}', [InternalSystemsController::class, 'delete'])->where('internal_system', '[0-9]+')->middleware('auth');
    Route::get('/console/internal_systems/image/{internal_system:id}', [InternalSystemsController::class, 'imageForm'])->where('internal_system', '[0-9]+')->middleware('auth');
    Route::post('/console/internal_systems/image/{internal_system:id}', [InternalSystemsController::class, 'image'])->where('internal_system', '[0-9]+')->middleware('auth');
    
    });
    







