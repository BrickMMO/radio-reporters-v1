<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RestrictedController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\InternalSystem;


class InternalSystemsController extends Controller
{

    public function list()
    {
    
        return view('internal_systems.list', [
            'internal_systems' => InternalSystem::all()
        ]);
    }

    public function addForm()
    {
        return view('internal_systems.add', [
            'system_names' => InternalSystem::select('id', 'system_name')->get(),
        ]);
    }
    
    
    public function add()
    {

        $attributes = request()->validate([
            'system_name' => 'required',
            'request_api_url' => 'nullable|url',
        ]);

        $internal_system = new InternalSystem();
        $internal_system->system_name = $attributes['system_name'];
        $internal_system->request_api_url = $attributes['request_api_url'];
        $internal_system->save();

        return redirect('/console/internal_systems/list')
            ->with('message', 'Internal System has been added!');
    }


    public function editForm(InternalSystem $internal_system)
    {
        return view('internal_systems.edit', [
            'internal_system' => $internal_system,
        ]);
    }

    public function edit(InternalSystem $internal_system)
    {

        $attributes = request()->validate([
            'system_name' => 'required',
            'request_api_url' => 'nullable|url',
        ]);

        $internal_system->system_name = $attributes['system_name'];
        $internal_system->request_api_url = $attributes['request_api_url'];
        $internal_system->save();

        return redirect('/console/internal_systems/list')
            ->with('message', 'Internal System has been edited!');
    }

    public function delete(InternalSystem $internal_system)
    {

        if($internal_system->image)
        {
            Storage::delete($internal_system->image);
        }
        
        $internal_system->delete();
        
        return redirect('/console/internal_systems/list')
            ->with('message', 'Internal system has been deleted!');        
    }

    public function imageForm(InternalSystem $internal_system)
    {
        return view('internal_systems.image', [
            'internal_system' => $internal_system,
        ]);
    }

    public function image(InternalSystem $internal_system)
    {

        $attributes = request()->validate([
            'system_icon' => 'required|image',
        ]);

        if($internal_system->image)
        {
            Storage::delete($internal_system->image);
        }
        
        $path = request()->file('system_icon')->store('internal_systems');

        $internal_system->system_icon = $path;
        $internal_system->save();
        
        return redirect('/console/internal_systems/list')
            ->with('message', 'Internal System icon has been edited!');
    }
    
}
