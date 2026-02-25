<?php 
namespace App\Models;
use App\Models\Attendance;
use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class Attendance extends Model
{
    protected $table      = 'attendance'; // The table name
    protected $primaryKey = 'attendance_id';    // The primary key field name

    protected $useAutoIncrement = true;

    // Define the fields that are allowed to be mass-assigned
    protected $allowedFields = ['emp_info_id', 'date_in', 'location_in', 'date_out', 'location_out']; 
    
    // You can also use other model features like validation, timestamps, etc.

    public function time_out($data)
    {
    $emp_info_id = $_SESSION['emp_info_id'];
    //$db      = \Config\Database::connect();
    $builder = new Attendance();
    //$builder = $db->table('attendance');
    $date_out=$data['date_out'];
    $location_out=$data['location_out'];
    $currentDate = date('Y:m:d');
    // $data['date_out']=date("l, F j, Y H:i:s");
    $builder->set('date_out', $date_out);
    $builder->set('location_out', $location_out);
    $builder->where('emp_info_id', $emp_info_id);
    $builder->where('location_out IS NULL');
    $builder->like('date_in', $currentDate);
    $builder->update();
   if ($this->db->affectedRows() > 0) {
    // Rows were successfully updated and changed
    return true;
    //echo "Update successful and rows affected.";
    } else {
    return false;
    // Query ran successfully but no data was changed, or no matching record was found
    //echo "Query successful, but no rows were updated.";
}

    }

    public function searchAttendance($data)
    {
        
        $emp_info_id = $data;
        $currentDate = date('Y:m:d');
        return $this->table($this->table)
                    ->where('emp_info_id', $emp_info_id)
                    ->where('location_out IS NULL')
                    ->where('location_in !=', '')
                    ->like('date_in', $currentDate) // Produces WHERE `username` LIKE '%searchTerm%'
                    ->findAll();
        //$num_rows = $query->getNumRows();
        //return $num_rows;
                    // Retrieves all matching results
        //return $password;
    }
}

?>