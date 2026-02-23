<?php 
namespace App\Models;
use App\Models\Employee_Info;
use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class Employee_Info extends Model
{
    protected $table      = 'employee_info'; // The table name
    protected $primaryKey = 'emp_info_id';    // The primary key field name

    protected $useAutoIncrement = true;

    // Define the fields that are allowed to be mass-assigned
    protected $allowedFields = ['user_id', 'firstname', 'lastname', 'status_id', 'role_id', 'date_created', 'remarks']; 
    
    // You can also use other model features like validation, timestamps, etc.

    public function searchEmp($emp)
    {
        
        $user_id = $emp;  
        return $this->table($this->table)
                    ->where('user_id', $user_id) // Produces WHERE `username` LIKE '%searchTerm%'
                    ->findAll();                    // Retrieves all matching results
        
    }
}

?>