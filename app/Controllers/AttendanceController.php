<?php
namespace App\Controllers;
namespace App\Filters;
namespace App\Controllers;
use App\Models\Attendance;
use CodeIgniter\I18n\Time;


class AttendanceController extends BaseController
{
    
    public function TimeIn()
    {
        
        if (!isset($_SESSION['user_id'])) {
            // If the user is not logged in, redirect them to the login page
            return redirect()->to('');
        }

         $emp_info_id = $_SESSION['emp_info_id'];
         //echo $emp_info_id;
         $attendanceModel = new Attendance();
        if($attendance = $attendanceModel->searchAttendance($emp_info_id)){
           // echo $attendance->location_in;
           echo date('l, F d, Y');
            $in = [
                'address' => $attendance[0]["location_in"],
            ];
            return view('pages/attendance/time-in',$in);
            }             
                else
            { 
                return view('pages/attendance/time-in'); 
            }
    }
        

        public function TimeOut()
    {
        
        if (!isset($_SESSION['user_id'])) {
            // If the user is not logged in, redirect them to the login page
            return redirect()->to('');
        }
        $emp_info_id = $_SESSION['emp_info_id'];
         //echo $emp_info_id;
         $attendanceModel = new Attendance();
        if(!$attendance = $attendanceModel->searchAttendance($emp_info_id)){
           // echo $attendance->location_in;
            $in = [
                'address' => 'You are not yet time in',
            ];
        return view('pages/attendance/time-in',$in);
        }             

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
    $userModel = new Attendance();
    $data = $this->request->getPost();
    $myTime = Time::now('Asia/Manila', 'en_US');
    //echo $myTime; return false;
    $data['date_in']=$myTime->format("l, F d, Y h:i:s");
    //print_r($data); return false;
        // Use the insert() method for new records
        if ($userModel->insert($data)){
        return redirect()->to('timein')->with('success', 'Successfully Time in!');
        }
    }

    public function Send_Out()
    {      
    $userModel = new Attendance();
    $data = $this->request->getPost();
    $myTime = Time::now('Asia/Manila', 'en_US');
    $data['date_out']=$myTime->format("l, F j, Y h:i:s");
    $userModel = new Attendance();
 
    if ($userModel->time_out($data)){
        return redirect()->to('timeout')->with('success', 'Successfully Time out!');
        }
    }
}
