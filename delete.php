<?php

header("Content-Type: application/json; charset=UTF-8");

require_once 'connect.php';

$key = $_POST['key'];
$id      = $_POST['id'];
$picture = $_POST['picture'];

if ( $key == "delete" ){

    $query = "DELETE FROM notes WHERE id='$id' ";

        if ( mysqli_query($conn, $query) ){

            $iparr = split ("/", $picture);
            $picture_split = $iparr[5];

            if ( unlink("profile_image/".$picture_split) ){

                $result["value"] = "1";
                $result["message"] = "Success!";

                echo json_encode($result);
                mysqli_close($conn);

            } else {
            
                $response["value"] = "0";
                $response["message"] = "Error to delete a image! ".mysqli_error($conn);
                echo json_encode($response);
    
                mysqli_close($conn);
            }

        } 
        else {

            $response["value"] = "0";
            $response["message"] = "Error! ".mysqli_error($conn);
            echo json_encode($response);

            mysqli_close($conn);
        }

} else {
    $response["value"] = "0";
    $response["message"] = "Error! ".mysqli_error($conn);
    echo json_encode($response);

    mysqli_close($conn);
}

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
// 	$id = $_POST['id'];


// 	require_once 'connect.php';

// 	$query = "DELETE FROM `notes` WHERE id = '$id'";

// 	if (mysqli_query($conn, $query)) {
// 	 	$response['success'] = true;
// 	 	$response['message'] = "Successfully";

// 	 } else {
// 	 	$response['success'] = false;
// 	 	$response['message'] = "Failure!";
// 	 }
// }else {
// 	$response['success'] = false;
// 	$response['message'] = "Error!";
// }

// echo json_encode($response);

?>