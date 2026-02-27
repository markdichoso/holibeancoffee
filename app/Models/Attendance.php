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
     return true;
    } else {
    return false;
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
                    ->like('date_in', $currentDate) 
                    ->findAll();
    }
        function getDaily()
    {
            $emp_info_id = $_SESSION['emp_info_id'];
            $db = \Config\Database::connect();    
            $sql = 'SELECT * FROM attendance att 
            where emp_info_id = ? and date(date_in) = CURDATE() 
            and date_out is null and location_in != ""';
            $query = $db->query($sql, [$emp_info_id]); // Use binding for security
            $result = $query->getRow();
            return $result;
    }

    function getMonthly()
    {
            $emp_info_id = $_SESSION['emp_info_id'];
            $db = \Config\Database::connect();    
            $sql = 'SELECT SUM(timestampdiff(SECOND, date_in, date_out)/3600) as hours FROM attendance att
            inner join employee_info ei on ei.emp_info_id = att.emp_info_id WHERE att.emp_info_id = ? 
            and MONTH(date_in) = MONTH(NOW())';
            $query = $db->query($sql, [$emp_info_id]); // Use binding for security
            $result = $query->getRow();
            return $result;
    }

    function getWeekly()
    {
            $emp_info_id = $_SESSION['emp_info_id'];
            $db = \Config\Database::connect();    
            $sql = 'SELECT concat(ei.firstname, " ", ei.lastname) name, SUM(timestampdiff(SECOND, date_in, date_out)/3600) as hours 
            FROM u142516471_hbishbc.attendance att 
            inner join employee_info ei on ei.emp_info_id = att.emp_info_id where att.emp_info_id = ? and YEARWEEK(date_in, 1) = YEARWEEK(CURDATE(), 1);';
            $query = $db->query($sql, [$emp_info_id]); // Use binding for security
            $result = $query->getRow();
            return $result;
    }
}

?>