<?php
//Connect to database
require'connectDB.php';

$output = '';

if(isset($_POST["To_Excel"])){
  
    if ( empty($_POST['date_sel'])) {

        $Log_date = date("Y-m-d");
    }
    else if ( !empty($_POST['date_sel'])) {

        $Log_date = $_POST['date_sel']; 
    }
        $sql = "SELECT * FROM users_logs WHERE checkindate='$Log_date' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
            $output .= '
                        <table class="table" bordered="1">  
                          <TR>
                            <TH>Nombre</TH>
                            <TH>Apellido</TH>
                            <TH>Matricula</TH>
                            <TH>Curso</TH>
                            <TH>Fingerprint ID</TH>
                            <TH>Dia de Registro</TH>
                            <TH>Hora llegada</TH>
                            <TH>Hora salida</TH>
                            <TH>Ausencias</TH>
                            <TH>Tardanzas</TH>
                            <TH>
                          </TR>';
              while($row=$result->fetch_assoc()) {
                  $output .= '
                              <TR> 
                                  <TD> '.$row['nombre'].'</TD>
                                  <TD> '.$row['apellido'].'</TD>
                                  <TD> '.$row['matricula'].'</TD>
                                  <TD> '.$row['curso'].'</TD>
                                  <TD> '.$row['fingerprint_id'].'</TD>
                                  <TD> '.$row['checkindate'].'</TD>
                                  <TD> '.$row['hora_llegada'].'</TD>
                                  <TD> '.$row['hora_salida'].'</TD>
                                  <TD> '.$row['ausencias'].'</TD>
                                  <TD> '.$row['tardanzas'].'</TD>
                              </TR>';
              }
              $output .= '</table>';
              header('Content-Type: application/xls');
              header('Content-Disposition: attachment; filename=User_Log'.$Log_date.'.xls');
              
              echo $output;
              exit();
        }
        else{
            header( "location: UsersLog.php" );
            exit();
        }
}
?>