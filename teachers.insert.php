<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'connection.php';

$postData = file_get_contents("php://input");
$param = json_decode($postData);

$query = 'insert into teachers(TeacherID, TeacherName, Username ,Password ,isAdmin) values (:TeacherID, :TeacherName, :Username, :Password, isAdmin)';
    $courseInsert = $conn->prepare($query);
    $courseInsert->execute(array(
        ':TeacherID'=> $_POST['TeacherID'],
        ':TeacherName'=> $_POST['TeacherName'],
        ':Username'=> $_POST['Username'],
        ':Password'=> $_POST['Password'],
        ':isAdmin'=> $_POST['isAdmin']
    ));

if($courseInsert->rowCount()>0){
    $respond=array(
        'Status'=>true,
        'Id'=> $_POST['TeacherID']
    );
}else{
    $respond=array('Status'=>false);
}
echo json_encode($respond);
?>