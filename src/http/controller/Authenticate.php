<?php

namespace MobileLogin\http\controller;
use App\Http\Controllers\Controller;
use MobileLogin\http\Requests\RequestCodeNumber;
use MobileLogin\http\Requests\RequestMobileNumber;

use MobileLogin\MobileLogin;

class Authenticate extends Controller
{
    public $mobileLogin=null;
    public function __construct(MobileLogin $mobileLogin)
    {
        $throttle = config('MobileLogin.throttle', 10);
        $this->middleware("throttle:$throttle,1")->only('verify', 'send');
        $this->mobileLogin=$mobileLogin;
    }

    public function send(RequestMobileNumber $requestMobileNumber){




    }
    public function verify(RequestCodeNumber $request){

    }
}
