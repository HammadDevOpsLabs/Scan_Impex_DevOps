<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['categories']=Category::all();
        return view('index',$data);
    }

    public function userProfile()
    {
        $data['orders']=Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('auth.profile',$data);
    }


    public function userProfileUpdate(Request $request)
    {
        $user=Auth::user();
        $rules = [
            'name' => 'required',
            'email' => 'email|required|unique:users,id,' . $user->id,
            'phone_number' => ['required', ],
            'address' => ['required', 'string'],

        ];
        if ($request->filled('password')) {
            $rules['password'] = 'required|min:6|confirmed';

        }
        $data = $request->except([ 'password_confirmation']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        }
        else{
            unset($data['password']);
        }
        $user->update($data);
        if ($user) {
            session()->flash('success', trans('User Update Successfully'));
        } else {
            session()->flash('error', trans('User Updating Failed'));
        }

        return redirect()->back();
    }
}
