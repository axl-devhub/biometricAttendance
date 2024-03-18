<?php 
  session_start();
  $_SESSION['current_page'] = "asistencia";
  include'header.php'; 
?> 

<script src="js/user_log_3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.33/moment-timezone-with-data.min.js"></script>
<script>
    $(document).ready(function() {
        let today = moment().tz("America/Santo_Domingo").format('YYYY-MM-DD');
        $('#date_sel_to').val(today);
        $('#dataTable').css('opacity', 0.5);


        let selectedDateTo = $('#date_sel_to').val();
      $.ajax({
          url: 'user_log_up.php',
          type: 'POST',
          data: {
              'date_sel': selectedDateTo,
              'date_sel_to': selectedDateTo,
              'log_date': 1,
          },
          success: function(response){
            $.ajax({
              url: "user_log_up.php",
              type: 'POST',
              data: {
                'log_date': 1,
                'date_sel': selectedDateTo,
                'date_sel_to': selectedDateTo,
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
    var intervalId;

    function startInterval() {
        intervalId = setInterval(function() {
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
        }, 5000);
    }

    function stopInterval() {
        clearInterval(intervalId);
    }

    // Start the interval when the page loads
    startInterval();

    // Stop the interval when the search bar gains focus
    $('#dataTableFilter').focus(stopInterval);

    // Start the interval when the search bar loses focus
    $('#dataTableFilter').blur(setTimeout(() => {
        startInterval()
    }), 100000
    );
    $(document).ready(function(){
    $("#dataTableFilter").on("keyup", function() {
        var value = $(this).val().toUpperCase();
        $("#dataTable tr").filter(function() {
        $(this).toggle($(this).text().toUpperCase().indexOf(value) > -1)
        });
    });
  });
});

$(document).ready(function() {
    let today = moment().tz("America/Santo_Domingo").format('YYYY-MM-DD');
    $('#date_sel').attr('max', today);
    $('#date_sel_to').attr('max', today);

    $('#filter_by_dropdown li').click(function() {
             var selectedText = $(this).text();
            $('#filter_by_dropdown').prev().text(selectedText);
        });
    });
</script>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Asistencia</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col d-block">
                                    <div>
                                        <form class="d-inline-block" method="POST" action="Export_Excel.php">
                                            <button class="btn btn-primary btn-icon-split" role="button" name="To_Excel" type="submit">
                                                <span class="text-white-50 icon">
                                                    <i class="fas fa-angle-double-down"></i>
                                                </span>
                                                <span class="text-white text">
                                                    Exportar excel
                                                </span>
                                            </button>
                                        </form>
                                        <div class="d-flex float-end flex-row" style="height: 39px;">
                                            <div class="d-flex" style="margin-right: 24px;">
                                                <p style="margin-top: 6px;margin-right: 6px;font-size: 18px;">Desde:</p>
                                                <input type="date" name="date_sel" id="date_sel"  />
                                            </div>
                                            <div class="d-flex">
                                                <p style="margin-top: 6px;margin-right: 6px;font-size: 18px;">Hasta:</p>
                                                <input type="date" name="date_sel_to" id="date_sel_to"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="max-height: 800px;">
                        <div class="d-flex align-items-center" style="max-width: 400px;">
                                        <div class="input-group mb-3 align-self-center ">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="filter_by_dropdown" selected_value="1">Buscar por:</button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" value="2">Nombre</a></li>
                                                    <li><a class="dropdown-item" href="#" value="1">Matricula</a></li>
                                                    <li><a class="dropdown-item" href="#" value="3">Curso</a></li>
                                                </ul>
                                            <input type="text" class="form-control" id="dataTableFilter" aria-label="Text input with dropdown button" placeholder="Buscar..." >
                                        </div>
                                    </div>
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                </div> 
                            </div>
                            <div id="dataTable-1" class="table-responsive table-responsive-sm mt-1" role="grid" aria-describedby="dataTable_info" style="max-height: 500px;">
                                <table id="dataTable" class="table my-sm-0" style="overflow-y: scroll; transition: all 0.5s ease-in-out;">
                                    <thead>
                                        <tr>
                                            <th>Matricula</th>
                                            <th>Nombre</th>
                                            <th>Curso</th>
                                            <th>Fecha</th>
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
                                            <th>Fecha</th>
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