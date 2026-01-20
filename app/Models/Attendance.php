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
    //$db      = \Config\Database::connect();
    $builder = new Attendance();
    //$builder = $db->table('attendance');
    $date_out=$data['date_out'];
    $location_out=$data['location_out'];
    $currentDate = date('l, F d, Y');
    // $data['date_out']=date("l, F j, Y H:i:s");
    $builder->set('date_out', $date_out);
    $builder->set('location_out', $location_out);
    $builder->where('emp_info_id', 1);
    $builder->like('date_in', $currentDate);
    $builder->update();
    return true;
    
    

    }
}

?>