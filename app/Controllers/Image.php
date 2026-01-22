<?php
// app/Controllers/Image.php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Files\File;

class Image extends Controller
{
    public function capture()
    {
         if (!isset($_SESSION['user_id'])) {
            // If the user is not logged in, redirect them to the login page
            return redirect()->to('');
        }

        return view('capture_image');
    }

    public function upload()
    {
         if (!isset($_SESSION['user_id'])) {
            // If the user is not logged in, redirect them to the login page
            return redirect()->to('');
        }

        $request = $this->request;
        $imageData = $request->getPost('imageData');
        
        // Remove the "data:image/jpeg;base64," part
        $filteredData = substr($imageData, strpos($imageData, ",") + 1);
        $unencodedData = base64_decode($filteredData);
        
        // Define the file path and name
        $filename = 'uploads/' . uniqid() . '.jpeg';
        
        // Ensure the uploads directory exists and has write permissions
        if (!is_dir(WRITEPATH . 'uploads')) {
            mkdir(WRITEPATH . 'uploads', 0755, true);
        }

        // Save the image file
        if (file_put_contents(WRITEPATH . $filename, $unencodedData) !== false) {
            // Return the image path for display
            echo base_url(WRITEPATH . $filename); 
        } else {
            // Handle error, check permissions of the 'writable/uploads' folder
            http_response_code(500);
            echo "Error: Failed to write data to file. Check folder permissions.";
        }
    }
}
?>