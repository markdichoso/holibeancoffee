<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\Users;
use App\Models\Employee_Info;

class LoginValidation extends BaseController
{
        public function Sign_In()
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
        }

// ******************************* verifying the username and password ****************************//
        $userModel = new Users();
        //$data = $this->request->getPost();
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
                            'emp_info_id'     => $return_emp[0]['emp_info_id'],
                            'user_id' => $return_emp[0]['user_id']
                        ];
            $session->set($newdata);
            //echo $session->get('firstname');
            return redirect()->to(base_url('attendance'));
                    }
                else {
                    return redirect()->to('')->with('success', 'Invalid Credentials!');
                }
            }
            else {
                return redirect()->to('')->with('success', 'Invalid Credentials!');
            }
        }

    }

    
    

    

