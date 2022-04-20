<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\newAccountMail;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Display all users
    public function index()
    {
        if (Auth::user()->isAdmin()){
            $users = User::all();
            return view('users.index', compact('users'));
        }
        if (Auth::user()->isSubAdmin()){
            $users = User::where('role', 'user')->get();
            return view('users.index', compact('users'));
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //add user account form
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store user data in table
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|email|unique:users,email',
            'mobile' => 'required|regex:/^[6-9]\d{9}$/u',
            'first_name' => 'required|min:5|max:15',
            'last_name' => 'nullable|min:5|max:15',
            'profile_picture' => 'mimes:jpg,png,jpeg,gif|max:20kb',
            'role' => 'required',
        ]);
        $fn = '';
        // Upload Image
        if ($request->hasfile('profile_picture')) {
            $fileName = $request->file('profile_picture');
            $fn = rand() . time() . '.' . $fileName->extension();
            $fileName->move(public_path('profiles/'), $fn);
        }
        if (empty($request->status)) {
            $status = 'inactive';
        } else {
            $status = 'active';
        }
        if ($request->role === "subadmin" || $request->role === "agent")
            $password = ucwords($request->first_name) . "@1234";
        if ($request->role === "user")
            $password = "User@1234";
        User::create([
            'email' => $request->username,
            'mobile' => $request->mobile,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'profile_pic' => $fn ? $fn : '',
            'status' => $status,
            'password' => Hash::make($password)
        ]);
        $details = [
            "username" => $request->username,
            "password" => $password
        ];
        Mail::to($request->username)->send(new newAccountMail($details));
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //edit user page
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update user data in table 
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|email|unique:users,email,' . $id . '',
            'mobile' => 'required|regex:/^[6-9]\d{9}$/u',
            'first_name' => 'required|min:5|max:15',
            'last_name' => 'nullable|min:5|max:15',
            'profile_picture' => 'mimes:jpg,png,jpeg,gif',
            'role' => 'required',
        ]);
        // Upload Image
        $fn = $request->current_image;
        if ($request->hasfile('profile_picture')) {
            $fileName = $request->file('profile_picture');
            $fn = rand() . time() . '.' . $fileName->extension();
            if ($fileName->move(public_path('profiles/'), $fn)) {
                $dest = 'profiles/' . $request->current_image;
                if (File::exists($dest)) {
                    File::delete($dest);
                }
            }
        }
        if (empty($request->status)) {
            $status = 'inactive';
        } else {
            $status = 'active';
        }
        User::where('id', $id)->update([
            'email' => $request->username,
            'mobile' => $request->mobile,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'profile_pic' => $fn,
            'status' => $status
        ]);
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!empty($user->profile_pic)) {
            $dest = 'profiles/' . $user->profile_pic;
            if (File::exists($dest)) {
                File::delete($dest);
            }
        }
        $user->delete();
        return redirect()->back();
    }
}
