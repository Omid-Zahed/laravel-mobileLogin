<?php

namespace  Omid\LaraveMoblieLogin\traits;

trait canLoginWithMobile
{
    public static function afterVerifyMobile($mobile){
        return ["do some thing"];
    }

}
