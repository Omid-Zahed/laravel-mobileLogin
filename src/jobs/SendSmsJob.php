<?php

namespace MobileLogin\jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MobileLogin\interfaces\SmsDeliver;
use MobileLogin\Models\SmsCode;


class SendSmsJob implements ShouldQueue
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
        $expire_at=Carbon::now()->addMinute(config('MobileLogin.code_expire_after_min',5));
        (new SmsCode(["mobile"=>$this->mobile_number,'code'=>$this->code,"expire_at"=>$expire_at]))->save();
       $this->smsDeliver->sendSms($this->mobile_number,$this->code);
    }
}
