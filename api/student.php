<?php  

use Dcblogdev\PdoWrapper\Database;

class Student
{
    public $db;

    public function __construct()
    {
        $options = [
            'username' => 'root',
            'database' => 'backend2024',
            'password' => '',
            'type' => 'mysql',
            'charset' => 'utf8',
            'host' => 'localhost',
            'port' => '3306'
        ];
        $this->db = new Database($options);
    }

    public function all()
    {
        return $this->db->rows("SELECT * FROM student");
    }

    public function add($data)
    {
        try {
            return $this->db->insert("student", $data);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($data, $id)
    {
        try {
            return $this->db->update("student", $data, ['id' => $id]);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete("student", ['id' => $id]);
        } catch (\Exception $e) {
            return false;
        }
    }     
}