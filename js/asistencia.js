$(document).ready(() => {
  $('#date_sel, #date_sel_to').on('change', function() {
      var selectedDate = $('#date_sel').val();
      var selectedDateTo = $('#date_sel_to').val();
      $('#dataTable').css('opacity', 0.5);
      $.ajax({
          url: 'user_log_up.php',
          type: 'POST',
          data: {
              'date_sel': selectedDate,
              'date_sel_to': selectedDateTo,
              'log_date': 1,
          },
          success: function(response) {
              $.ajax({
                  url: "user_log_up.php",
                  type: 'POST',
                  data: {
                      'log_date': 1,
                      'date_sel': selectedDate,
                      'date_sel_to': selectedDateTo,
                      'select_date': 0,
                  }
              }).done(function(data) {
                  $('#dataTable').css('opacity', 1);
                  $('#usersLog').html(data);
              });
          },
          error: function(error) {
              // handle error
          }
      });

      function DateSelect() {
          function getFormattedDate() {
              $('#date_sel').val(date);
              return date;
          }

          function disableDateIpnut() {
              $('#date_sel').attr('disabled', 'disabled');
          }

          function enableDateInput() {
              $('#date_sel').removeAttr('disabled');
          }

          return {
              getFormattedDate,
              disableDateIpnut,
              enableDateInput
          };
      }

      const dateSelect = DateSelect();

      function DateFilter() {
          function setToday() {
              var date = new Date();
              var today = date.toISOString().substr(0, 10);
              return today;
          }

          function setWeek() {
              var date = new Date();
              var week = new Date(date.setDate(date.getDate() - 7));
              var week = week.toISOString().substr(0, 10);
              return week;
          }

          function setMonth() {
              var date = new Date();
              var month = new Date(date.setMonth(date.getMonth() - 1));
              var month = month.toISOString().substr(0, 10);
              return month;
          }

          function setAll() {
              var date = new Date();
              var all = new Date(date.setFullYear(date.getFullYear() - 10));
              var all = all.toISOString().substr(0, 10);
              return all;
          }

          return {
              setToday,
              setWeek,
              setMonth,
              setAll
          };
      }

      const dateFilter = DateFilter();

      $('date_sel').on('click', function() {
              dateSelect.enableDateInput();
          }

      )
      $('#dateFilter').on('click', function() {
          dateSelect.disableDateIpnut();
      });

      $('#dateFilter').on('blur', function() {
          dateSelect.enableDateInput();
      });

      $('#dateFilter').on('change', function() {
          let dateFilterValue = $(this).val();

          if (dateFilterValue == 'currentDate') {

          } else if (dateFilterValue == 'currentWeek') {

          } else if (dateFilterValue == 'currentMonth') {

          } else if (dateFilterValue == 'all') {

          }
      })
  });

  $('export_to_excel').on('click', (e) => {
     let date_sel = $('#date_sel').val();
     let date_sel_to = $('#date_sel_to').val();

     $.ajax({
         url: 'Export_Excel.php',
         type: 'POST',
         data: {
             'To_Excel': 1,
             'date_sel': date_sel,
             'date_sel_to': date_sel_to,
         },
         success: function(response) {
            alert('Se exporto a excel');
         },
         error: function(error) {
             alert('No se pudo exportar a excel');
         }

  });
});
})