<?php
ob_start(); // Turn on output buffering
session_start();
include "../connectDB.php";
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['codInst'])){
    function validate ($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return  $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: ../login.php?error=El username es necesario");
        exit();
    }
    else if (empty($password)){
        header("Location: ../login.php?error=El password es necesario");
        exit();
        
    }

    else{
        //Check if the user exists
        $sql = "SELECT  user_id, username, password, imagen FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result)){
            $row =  mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $password) {
                if ($row['status'] == '0'){
                    header("Location: login.php?error=El usuario esta deshabilitado");
                    exit();
                }
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role_id'] = ''; //TODO: Add role_id to the database
                $_SESSION['user_image'] = $row['imagen'];
                header ("Location: ../dashboard.php");
                exit();
            }
            else{
                header("Location: ./index.php?error=No se ha encontrado el usuario");
                exit();
            }
        }
        else{
            header("Location: ./index.php?error=No se ha encontrado el usuario");
            exit();
        }
    }
} 
ob_end_flush(); // Send the buffered output to the browser
?>