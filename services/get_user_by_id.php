<?php
header('Content-Type: application/json');

if (isset($_GET['Finger_id'])) {
    require '../connectDB.php';
    $fingerID = $_GET['Finger_id'];

    // Prepare the SQL statement
    if ($stmt = $conn->prepare("SELECT nombre, apellido, ausencias, id_curso, matricula, sexo, tardanzas, maestro FROM users WHERE fingerprint_id = ?")) {
        $stmt->bind_param("i", $fingerID);

        $stmt->execute();

        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        $stmt->close();

        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
} else {
    echo json_encode(['error' => 'No fingerID provided']);
}

// Close the connection
$conn->close();
?>