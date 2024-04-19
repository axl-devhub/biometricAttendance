<?php
include  'header.php';
if (empty($_GET['id_curso'])) {
    header("Location: login.php");
    exit();
}

include 'connectDB.php';

$course_id = $_GET['course_id'];
$sql = "SELECT * FROM users WHERE id_curso = ?";
$result = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($result, $sql)) {
    echo '<p class="error">SQL Error</p>';
}
else{
    mysqli_stmt_bind_param($result, "i", $course_id);
    mysqli_stmt_execute($result);
    $resultl = mysqli_stmt_get_result($result);
    if (mysqli_num_rows($resultl) > 0){
        while ($row = mysqli_fetch_assoc($resultl)){
            $students[] = $row;
        }
    }
    else {
        echo 'No data found';
    }
}
?>

<div class="card shadow">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <form class="d-inline-block"><a class="btn btn-primary btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-angle-double-down"></i></span><span class="text-white text">Exportar a Excel</span></a></form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div id="dataTable-1" class="table-responsive table-responsive-sm mt-1" role="grid" aria-describedby="dataTable_info">
            <table id="dataTable" class="table my-sm-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Matricula</th>
                        <th>Tardanzas</th>
                        <th>Faltas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Axel Javier Cuevas Terrero</td>
                        <td>2022-0146</td>
                        <td>3</td>
                        <td>0</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>#</strong></td>
                        <td><strong>Nombre</strong></td>
                        <th>Apellido</th>
                        <td><strong>Matricula</strong></td>
                        <td><strong>Faltas</strong></td>
                        <td><strong>Faltas</strong></td>
                        <td><strong>% de asistencia</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>