<?php

namespace  Omid\LaraveMoblieLogin\interfaces;

interface SmsDeliver
{
 public function sendSms($mobile,$text);
}
