<?php

namespace App;

class Role {

    const  TEAM_GUEST  = 10000;  //不是小组的成员,游客
    const  TEAM_FOUNDER = 10001;  //创始人
    const  TEAM_MANAGER = 10002;  //管理员
    const  TEAM_MEMBER  = 10003;  //会员、参与者
    const  TEAM_FOLLOWER  = 10004;  //订阅者



    const PRIV_VIEW = 11000;
    const PRIV_UPDATE = 11002;
    const PRIV_REMOVE = 11003;
    const PRIV_SUBSCRIBE = 11004;


    public static function checkPrivilege($roleId, $privilegeId){
        $privMap = [
            self::TEAM_GUEST => [
                self::PRIV_VIEW
            ],

            self::TEAM_FOUNDER => [
                self::PRIV_VIEW,
                self::PRIV_UPDATE,
                self::PRIV_REMOVE,
                self::PRIV_SUBSCRIBE
            ],

            self::TEAM_MANAGER => [
                self::PRIV_VIEW,
                self::PRIV_UPDATE,
                self::PRIV_SUBSCRIBE
            ],

            self::TEAM_MEMBER => [
                self::PRIV_VIEW,
                self::PRIV_SUBSCRIBE
            ],

            self::TEAM_FOLLOWER => [
                self::PRIV_VIEW,
            ],
        ];

        return isset($privMap[$roleId]) && in_array($privilegeId, $privMap[$roleId]);
    }

}