<?php

namespace App\Http\Controllers;

use App\Models\Host;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HostsController extends Controller
{
    /**
     * Display a list of hosts.
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
        return view('hosts.list', [
            'hosts' => Host::all()
        ]);
    }

    /**
     * Display the form for adding a new host.
     *
     * @return \Illuminate\View\View
     */
    public function addForm()
    {
        return view('hosts.add');
    }

    /**
     * Add a new host.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add()
    {
        // Validate the request data
        $attributes = request()->validate([
            'name' => 'required',
            'gtts_name' => 'required',
            'personality' => 'required',
            'bio' => 'required',
        ]);

        // Create a new Host instance
        $host = new Host();
        $host->name = $attributes['name'];
        $host->gtts_name = $attributes['gtts_name'];
        $host->personality = $attributes['personality'];
        $host->bio = $attributes['bio'];

        // Save the host
        $host->save();

        return redirect('/console/hosts/list')
            ->with('message', 'Host has been added!');
    }

    /**
     * Display the form for editing a host.
     *
     * @param  \App\Models\Host  $host
     * @return \Illuminate\View\View
     */
    public function editForm(Host $host)
    {
        return view('hosts.edit', [
            'host' => $host,
        ]);
    }

    /**
     * Update a host.
     *
     * @param  \App\Models\Host  $host
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Host $host)
    {
        // Validate the request data
        $attributes = request()->validate([
            'name' => 'required',
            'gtts_name' => 'required',
            'personality' => 'required',
            'bio' => 'required',
        ]);

        // Update the host attributes
        $host->name = $attributes['name'];
        $host->gtts_name = $attributes['gtts_name'];
        $host->personality = $attributes['personality'];
        $host->bio = $attributes['bio'];

        // Save the updated host
        $host->save();

        return redirect('/console/hosts/list')
            ->with('message', 'Host has been edited!');
    }

    /**
     * Delete a host.
     *
     * @param  \App\Models\Host  $host
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Host $host)
    {
        // Delete the host's image if it exists
        if ($host->image) {
            Storage::delete($host->image);
        }

        // Delete the host
        $host->delete();

        return redirect('/console/hosts/list')
            ->with('message', 'Host has been deleted!');
    }

    /**
     * Display the form for editing a host's image.
     *
     * @param  \App\Models\Host  $host
     * @return \Illuminate\View\View
     */
    public function imageForm(Host $host)
    {
        return view('hosts.image', [
            'host' => $host,
        ]);
    }

    /**
     * Update a host's image.
     *
     * @param  \App\Models\Host  $host
     * @return \Illuminate\Http\RedirectResponse
     */
    public function image(Host $host)
    {
        // Validate the request data
        $attributes = request()->validate([
            'profile_pic' => 'required|image',
        ]);

        // Delete the host's previous image if it exists
        if ($host->image) {
            Storage::delete($host->image);
        }

        // Store the new image
        $path = request()->file('profile_pic')->store('hosts');

        // Update the host's profile picture
        $host->profile_pic = $path;

        // Save the updated host
        $host->save();

        return redirect('/console/hosts/list')
            ->with('message', 'Host image has been edited!');
    }  
}
