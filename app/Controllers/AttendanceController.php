<?php

namespace App\Controllers;

class AttendanceController extends BaseController
{
    public function TimeIn(): string
    {
       // echo 'test';
        return view('pages/attendance/time-in');
    }

        public function TimeOut(): string
    {
        return view('pages/attendance/time-out');
    }
// for reconstruction direct location used instead //
    public function Location()
    {
     if ($this->request->is('post')) {
            // Retrieve specific post data
            $latitude = $this->request->getPost('latitude');
            $longitude = $this->request->getPost('longitude');
     }
    $url = 'https://us1.locationiq.com/v1/reverse?key=pk.35a6dfbc6fb83f3e2bf972bcfdd6ac50&lat='.$latitude.'&lon='.$longitude.'&format=json&';
    $json = @file_get_contents($url);
    $data = json_decode($json);
   // $status = $data->status;
   
    //if request status is successful
    if($data){
        //get address from json data
        $location = $data->display_name;
    }else{
        $location =  '';
    }
    
    //return address to ajax 
    echo $location;
   // }

    echo "test";
        }
  // end of Location //      
}
