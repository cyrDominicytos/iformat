<?php

namespace App\Http\Controllers;

use App\Models\ClassRoomModel;
use App\Models\LearningModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Learning extends Controller
{

    protected $modelRoom = null;
    protected $modelLearning = null;

    public function __construct(){
        $this->modelRoom = new ClassRoomModel();
        $this->modelLearning = new LearningModel();

    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data['learning'] = $this->modelRoom->get_rooms_list(1);
        $data['countries_list'] = countries_list();
        $data['days_list'] = days_list();
        $data['cabinet_list'] = cabinet_list();
        return view('learnings.create', $data);
    }

    public function list()
    {
        $data['learning'] = $this->modelLearning->get_learnings_list(1);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
