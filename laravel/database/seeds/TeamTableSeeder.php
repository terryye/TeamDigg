<?php

use App\Role;
use App\Team;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('team_user')->delete();
        DB::table('teams')->delete();

        for($i=1; $i<40; $i++){
            Team::updateOrCreate([
                "team_id"    => $i,
                'team_name' => '这是团队 -' . $i,
                'team_intro'   => "团队 $i 的介绍",
            ]);
        }

        for($i=1; $i<20; $i++) {

            if ($i == 1) {
                $role_id = Role::TEAM_FOUNDER;
            }else if ( $i % 4  == 1) {
                $role_id = Role::TEAM_MANAGER;
            }else if ( $i % 4  == 1) {
                $role_id = Role::TEAM_MANAGER;
            }else if ( $i % 4  == 2) {
                $role_id = Role::TEAM_MEMBER;
            }else if ( $i % 4  == 3) {
                $role_id = Role::TEAM_FOLLOWER;
            }

            $user_id = $i;
            $team_id = 1;

            $team = Team::find($team_id);
            if($team){
                $team->attach($user_id, $role_id);
            }
        }
    }
}
