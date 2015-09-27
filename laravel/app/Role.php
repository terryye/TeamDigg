<?php

namespace App;

class Role {

    const  TEAM_GUEST  = 10000;  //不是小组的成员,游客
    const  TEAM_FOUNDER = 10010;  //创始人  所有权限，可以解散团队
    const  TEAM_MANAGER = 10020;  //管理员  解散团队以外的所有权限
    const  TEAM_MEMBER  = 10030;  //会员    可以分享内容，订阅内容。
    const  TEAM_FOLLOWER  = 10040;  //追随者  只能够查看其他人分享的内容



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


    public static function getRoleMap( ){
        $roleMap = [
            self::TEAM_GUEST => '游客',

            self::TEAM_FOUNDER => '创始人',

            self::TEAM_MANAGER => '管理员',

            self::TEAM_MEMBER => '会员',

            self::TEAM_FOLLOWER => '追随者',
        ];

        return $roleMap;
    }

}