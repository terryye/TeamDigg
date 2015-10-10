<?php

namespace App;

use App\Libs\Storage;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
/*
    const  USER_ROLE_GUEST  = 10000;  //不是小组的成员,游客
    const  USER_ROLE_FOUNDER = 10001;  //创始人
    const  USER_ROLE_MANAGER = 10002;  //管理员
    const  USER_ROLE_MEMBER  = 10003;  //会员、参与者
    const  USER_ROLE_FOLLOWER  = 10004;  //订阅者
*/

    /**
     * The table associated with the model.
     *
     * @var string
     */
//    protected $table = 'teams'; // 默认的数据表名称
    /**
     * @var string Primary Key
     */
    protected $primaryKey = "team_id";
    /**
     * fillable fields for a Team.
     *
     * @var array
     */
    protected $fillable = [
        'team_name',
        'team_intro'
    ];

    public $max_manager = 3;

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * An team is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot("user_role","updated_at");
    }

    public function currentUserRole(){
        $uid = Auth::user()->id;
        $user = $this->users()->find($uid);


        if ( isset($user['pivot']['user_role']) ) {
            return intval($user['pivot']['user_role']);
        } else {
            return Role::TEAM_GUEST;
        }
    }

    public function checkCurrentUsePrivilege($privilegeId){
        $role_id = $this->currentUserRole();
        return Role::checkPrivilege($role_id, $privilegeId);
    }

    public function attach($userID, $roleID){
        $this->users()->withTimestamps()->attach($userID,['user_role'=>$roleID]);
    }


    /**
     * An article is owned by a user.
     *
     * @return \Illuminate\Datebase\Eloquent\Relations\HasMany
     */
    public function authors()
    {
        //return $this->hasMany('App\Author');

    }

    /**
     * Get the icon url address
     *
     * @return array
     */
    public function getIconAttribute()
    {
        if($this->team_id){
            return Storage::getUrl('team_icon',$this->team_id . ".png");
        } else{
            return asset("img/icon.jpeg");
        }
    }

    /**
     *
     */
    public static function getIconUrlByTeamId($team_id){
        if($team_id){
            return Storage::getUrl('team_icon',$team_id . ".png");
        } else{
            return asset("img/icon.jpeg");
        }
    }

}
