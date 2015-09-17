<?php

namespace App\Http\Controllers\Manage;

use App\Libs\Storage;
use App\Team;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //

        return view("manage.home");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view("manage.team_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Team $team, Request $request)
    {
        //入库基本资料，
        $result = $team->create($request->all());
        $team_id = $result['id'];

        $this->saveTeamIcon($team_id);



    }

    private function saveTeamIcon ($team_id){

        $icon_name = $team_id;
        $tmp_file = Input::file("team_icon");
        $tmp_file_name = $tmp_file->getPathname();
        $ext = $tmp_file->guessClientExtension();

        if(in_array($ext,["png","jpg","gif","jpeg"])){
            $url = Storage::upload("team_icon", $icon_name .".".$ext,  $tmp_file_name);
        }else{

        }

        dd($url);


        //存储图标
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
