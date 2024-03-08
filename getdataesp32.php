<?php  
//Connect to database
require 'connectDB.php';

if (isset($_GET['FingerID'])) {
    
    $fingerID = $_GET['FingerID'];

    $sql = "SELECT * FROM users WHERE fingerprint_id=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_card";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $fingerID);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){
            //*****************************************************
            //An existed fingerprint has been detected for Login or Logout
            if ($row['nombre'] != "nombre"){
                $nombre = $row['nombre'];
                $apellido =  $row['apellido'];
                $matricula = $row['matricula'];
                $tardanzas = $row['tardanzas'];
                $ausencias = $row['ausencias'];

                $curso = "5TO E";//por ahora
                $id = $row['id']; 
                $sql = "SELECT * FROM users_logs WHERE fingerprint_id=? AND checkindate=CURDATE() AND hora_salida=''";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_logs";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $fingerID);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    //*****************************************************
                    //Login
                    if (!$row = mysqli_fetch_assoc($resultl)){

                        $sql = "INSERT INTO users_logs (
                                    nombre, apellido, matricula, tardanzas, ausencias, curso, fingerprint_id, checkindate, hora_llegada, hora_salida, user_id
                                ) 
                                VALUES (? ,?, ?, ?, ?, ?, ?, CURDATE(), CURTIME(), ?, ?)";
                        $result = mysqli_stmt_init($conn);
                        
                        
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select_login1";
                            exit();
                        }
                        else{
                            $timeout = "0";
                            mysqli_stmt_bind_param($result, "sssiisisi", $nombre, $apellido, $matricula, $tardanzas, $ausencias, $curso, $fingerID, $timeout, $id);
                            mysqli_stmt_execute($result);
                        
                            // Get the current time
                            date_default_timezone_set('America/Santo_Domingo');
                            $current_time = date('H:i:s', strtotime('now'));
                        
                            // Check if the current time is later than 7:40 AM
                            if ($current_time > '7:40:00') {
                                // Prepare the SQL statement to increment the tardanzas field
                                $sql_tardanzas = "UPDATE users SET tardanzas = tardanzas + 1 WHERE fingerprint_id = ?";
                                $result_tardanzas = mysqli_stmt_init($conn);
                        
                                if (!mysqli_stmt_prepare($result_tardanzas, $sql_tardanzas)) {
                                    echo "SQL_Error_Update_tardanzas";
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($result_tardanzas, "i", $fingerID);
                                    mysqli_stmt_execute($result_tardanzas);
                                    $matricula = $matricula . "  Tardanza";
                                }

                            }
                        
                            echo "login".$matricula;
                            exit();
                        }
                    }
                    //*****************************************************
                    //Logout
                    else{
                        $sql="UPDATE users_logs SET hora_salida=CURTIME() WHERE fingerprint_id=? AND checkindate=CURDATE() AND hora_salida='0'";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert_logout1";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "i", $fingerID);
                            mysqli_stmt_execute($result);

                            echo "logout".$matricula;
                            exit();
                        }
                    }
                }
            }
            //*****************************************************
            //An available Fingerprint has been detected
            else{
                $sql = "SELECT fingerprint_select FROM users WHERE fingerprint_select=1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                }
                else {
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    
                    if ($row = mysqli_fetch_assoc($resultl)) {
                        $sql="UPDATE users SET fingerprint_select=0";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);

                            $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_insert_An_available_card";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "i", $fingerID);
                                mysqli_stmt_execute($result);

                                echo "available";
                                exit();
                            }
                        }
                    }
                    else {
                        $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert_An_available_card";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "i", $finger_sel, $fingerID);
                            mysqli_stmt_execute($result);

                            echo "available";
                            exit();
                        }
                    }
                }
            }
        }
        //*****************************************************
        //New Fingerprint has been added
        else{
            $Uname = "Name";
            $Number = "000000";
            $Email= " Email";

            $Timein = "00:00:00";
            $Gender= "Gender";


            $sql="UPDATE users SET fingerprint_select=0";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error_insert";
                exit();
            }
            else{
                mysqli_stmt_execute($result);
                $sql = "INSERT INTO users ( username, serialnumber, gender, email, fingerprint_id, fingerprint_select, user_date, time_in, add_fingerid) VALUES (?, ?, ?, ?, ?, 1, CURDATE(), ?, 0)";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_add";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "sdssis", $Uname, $Number, $Gender, $Email, $fingerID, $Timein );
                    mysqli_stmt_execute($result);

                    echo "succesful1";
                    exit();
                }
            }
        }
    }
}
if (isset($_GET['Get_Fingerid'])) {
    
    if ($_GET['Get_Fingerid'] == "get_id") {
        $sql= "SELECT fingerprint_id FROM users WHERE add_fingerid=1";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                echo "add-id".$row['fingerprint_id'];
                exit();
            }
            else{
                echo "Nothing";
                exit();
            }
        }
    }
    else{
        exit();
    }
}
if (!empty($_GET['confirm_id'])) {

    $fingerid = $_GET['confirm_id'];

    $sql="UPDATE users SET fingerprint_select=0 WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        
        $sql="UPDATE users SET add_fingerid=0, fingerprint_select=1 WHERE fingerprint_id=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            mysqli_stmt_bind_param($result, "s", $fingerid);
            mysqli_stmt_execute($result);
            echo "   Huella Registrada";
            exit();
        }
    }  
}
if (isset($_GET['DeleteID'])) {

    if ($_GET['DeleteID'] == "check") {
        $sql = "SELECT fingerprint_id FROM users WHERE del_fingerid=1";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                
                echo "del-id".$row['fingerprint_id'];

                $sql = "DELETE FROM users WHERE del_fingerid=1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_delete";
                    exit();
                }
                else{
                    mysqli_stmt_execute($result);
                    exit();
                }
            }
            else{
                echo "nothing";
                exit();
            }
        }
    }
    else{
        exit();
    }
}
mysqli_stmt_close($result);
mysqli_close($conn);
?>
