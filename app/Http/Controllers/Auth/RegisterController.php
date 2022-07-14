<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

     /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $data['roles'] = roles_list();
        return view('auth.register', $data);
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       // ($data);
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_role_id' => ['required'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'email' => Rule::unique('users')->where(fn ($query) => $query->where('status', 1))
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'first_name.required' => 'Renseignez le prénom',
            'last_name.required' => 'Renseignez le nom',
            'user_role_id.required' => 'Renseignez le rôle de l\'utilisateur',
            'email' => 'Renseignez une adresse email valid',
            'email.required' => 'Renseignez une adresse email valid',
            'email.unique' => "L'adresse email existe déjà",                
            'password.required' => 'Renseignez le mot de passe',
            'password.confirmed' => 'Les mots de passe ne correspondent pas !',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'user_role_id' => $data['user_role_id'],
            'email' => $data['email'],
            'from' => $data['from'],
            'fonction' => $data['fonction'],
            'status' => 1,
            'user_created_by' => Auth::user()->id,
            'password' => Hash::make($data['password']),
            'department' => $data['department'],
        ]);
    }
}
