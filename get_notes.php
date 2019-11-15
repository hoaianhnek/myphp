<?php 

header("Content-Type: application/json; charset=UTF-8");

require_once 'connect.php';

$query = "SELECT * FROM notes ORDER BY id DESC ";
$result = mysqli_query($conn, $query);
$response = array();

$server_name = $_SERVER['SERVER_ADDR'];

while( $row = mysqli_fetch_assoc($result) ){

    array_push($response, 
    array(
        'id'         =>$row['id'], 
        'title'      =>$row['title'], 
        'note'       =>$row['note'],
        'color'      =>$row['color'],
        'date_note'  =>date('d M Y', strtotime($row['date_note'])),
        'picture'    =>"http://$server_name:8080" . $row['picture']) 
    );
}

echo json_encode($response);

mysqli_close($conn);

?>