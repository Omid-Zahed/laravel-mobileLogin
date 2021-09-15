<?php

namespace  Omid\LaraveMoblieLogin\tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{

    protected function sendRequest($mobile): \Illuminate\Testing\TestResponse
    {
        $data=["mobile"=>$mobile];
        $sendRoute=config("mobileLogin",'api/mobile/send');
        return $this->withHeader("Accept","application/json")->post('api/mobile/send',$data);
    }


    public function test_store_wrong_number(){
       $wrong_numbers=["09359814171","1232","935081417","93508141711","3508141710"];
       foreach ($wrong_numbers as $number){
           $response=$this->sendRequest($number);
           $response->assertStatus(422);
       }
    }
    public function test_store(){
        $response=$this->sendRequest("9350814171");
        $response->assertStatus(201);
        $response->assertJson(["status"=>"ok"]);
    }


}
