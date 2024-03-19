<?php
//Connect to database
require'connectDB.php';

$output = '';

if(isset($_POST["To_Excel"])){
    date_default_timezone_set('America/Santo_Domingo');
    if ( empty($_POST['date_sel'])) {
        $Log_date = date("Y-m-d");
        $Log_date_to = $_POST['date_sel_to'];
        if (empty($_POST['date_sel_to'])) {
            $Log_date_to = date("Y-m-d");
        }
    }
    else if ( !empty($_POST['date_sel']) && !empty($_POST['date_sel_to'])) {
        $Log_date = $_POST['date_sel']; 
        $Log_date_to = $_POST['date_sel_to'];
    }
    $sql = "SELECT * FROM users_logs WHERE checkindate BETWEEN '$Log_date' AND '$Log_date_to' ORDER BY id DESC";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo '<p class="error">SQL Error</p>';
        exit();
    }
    mysqli_stmt_execute($result);
    $resultl = mysqli_stmt_get_result($result);
    if (mysqli_num_rows($resultl) > 0){
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
              while($row=mysqli_fetch_assoc($resultl)) {
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
              header('Content-Disposition: attachment; filename=Asistencia' .$Log_date. '-'. $Log_date_to .'xls');
              
              echo $output;
              exit();
        }
        else{
            header( "location: asistencia.php" );
            exit();
        }
}
?>