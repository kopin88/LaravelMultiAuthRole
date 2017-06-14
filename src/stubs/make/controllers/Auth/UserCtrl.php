<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Auth;
use App\Http\Controllers\Controller;

class UserCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function help()
    {
      return view('auth.help');
    }

    public function index()
    {
        $admin = Role::all();
        $roles = Role::all();

        return view('auth.index')->withRoles($roles)->withAdmin($admin);
    }


    public function show($id)
    {
        $user = User::find($id);

        return view('auth.show')->with('user', $user);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->active=1;
        $user->save();
        return redirect('users/list');
    }

    public function profile()
    {
      return view('auth.profile', array('user' => Auth::user()) );
    }

    public function changepass()
    {
      $User = User::find(Auth::user()->id);

      if (Hash::check(Input::get('passwordold'), $User['password']) && Input::get('password') == Input::get('password_confirmation')) {

        $User->password = bcrypt(Input::get('password'));
        $User->save();
        return back()->with('success', 'Password Changed');
      }else {
        return back()->with('error', 'Password NOT Changed!!');
      }
    }

    public function update_avatar(Request $request)
    {
      if ($request->hasFile('avatar')) {
        // get file name
        $avatar = $request->file('avatar')->getClientOriginalName();
        // move image to Server
        $destination = base_path() . '/public/uploads/user_images';
        $request->file('avatar')->move($destination, $avatar);

        $user = Auth::user();
        $user->avatar = $avatar;
        $user->save();
      }
      return view('auth.profile', array('user' => Auth::user()) );
    }

    public function role_list()
    {
      return view('auth.roles');
    }


    public function AdminAssignRoles(Request $request)
    {
      $user = User::where('email', $request['email'])->first();
      $user->roles()->detach();
      if ($request['role_user']) {
        $user->roles()->attach(Role::where('name', 'User')->first());
      }
      if ($request['role_personal_r']) {
        $user->roles()->attach(Role::where('name', 'Personal Read')->first());
      }
      if ($request['role_personal_w']) {
        $user->roles()->attach(Role::where('name', 'Personal Write')->first());
      }
      if ($request['role_personal_m']) {
        $user->roles()->attach(Role::where('name', 'Personal Manager')->first());
      }
      if ($request['role_account_r']) {
        $user->roles()->attach(Role::where('name', 'Account Read')->first());
      }
      if ($request['role_account_w']) {
        $user->roles()->attach(Role::where('name', 'Account Write')->first());
      }
      if ($request['role_account_m']) {
        $user->roles()->attach(Role::where('name', 'Account Manager')->first());
      }
      if ($request['role_store_r']) {
        $user->roles()->attach(Role::where('name', 'Store Read')->first());
      }
      if ($request['role_store_w']) {
        $user->roles()->attach(Role::where('name', 'Store Write')->first());
      }
      if ($request['role_store_m']) {
        $user->roles()->attach(Role::where('name', 'Store Manager')->first());
      }
      if ($request['role_user_manager']) {
        $user->roles()->attach(Role::where('name', 'User Manager')->first());
      }
      if ($request['role_admin']) {
        $user->roles()->attach(Role::where('name', 'Administrator')->first());
      }

      return back();
    }

}
