<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    /**
     * 登录
     *
     * @param Request $request->name
     * @param Request $request->password
     * @return 'message'
     *
     * test：
     * http://chat.chiukiki.cn/api/login?name=小赵&password=aaaaaa
     */
    public function login(Request $request){
        $result = User::loginModel($request);
        switch($result){
            case "0":
                return response(array('message'=>'账号不存在'),401);
                break;
            case "1":
                return response(array('message'=>'登录成功'));
                break;
            default:
                return response(array('message' => '用户名或密码错误'), 401);

        }
    }


    /**
     * 注册
     *
     * @param Request $request->name
     * @param Request $request->gender
     * @param Request $request->tel
     * @param Request $request->password
     * @param Request $request->confirmPassword
     * @return 'message'
     *
     * test:
     * http://chat.chiukiki.cn/api/register?name=小赵&gender=女&tel=15800280827&password=aaaaaa&confirmPassword=aaaaaa
     */
    public function register(Request $request){
        $password = $request->get('password');
        $confirmPassword = $request->get('confirmPassword');
        if($password == $confirmPassword) {
            $result = User::registerModel($request);
            switch($result){
                case "0":
                    return response(array('message' => '该用户名已被注册'), 403);
                    break;
                case "1":
                    return response(array('message' => '注册成功'));
                    break;
                default:
                    return response(array('message' => '注册失败'), 403);

            }
        }else return response(array('message' => '密码不一致'), 403);
    }


}
