<?php  

use Dcblogdev\PdoWrapper\Database;

class student
{
    public $db;

    public function __construct()
    {
        $options = [
            //required
            'username' => 'root',
            'database' => 'backend2024',
            //optional
            'password' => '',
            'type' => 'mysql',
            'charset' => 'utf8',
            'host' => 'localhost', // assuming it's localhost
            'port' => '3306'
        ];

        $this->db = new Database($options);
    }

    public function all()
    {
        $data = $this->db->rows("SELECT * FROM student");
        return $data;
    }

    public function add($data)
    {
        print_r($data);die;
        $data = $this->db->insert("student", $data);
        return $data; // Return the result of the insert operation
    }

    public function update($data,$id)
    {
        $data = $this->db->update("student", $data,$id);
        return $data; 
    }

    public function delete($id)
    {
        $data = $this->db->delete("student",$id);
        return $data;
    }     
}