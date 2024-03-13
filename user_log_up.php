<?php  
session_start();
?>
    <?php
      //Connect to database
      require'connectDB.php';

      if (isset($_POST['log_date'])) {
        if ($_POST['date_sel'] != 0 && $_POST['date_sel_to'] != 0) {
            $_SESSION['seldate'] = $_POST['date_sel'];
            $_SESSION['seldate_to'] = $_POST['date_sel_to'];
        }
        else{
            $_SESSION['seldate'] = date("Y-m-d");
            $_SESSION['seldate_to'] = date("Y-m-d");
        }
      }
      
      if ($_POST['select_date'] == 1) {
          $_SESSION['seldate'] = date("Y-m-d");
          $_SESSION['seldate_to'] = date("Y-m-d");
      }
      else if ($_POST['select_date'] == 0 ) {
          $seldate = $_SESSION['seldate'];
          $seldate_to = $_SESSION['seldate_to'];
      }

      $sql = "SELECT * FROM users_logs WHERE checkindate BETWEEN '$seldate' AND '$seldate_to' ORDER BY id DESC";
      $result = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($result, $sql)) {
          echo '<p class="error">SQL Error</p>';
      }
      else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if (mysqli_num_rows($resultl) > 0){
            while ($row = mysqli_fetch_assoc($resultl)){
      ?>
                  <TR>
                    <TD><?php echo $row['matricula'];?></TD>
                    <TD><?php echo $row['nombre'] . " " . $row['apellido'];?></TD>
                    <TD><?php echo $row['curso'];?></TD>
                    <TD><?php echo $row['checkindate'];?></TD>
                    <TD><?php echo $row['hora_llegada'];?></TD>
                    <TD><?php echo $row['hora_salida'];?></TD>
                    <TD><?php echo $row['tardanzas'];?></TD>
                    <TD><?php echo $row['ausencias'];?></TD>
                  </TR>
    <?php
            }   
        }
        else {
          echo 'No data found';
        }
      }
    ?>