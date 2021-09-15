<?php

namespace  Omid\LaraveMoblieLogin\tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use  Omid\LaraveMoblieLogin\Models\SmsCode;
use Tests\TestCase;

class VerifyTest  extends TestCase
{



    protected function sendRequest($mobile,$code): \Illuminate\Testing\TestResponse
    {
        $data=["mobile"=>$mobile,"code"=>$code];
        $sendRoute=config("mobileLogin.verifyRoute",'api/mobile/verify');
        return $this->withHeader("Accept","application/json")->post($sendRoute,$data);
    }
    protected function createNewSmsCode($mobile,$code): SmsCode
    {
        $smsCodeModel=new SmsCode();
        $smsCodeModel->mobile=$mobile;
        $smsCodeModel->code=$code;
        $smsCodeModel->expire_at=Carbon::now()->addMinute(5);
        $smsCodeModel->save();
        return $smsCodeModel;
    }

    public function test_verify_with_wrong_mobile(){
       $wrong_numbers=["09359814171","1232","935081417","93508141711","3508141710"];
       foreach ($wrong_numbers as $code=>$mobile){
           $response=$this->sendRequest($mobile,$code);
           $response->assertStatus(422);
       }
    }
    public function test_verify_with_wrong_code(){
        $smsCodeModel=$this->createNewSmsCode("9350814171",(string)rand(1000,9999));
        $response=$this->sendRequest($smsCodeModel->mobile,"12345");
        $response->assertStatus(401);
    }
    public function test_verify(){
        $smsCodeModel=$this->createNewSmsCode("9350814171",(string)rand(1000,9999));
        $response=$this->sendRequest($smsCodeModel->mobile,$smsCodeModel->code);
        $response->assertStatus(200);

    }



}
