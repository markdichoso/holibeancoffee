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
    //    helper('form','url');
        $latitude = $this->request->getPost('latitude');
        $longitude = $this->request->getPost('longitude');
        if(!empty($latitude) && !empty($longitude)){
    //send request and receive json data by latitude and longitude
    //$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false&key=AIzaSyCJyDp4TLGUigRfo4YN46dXcWOPRqLD0gQ';
    $url = 'https://us1.locationiq.com/v1/reverse?key=pk.35a6dfbc6fb83f3e2bf972bcfdd6ac50&lat='.trim($_POST['latitude']).'&lon='.trim($_POST['longitude']).'&format=json&';
    $json = @file_get_contents($url);
    $data = json_decode($json);
      
    //if request status is successful
    if($data){
        //get address from json data
        $location = $data->display_name;
    }else{
        $location =  '';
    }
    
    //return address to ajax 
    echo $location;
    } 

        }
  // end of Location //      

  public function Send_In()
    {
    $data = $this->request->getPost();
    print_r($data);  
    //return view('pages/attendance/time-out');
    }
}
