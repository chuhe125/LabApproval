<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 登录
     * @param Request $loginRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $loginRequest)
    {

        try {
            $credentials = self::credentials($loginRequest);
            if (!$token = auth('api')->attempt($credentials)) {
                return json_fail(100, '账号或者密码错误!', null);
            }
            $login_role = $loginRequest['login_role'];

            return self::respondWithToken($token, '登录成功!',$login_role);
        } catch (\Exception $e) {

            echo $e->getMessage();
            return json_fail(500, '登录失败!', null, 500);
        }
    }

    /**
     * 注销登录
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth()->logout();
        } catch (\Exception $e) {

        }
        return auth()->check() ?
            json_fail('注销登录失败!',null, 100 ) :
            json_success('注销登录成功!',null,  200);
    }



    protected function credentials($request)
    {
        return ['user_account' => $request['user_account'], 'password' => $request['password']];
    }

    protected function respondWithToken($token, $msg,$login_role)
    {
        $data = Auth::user();
        //echo $data;
        //echo "\n";
        if($data['status'] != $login_role)
        {
            return json_fail('没有权限！',$data['status'],222);
        }

        return json_success( $msg, array(
            'token' => $token,
            //设置权限  'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ),200);
    }

    /**
     * 注册
     * @param Request $registeredRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function registered(Request $registeredRequest)
    {
        return User::createUser(self::userHandle($registeredRequest)) ?
            json_success('注册成功!',null,200  ) :
            json_success('注册失败!',null,100  ) ;

    }
    protected function userHandle($request)
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        $registeredInfo['user_account'] = $registeredInfo['user_account'];
        $registeredInfo['status'] = $registeredInfo['status'];


        return $registeredInfo;
    }

    public function test(Request $request){
        $id = Auth::id();
        echo $id;
    }
}
