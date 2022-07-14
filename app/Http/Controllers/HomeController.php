<?php

namespace App\Http\Controllers;

use App\Models\LearningModel;
use App\Models\PresenceModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class HomeController extends Controller
{
    protected $modelUser = null;
    protected $modelPresence = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->modelUser = new User();
        $this->modelPresence = new PresenceModel();
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
    public function addAdmin()
    {
        $data['roles'] = roles_list();
        $data['role_id'] = 1;
        return view('auth.register', $data);
    }

    public function users_list($role=null)
    {
        if($role >0){
            $data['users'] = $this->modelUser->where("user_role_id", $role)->where("status", 1)->get();
            $data['role_name'] = roles_list()[$role];
            $data['role_id'] = $role;
            return view('users.list', $data);
        }else{
            echo "Unvalid routes";
        }
    }

    public function users_update($role=null,$user_id=null)
    {
        if($role >0 && $user_id > 0){
            $user = $this->modelUser->where("id", $user_id)->where("user_role_id", $role)->get();
           if(count($user) <= 0)
                return back()->with('error_message', "Le profile que vous désirez éditer n'existe pas !");

            $data['roles'] = roles_list();
            $data['old_user'] =  $user[0];
            $data['role_id'] = $role;
            return view('auth.register', $data);
        }else{
            return back()->with('error_message', "Tentative d'accès illégal à une réssource !");
        }
    }

    //Edit user
    public function edit_user(Request $request)
    {
        $old_user = $this->modelUser->where("id",$request->id)->get();
        if(count($old_user) <= 0)
             return back()->with('error_message', "Le profile que vous désirez éditer n'existe pas !");

            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'user_role_id' => ['required'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'email' => Rule::unique('users')->ignore($request->id)->where(fn ($query) => $query->where('status', 1))
                ],
            ],[
                'first_name.required' => 'Renseignez le prénom',
                'last_name.required' => 'Renseignez le nom',
                'user_role_id.required' => 'Renseignez le rôle de l\'utilisateur',
                'email' => 'Renseignez une adresse email valid',
                'email.required' => 'Renseignez une adresse email valid',                
                'email.unique' => "L'adresse email existe déjà",                
            ]);
     
            if ($validator->fails()) {
                return       back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error_message', "Une erreur est survenue lors de la mise à jour de l'utilisateur !");
            }else{
                //validation okay
                $field = [
                    'first_name' => $request->first_name,
                    'last_name' =>$request->last_name,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'user_role_id' => $request->user_role_id,
                    'email' => $request->email,
                    'from' => $request->from,
                    'fonction' => $request->fonction,
                    'department' => $request->department,
                    'status' => 1,
                    'user_created_by' => Auth::user()->id,
                ];
                /*if(!empty($request->from) && $request->from!= null )
                    $field['from'] = $request->from;
                if(!empty($request->fonction) && $request->fonction!= null )
                    $field['fonction'] = $request->fonction;*/
                $updated_user = User::where("id",$request->id)->update($field);

               // dd(  $updated_user);
                return redirect(route('users_list',[$request->user_role_id]))->with('success_message', "Le profile ".$request->last_name." ".$request->first_name." a été mise à jour avec succès !");
            }

      
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = User::where("id",$id)->update([
            "status"=>-1,
            'user_updated_by' => Auth::user()->id,

        ]);
        if($response){
            return back()->with('success_message', "Utilisateur supprimé avec succès !");
        }else{
            return  back()->with('error_message', "Une erreur s'est produite lors de la suppression de l'utilisateur !");
        }
    }


    public function dashboard()
    {

        $data['formed_count'] = $this->modelPresence->get_agent_count();
        $data['certify_count'] = $this->modelPresence->get_certify_count();
        $data['learning_count'] = $this->modelPresence->get_learning_count();
        $data['tested_agent_count'] = $this->modelPresence->get_evaluated_agent_count();


        
      //  dd($data['certify_count']);
        return view('dashboard/dashboard', $data);
    }
}
