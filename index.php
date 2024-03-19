<?php
$_SESSION['current_page'] = "index";
include 'header.php';

include 'connectDB.php';

$sql = "SELECT COUNT(id) FROM users WHERE maestro = 0";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_array($result);
    $total_estudiantes = $row[0];
}

$sql = "SELECT COUNT(id) FROM users WHERE maestro = 1";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_array($result);
    $total_maestros = $row[0];
}

$sql = "SELECT COUNT(id) FROM cursos";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_array($result);
    $total_cursos = $row[0];
}

$sql = "SELECT DATE_FORMAT(SEC_TO_TIME(ROUND(AVG(TIME_TO_SEC(hora_llegada)))), '%H:%i') 
FROM users_logs 
LIMIT 400";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_array($result);
    $avg_hora_llegada = $row[0];

    if ($avg_hora_llegada < "12:00:00"){
        $avg_hora_llegada .= " AM";
    } else {
        $avg_hora_llegada .= "PM";
    
    }
}




?>
<style>
    .dashboard-icon {
  color: rgb(54,55,58);
}
</style>
<div class="container-fluid">
   <div class="d-sm-flex justify-content-between align-items-center mb-4">
      <h3 class="text-dark mb-0">Dashboard</h3>
      <div class="dropdown">
         <button class="btn btn-dark dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">Descargar Reporte&nbsp;</button>
         <div class="dropdown-menu" style="max-height: 200px;overflow-y: auto;"><a class="dropdown-item" href="#">2023-2024 - Actual</a><a class="dropdown-item" href="#">2022-2023</a><a class="dropdown-item" href="#">2021-2022</a></div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-xl-3 mb-4">
         <div class="card shadow border-start-primary py-2">
            <div class="card-body" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-original-title="Total de estudiantes inscritos en ITESA durante este año lectivo">
               <div class="row align-items-center no-gutters">
                  <div class="col me-2">
                     <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total estudiantes</span></div>
                     <div class="text-dark fw-bold h5 mb-0"><span><?= $total_estudiantes; ?></span></div>
                  </div>
                  <div class="col-auto"><i class="fas fa-user-graduate fa-2x dashboard-icon"></i></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-xl-3 mb-4">
         <div class="card shadow border-start-success py-2">
            <div class="card-body" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-original-title="Total de maestros impartiendo docencia en ITESA durante este periodo">
               <div class="row align-items-center no-gutters">
                  <div class="col me-2">
                     <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total maestros</span></div>
                     <div class="text-dark fw-bold h5 mb-0"><span><?= $total_maestros; ?></span></div>
                  </div>
                  <div class="col-auto"><i class="fas fa-chalkboard-teacher fa-2x" style="color: rgb(54,55,58) !important;"></i></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-xl-3 mb-4">
         <div class="card shadow border-start-info py-2">
            <div class="card-body" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-original-title="Total de secciones en ITESA, estas cuentan todos los grados (4TO, 5TO, 6TO)">
               <div class="row align-items-center no-gutters">
                  <div class="col me-2">
                     <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>total de Aulas</span></div>
                     <div class="row g-0 align-items-center">
                        <div class="col-auto">
                           <div class="text-dark fw-bold h5 mb-0"><span><?= $total_cursos?></span></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-auto"><i class="fas fa-school fa-2x dashboard-icon"></i></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-xl-3 mb-4">
         <div class="card shadow border-start-warning py-2">
            <div class="card-body" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-original-title="Estudiantes con mas de 4 tardanzas a los cuales se les envia una carta de advertencia">
               <div class="row align-items-center no-gutters">
                  <div class="col me-2">
                     <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>AVg. hora llegada</span></div>
                     <div class="text-dark fw-bold h5 mb-0"><span><?= $avg_hora_llegada ?></span></div>
                  </div>
                  <div class="col-auto"><i class="fas fa-clock fa-2x dashboard-icon"></i></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-7 col-xl-8">
         <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h6 class="text-primary fw-bold m-0">Cantidad de estudiantes por grado</h6>
               <div class="dropdown no-arrow">
                  <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                  <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                     <p class="text-center dropdown-header">SEleccione el grado</p>
                     <a class="dropdown-item" href="#">&nbsp;4TO</a><a class="dropdown-item" href="#">5TO</a><a class="dropdown-item" href="#">6TO</a>
                     <div class="dropdown-divider"></div>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div>
                  <div class="chartjs-size-monitor">
                     <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                     </div>
                     <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                     </div>
                  </div>
                  <canvas data-bss-chart="{&quot;type&quot;:&quot;horizontalBar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;January&quot;,&quot;February&quot;,&quot;March&quot;,&quot;April&quot;,&quot;May&quot;,&quot;June&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Revenue&quot;,&quot;backgroundColor&quot;:&quot;#4e73df&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:[&quot;4500&quot;,&quot;5300&quot;,&quot;6250&quot;,&quot;7800&quot;,&quot;9800&quot;,&quot;15000&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},&quot;position&quot;:&quot;top&quot;},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;bold&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;ticks&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:false}}],&quot;yAxes&quot;:[{&quot;ticks&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:false}}]}}}" width="632" height="316" style="display: block; width: 632px; height: 316px;" class="chartjs-render-monitor"></canvas>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-5 col-xl-4">
         <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h6 class="text-primary fw-bold m-0">No. de estudiantes tardíos</h6>
               <div class="dropdown no-arrow">
                  <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="true" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                  <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in" data-bs-popper="none">
                     <p class="text-center dropdown-header">Seleccione la seccion</p>
                     <a class="dropdown-item" href="#">5TO A</a><a class="dropdown-item" href="#">5TO E</a>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="chart-area">
                  <div class="chartjs-size-monitor">
                     <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                     </div>
                     <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                     </div>
                  </div>
                  <canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Direct&quot;,&quot;Social&quot;,&quot;Referral&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#df4c40&quot;,&quot;#1cc88a&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;35&quot;,&quot;30&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}}" width="287" height="320" style="display: block; width: 287px; height: 320px;" class="chartjs-render-monitor"></canvas>
               </div>
               <div class="text-center small mt-4"><span class="me-2"><i class="fas fa-circle text-danger" style="color: var(--bs-danger);"></i>&nbsp;Mas de 4 tardanzas</span><span class="me-2"><i class="fas fa-circle text-success"></i>&nbsp;Normal</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col">
         <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h6 class="text-primary fw-bold m-0">Reportaje de las horas de llegada</h6>
               <div class="dropdown no-arrow">
                  <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                  <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                     <p class="text-center dropdown-header">SEleccione la tanda</p>
                     <a class="dropdown-item" href="#">&nbsp;Mañana</a><a class="dropdown-item" href="#">Tarde</a>
                     <div class="dropdown-divider"></div>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div>
                  <div class="chartjs-size-monitor">
                     <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                     </div>
                     <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                     </div>
                  </div>
                  <canvas data-bss-chart="{&quot;type&quot;:&quot;scatter&quot;,&quot;data&quot;:{&quot;datasets&quot;:[{&quot;label&quot;:&quot;Revenue&quot;,&quot;backgroundColor&quot;:&quot;#4e73df&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:[{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;4500&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;5300&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;6250&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;7800&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;9800&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;15000&quot;}]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},&quot;position&quot;:&quot;top&quot;},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;bold&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;ticks&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:false}}],&quot;yAxes&quot;:[{&quot;ticks&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:false}}]}}}" width="977" height="488" style="display: block; width: 977px; height: 488px;" class="chartjs-render-monitor"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="./js/chart.min.js"></script>
<?php
include 'footer.php'
?>