<?php
namespace  Omid\LaraveMoblieLogin;
use  Omid\LaraveMoblieLogin\SmsDelivers\SimpleSmsDeliver;


class MobileLogin
{
    public function create_sms_code($length){
        $length=pow(10,$length);//1000
        $min=($length/10);
        $max=$length-1;
        return rand($min,$max);
    }

    /**
     * @return SimpleSmsDeliver
     */
    public function get_sms_deliver(){
        return new SimpleSmsDeliver();
    }



}
