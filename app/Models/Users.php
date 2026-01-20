<?php 
namespace App\Models;
use App\Models\Users;
use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class Users extends Model
{
    protected $table      = 'user'; // The table name
    protected $primaryKey = 'user_id';    // The primary key field name

    protected $useAutoIncrement = true;

    // Define the fields that are allowed to be mass-assigned
    protected $allowedFields = ['username', 'password', 'date_created', 'remarks']; 

        public function searchUsers($data)
    {
        
        $username = $data['username'];
        return $this->table($this->table)
                    ->where('username', $username) // Produces WHERE `username` LIKE '%searchTerm%'
                    ->findAll();                    // Retrieves all matching results
        //return $password;
    }
}

?>