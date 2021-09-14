<?php

namespace Login_with_sms\jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Login_with_sms\interfaces\SmsDeliver;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   protected $mobile_number,$code,$smsDeliver;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SmsDeliver $smsDeliver,$mobile_number,$code)
    {
        $this->code=$code;
        $this->smsDeliver=$smsDeliver;
        $this->mobile_number=$mobile_number;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $this->smsDeliver->sendSms($this->mobile_number,$this->code);
    }
}
