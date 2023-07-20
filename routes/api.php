<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Type;
use App\Models\Segment;
use App\Models\Host;
use App\Models\User;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Retrieve the authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Retrieve all types
Route::get('/types', function(){
    $types = Type::orderBy('title')->get();
    return $types;
});

// Retrieve all hosts
Route::get('/hosts', function(){
    $hosts = Host::orderBy('name')->get();
    return $hosts;
});

// Retrieve all segments
Route::get('/segments', function(){
    $segments = Segment::orderBy('created_at')->get();
    return $segments;
});

// Retrieve all projects
Route::get('/projects', function(){
    $projects = Project::orderBy('created_at')->get();

    foreach($projects as $key => $project)
    {
        // Retrieve the associated user and type for each project
        $projects[$key]['user'] = User::where('id', $project['user_id'])->first();
        $projects[$key]['type'] = Type::where('id', $project['type_id'])->first();

        // If the project has an image, construct the full image URL
        if($project['image'])
        {
            $projects[$key]['image'] = env('APP_URL').'storage/'.$project['image'];
        }
    }

    return $projects;
});

// Retrieve a specific project's profile
Route::get('/projects/profile/{project?}', function(Project $project){
    // Retrieve the associated user and type for the project
    $project['user'] = User::where('id', $project['user_id'])->first();
    $project['type'] = Type::where('id', $project['type_id'])->first();

    // If the project has an image, construct the full image URL
    if($project['image'])
    {
        $project['image'] = env('APP_URL').'storage/'.$project['image'];
    }

    return $project;
});
