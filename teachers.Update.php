<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'connection.php';

$postData = file_get_contents("php://input");
$param = json_decode($postData);

$n=0;
$bind = array();

$query='update teachers set ';

if(isset($_POST['TeacherName'])){
    $query .='TeacherName=:TeacherName';
    $bind['TeacherName']=$_POST['TeacherName'];
    $n=1;
}

if(isset($_POST['Username'])){
    if($n==1)
        $query .=',';
    $query .='Username=:Username';
    $bind['Username']=$_POST['Username'];
    $n=2;
}

if(isset($_POST['Password'])){
    if($n==1)
        $query .=',';
    $query .='Password=:Password';
    $bind['Password']=$_POST['Password'];
    $n=2;
}

if(isset($_POST['isAdmin'])){
    if($n==1)
        $query .=',';
    $query .='isAdmine=:isAdmin';
    $bind['isAdmin']=$_POST['isAdmin'];
    $n=2;
}

if(isset($_POST['newTeacherID '])){
    if($n==2)
        $query .=',';
    $query .='TeacherID =:newTeacherID D';
    $bind['newTeacherID ']=$_POST['newTeacherID '];
}

$query .=' where TeacherID =:TeacherID ';
$bind[':TeacherID ']=$_POST['TeacherID '];
$courseUpdate = $conn->prepare($query);
    $courseUpdate->execute($bind);  

if($courseUpdate->rowCount()>0){
    echo json_encode(array('Status'=>true));
}else{
    echo json_encode(array('Status'=>false));
}
?>