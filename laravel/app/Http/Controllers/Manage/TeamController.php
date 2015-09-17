<?php

namespace App\Http\Controllers\Manage;

use App\Libs\Storage;
use App\Team;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

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

    public function validator(Request $request){
        $this->validate($request, [
            'team_name' => 'required|max:60',
            'team_icon' => 'image|max:500',
        ]);
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
        //验证
        $this->validator($request);

        //入库基本资料s
        $result = $team->create($request->all());

        //入库图标
        $team_id = $result['id'];
        if($request->hasFile("team_icon")){
            $this->saveTeamIcon($team_id);
        }

        //feeds页面
        return redirect(route("manage.team.subscribe",['team_id'=>$team_id]));
    }

    private function saveTeamIcon ($team_id){

        $tmp_file = Input::file("team_icon");
        $tmp_file_name = $tmp_file->getPathname();
        $ext = $tmp_file->guessClientExtension();
        $icon_name = $team_id .".png";

        if(in_array($ext,["png","jpg","gif","jpeg"])){
            $imgdata = Image::make($tmp_file_name)->fit(200)->encode("png");
            //$url = Storage::upload("team_icon", $icon_name,  $tmp_file_name);
            Storage::write("team_icon" , $icon_name ,$imgdata);
        }
        return ;
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
