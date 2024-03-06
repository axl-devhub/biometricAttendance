<?php
$sql = "SELECT MAX(fingerprint_id) FROM users ";
require '../connectDB.php';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$finger_id_to_send = $row['MAX(fingerprint_id)'] + 1;
} else {
	$finger_id_to_send = 1;
}
echo $finger_id_to_send;
?>