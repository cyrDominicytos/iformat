<?php

namespace App\Http\Controllers;

use App\Models\ClassRoomModel;
use App\Models\GroupModel;
use App\Models\LearningModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class Group extends Controller
{

    protected $modelRoom = null;
    protected $modelLearning = null;
    protected $modelUser = null;
    protected $modelGroup = null;

    public function __construct(){
        $this->modelRoom = new ClassRoomModel();
        $this->modelLearning = new LearningModel();
        $this->modelUser = new User();
        $this->modelGroup = new GroupModel();

    }
  
    public function list()
    {
        $data['groups'] = $this->modelGroup->get_group_list(1);
        $data['users'] = $this->modelUser->where("user_role_id", 4)->where("status", 1)->get();
        return view('groups.list', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'groups_name' => 'required',
                'groups_participant' => 'required',
               // 'classrooms_name' => 'required|unique:posts|max:255',
            ],[
                'groups_name.required' => 'Renseignez la désignation du groupe',
                'groups_participant.required' => 'Ajouter des participants au groupe',
            ]);
     
            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error_message', "Une erreur est survenue lors de la création du groupe de formation !");
            }else{
                //validation okay
                $group = GroupModel::create([
                    'groups_name' => $request->groups_name,
                    'groups_participant' => json_encode($request->groups_participant),
                    'groups_detail' => $request->groups_detail,
                    'groups_user_created_by' => Auth::user()->id,
                    'groups_status' =>1,
                ]);

                //dd($classrooms);
                return back()->with('success_message', "Le groupe de formation est créé avec succès !");
            }

      
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       
            $validator = Validator::make($request->all(), [
                'classrooms_countries_id' => 'required',
                'classrooms_name' => 'required|max:255',
               // 'classrooms_name' => 'required|unique:posts|max:255',
            ],[
                'classrooms_name.required' => 'Renseignez la désignation du site',
                'classrooms_countries_id.required' => 'Renseignez la ville du site',
            ]);
     
            if ($validator->fails()) {
                return redirect('/listRooms')
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error_message', "Une erreur est survenue lors de la mise à jour du site de formation !");
            }else{
                //validation okay
                $classrooms = ClassRoomModel::where("classrooms_id",$request->id)->update([
                    'classrooms_name' => $request->classrooms_name,
                    'classrooms_countries_id' => $request->classrooms_countries_id,
                    'classrooms_detail' => $request->classrooms_detail,
                    'classrooms_user_updated_by' => Auth::user()->id,
                ]);

                //dd($classrooms);
                return redirect('/listRooms')->with('success_message', "Le site de formation a été mise à jour avec succès !");
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
        $response = ClassRoomModel::where("classrooms_id",$id)->update([
            "classrooms_status"=>-1,
            'classrooms_user_updated_by' => Auth::user()->id,

        ]);
        if($response){
            return redirect('/listRooms')->with('success_message', "Le site de formation a été supprimé avec succès !");
        }else{
            return redirect('/listRooms')->with('error_message', "Une erreur s'est produite lors de la suppression du site de formation !");
        }
    }
}
