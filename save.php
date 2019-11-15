<?php

require_once 'connect.php';

$key = $_POST['key'];

$title       = $_POST['title'];
$note        = $_POST['note'];
$color       = $_POST['color'];
$date_note   = $_POST['date_note'];
$picture     = $_POST['picture'];

if ( $key == "insert" ){

    $date_note_newformat = date('Y-m-d', strtotime($date_note));

    $query = "INSERT INTO notes (title,note,color,date_note)
    VALUES ('$title', '$note', '$color', '$date_note_newformat') ";

        if ( mysqli_query($conn, $query) ){

            if ($picture == null) {

                $finalPath = "/Android/DiaryApp/pet_logo.png"; 
                $result["value"] = "1";
                $result["message"] = "Success";
    
                echo json_encode($result);
                mysqli_close($conn);

            } else {

                $id = mysqli_insert_id($conn);
                $path = "profile_image/$id.jpeg";
                $finalPath = "/Android/DiaryApp/".$path;

                $insert_picture = "UPDATE notes SET picture='$finalPath' WHERE id='$id' ";
            
                if (mysqli_query($conn, $insert_picture)) {
            
                    if ( file_put_contents( $path, base64_decode($picture) ) ) {
                        
                        $result["value"] = "1";
                        $result["message"] = "Success!";
            
                        echo json_encode($result);
                        mysqli_close($conn);
            
                    } else {
                        
                        $response["value"] = "0";
                        $response["message"] = "Error! ".mysqli_error($conn);
                        echo json_encode($response);

                        mysqli_close($conn);
                    }

                }
            }

        } 
        else {
            $response["value"] = "0";
            $response["message"] = "Error! ".mysqli_error($conn);
            echo json_encode($response);

            mysqli_close($conn);
        }
}

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
// 	$title = $_POST['title'];
// 	$note = $_POST['note'];
// 	$color = $_POST['color'];
// 	$date_note = $_POST['date_note'];
// 	// $picture = $_POST['picture'];

// 	require_once 'connect.php';

// 	$query = "INSERT INTO `notes` (title, note, color, date_note) VALUES ('$title', '$note', '$color', '$date_note')";

// 	if (mysqli_query($conn, $query)) {
// 		$response['success'] = true;
// 		$response['message'] = "Successfully";
// 	}else{

// 		$response['success'] = false;
// 		$response['message'] = "Failure!";
// 	}
// }else {
// 	$response['success'] = false;
// 	$response['message'] = "Error! ";
// }
// echo json_encode($response);

?>