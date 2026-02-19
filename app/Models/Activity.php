<?php 
namespace App\Models;
use App\Models\Activity;
use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class Activity extends Model
{
    protected $table      = 'activity'; // The table name
    protected $primaryKey = 'activity_id';    // The primary key field name

    protected $useAutoIncrement = true;

    // Define the fields that are allowed to be mass-assigned
    protected $allowedFields = ['activity_id', 'action_taken', 'emp_info_id', 'location', 'date']; 
    
    // You can also use other model features like validation, timestamps, etc.

public function recentActivity()
    {
        $emp_info_id = $_SESSION['emp_info_id'];
        return $this->table($this->table)
                ->where('emp_info_id',$emp_info_id) // Produces WHERE `username` LIKE '%searchTerm%'
                ->orderBy('date', 'DESC')
                ->limit(5,0)
                ->findAll();                    // Retrieves all matching results
        //return $password;
    }

}

?>