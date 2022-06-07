<?php

namespace App\Http\Controllers;

use App\Models\CertificationModel;
use App\Models\ClassRoomModel;
use App\Models\GroupModel;
use App\Models\PlanningModel;
use App\Models\LearningModel;
use App\Models\PresenceModel;
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
        //dd(learning_time_slot("1")); 
        $data['learning_list'] =$this->modelLearning->where('learnings_status',1)->get();
        $data['room_list'] =$this->modelRoom->where('classrooms_status',1)->get();
        $data['teacher_list'] = $this->modelUser->where("user_role_id", 3)->where("status", 1)->get();
        $data['group_list'] = $this->modelGroup->get_group_list(1);
        return view('plannings.create', $data);
    }

    public function list()
    {
        $data['planning'] = $this->modelplanning->get_plannings_list(1);
       // dd($data['planning']);
        $data['countries_list'] = countries_list();
        return view('plannings.list', $data);
    }

    public function planningsView()
    {
        $group = "1";
        $beginDate = "2022-05-01";
        $endDate = "2022-05-31";
        $yearMonth = "2022-05";
        $result = $this->modelplanning->get_participant_planning($group, $beginDate, $endDate, $yearMonth );
       $events = [];
       $eventElements = [];
        if($result){
            foreach($result as $value){
             $date_slots = json_decode($value->plannings_date);
             $time_slots = json_decode($value->plannings_time_slot);
                foreach ($date_slots as $date_key=> $date_value){
                    if($date_value >= $beginDate && $date_value <= $endDate){
                        array_push($eventElements,
                            array(
                            'date'=>  $date_value,
                            'title'=>"<div style='width:100%' title='Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication'><p style='text-align:center; font-weight:bold; color:red;'>7:00 - 12:00</p> \n\n Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication</div>",
                            'learnTime'=>  $time_slots[$date_key],
                            'learnClass'=> $value->classrooms_name,
                            'learnText'=> $value->learnings_title,
                            'learnGoal'=> $value->learnings_goal,
                            'learnDesc'=> $value->learnings_infos,
                            'learnGroup'=> implode(", ",GroupModel::whereIn('groups_id',json_decode($value->plannings_user_groups))->where('groups_status',1)->pluck('groups_name')->toArray()),

                        )
                            );
                    }
                }

            }
        }
        foreach ($eventElements as $key=>$value){
            if(!array_key_exists($value['date'],$events))
                $events[$value['date']] = [];
            array_push($events[$value['date']],$value );  
           
        }
       
        //dd($events);
        $data['planning'] = $this->modelplanning->get_plannings_list(1);
        $data['countries_list'] = countries_list();
        $data['events'] = $events;
        return view('plannings.planningsView', $data);
    }

    //learning_time_slot
    public function learning_time_slot(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
       return  learning_time_slot($request->id);	
    }

    //learning_time_slot
    public function learning_days(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
       return  learning_days($request->id);	
    }

    public function learning_available_groupe(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
       return  learning_available_groupe($request->id);	
    }
    public function learning_available_groupe2(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
       return  learning_available_groupe2($request->id,$request->session_id,$request->old_groups);	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'plannings_learning_id' => 'required',
            'plannings_classroom_id' => 'required',
            'plannings_teachers' => [
                'required',
                'array',
            ],
            'plannings_user_groups' => [
                'required',
                'array',
            ],
            'plannings_date' => [
                'required',
                'array',
            ],
            'plannings_time_slot' => [
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
                        ->with('error_message', "Une erreur est survenue lors de l'enregistrement de la session de formation !");
        }else{
            //validation okay
          //  dd( $request);
            $planning = planningModel::create([
                'plannings_learning_id' => $request->plannings_learning_id,
                'plannings_code' =>generate_planning_code(),
                'plannings_classroom_id' => $request->plannings_classroom_id,
                'plannings_teachers' => json_encode($request->plannings_teachers),
                'plannings_user_groups' => json_encode($request->plannings_user_groups),
                'plannings_date' => json_encode($request->plannings_date),
                'plannings_time_slot' => json_encode($request->plannings_time_slot),
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
       // learning_available_groupe2(1,4);
        if($id <= 0)
            return back()->with('error_message', "Accès illégal !");
            $old_planning = $this->modelplanning->where("plannings_status", 1)->find($id);
            if(!$old_planning)
                return back()->with('error_message', "La session de formation que vous désirez éditer n'existe pas'!");
            
            $data['learning_list'] =$this->modelLearning->where('learnings_status',1)->get();
            $data['room_list'] =$this->modelRoom->where('classrooms_status',1)->get();
            $data['teacher_list'] = $this->modelUser->where("user_role_id", 3)->where("status", 1)->get();
            $data['group_list'] = $this->modelGroup->get_group_list(1);;
        

            $data['old_planning'] = $old_planning;
            $data['old_teachers'] = json_decode($old_planning->plannings_teachers);
            $data['old_time_slot'] = json_decode($old_planning->plannings_time_slot);
            $data['old_date'] = json_decode($old_planning->plannings_date);
            $data['old_groups'] = json_decode($old_planning->plannings_user_groups);
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
            return back()->with('error_message', "La session de formation que vous désirez éditer n'existe pas'!");
       
            $validator = Validator::make($request->all(), [
                'plannings_learning_id' => 'required',
                'plannings_classroom_id' => 'required',
                'plannings_teachers' => [
                    'required',
                    'array',
                ],
                'plannings_time_slot' => [
                    'required',
                    'array',
                ],
                'plannings_date' => [
                    'required',
                    'array',
                ],
                'plannings_user_groups' => [
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
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error_message', "Une erreur est survenue lors de la mise à jour de la session de formation !");
        }else{
            //validation okay
            $planning = planningModel::where("plannings_id", $request->id)->update([
                'plannings_learning_id' => $request->plannings_learning_id,
                'plannings_classroom_id' => $request->plannings_classroom_id,
                'plannings_teachers' => json_encode($request->plannings_teachers),
                'plannings_user_groups' => json_encode($request->plannings_user_groups),
                'plannings_date' => json_encode($request->plannings_date),
                'plannings_time_slot' => json_encode($request->plannings_time_slot),
                'plannings_infos' => $request->plannings_infos,
                'plannings_user_updated_by' => Auth::user()->id,
            ]);
         if($planning)
            return redirect('/listPlannings')->with('success_message', "La session de formation est mise à jour avec succès !");
            return back()->with('error_message', "Vous ne pouvez pas éditer cette session de formation !");
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
        $response = PlanningModel::where("plannings_id",$id)->update([
            "plannings_status"=>-1,
            'plannings_user_updated_by' => Auth::user()->id,

        ]);
        if($response){
            return back()->with('success_message', "La session de formation a été supprimée avec succès !");
        }else{
            return back()->with('error_message', "Une erreur s'est produite lors de la suppression de la session de formation !");
        }
    }

    public function presence($code=null)
    {
        //dd(planning_details_list("2")); 
       //dd(planning_list(1));
        $data['learning_list'] =$this->modelLearning->where('learnings_status',1)->get();
        $data['room_list'] =$this->modelRoom->where('classrooms_status',1)->get();
        $data['teacher_list'] = $this->modelUser->where("user_role_id", 3)->where("status", 1)->get();
        $data['group_list'] = $this->modelGroup->get_group_list(1);
        $data['countries_list'] = countries_list();
        $data['days_list'] = days_list();
        $data['cabinet_list'] = cabinet_list();
        return view('presence.create', $data);
    }

    public function planning_list(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
       return  planning_list($request->id);	
    }

    public function planning_details_list(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
       return  planning_details_list($request->id);	
    }
    public function group_participant_list(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
       return  group_participant_list($request->id, $request->date_time);	
    }

  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function presence_store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'plannings_learning_id' => 'required',
            'plannings_classroom_id' => 'required',
            'plannings_datetime' => 'required',
            'participant' => [
                'required',
                'array',
            ],
            
        ],[
            'plannings_learning_id.required' => 'Choisissez une formation',
            'plannings_classroom_id.required' => 'Choisissez une session de formation',
            'plannings_datetime.required' => 'Choisissez la date et heure de session',
            'participant.required' => 'Aucun participant trouvé',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error_message', "Une erreur est survenue lors de l'enregistrement de la présence des participants !");
        }else{
            //validation okay
          //  dd( $request);
          if($request->presences_participant==null)
          return redirect()->back()->with('error_message', "Aucune présence  n'a été marquée !");

            $datetime = explode(' de ',$request->plannings_datetime);
            $old = PresenceModel::where("presences_date", $datetime[0])->where("presences_time_slot", $datetime[1])->where("presences_group_id", $request->plannings_group)->first();
            if($old){
                PresenceModel::where("presences_id", $old->presences_id)->update(
                    [
                        'presences_participant' => json_encode($request->participant),
                        'presences_participant_list' => json_encode($request->presences_participant),
                        'presences_user_updated_by' => Auth::user()->id,
                    ]
                );
                return redirect()->back()->with('success_message', "La présence des participants est mise à jour avec succès !");
            }else{
               PresenceModel::create([
                    'presences_code' =>generate_presence_code(),
                    'presences_time_slot' => $datetime[1],
                    'presences_date' => $datetime[0],
                    'presences_planning_id' => $request->plannings_classroom_id,
                    'presences_participant' => json_encode($request->participant),
                    'presences_participant_list' => json_encode($request->presences_participant),
                    'presences_group_id' => $request->plannings_group,
                    'presences_user_created_by' => Auth::user()->id,
                ]);
                return redirect()->back()->with('success_message', "La présence des participants est enregistrée avec succès !");
            }            
        }
    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function certification_store(Request $request)
    {
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'plannings_learning_id' => 'required',
            'participant' => 'required',
                       
        ],[
            'plannings_learning_id.required' => 'Choisissez une formation',
            'participant.required' => 'Aucun participant trouvé',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error_message', "Une erreur est survenue lors de l'enregistrement de la certification !");
        }else{
            //validation okay
          //  dd( $request);
            if($request->presences_participant==null)
                return redirect()->back()->with('error_message', "Aucune certification n'a été soumise !");

            $old = CertificationModel::where("certifications_learnings_id", $request->plannings_learning_id)->where("certifications_group_id", $request->plannings_group)->first();
            if($old){
                CertificationModel::where("certifications_id", $old->certifications_id)->update(
                    [
                        'certifications_participant' => json_encode($request->participant),
                        'certifications_participant_list' => json_encode($request->presences_participant),
                        'certifications_user_created_by' => Auth::user()->id,
                    ]
                );
                return redirect()->back()->with('success_message', "La certification des participants est mise à jour avec succès !");
            }else{
                CertificationModel::create([
                    'certifications_code' =>generate_certif_code(),
                    'certifications_learnings_id' => $request->plannings_learning_id,
                    'certifications_participant' => json_encode($request->participant),
                    'certifications_participant_list' => json_encode($request->presences_participant),
                    'certifications_group_id' => $request->plannings_group,
                    'certifications_user_created_by' => Auth::user()->id,
                ]);
                return redirect()->back()->with('success_message', "La certification des participants est enregistrée avec succès !");
            }            
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function presence_update(Request $request)
    {
        //dd($request);   
        $old_planning = $this->modelplanning->where("plannings_status", 1)->find($request->id);
        if(!$old_planning)
            return back()->with('error_message', "La session de formation que vous désirez éditer n'existe pas'!");
       
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
                        ->with('error_message', "Une erreur est survenue lors de l'enregistrement de la session de formation !");
        }else{
            //validation okay
            $planning = planningModel::where("plannings_id", $request->id)->update([
                'plannings_learning_id' => $request->plannings_learning_id,
                'plannings_classroom_id' => $request->plannings_classroom_id,
                'plannings_teachers' => json_encode($request->plannings_teachers),
                'plannings_user_groups' => json_encode($request->plannings_user_groups),
                'plannings_date' => json_encode($request->plannings_date),
                'plannings_time_slot' => json_encode($request->plannings_time_slot),
                'plannings_infos' => $request->plannings_infos,
                'plannings_user_updated_by' => Auth::user()->id,
            ]);
         if($planning)
            return redirect('/listPlannings')->with('success_message', "La session de formation est mise à jour avec succès !");
            return back()->with('error_message', "Vous ne pouvez pas éditer cette session de formation !");
        }
    }



    //Certification

    public function certify($code=null)
    {
        $data['learning_list'] =$this->modelLearning->where('learnings_status',1)->get();
        return view('certification.create', $data);
    }

    public function certif_learning_groups(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
       return  certif_learning_groups($request->id);	
    }
    public function certify_group_participant_list(Request $request)
    {
       /* if (!$request->isMethod('post'))
		{
			return redirect()->to('/');
		}*/
       return  certify_group_participant_list($request->id, $request->learning);	
    }
}
