<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 登录
     *
     * @param Request $request->name
     * @param Request $request->password
     * @return $result
     */
    public static function loginModel($request){
        $name = $request->get('name');
        $password = $request->get('password');

        $isNameExist = User::where(['name'=>$name])->first();
        if(!$isNameExist) return $result = 0;

        $match = User::where(['name'=>$name,'password'=>$password])->first();
        if($match) return $result = 1;
        else return $result = -1;
    }

    /**
     * 注册
     *
     * @param $request->name
     * @param $request->gender
     * @param $request->tel
     * @param $request->password
     * @return $result
     */
    public static function registerModel($request){
        $name = $request->get('name');
        $gender = $request->get('gender');
        $tel = $request->get('tel');
        $password = $request->get('password');

        $isNameExist = User::where(['name'=>$name])->first();
        if($isNameExist) return $result = 0;
        $res = User::insert(['name'=>$name, 'gender'=>$gender, 'tel'=>$tel,'password'=>$password]);
        if($res) return $result = 1;
        else return $result = -1;
    }


}
