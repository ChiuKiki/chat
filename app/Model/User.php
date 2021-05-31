<?php

namespace App;

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

        $isTelExist = User::where(['tel'=>$tel])->first();
        if($isTelExist) return $result = 0;
        $res = User::insert(['name'=>$name, 'gender'=>$gender, 'tel'=>$tel,'password'=>$password]);
        if($res) return $result = 1;
        else return $result = -1;
    }

    /**
     * 获取个人信息
     *
     * @param $name
     * @return $result
     */
    public static function userModel($name){
        $result=User::where('name',$name)
            ->select('name','gender','birthday','tel', 'QQ','email')
            ->first();
        return $result;
    }

    /**
     * 修改个人信息
     *
     * @param $request->tel
     * @param $request->name
     * @param $request->gender
     * @param $request->birthday
     * @param $request->QQ
     * @param $request->email
     * @return $result
     */
    public static function updateModel($request){
        $tel = $request->get('tel');
        $name = $request->get('name');
        $gender = $request->get('gender');
        $birthday = $request->get('birthday');
        $QQ = $request->get('QQ');
        $email = $request->get('email');
        $result = User::where('name', $name)->update(
                ['tel' => $tel, 'gender' => $gender, 'birthday' => $birthday, 'QQ' => $QQ, 'email' => $email]
        );
        return $result;
    }

}
