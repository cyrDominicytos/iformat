<?php

namespace App\Http\Controllers;

use App\Models\ClassRoomModel;
use App\Models\GroupModel;
use App\Models\LearningModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
  
    public function add()
    {
        $data['groups'] = $this->modelGroup->get_group_list(1);
        $data['learnings'] = $this->modelLearning->where("learnings_status", 1)->get();
        $data['add'] = 1;
        $data['users'] = $this->modelUser->where("user_role_id", 4)->where("status", 1)->get();
        $data['user_to_offset'] = no_assign_participants_to_group();
        return view('groups.list', $data);
    }
    public function list()
    {
        $data['add'] = 0;
        $data['groups'] = $this->modelGroup->get_group_list(1);
        $data['learnings'] = $this->modelLearning->where("learnings_status", 1)->get();
        $data['users'] = $this->modelUser->where("user_role_id", 4)->where("status", 1)->get();
        $data['user_to_offset'] = no_assign_participants_to_group();
        return view('groups.list', $data);
    }

    public function update($id)
    {

        if($id > 0){
            $old_group = $this->modelGroup->where("groups_id", $id)->where("groups_status", 1)->get();
            if(count($old_group) <= 0)
                return back()->with('error_message', "Le groupe de formation que vous désirez éditer n'existe pas !");
           
            $data['users'] = $this->modelUser->where("user_role_id", 4)->where("status", 1)->get();
            $data['groups'] = $this->modelGroup->get_group_list(1);
            $data['user_to_offset'] = no_assign_participants_to_group_for_update($id);
            $data['old_group'] = $old_group[0];
            $data['old_participation'] = json_decode($old_group[0]->groups_participant);
            $data['add'] = 0;
            $data['learnings'] = $this->modelLearning->where("learnings_status", 1)->get();
            return view('groups.list', $data);
        }else{
            return back()->with('error_message', "Accès illégal !");
        }
        
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
                'groups_name' => [
                                'required',
                                'groups_name' => Rule::unique('groups')->where(fn ($query) => $query->where('groups_learning_id', $request->groups_learning_id)->where('groups_status', 1))
                            ],
                'groups_participant' => 'required',
                'groups_learning_id' => 'required',
            ],[
                'groups_name.required' => 'Renseignez la désignation du groupe',
                'groups_name.unique' => 'Le groupe '.$request->groups_name.' existe déjà pour cette formation',

                'groups_participant.required' => 'Ajouter des participants au groupe',
                'groups_learning_id.required' => 'Ajouter une formation au groupe',
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
                    'groups_learning_id' => $request->groups_learning_id,
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
       
      
            $old_group = $this->modelGroup->where("groups_id", $request->id)->where("groups_status", 1)->get();
            if(count($old_group) <= 0)
                return back()->with('error_message', "Le groupe de formation que vous désirez éditer n'existe pas !");

           $validator = Validator::make($request->all(), [
                        'groups_name' => [
                            'required',
                            'groups_name' => Rule::unique('groups')->ignore($request->id, 'groups_id')->where(fn ($query) => $query->where('groups_learning_id', $request->groups_learning_id)->where('groups_status', 1))

                        ]
                        /*,
                            'groups_name' => 'required'.($request->groups_name!= $old_group[0]->groups_name ? '|unique:groups' : ''),
                            'groups_participant' => 'required',*/
            ],
            [
                'groups_name.required' => 'Renseignez la désignation du groupe',
                'groups_name.unique' => 'Le groupe '.$request->groups_name.' existe déjà pour cette formation',
                'groups_participant.required' => 'Ajouter des participants au groupe',
            ]);
     
            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error_message', "Une erreur est survenue lors de la création du groupe de formation !");
            }else
            {
                //validation okay
                $group = GroupModel::where("groups_id", $request->id)->update([
                    'groups_name' => $request->groups_name,
                    'groups_participant' => json_encode($request->groups_participant),
                    'groups_learning_id' => $request->groups_learning_id,
                    'groups_detail' => $request->groups_detail,
                    'groups_user_updated_by' => Auth::user()->id,
                    'groups_status' =>1,
                ]);

                return redirect('listGroups')->with('success_message', "Le groupe de formation est mise à jour avec succès !");
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
        $response = GroupModel::where("groups_id",$id)->update([
            "groups_status"=>-1,
            'groups_user_updated_by' => Auth::user()->id,

        ]);
        if($response){
            return back()->with('success_message', "Le groupe de formation a été supprimé avec succès !");
        }else{
            return back()->with('error_message', "Une erreur s'est produite lors de la suppression du groupe de formation !");
        }
    }
}
