<?php 
namespace App\Models;
use App\Models\Acitivy;
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

    public function time_out($data)
    {
    $emp_info_id = $_SESSION['emp_info_id'];
    //$db      = \Config\Database::connect();
    $builder = new Attendance();
    //$builder = $db->table('attendance');
    $date_out=$data['date_out'];
    $location_out=$data['location_out'];
    $currentDate = date('l, F j, Y');
    // $data['date_out']=date("l, F j, Y H:i:s");
    $builder->set('date_out', $date_out);
    $builder->set('location_out', $location_out);
    $builder->where('emp_info_id', $emp_info_id);
    $builder->where('location_out IS NULL');
    $builder->like('date_in', $currentDate);
    $builder->update();
    return true;   

    }

    public function searchAttendance($data)
    {
        
        $emp_info_id = $data;
        $currentDate = date('l, F j, Y');
        return $this->table($this->table)
                    ->where('emp_info_id', $emp_info_id)
                    ->where('location_out IS NULL')
                    ->where('location_in !=', '')
                    ->like('date_in', $currentDate) // Produces WHERE `username` LIKE '%searchTerm%'
                    ->findAll();                    // Retrieves all matching results
        //return $password;
    }
}

?>