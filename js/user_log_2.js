$(document).ready(() => {
  $('#date_sel').on('change', function() {
    var selectedDate = $(this).val();
    $('#dataTable').css('opacity', 0.5);
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
        },
        error: function(error) {
            // handle error
        }
    });

function DateSelect(){
  function getFormattedDate() {
    $('#date_sel').val(date);
    return date;
  }

  function disableDateIpnut(){
    $('#date_sel').attr('disabled', 'disabled');
  }

  function enableDateInput(){
    $('#date_sel').removeAttr('disabled');
  }

  return {getFormattedDate, disableDateIpnut, enableDateInput};
}

const dateSelect = DateSelect();

function DateFilter(){
    function setToday(){
      var date = new Date();
      var today = date.toISOString().substr(0, 10);
      return today;
    }

    function setWeek(){
      var date = new Date();
      var week = new Date(date.setDate(date.getDate() - 7));
      var week = week.toISOString().substr(0, 10);
      return week;
    }

    function setMonth(){
      var date = new Date();
      var month = new Date(date.setMonth(date.getMonth() - 1));
      var month = month.toISOString().substr(0, 10);
      return month;
    }

    function setAll(){
      var date = new Date();
      var all = new Date(date.setFullYear(date.getFullYear() - 10));
      var all = all.toISOString().substr(0, 10);
      return all;
    }

    return {setToday, setWeek, setMonth, setAll};
}

const dateFilter = DateFilter();

$('date_sel').on('click', function(){
  dateSelect.enableDateInput(); 
}

)
$('#dateFilter').on('click', function(){
  dateSelect.disableDateIpnut();
});

$('#dateFilter').on('blur', function()  {
  dateSelect.enableDateInput();
});

$('#dateFilter').on('change', function()  {
  let dateFilterValue = $(this).val();

  if(dateFilterValue == 'currentDate'){
    
  }
  else if(dateFilterValue == 'currentWeek'){
    
  }
  else if(dateFilterValue == 'currentMonth'){
    
  }
  else if(dateFilterValue == 'all'){
    
  }
})
});  
})

