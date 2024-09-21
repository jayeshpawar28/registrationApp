<?php

namespace App\Http\Controllers;

use App\Events\MailEvent;
use App\Models\Register;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Requests\UpdateRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Register::all();
        return view('home', ['data' => $data]);
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
    public function store(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'photo' => 'required|image|mimes:jpeg,jpg,png',
            'address' => 'nullable',
        ]);

        //File Uploading
        $photo_path = null;
        if ($req->hasFile('photo')) {
            $photo_path = $req->file('photo')->store('user_img', 'public');
        }

        if($data){
            $user = Register::create([
                'name' => $req->name,
                'email' => $req->email,
                'address' => $req->address,
                'photo' => $photo_path, 
            ]);

            event(new MailEvent($user));
            
            return redirect()->route('register.index')->with('success', 'Register Successfully!');
        }

        return redirect()->route('register.index')->with('error', 'Registration Failed!');
 
    }

    /**
     * Display the specified resource.
     */
    public function show(Register $register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Register::findOrFail($id);
        $data = Register::all();

        if($user){
            return view('home', ['user' => $user, 'data' => $data]);
        }
        return redirect()->route('register.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $user = Register::findOrFail($id);

        $data = $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'photo' => 'required|image|mimes:jpeg,jpg,png',
            'address' => 'nullable',
        ]);

        if ($req->hasFile('photo')) {
            // Delete the old photo if exists
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }
    
            // Store new photo
            $photo_path = $req->file('photo')->store('user_img', 'public');
            $data['photo'] = $photo_path; // Add the new photo path to data array
        }

        $user->update($data);

        return redirect()->route('register.index')->with('success', 'User updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Register::findOrFail($id);
        if ($user) {
            $user->delete();
            return redirect()->route('register.index')->with('error', 'User deleted !');
        }
        return redirect()->route('register.index');

    }
}
