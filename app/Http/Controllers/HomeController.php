<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $modelUser = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->modelUser = new User();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function addParticipant($id=null)
    {
        if($id!=null){
            $user = $this->modelUser->where('id',$id)->get();
            if($user)         $data['old_user'] =  $user;

        }
        $data['roles'] = roles_list();
        $data['role_id'] = 4;
       // dd($data);
        return view('auth.register', $data);
    }
    public function addTeacher()
    {
        $data['roles'] = roles_list();
        $data['role_id'] = 3;
        return view('auth.register', $data);
    }
    public function addSponsor()
    {
        $data['roles'] = roles_list();
        $data['role_id'] = 2;
        return view('auth.register', $data);
    }

    public function users_list($role=null)
    {
        if($role >0){
            $data['users'] = $this->modelUser->where("user_role_id", $role)->get();
            $data['role_name'] = roles_list()[$role];
            $data['role_id'] = $role;
            return view('users.list', $data);
        }else{
            echo "Unvalid routes";
        }
    }

    public function dashboard()
    {
        return view('dashboard/dashboard');
    }
}
