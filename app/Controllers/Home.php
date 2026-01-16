<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;

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
            //print_r($data); return false;
            return view('pages/index',$data);
        }
        }

        return view('pages/index');
    }

    public function check()
    {
        helper('form','url');
        $data = $this->request->getPost();
        //if($data){
           print_r($data);
        //}
        //return view('pages/index',$data);
    }
}
