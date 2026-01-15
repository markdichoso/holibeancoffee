<?php

namespace App\Controllers;

class LoginValidation extends BaseController
{
    public function Sign_in(){
$db = \Config\Database::connect();
$builder = $db->table('user'); // Load the Query Builder for 'mytable'

// Build the SELECT query
$builder->select();
$query = $builder->get();

// Get the results
$results = $query->getResult(); // Returns an array of objects
// or
$resultsArray = $query->getResultArray(); // Returns an array of arrays

// Iterate through results
print_r($results);
}
}