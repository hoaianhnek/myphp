<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = $_POST['id'];
	$picture = $_POST['picture'];

	$path = "profile_image/$id.png";
	$finalPath = "http://172.17.18.178/Android/DiaryApp/".$path;

	require_once 'connect.php';

	$sql = "UPDATE notes SET photo='$finalPath' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
		if (file_put_contents($path, base64_decode($picture))) {
			
			$result['success'] = "1";
			$result['message'] = "success";

			echo json_encode($result);
			mysqli_close($conn);
		}
	}
}

?>