<?php

namespace App\Http\Controllers;

use App\Models\ClassRoomModel;
use App\Models\GroupModel;
use App\Models\LearningModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Learning extends Controller
{

    protected $modelRoom = null;
    protected $modelLearning = null;
    protected $modelGroup = null;

    public function __construct(){
        $this->modelRoom = new ClassRoomModel();
        $this->modelLearning = new LearningModel();
        $this->modelGroup = new GroupModel();

    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        
        $data['countries_list'] = countries_list();
        $data['days_list'] = days_list();
        $data['cabinet_list'] = cabinet_list();
        return view('learnings.create', $data);
    }

    public function list()
    {
        $userRole = Auth::user()->user_role_id;
        switch ($userRole) {
            case 3:
                //formateur
                $data['learning'] = $this->modelLearning->get_learnings_by_teachers(Auth::user()->id);
                //dd($data['learning']);
                break;
            case 4:
                //Agent
                $group = session('userGroup');
                $data['learning'] = $this->modelLearning->get_learnings_by_agent($group->groups_id);
             break;
            default:
                $data['learning'] = $this->modelLearning->get_learnings_list([-1]);
            break;
        }
        $data['countries_list'] = countries_list();
        return view('learnings.list', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'learnings_author_id' => 'required|numeric',
            'learnings_title' => 'required',
            'learnings_duration' => 'required|numeric',
            'learnings_days' => [
                'required',
                'array',
            ],
            'learnings_time_slot' => [
                'required',
                'array',
            ],
        ],[
            'learnings_author_id.required' => 'Renseignez le cabinet de formation',
            'learnings_title.required' => 'Renseignez le titre de la formation',
            'learnings_duration.required' => 'Renseignez la durée de la formation',
            'learnings_days.required' => 'Renseignez les jours de formation',
            'learnings_time_slot.required' => 'Renseignez les heures de formation',
        ]);
 
        if ($validator->fails()) {
            return redirect('/addLearning')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error_message', "Une erreur est survenue lors de l'enregistrement de la formation !");
        }else{
            //validation okay
            $learning = LearningModel::create([
                'learnings_author_id' => $request->learnings_author_id,
                'learnings_code' =>generate_learning_code(),
                'learnings_title' => $request->learnings_title,
                'learnings_title2' => $request->learnings_title2,
                'learnings_duration' => $request->learnings_duration,
                'learnings_days' => json_encode($request->learnings_days),
                'learnings_time_slot' => json_encode($request->learnings_time_slot),
                'learnings_goal' => $request->learnings_goal,
                'learnings_target' => $request->learnings_target,
                'learnings_infos' => $request->learnings_infos,
                'learnings_user_created_by' => Auth::user()->id,
            ]);

            return redirect('/listLearnings')->with('success_message', "Une nouvelle formation est créée avec succès !");
            //return redirect(route('liste_versement.delivres'))->with('success', "Etat de versement délivré avec succès");
        }
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
    public function edit($id)
    {
        if($id <= 0)
            return back()->with('error_message', "Accès illégal !");
            $old_learning = $this->modelLearning->where("learnings_status", 1)->find($id);
            if(!$old_learning)
                return back()->with('error_message', "La formation que vous désirez éditer n'existe pas'!");
           
            $data['old_learning'] = $old_learning;
            $data['old_days'] = json_decode($old_learning->learnings_days);
            $data['old_time_slot'] = json_decode($old_learning->learnings_time_slot);
            $data['countries_list'] = countries_list();
            $data['days_list'] = days_list();
            $data['cabinet_list'] = cabinet_list();
            return view('learnings.create', $data);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);   
        $old_learning = $this->modelLearning->where("learnings_status", 1)->find($request->id);
        if(!$old_learning)
            return back()->with('error_message', "La formation que vous désirez éditer n'existe pas'!");
       
        $validator = Validator::make($request->all(), [
            'learnings_author_id' => 'required|numeric',
            'learnings_title' => 'required',
            'learnings_duration' => 'required|numeric',
            'learnings_days' => [
                'required',
                'array',
            ],
            'learnings_time_slot' => [
                'required',
                'array',
            ],
        ],[
            'learnings_author_id.required' => 'Renseignez le cabinet de formation',
            'learnings_title.required' => 'Renseignez le titre de la formation',
            'learnings_duration.required' => 'Renseignez la durée de la formation',
            'learnings_days.required' => 'Renseignez les jours de formation',
            'learnings_time_slot.required' => 'Renseignez les heures de formation',
        ]);
 
        if ($validator->fails()) {
            return redirect('/addLearning')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error_message', "Une erreur est survenue lors de l'enregistrement de la formation !");
        }else{
            //validation okay
            $learning = LearningModel::where("learnings_id", $request->id)->update([
                'learnings_author_id' => $request->learnings_author_id,
                'learnings_title' => $request->learnings_title,
                'learnings_title2' => $request->learnings_title2,
                'learnings_duration' => $request->learnings_duration,
                'learnings_days' => json_encode($request->learnings_days),
                'learnings_time_slot' => json_encode($request->learnings_time_slot),
                'learnings_goal' => $request->learnings_goal,
                'learnings_target' => $request->learnings_target,
                'learnings_infos' => $request->learnings_infos,
                'learnings_user_updated_by' => Auth::user()->id,
            ]);
         if($learning)
            return redirect('/listLearnings')->with('success_message', "Une nouvelle formation est créée avec succès !");
            return back()->with('error_message', "Vous ne pouvez pas éditer cette formation !");
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
        $response = LearningModel::where("learnings_id",$id)->update([
            "learnings_status"=>-1,
            'learnings_user_updated_by' => Auth::user()->id,

        ]);
        if($response){
            return back()->with('success_message', "La formation a été supprimée avec succès !");
        }else{
            return back()->with('error_message', "Une erreur s'est produite lors de la suppression de la formation !");
        }
    }

    public function close($id)
    {
        $response = LearningModel::where("learnings_id",$id)->update([
            "learnings_status"=>-2,
            'learnings_user_updated_by' => Auth::user()->id,

        ]);
        if($response){
            return back()->with('success_message', "La formation a été cloturée avec succès !");
        }else{
            return back()->with('error_message', "Une erreur s'est produite lors de la clôture de la formation !");
        }
    }

    public function getLearning(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
        
        $userRole = Auth::user()->user_role_id;
        //$group =$this->modelGroup->get_user_group(Auth::user()->id);
        if($userRole==4){
           // $planning= get_learning_planning_by_group($request->id, $group[0]->groups_id);
           $group = session('userGroup');
            $planning= get_learning_planning_by_group($request->id, $group->groups_id);
            
            if($planning){
                $teachers = User::where("status",1)->whereIn("id", json_decode($planning->plannings_teachers))->get();
               return response()->json([
                    "teachers" =>teachers_list($teachers),
                    "learning" =>  LearningModel::where("learnings_status",1)->where("learnings_id",$request->id)->first(),
               ]);
               // return ;	
            }
        }
        return 0;
    }
}
