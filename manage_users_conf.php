<?php  
//Connect to database
require'connectDB.php';

// select passenger 
if (isset($_GET['select'])) {

    $Finger_id = $_GET['Finger_id'];

    $sql = "SELECT fingerprint_select FROM users WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo json_encode(["error" => true, 'message' => 'SQL_Error_Select']);
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            $sql="UPDATE users SET fingerprint_select=0";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo json_encode(["error" => true, 'message' => 'SQL_Error_Select']);
                exit();
            }
            else{
                mysqli_stmt_execute($result);

                $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo json_encode(["error" => true, 'message' => 'SQL_Error_Select_Fingerprint']);
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $Finger_id);
                    mysqli_stmt_execute($result);
                    
                    echo json_encode(["success" => true, 'message' => 'El FPUID del usuario ha sido seleccionado']);
                    exit();
                }
            }
        }
        else{
            $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo json_encode(["error" => true, 'message' => 'SQL_Error_Select_Fingerprint']);
                exit();
            }
            else{
                mysqli_stmt_bind_param($result, "s", $Finger_id);
                mysqli_stmt_execute($result);

                echo json_encode(["success" => true, 'message' => 'El FPUID del usuario ha sido seleccionado']); 
                exit();
            }
        }
    } 
}
if (isset($_POST['Add'])) {
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $matricula = $_POST['matricula'];
    $sexo = $_POST['sexo'];
    $tardanzas = $_POST['tardanzas'];
    $ausencias = $_POST['ausencias'];
    $curso = (int)$_POST['curso'];
    $maestro = $_POST['maestro'];

    //check if there any selected user
    $sql = "SELECT nombre FROM users WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
      echo "SQL_Error";
      exit();
    }
    else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            if ($row['nombre']=="nombre") {

                if (!empty($nombre) && !empty($matricula) && !empty($apellido)) {
                    //check if there any user had already the Serial Number
                    $sql = "SELECT matricula FROM users WHERE matricula=?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "s", $matricula);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {
                            $sql = "SELECT COUNT(*) as count FROM users WHERE id_curso=? AND maestro=1";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "i", $curso);
                                mysqli_stmt_execute($result);
                                $resultl = mysqli_stmt_get_result($result);
                                $row = mysqli_fetch_assoc($resultl);
                                if ($row['count']) {
                                    echo json_encode(['error' => true, 'message' => "Ya existe un maestro encargado para ese curso"]);
                                    exit();
                                }
                            }
                            $sql="UPDATE users SET nombre=?, apellido=?, matricula=?, id_curso=?, sexo=?, tardanzas=?, ausencias=?, maestro=?, user_date=CURDATE() WHERE fingerprint_select=1";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_select_Fingerprint";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "sssisiii", $nombre, $apellido, $matricula, $curso, $sexo, $tardanzas, $ausencias, $maestro);
                                mysqli_stmt_execute($result);

                                echo json_encode(['success' => true, 'message' => "Se ha añadido un nuevo usuario"]);
                                exit();
                            }
                        }
                        else {
                            echo json_encode(['error' => true, 'message' => "La matricula ya esta registrada"]);
                            exit();
                        }
                    }
                }
                else{
                    echo json_encode(['error' => true, 'message' => "Rellene los campos!"]);
                    exit();
                }
            }
            else{
                echo json_encode(['error' => true, 'message' => "Esta huella ya existe"]);
                exit();
            }    
        }
        else {
            echo "There's no selected Fingerprint!";
            exit();
        }
    }
}
//Add user Fingerprint
if (isset($_POST['Add_fingerID'])) {

    $fingerid = $_POST['fingerid'];

    $nombre = "nombre";
    $apellido = "apellido";
    $matricula = "0000-0000";

    //optional
    $sexo = "sexo";

    if ($fingerid == 0) {
        echo json_encode(['error' => true, 'message' => 'Añada un FPUID valido para registrar el usuario!']);
        exit();
    }
    else{
        if ($fingerid > 0 && $fingerid < 128) {
            $sql = "SELECT fingerprint_id FROM users WHERE fingerprint_id=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo json_encode(['error' => true, 'message' => 'SQL_Error']);
              exit();
            }
            else{
                mysqli_stmt_bind_param($result, "i", $fingerid );
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
                if (!$row = mysqli_fetch_assoc($resultl)) {

                    $sql = "SELECT add_fingerid FROM users WHERE add_fingerid=1";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo json_encode(['error' => true, 'message' => 'SQL_Error']);
                      exit();
                    }
                    else{
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {
                            //check if there any selected user
                            $sql="UPDATE users SET fingerprint_select=0 WHERE fingerprint_select=1";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo json_encode(['error' => true, 'message' => 'SQL_Error']);;
                              exit();
                            }
                            else{
                                mysqli_stmt_execute($result);
                                $sql = "INSERT INTO users (nombre, apellido, matricula, sexo, id_curso, fingerprint_id, fingerprint_select, user_date, del_fingerid, add_fingerid) VALUES (?, ?, ?, ?, 5, ?, 1, CURDATE(), 0, 1)";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo json_encode(['error' => true, 'message' => 'SQL_Error']);
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "ssssi", $nombre, $apellido, $matricula, $sexo, $fingerid);
                                    mysqli_stmt_execute($result);
                                    echo json_encode(['success' => true, 'message' => 'Este FPUID esta preparado para ser registrado']);
                                    exit();
                                }
                            }
                        }
                        else{
                            echo json_encode(['warning' => true, 'message' => 'No se puede agregar otro FPUID hasta que se haya registrado el anterior']);
                        }
                    }   
                }
                else{
                    echo json_encode(['error' => true, 'message' => 'Este FPUID ya esta registrado! Eliminelo del dispositivo para poder agregarlo nuevamente']);
                    exit();
                }
            }
        }
        else{
            echo json_encode(['error' => true, 'message' => 'El FPUID debe tener un valor de entre 1 y 127']);;
            exit();
        }
    }
}
// Update an existance user 
if (isset($_POST['Update'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $matricula = $_POST['matricula'];
    $sexo = $_POST['sexo'];
    $tardanzas = $_POST['tardanzas'];
    $ausencias = $_POST['ausencias'];
    $curso = (int)$_POST['curso'];

    $maestro = $_POST['maestro'];
    //check if there any selected user
    $sql = "SELECT * FROM users WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
      echo json_encode(['error' => true, 'message' => 'SQL_Error']);
      exit();
    }
    else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            if (empty($row['nombre'])) {
                echo json_encode(['error' => true, 'message' => "Necesitas agregar el usuario primero!"]);
                exit();
            }
            else{
                if (empty($nombre) && empty($apellido) && empty($matricula)) {
                    echo json_encode(['error' => true, 'message' => "Rellene los campos!"]);
                    exit();
                }
                else{
                    //check if there any user had already the Serial Number
                    $sql = "SELECT matricula FROM users WHERE matricula=? AND fingerprint_select != 1";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo json_encode(['error' => true, 'message' => 'SQL_Error']);
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "s", $matricula);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {

                            if (!empty($nombre) && !empty($apellido) && !empty($matricula)) {
                                $sql = "SELECT COUNT(*) as count FROM users WHERE id_curso=? AND maestro=1";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "i", $curso);
                                    mysqli_stmt_execute($result);
                                    $resultl = mysqli_stmt_get_result($result);
                                    $row = mysqli_fetch_assoc($resultl);
                                    if ($row['count']) {
                                        echo json_encode(['error' => true, 'message' => "Ya existe un maestro encargado para ese curso"]);
                                        exit();
                                    }
                                }
                                $sql="UPDATE users SET nombre=?, apellido=?, matricula=?, id_curso=?, sexo=?, tardanzas=?, ausencias=?, maestro=? WHERE fingerprint_select=1";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo json_encode(['error' => true, 'message' => "SQL_Error_select_Fingerprint"]);
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "sssisiii", $nombre, $apellido, $matricula, $curso, $sexo, $tardanzas, $ausencias, $maestro);
                                    mysqli_stmt_execute($result);

                                    echo json_encode(['success' => true, 'message' => "El usuario seleccionado ha sido actualizado!"]);
                                    exit();
                                }
                            }
                            else{
                            /*
                                if (!empty($Timein)) {
                                    $sql="UPDATE users SET gender=?, time_in=? WHERE fingerprint_select=1";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_select_Fingerprint";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "ss", $Gender, $Timein );
                                        mysqli_stmt_execute($result);

                                        echo "The selected User has been updated!";
                                        exit();
                                    }
                                }
                                else{
                                    echo "The User Time-In is empty!";
                                    exit();
                                }    
                                */
                                echo json_encode(['warning' => true, 'message' => "Rellene los campos!"] );
                            }  
                        }
                        else {
                            echo json_encode(['warning' => true, 'message' => "La matricula ya esta registrada"]);
                            exit();
                        }
                    }
                }
            }    
        }
        else {
            echo json_encode(['error' => true, 'message' => "No ha seleccionado un usuario para actualizar"]);
            exit();
        }
    }
}
// delete user 
if (isset($_POST['delete'])) {

    $sql = "SELECT fingerprint_select FROM users WHERE fingerprint_select=1 AND add_fingerid=0";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo json_encode(['error' => true, 'message' => 'SQL_Error_Select']);
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {
            $sql="UPDATE users SET del_fingerid=1 WHERE fingerprint_select=1";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo json_encode(['error' => true, 'message' => 'SQL_Error_delete']);
                exit();
            }
            else{
                mysqli_stmt_execute($result);
                echo json_encode(['success' => true, 'message' => 'El usuario seleccionado ha sido eliminado']);
                exit();
            }
        }
        else{
            echo json_encode(['error' => true, 'message' => 'El usuario no se debe eliminar']);
            exit();
        }
    }
}
mysqli_stmt_close($result);
mysqli_close($conn);
?>
