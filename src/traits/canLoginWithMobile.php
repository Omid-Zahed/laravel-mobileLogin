<?php

namespace MobileLogin\traits;

trait canLoginWithMobile
{
    public static function afterVerifyMobile($mobile){
        return ["do some thing"];
    }

}
