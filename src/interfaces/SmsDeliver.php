<?php

namespace Login_with_sms\interfaces;

interface SmsDeliver
{
 public function sendSms($mobile,$text);
}
