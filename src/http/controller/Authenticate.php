<?php

namespace MobileLogin\http\controller;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use MobileLogin\http\Requests\RequestCodeNumber;
use MobileLogin\http\Requests\RequestMobileNumber;

use MobileLogin\jobs\SendSmsJob;
use MobileLogin\MobileLogin;
use MobileLogin\Models\SmsCode;

class Authenticate extends Controller
{
    public $mobileLogin=null;
    public function __construct(MobileLogin $mobileLogin)
    {
        $throttle = config('mobileLogin.throttle', 10);
        $this->middleware("throttle:$throttle,1")->only('verify', 'send');
        $this->mobileLogin=$mobileLogin;
    }

    public function send(RequestMobileNumber $requestMobileNumber){
        try {
            $mobile_number=$requestMobileNumber->get("mobile");
            $sms_code=$this->mobileLogin->create_sms_code(config("mobileLogin.smsCodeLength"),4);
            $this->dispatch(new SendSmsJob($this->mobileLogin->get_sms_deliver(),$mobile_number,$sms_code));
            return response(["status"=>"ok"],201);
        }
        catch (\Exception $exception){
            return response(["status"=>"false","message"=>$exception],500);
        }
    }
    public function verify(RequestCodeNumber $request){
        try {
                 $code  =$request->get('code');
                 $mobile=$request->get("mobile");
                 $where =[["mobile","=",$mobile],["code","=",$code],["expire_at",">",Carbon::now()]];

                 /**
                 * @var SmsCode $smsCodeModel
                 */
                 $smsCodeModel=SmsCode::where($where)->get()[0]??null;
                 if ($smsCodeModel){
                     $smsCodeModel->delete();
                     return  \App\Models\User::afterVerifyMobile($mobile);
                 }
                 else return response(["status"=>"false","message"=>__("dont found")],401);
        }
        catch (\Exception $exception)
        { return  response(["error"=>$exception->getMessage()],500);}

    }
}
