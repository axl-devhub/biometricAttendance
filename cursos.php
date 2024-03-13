<?php 
  session_start();
  $_SESSION['current_page'] = "cursos";

  include 'connectDB.php';
  $sql = "SELECT cursos.*, COUNT(users.id_curso) as student_count 
  FROM cursos 
  LEFT JOIN users ON cursos.id= users.id_curso 
  GROUP BY cursos.id";
  $result = mysqli_query($conn, $sql);


    $courses = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }

  include'header.php'; 
?> 



<div id="content" style="margin-left: 0;">
                <nav class="navbar navbar-expand bg-dark shadow mb-4 topbar static-top navbar-light" style="--bs-dark: #1e1b1d;--bs-dark-rgb: 30,27,29;background: rgb(28,28,31);" data-bs-theme="dark">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button" bs-><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item no-arrow"><a class="nav-link nav-link active" href="#">
                                    <div class="sb-nav-link-icon"><img class="border rounded-circle img-profile" src="assets/img/Asinyx%20logo.svg" width="49" height="49"></div><span>&nbsp; Usuario</span>
                                </a></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Asistencia</h3>
<div class="card shadow" style="margin-bottom: 32px;">
    <div class="card-header py-3">
        <h2 style="color: rgb(58,50,50);font-family: 'Autour One', serif;font-weight: bold;">5to</h2>
    </div>
    <div class="card-body">
        <div id="dataTable-2" class="table-responsive table-responsive-sm mt-1" role="grid" aria-describedby="dataTable_info">
            <table id="dataTable" class="table my-sm-0">
                <thead>
                    <tr>
                        <th>Sección</th>
                        <th>Taller</th>
                        <th>Maestro encargado</th>
                        <th>No. de estudiantes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <a href="#">
                            <td>A</td>
                            <td>Electronica </td>
                            <td>Regina Ortiz </td>
                            <td>30</td>
                        </a>
                    </tr>
                    <?php
                        foreach ($courses as $course) {
                            echo "<tr>";
                            echo "<a href='asistencia_por_curso.php?course_id=".$course['id']."'>";
                            echo "<td>".$course['curso']."</td>";
                            echo "<td>".$course['taller']."</td>";
                            echo "<td>"."Ninguno ha sido asignado"."</td>";
                            echo "<td>".$course['student_count']."</td>";
                            echo "</a>";    
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr></tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php   
    include('./footer.php');
?>