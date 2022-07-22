<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;






class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        User::where('id', Auth::user()->id)->update(["active"=> 1]);

        if($user->user_role_id==4){
            $request->session()->put('userGroup', get_participant_group($user->id));
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;



    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ],
        [
            "email" => 'Renseignez une adresse email valid',
            'email.required' => 'Renseignez une adresse email valid',          
            'password.required' => 'Renseignez le mot de passe',
        ]);
    }


    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request, $type=1)
    {
        if($type==2)
            throw ValidationException::withMessages([
                $this->username() => ["Votre compte est actuellement actif sur un autre périphérique, Veuillez vous déconnecter et réessayer!"],
            ]);

        throw ValidationException::withMessages([
            $this->username() => ["Données de connexion incorrectes !"],
        ]);
        
    }


    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        try{
            $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $type=$this->attemptLogin($request);
       
        if ($type == 1) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request, $type);
            
        }catch(Exception $e){
            return redirect()->back()->with('message', "Nous n'avons pas pu contacter le serveur !");
        }
    }



    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
            $result =  $this->guard()->attempt(
                $this->credentials($request), $request->filled('remember')
            );
            //successfullogin
            if($result){
                //$user = User::where("email", $request->get('email'))->where("password", $request->get('password'))->first();
                $user = User::where("active",0)->where("status", 1)->where("email", $request->get('email'))->first();
    
                //valid login
                if($user!= null){
                    return 1;
                }
    
                $this->logout($request, 2);
                $user = User::where("status", 1)->where("email", $request->get('email'))->first();
                //undeleted login
                if($user!= null){
                    return 2;
                }else return 0;//deleted login
            }else return 0;
      
    }



 /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request, $type=1)
    {
        User::where('id', Auth::user()->id)->update(["active"=> 0]);
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

       if($type==1){
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/')->with("message", "Vous êtes déconnectés avec succès !");
       }
       
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }


       /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            $this->username() => ["Trop de tentative de connexion. Veuillez réessayer après ".(ceil($seconds / 60) >0 ? ceil($seconds / 60)." min ". $seconds." secondes" : $seconds." secondes")],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


}
