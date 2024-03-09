<?php 

require_once "database/database.php";
require_once "api/student.php";

// Handle the API request
$url = explode("/", $_SERVER['QUERY_STRING']);

header('Access-Control-Allow-Origin: application/json');
header('Content-Type: application/json');

if ($url[1] == 'v1' && $url[2] == 'student') {
    header('Access-Control-Allow-Methods:GET');

    $student = new student();

    if ($url[3] == 'all') {
        $data = $student->all();
        $res = [
            'status' => 200,
            'data' => $data
        ];
        echo json_encode($res);

    } elseif ($url[3] == 'add') {

        header('Access-Control-Allow-Methods:POST');

        $data = file_get_contents("php://input");
        $data_de = json_decode($data, true);
        $res = $student->add($data_de);

        if ($res) {
            $res = [
                'status' => 201,
                'msg' => "Student inserted"
            ];
        } else {
            $res = [
                'status' => 400,
                'msg' =>  "Error"
            ];
        }
        echo json_encode($res);
    }
     elseif ($url[3] == 'update') {
        header('Access-Control-Allow-Methods:PUT');

        $data = file_get_contents("php://input");
        $data_de = json_decode($data, true);

        $id =  [ "id" => $data_de ['id']];
        $data = $data_de['student'];

        $res = $student->update($data,$id);

        if ($res) {
            $res = [
                'status' => 200,
                'msg' => "Student updated"
            ];
        } else {
            $res = [
                'status' => 400,
                'msg' =>  "Error"
            ];
        }
        echo json_encode($res);


    } elseif ($url[3] == 'delete') {

        header('Access-Control-Allow-Methods:DELETE');

        $data = file_get_contents("php://input");
        $data_de = json_decode($data, true);
        $id =  [ "id" => $data_de ['id']];
        $res = $student->delete($id);

        if ($res) {
            $res = [
                'status' => 200,
                'msg' => "Student deleted"
            ];
        } else {
            $res = [
                'status' => 400,
                'msg' =>  "Error deleting student"
            ];
        }
        echo json_encode($res);
    }
}
