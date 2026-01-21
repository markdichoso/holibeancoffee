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
        helper('form','url');
        $rules = [
            'username' => 'required|max_length[30]|min_length[3]',
            'password' => 'required|max_length[30]|min_length[3]',
                ];
        
                // 3. Run the validation
        if($data = $this->request->getPost()){
        if (! $this->validateData($data, $rules)) {
            // If validation fails, redirect back with input and errors
         //   print_r($data); return false;
            return view('pages/index',$data);
        }
        $userModel = new Users();

        if($return_user = $userModel->searchUsers($data)){
            $pass_verify = $return_user[0]['password'];
            $pass_in = $data['password'];

        if(password_verify($pass_in, $pass_verify)){
            $user = $return_user[0]['user_id'];
            $emp_info = new Employee_Info();
            $return_emp = $emp_info->searchEmp($user);
            $session = session();
            $newdata = [
                            'firstname'  => $return_emp[0]['firstname'],
                            'lastname'     => $return_emp[0]['lastname'],
                            'user_id' => $return_emp[0]['user_id']
                        ];
            $session->set($newdata);
            //echo $session->get('firstname');
            return redirect()->to(base_url('dashboard'));
                    }
            }
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
        
        //echo "This is Dashboard";
        echo session()->get('firstname')." ";
        echo session()->get('lastname');
    }
}
