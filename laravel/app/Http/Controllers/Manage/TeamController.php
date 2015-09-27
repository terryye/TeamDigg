<?php

namespace App\Http\Controllers\Manage;

use App\Libs\Storage;
use App\Role;
use App\Team;
use Barryvdh\Debugbar;
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
        //todo: list the first page of it.
        $teams_arr = Auth::user()->teams()->get()->toArray();

        //
        $teams = [];
        foreach ($teams_arr as $team) {
            $team['icon'] = Team::getIconUrlByTeamId($team['team_id']);
            $u_type = $team['pivot']['user_role'];
            if (!isset($teams[$u_type])) {
                $teams[$u_type] = [];

            }
            array_push($teams[$u_type], $team);
        }

        $creaters = isset($teams[Role::TEAM_FOUNDER]) ? $teams[Role::TEAM_FOUNDER] : null;
        $managers = isset($teams[Role::TEAM_MANAGER]) ? $teams[Role::TEAM_MANAGER] : null;
        $members = isset($teams[Role::TEAM_MEMBER]) ? $teams[Role::TEAM_MEMBER] : null;
        $followers = isset($teams[Role::TEAM_FOLLOWER]) ? $teams[Role::TEAM_FOLLOWER] : null;
        return view("manage.home",
            compact("creaters", 'managers', 'members', 'followers'));

    }

    public function validator(Request $request)
    {
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
    public function create(Team $team)
    {
        //最多创建10个群
        $this->_checkMaxCreate();

        $disabled = "";

        //
        return view("manage.team_create", compact('team', 'disabled'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //验证
        $this->validator($request);

        //最多创建10个群
        $this->_checkMaxCreate();

        $pivot_attr = ['user_role' => Role::TEAM_FOUNDER];

        //入库基本资料
        $result = Auth::user()->teams()->withTimestamps()->create($request->all(), $pivot_attr);

        //入库图标
        $team_id = $result['id'];
        if ($request->hasFile("team_icon")) {
            $this->_saveTeamIcon($team_id);
        }

        //feeds页面
        $url = route("manage.team.subscribe", ['team_id' => $team_id]);
        return redirect($url);

    }

    private function _saveTeamIcon($team_id)
    {

        $tmp_file = Input::file("team_icon");
        $tmp_file_name = $tmp_file->getPathname();
        $ext = $tmp_file->guessClientExtension();
        $icon_name = $team_id . ".png";

        if (in_array($ext, ["png", "jpg", "gif", "jpeg"])) {
            $img_data = Image::make($tmp_file_name)->fit(200)->encode("png");
            //$url = Storage::upload("team_icon", $icon_name,  $tmp_file_name);
            Storage::write("team_icon", $icon_name, $img_data);
        }
        return;
    }

    public function member($team_id, Request $request)
    {
        $nick = $request->input('nick');


        $team = Team::find($team_id);

        $teamModel = $team->users();
        if ($nick) {
            $teamModel->where("name", 'like', "%$nick%");
        }


        $team_users = $teamModel
            ->orderBy('pivot_user_role', 'asc')
            ->orderBy('pivot_updated_at', 'desc')
            ->paginate(15);
        if ($nick) {
            $team_users->appends('nick', $nick);
        }

        //$team_users->setPath('custom/url');

        $role_map = Role::getRoleMap();
        return view("manage.team_member",
            compact('team',
                "team_users",
                'role_map',
                'nick')
        );
    }

    public function subscribe()
    {
        return "under construction";
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $team_id
     *
     * @return Response
     */
    public function edit($team_id)
    {

        //获取当前用户在团队中的角色
        $team = Team::find($team_id);
        $role = $team->currentUserRole();

        //有展示的权限即可查看编辑页面。在保存时会检查是否有更新的权限
        if (!Role::checkPrivilege($role, Role::PRIV_VIEW)) {
            abort(403, "你不是团队的成员，没有查看的权限");
        }


        $manager = Role::checkPrivilege($role, Role::PRIV_UPDATE);
        $disabled = $manager ? "" : "disabled";

        if (!$manager) {
            view()->share('info', "您没有修改当前团队资料的权限。");
        }

        return view("manage.team_edit", compact("team", 'disabled'));
    }

    /*
        private function _authTeamManagerByTeamId($team_id)
        {
            use DB;

            $uid = Auth::user()->id;
            $team = new Team();
            $team_tbname = $team->getTable();
            $pivot_tbname = $team->users()->getTable();

            $results = DB::selectOne("select team_user.user_role from $pivot_tbname as team_user
                                          left join $team_tbname as teams
                                            on teams.team_id = team_user.team_id
                                            where team_user.user_id = ?", [$uid]);

            if (isset($results->user_role)
                && in_array($results->user_role,
                    [Role::TEAM_FOUNDER, Role::MANAGER]
                )
            ) {
                return true;
            }

            abort(403, "你不是团队的管理员，没有修改的权限");
        }
    */

    private function _checkMaxCreate()
    {
        $teamCount = Auth::user()->teams()->count();
        if ($teamCount >= 10) {
            abort(403, "每个用户只能创建10个团队哦。");
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  int $team_id
     * @param  Request $request
     * @return Response
     */
    public function update($team_id, Request $request)
    {

        //验证
        $this->validator($request);


        $team = Team::find($team_id);

        if (!$team->checkCurrentUsePrivilege(Role::PRIV_UPDATE)) {
            abort(403, "您没有修改该团队的权限。");
        }

        $team->update($request->all());

        //入库图标
        if ($request->hasFile("team_icon")) {
            $this->_saveTeamIcon($team_id);
        }

        $url = route("manage.home");
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //

    }
}
