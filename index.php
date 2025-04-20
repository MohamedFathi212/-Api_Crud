<?php 
require_once "database/database.php";
require_once "api/student.php";

// Handle the API request
$url = explode("/", $_SERVER['QUERY_STRING']);

// Set headers globally
header(header: 'Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');


//Get All Student 

if (isset($url[1]) && $url[1] == 'v1' && isset($url[2]) && $url[2] == 'student') {
    $student = new Student();

    if (isset($url[3]) && $url[3] == 'all') {
        $data = $student->all();
        $res = [
            'status' => 200,
            'data' => $data
        ];
        echo json_encode($res);

        //Insert All Student 
        
    } elseif (isset($url[3]) && $url[3] == 'add') {
        $data = file_get_contents("php://input");
        $data_de = json_decode($data, true);
        $res = $student->add($data_de);

        if ($res) {
            http_response_code(201);
            echo json_encode(['status' => 201, 'msg' => "Student inserted"]);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 400, 'msg' => "Error inserting student"]);
        }

        //Update All Student 

    } elseif (isset($url[3]) && $url[3] == 'update') {
        $data = file_get_contents("php://input");
        $data_de = json_decode($data, true);
        $id = $data_de['id'];
        $studentData = $data_de['student'];

        $res = $student->update($studentData, $id);

        if ($res) {
            http_response_code( 200);
            echo json_encode(['status' => 200, 'msg' => "Student updated"]);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 400, 'msg' => "Error updating student"]);
        }


    //Delete All Student 

    } elseif (isset($url[3]) && $url[3] == 'delete') {
        $data = file_get_contents("php://input");
        $data_de = json_decode($data, true);
        $id = $data_de['id'];

        $res = $student->delete($id);

        if ($res) {
            http_response_code(200);
            echo json_encode(['status' => 200, 'msg' => "Student deleted"]);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 400, 'msg' => "Error deleting student"]);
        }
    }
}