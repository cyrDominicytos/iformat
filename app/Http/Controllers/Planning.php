<?php

namespace App\Http\Controllers;

use App\Models\ClassRoomModel;
use App\Models\GroupModel;
use App\Models\PlanningModel;
use App\Models\LearningModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class planning extends Controller
{

    protected $modelRoom = null;
    protected $modelplanning = null;
    protected $modelLearning = null;
    protected $modelUser = null;
    protected $modelGroup = null;

    public function __construct(){
        $this->modelRoom = new ClassRoomModel();
        $this->modelplanning = new PlanningModel();
        $this->modelLearning = new LearningModel();
        $this->modelUser = new User();
        $this->modelGroup = new GroupModel();

    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($code=null)
    {
        $data['learning_list'] =$this->modelLearning->where('learnings_status',1)->get();
        $data['room_list'] =$this->modelRoom->where('classrooms_status',1)->get();
        $data['teacher_list'] = $this->modelUser->where("user_role_id", 3)->where("status", 1)->get();
        $data['group_list'] = $this->modelGroup->get_group_list(1);;
        $data['countries_list'] = countries_list();
        $data['days_list'] = days_list();
        $data['cabinet_list'] = cabinet_list();
        return view('plannings.create', $data);
    }

    public function list()
    {
        $data['planning'] = $this->modelplanning->get_plannings_list(1);
        $data['countries_list'] = countries_list();
        return view('plannings.list', $data);
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
            'plannings_learning_id' => 'required',
            'plannings_classroom_id' => 'required',
            'plannings_user_groups' => 'required',
            'plannings_date' => 'required',
            'plannings_time_slot' => 'required',
            'plannings_teachers' => [
                'required',
                'array',
            ],
            
        ],[
            'plannings_learning_id.required' => 'Choisissez une formation',
            'plannings_classroom_id.required' => 'Choisissez une salle de formation',
            'plannings_teachers.required' => 'Ajoutez le(s) formateur(s)',
            'plannings_user_groups.required' => 'Ajoutez le(s) groupe(s) de formation',
            'plannings_date.required' => 'Renseignez la date de formation',
            'plannings_time_slot.required' => 'Choisissez une heure de formation',
        ]);
 
        if ($validator->fails()) {
            return redirect('/addPlanning')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error_message', "Une erreur est survenue lors de l'enregistrement de la formation !");
        }else{
            //validation okay
          //  dd( $request);
            $planning = planningModel::create([
                'plannings_learning_id' => $request->plannings_learning_id,
                'plannings_code' =>generate_planning_code(),
                'plannings_classroom_id' => $request->plannings_classroom_id,
                'plannings_teachers' => json_encode($request->plannings_teachers),
                'plannings_user_groups' => json_encode($request->plannings_user_groups),
                'plannings_date' => $request->plannings_date,
               
                'plannings_time_slot' => $request->plannings_time_slot,
                'plannings_infos' => $request->plannings_infos,
                'plannings_user_created_by' => Auth::user()->id,
            ]);

            return redirect('/listPlannings')->with('success_message', "Une nouvelle session de formation est créée avec succès !");
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
            $old_planning = $this->modelplanning->where("plannings_status", 1)->find($id);
            if(!$old_planning)
                return back()->with('error_message', "La formation que vous désirez éditer n'existe pas'!");
           
            $data['old_planning'] = $old_planning;
            $data['old_days'] = json_decode($old_planning->plannings_days);
            $data['old_time_slot'] = json_decode($old_planning->plannings_time_slot);
            $data['countries_list'] = countries_list();
            $data['days_list'] = days_list();
            $data['cabinet_list'] = cabinet_list();
            return view('plannings.create', $data);
       
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
        $old_planning = $this->modelplanning->where("plannings_status", 1)->find($request->id);
        if(!$old_planning)
            return back()->with('error_message', "La formation que vous désirez éditer n'existe pas'!");
       
        $validator = Validator::make($request->all(), [
            'plannings_author_id' => 'required|numeric',
            'plannings_title' => 'required',
            'plannings_duration' => 'required|numeric',
            'plannings_days' => [
                'required',
                'array',
            ],
            'plannings_time_slot' => [
                'required',
                'array',
            ],
        ],[
            'plannings_author_id.required' => 'Renseignez le cabinet de formation',
            'plannings_title.required' => 'Renseignez le titre de la formation',
            'plannings_duration.required' => 'Renseignez la durée de la formation',
            'plannings_days.required' => 'Renseignez les jours de formation',
            'plannings_time_slot.required' => 'Renseignez les heures de formation',
        ]);
 
        if ($validator->fails()) {
            return redirect('/addplanning')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error_message', "Une erreur est survenue lors de l'enregistrement de la formation !");
        }else{
            //validation okay
            $planning = planningModel::where("plannings_id", $request->id)->update([
                'plannings_author_id' => $request->plannings_author_id,
                'plannings_title' => $request->plannings_title,
                'plannings_title2' => $request->plannings_title2,
                'plannings_duration' => $request->plannings_duration,
                'plannings_days' => json_encode($request->plannings_days),
                'plannings_time_slot' => json_encode($request->plannings_time_slot),
                'plannings_goal' => $request->plannings_goal,
                'plannings_target' => $request->plannings_target,
                'plannings_infos' => $request->plannings_infos,
                'plannings_user_updated_by' => Auth::user()->id,
            ]);
         if($planning)
            return redirect('/listplannings')->with('success_message', "Une nouvelle formation est créée avec succès !");
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
        $response = planningModel::where("plannings_id",$id)->update([
            "plannings_status"=>-1,
            'plannings_user_updated_by' => Auth::user()->id,

        ]);
        if($response){
            return back()->with('success_message', "La formation a été supprimée avec succès !");
        }else{
            return back()->with('error_message', "Une erreur s'est produite lors de la suppression de la formation !");
        }
    }
}
