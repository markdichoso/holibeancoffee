<?php 
namespace App\Models;

use CodeIgniter\Model;

class Attendance extends Model
{
    protected $table      = 'attendance'; // The table name
    protected $primaryKey = 'attendance_id';    // The primary key field name

    protected $useAutoIncrement = true;

    // Define the fields that are allowed to be mass-assigned
    protected $allowedFields = ['emp_info_id', 'date_in', 'location_in', 'date_out', 'location_out']; 
    
    // You can also use other model features like validation, timestamps, etc.
}

?>