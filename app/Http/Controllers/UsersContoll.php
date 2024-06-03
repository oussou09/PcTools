<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;


class UsersContoll extends Controller
{
    use AuthorizesRequests;
    protected $UserPolicy;

    public function __construct(UserPolicy $UserPolicy)
    {
        $this->UserPolicy = $UserPolicy;
    }


    public function loginuser()
    {
        return view('users.AuthUser.LoginUser');
    }

    public function loginusereque(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('user')->attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('usersession',auth()->guard('user')->user()->username);
            return redirect()->route('user.dashborduser');
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logoutuser()
    {
        $message = '';
        if (session()->has('usersession')) {
            $message = 'Successful logout'.session('usersession').'.';
        }
        Auth::guard('user')->logout();
        Session::flush();
        return redirect()->route('user.loginuser')->with('LogoutAdmin',$message);
    }

    public function registeruser()
    {
        return view('users.AuthUser.RegisterUser');
    }

    public function storeuser(Request $request)
    {
        logger()->info($request->all());

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'account_type' => 'required|in:0,1',
            'password' => 'required|string|min:10',
        ]);

        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'account_type' => (int) $request->account_type,  // Cast to integer if necessary
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.loginuser')->with('success', ''.$request->username.' created successfully!');
    }

    public function dashborduser()
    {
        $user = auth()->guard('user')->user();
        return view('users.AuthUser.DashbordUser',[
            'user' => $user]);
    }

    public function profileuser(string $id)
    {
        $user = User::findOrFail($id);
        $likedProduct = $user->likes()->take(5)->get();
        $authUser = auth()->guard('user')->user();
        if (!$this->UserPolicy->view($authUser, $user)) {
            return abort(403);
        }
        return view('users.AuthUser.ProfileUser',[
            'user' => $user,
            'likedProducts' => $likedProduct]);
    }

    public function edituser(string $id)
    {
        $user = User::findOrFail($id);
        $authuser = auth()->guard('user')->user();

        if (! $this->UserPolicy->view($authuser,$user)) {
            return abort(403);
        }
        return view('users.AuthUser.EditUser',compact('user'));
    }

    public function updateUser(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->guard('user')->user();

        if (! $this->UserPolicy->update($authUser, $user)) {
            abort(403);
        }

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = strip_tags($request->input('username'));
        $user->email = strip_tags($request->input('email'));

        $user->save();

        return redirect()->route('user.profileuser', ['id' => $user->id]);
    }

    public function updatepassuser(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.AuthUser.UpdatePassUser',compact('user'));
    }

    public function updatepassusereq(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->guard('user')->user();

        if (!$this->UserPolicy->update($authUser, $user)) {
            abort(403);
        }

        $request->validate([
            'oldpassword' => 'required|min:10|max:255',
            'newpassword' => 'required|string|min:10|max:255|confirmed',
        ]);

        if (!Hash::check($request->oldpassword, $user->password)) {
            return back()->withErrors(['oldpassword' => 'The provided password does not match your current password.']);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();


        return redirect()->route('user.profileuser', ['id' => $user->id])->with(['Seccess' => 'Seccess Changing password.']);
    }
}
