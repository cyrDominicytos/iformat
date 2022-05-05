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
        $data['learning'] = $this->modelRoom->get_rooms_list(1);
        $data['countries_list'] = countries_list();
        $data['days_list'] = days_list();
        return view('learnings.create', $data);
    }
    public function list()
    {
        $data['learning'] = $this->modelRoom->get_rooms_list(1);
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
        //
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
