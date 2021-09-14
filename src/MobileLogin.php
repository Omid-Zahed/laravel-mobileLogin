<?php
namespace MobileLogin;
use Login_with_sms\interfaces\SmsDeliver;


class MobileLogin
{
    public function create_sms_code($length){
        $length=pow(10,$length);//1000
        $min=($length/10);
        $max=$length-1;
        return rand($min,$max);
    }

    /**
     * @return SmsDeliver
     */
    public function get_sms_deliver(){

    }

    public function after_confirm_mobile($mobile){
        //todo do some thing
        return ["status"=>"ok"];
    }

}
