<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\Users;
use App\Models\Employee_Info;

class Home extends BaseController
{
      
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            // If the user is not logged in, redirect them to the login page
            return redirect()->to('dashboard');
        }
     

        return view('pages/index');
    }

    public function create_pass()
    {
        //         $password = '1234567890';

// // Hash the password using the recommended Argon2id algorithm and default options
// $hash = password_hash($password, PASSWORD_ARGON2ID);

// if ($hash === false) {
//     // Handle error, e.g., log it and display a generic message to the user
//     die('Password hashing failed.');
// }

// // Store the $hash in your database
// echo $hash;
    }
    public function session_destroyer(){
        session()->destroy();

// Optional: Redirect the user after destroying the session
return redirect()->to(base_url(''));
    }

    public function dashboard(){
        
        return view('pages/dashboard');

    }
}
