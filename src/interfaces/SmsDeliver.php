<?php

namespace MobileLogin\interfaces;

interface SmsDeliver
{
 public function sendSms($mobile,$text);
}
