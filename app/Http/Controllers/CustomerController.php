<?php

namespace App\Http\Controllers;

use App\Events\mailCustomer;
use App\Events\updateEvent;
use App\Mail\TestEmail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**     `
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    public function upload(Request $req)
    {
        $photo = null;
        if($req->photo){
            $photo = Storage::disk('public')->put('customer_img', $req->photo);
            dd($photo);
        }


        Customer::create([
            'customer_name' => $req->customer_name,
            'email' => $req->email,
            'number' => $req->number,
            'photo' => $photo
        ]);

        // if($customer){
        //     // Mail::to($req->email)->send(new TestEmail($customer));
        //     event(new mailCustomer($customer));
        // }
        return redirect()->route('show');
    }

    public function show()
    {
        $data = Customer::orderBy('id', 'desc')->get();
        if ($data){
            return view('show', ['data' => $data]);
        }
        return view('welcome');
    }

    public function updatePage($id)
    {
        $data = Customer::find($id);

        if ($data){
            return view('updatePage', ['data' => $data]);
        }
        return view('welcome');

    }

    public function update(Request $req, $id)
    {
        $customer = Customer::find($id);


        // if ($customer){
        //     event(new updateEvent($customer, $req->all()));
        //     return redirect()->route('show');
        // }
        $data = $req->validate([
            'customer_name' => 'required',
            'email' => 'required',
            'number' => 'required'
        ]);
        if($customer){
            $customer->update($data);
            return redirect()->route('show');
        }
        return redirect()->route('show');

    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        if($customer){
            $customer->delete($id);
            return redirect()->route('show');
        }
        return redirect()->route('show');

    }
}
