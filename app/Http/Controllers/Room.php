<?php

namespace App\Http\Controllers;

use App\Models\ClassRoomModel;
use App\Models\LearningModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class Room extends Controller
{

    protected $modelRoom = null;
    protected $modelLearning = null;

    public function __construct(){
        $this->modelRoom = new ClassRoomModel();
        $this->modelLearning = new LearningModel();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
    }

    public function list()
    {
        $data['rooms'] = $this->modelRoom->get_rooms_list(1);
        $data['countries_list'] = countries_list();
        return view('rooms.list', $data);
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
                'classrooms_countries_id' => 'required',
                'classrooms_state' => 'required',
                'classrooms_name' => [
                    'required',
                    'max:255',
                    'classrooms_name' => Rule::unique('classrooms')
                        ->where(fn ($query) => $query->where('classrooms_countries_id', $request->classrooms_countries_id))
                        ->where(fn ($query) => $query->where('classrooms_status', 1))
                ],
            ],[
                'classrooms_name.required' => 'Renseignez la désignation du site',
                'classrooms_state.required' => 'Renseignez le département du site',
                'classrooms_name.unique' => 'Ce site de formation est déjà créé dans cette ville',
                'classrooms_name.max' => 'La désignation du site doit comporter maximum 255 caractères',
                'classrooms_countries_id.required' => 'Renseignez la ville du site',
            ]);
     
            if ($validator->fails()) {
                return redirect('/listRooms')
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error_message', "Une erreur est survenue lors de la création du site de formation !");
            }else{
                //validation okay
                $classrooms = ClassRoomModel::create([
                    'classrooms_name' => $request->classrooms_name,
                    'classrooms_countries_id' => $request->classrooms_countries_id,
                    'classrooms_detail' => $request->classrooms_detail,
                    'classrooms_state' => $request->classrooms_state,
                    'classrooms_user_created_by' => Auth::user()->id,
                ]);

                //dd($classrooms);
                return redirect('/listRooms')->with('success_message', "Un nouveau site est créé avec succès !");
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
    public function edit(Request $request)
    {
       
            $validator = Validator::make($request->all(), [
                'classrooms_countries_id' => 'required',
                'classrooms_state' => 'required',
                'classrooms_name' => [
                    'required',
                    'max:255',
                    'classrooms_name' => Rule::unique('classrooms')
                        ->ignore($request->id, 'classrooms_id')
                        ->where(fn ($query) => $query->where('classrooms_countries_id', $request->classrooms_countries_id))
                        ->where(fn ($query) => $query->where('classrooms_status', 1))
                ],
            ],[
                'classrooms_name.required' => 'Renseignez la désignation du site',
                'classrooms_name.unique' => 'Ce site de formation est déjà créé dans cette ville',
                'classrooms_name.max' => 'La désignation du site doit comporter maximum 255 caractères',
                'classrooms_countries_id.required' => 'Renseignez la ville du site',
                'classrooms_state.required' => 'Renseignez le département du site',
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
                    'classrooms_state' => $request->classrooms_state,
                    'classrooms_user_updated_by' => Auth::user()->id,
                ]);

                //dd($classrooms);
                return redirect('/listRooms')->with('success_message', "Le site de formation a été mise à jour avec succès !");
            }

      
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
