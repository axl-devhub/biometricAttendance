<?php
	//Connect to database
    $servername = "localhost";
    $username = "root";		//put your phpmyadmin username.(default is "root")
    $password = "";			//if your phpmyadmin has a password put it here.(default is "root")
    $dbname = "";
    
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Create database
	$sql = "CREATE DATABASE biometricattendace";
	if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}

	echo "<br>";

	$dbname = "biometricattendace";
    
	$conn = new mysqli($servername, $username, $password, $dbname);

	// sql to create table
	$sql = "CREATE TABLE IF NOT EXISTS `users` (
		`id` int(11) NOT NULL,
		`nombre` varchar(100) NOT NULL,
		`apellido` varchar(100) NOT NULL,
		`matricula` varchar(10) NOT NULL,
		`sexo` varchar(20) NOT NULL,
		`tardanzas` int(11) NOT NULL,
		`ausencias` int(11) NOT NULL,
		`id_curso` int(11) NOT NULL,
		`maestro` tinyint(1) NOT NULL DEFAULT 0,
		`fingerprint_id` int(11) NOT NULL,
		`fingerprint_select` tinyint(1) NOT NULL DEFAULT 0,
		`del_fingerid` tinyint(1) NOT NULL DEFAULT 0,
		`add_fingerid` tinyint(1) NOT NULL DEFAULT 0,
		`user_date` datetime NOT NULL DEFAULT current_timestamp()
	  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

	if ($conn->query($sql) === TRUE) {
	    echo "Table users created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$sql = "CREATE TABLE IF NOT EXISTS `users_logs` (
		`id` int(11) NOT NULL,
		`nombre` varchar(100) NOT NULL,
		`apellido` varchar(100) NOT NULL,
		`matricula` varchar(20) NOT NULL,
		`user_id` int(11) NOT NULL,
		`fingerprint_id` int(5) NOT NULL,
		`checkindate` date NOT NULL,
		`hora_llegada` time NOT NULL,
		`hora_salida` time NOT NULL,
		`curso` varchar(10) NOT NULL,
		`tardanzas` int(11) NOT NULL,
		`ausencias` int(11) NOT NULL
	  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci";
	  

	if ($conn->query($sql) === TRUE) {
	    echo "Table users_logs created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$sql = "CREATE TABLE IF NOT EXISTS `cursos` (
		`id` int(11) NOT NULL,
		`curso` varchar(15) NOT NULL,
		`maestro` int(11) NOT NULL,
		`taller` varchar(100) NOT NULL,
		`num_estudiantes` int(11) NOT NULL,
		`grado` varchar(10) NOT NULL
	  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

	if ($conn->query($sql) === TRUE) {
	    echo "Table cursos created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}

	$sql = "INSERT INTO `cursos` (`id`, `curso`, `maestro`, `taller`, `num_estudiantes`, `grado`) VALUES
	(1, 'A', 0, 'Electrónica ', 0, '5TO'),
	(2, 'B', 0, 'Artes graficas y multimedia ', 0, '5TO'),
	(3, 'C', 0, 'Mecánica ', 0, '5TO'),
	(4, 'D', 0, 'Electricidad', 0, '5TO'),
	(5, 'E', 0, 'Programación ', 0, '5TO'),
	(6, 'F', 0, 'Redes', 0, '5TO'),
	(7, 'G', 0, 'Artes graficas y multimedia', 0, '5TO')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "INSERT INTO `users` (`id`, `nombre`, `apellido`, `matricula`, `sexo`, `tardanzas`, `ausencias`, `id_curso`, `fingerprint_id`, `fingerprint_select`, `del_fingerid`, `add_fingerid`, `user_date`) VALUES
	(3, 'Mia', 'Taveras', '2022-0028', 'Masculino', 20, 1, 5, 3, 0, 0, 0, '2024-03-04 00:00:00'),
	(4, 'Axel', 'Cuevas', '2022-0146', 'Masculino', 13, 1, 5, 4, 0, 0, 0, '2024-03-05 00:00:00'),
	(5, 'Jose', 'Rojas', '2022-0039', 'Masculino', 4, 0, 5, 5, 0, 0, 0, '2024-03-06 00:00:00'),
	(6, 'Adriana', 'Encarnacion', '2022-0111', 'Femenino', 8, 2, 5, 6, 0, 0, 0, '2024-03-06 00:00:00'),
	(8, 'Emely', 'Quezada', '2022-0238', 'Femenino', 4, 1, 5, 8, 0, 0, 0, '2024-03-06 00:00:00'),
	(9, 'Mañolo ', 'La escopeta', 'Escopeta', 'Masculino', 11, 1, 5, 9, 0, 0, 0, '2024-03-06 00:00:00'),
	(10, 'Rubi', 'Mendez', '2022-0141', 'Femenino', 5, 1, 5, 10, 0, 0, 0, '2024-03-06 00:00:00'),
	(11, 'Mirianny', 'Medina', '2022-0037', 'Femenino', 2, 2, 5, 11, 0, 0, 0, '2024-03-06 00:00:00'),
	(12, 'Enmanuel ', 'Fortunato', '2022-0114', 'Masculino', 3, 1, 5, 12, 0, 0, 0, '2024-03-06 00:00:00')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	

	$sql = "INSERT INTO `users_logs` (`id`, `nombre`, `apellido`, `matricula`, `user_id`, `fingerprint_id`, `checkindate`, `hora_llegada`, `hora_salida`, `curso`, `tardanzas`, `ausencias`) VALUES
	(1, 'Mia', 'Taveras', '2022-0028', 3, 3, '2024-03-04', '08:00:00', '12:00:00', 'A', 20, 1),
	(2, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-05', '08:00:00', '12:00:00', 'A', 13, 1),
	(3, 'Jose', 'Rojas', '2022-0039', 5, 5, '2024-03-06', '08:00:00', '12:00:00', 'A', 4, 0),
	(4, 'Adriana', 'Encarnacion', '2022-0111', 6, 6, '2024-03-06', '08:00:00', '12:00:00', 'A', 8, 2),
	(5, 'Emely', 'Quezada', '2022-0238', 8, 8, '2024-03-06', '08:00:00', '12:00:00', 'A', 4, 1),
	(6, 'Mañolo ', 'La escopeta', 'Escopeta', 9, 9, '2024-03-06', '08:00:00', '12:00:00', 'A', 11, 1),
	(7, 'Rubi', 'Mendez', '2022-0141', 10, 10, '2024-03-06', '08:00:00', '12:00:00', 'A', 5, 1),
	(8, 'Mirianny', 'Medina', '2022-0037', 11, 11, '2024-03-06', '08:00:00', '12:00:00', 'A', 2, 2),
	(9, 'Enmanuel ', 'Fortunato', '2022-0114', 12, 12, '2024-03-06', '08:00:00', '12:00:00', 'A', 3, 1)";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "ALTER TABLE `cursos`
	ADD PRIMARY KEY (`id`);";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "ALTER TABLE `users`
	ADD PRIMARY KEY (`id`),
  	ADD KEY `FK_users_cursos` (`id_curso`);";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "ALTER TABLE `users_logs`
	ADD PRIMARY KEY (`id`);";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "ALTER TABLE `cursos` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$sql = "ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$sql = "ALTER TABLE `users_logs` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "ALTER TABLE `users`
	ADD CONSTRAINT `FK_users_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);
  COMMIT";

		
	$conn->close();
?>