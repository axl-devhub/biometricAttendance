<?php 
  session_start();
  $_SESSION['current_page'] = "index";
  include'header.php'; 
?> 

<script src="js/user_log_2.js"></script>
<script>
    $(document).ready(function() {
        let today = new Date().toISOString().split('T')[0];
        $('#date_sel').val(today);
        $('#dataTable').css('opacity', 0.5);

        let selectedDate = $('#date_sel').val();
      $.ajax({
          url: 'user_log_up.php',
          type: 'POST',
          data: {
              'date_sel': selectedDate,
              'log_date': 1,
          },
          success: function(response){
            $.ajax({
              url: "user_log_up.php",
              type: 'POST',
              data: {
                'log_date': 1,
                'date_sel': selectedDate,
                'select_date': 0,
              }
              }).done(function(data) {
              $('#dataTable').css('opacity', 1); 
              $('#usersLog').html(data);
            });
          }
        });
    });
      $(document).ready(function(){
      $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
            'select_date': 1,
        }
      });
      setInterval(function(){
    $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
            'select_date': 0,
        },
        success: function(data) {
            $('#usersLog').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
},3000);
  });
</script>

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
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col d-flex flex-row justify-content-xxl-start">
                                    <form class="d-inline-block">
                                        <a class="btn btn-primary btn-icon-split" role="button">
                                            <span class="text-white-50 icon">
                                                <i class="fas fa-angle-double-down"></i>
                                            </span>
                                            <span class="text-white text">Exportar excel</span>
                                        </a>
                                    </form>
                                    <div class="d-flex ms-auto">
                                        <input type="date" name="date_sel" id="date_sel"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="max-height: 800px;">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length-1" class="dataTables_length" aria-controls="dataTable">
                                        <label class="form-label">Mostrar 
                                            <select id="dateFilter" class="d-inline-block form-select form-select-sm">
                                                <option value="currentDate" selected>Hoy</option>
                                                <option value="currenWeek">Esta semana</option>
                                                <option value="currentMonth">Este mes</option>
                                                <option value="all">Todos</option>
                                            </select></label></div>
                                </div>
                                <div class="col-md-6">
                                    <div id="dataTable_filter-2" class="text-md-end dataTables_filter"><label class="form-label"><input class="form-control form-control-sm" type="search" aria-controls="dataTable" placeholder="Buscar por matricula" /></label></div>
                                </div>
                            </div>
                            <div class="jumbotron-container" id="noAsistanceMessage" style="display: none;"> 
                                <div class="jumbotron"> 
                                    <h1 class="display-4 cool-fonted">There are no products to show my friend</h1> 
                                    <hr class="my-4"> 
                                    <p class="lead align-center">Add one above to get started</p> 
                                </div> 
                            </div>
                            <div id="dataTable-1" class="table-responsive table-responsive-sm mt-1" role="grid" aria-describedby="dataTable_info" style="max-height: 500px;">
                                <table id="dataTable" class="table my-sm-0" style="overflow-y: scroll; transition: all 0.5s ease-in-out;">
                                    <thead>
                                        <tr>
                                            <th>Matricula</th>
                                            <th>Nombre</th>
                                            <th>Curso</th>
                                            <th>Hora-llegada</th>
                                            <th>Hora-salida</th>
                                            <th>Tardanzas</th>
                                            <th>Ausencias</th>
                                        </tr>
                                    </thead>
                                    <tbody id="usersLog">
                                    </tbody> 
                                    <tfoot>
                                        <tr>
                                            <td><strong>Matricula</strong></td>
                                            <td><strong>Nombre</strong></td>
                                            <td><strong>Curso</strong></td>
                                            <td><strong>Hora-llegada</strong></td>
                                            <td><strong>Hora-salida</strong></td>
                                            <td><strong>Tardanzas</strong></td>
                                            <td><strong>Auesncias</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php   
    include('./footer.php');
?>