function getFingerPrintId(){
  $.ajax({
    url: "services/get_fingerprint_id_to_send.php",
    success: function(response){
      $('#sendFingerprintId').prop('disabled', false);
      $('#currentFingerPrintId').text('FPUID a enviar:  ' + response);
      $('#fingerid').val(response);
    }
  }, 
  )
}

const deleteBtn = "<button class='btn btn-danger user_rmo'>Eliminar</button>";

function DeleteButton(){
  function createButton(){
    $('#delete-btn').html(deleteBtn);
  }
  function removeButton(){
    $('#delete-btn').html('');
  }

  return {createButton, removeButton}
}

function restoreInputs(){
  $('#nombre').val('');
  $('#apellido').val('');
  $('#matricula').val('');
  $('#sexo').val('');
  $('#tardanzas').val('');
  $('#ausencias').val('');
  $('#curso').val('');   
  $('#maestro').prop('checked', false);
}

function fetchTable(){
  $.ajax({
    url: "manage_users_up.php",
    }).done(function(data) {
    $('#manage_users').html(data);
  });
}


$(document).ready(function(){
  function button(){
    function setUpdate (){
      $('#save_student').removeClass('user_add').addClass('user_upd').text('Actualizar usuario');
  }
  function setSave(){
      $('#save_student').removeClass('user_upd').addClass('user_add').text('Agregar usuario');
  }
    return {setSave, setUpdate}
  }

  const buttonState = button();
  const deleteButton = DeleteButton();
  let isFingerEnrrolled = false
  getFingerPrintId();
   if (!isFingerEnrrolled) {
    disableInputs();
    $.ajax({
      url: "manage_users_up.php"
      }).done(function(data) {
      $('#manage_users').html(data);
    });
  }

  function disableInputs() {
    let inputs = document.getElementsByTagName('input');
    $('#save_student').prop('disabled', true);
    for (let i = 0; i < inputs.length; i++) {
      inputs[i].disabled = true;
    }
    let selects = document.getElementsByTagName('select');
    for (let i = 0; i < selects.length; i++) {
      selects[i].disabled = true;
    }
    isFingerEnrrolled = false;
  }
  
  function enableInputs() {
    $('#save_student').prop('disabled', false);
    let inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
      inputs[i].disabled = false;
    }
    let selects = document.getElementsByTagName('select');
    for (let i = 0; i < selects.length; i++) {
      selects[i].disabled = false;
    }
    isFingerEnrrolled = true;
  }
  function changeSVGColor(colorCode) {
    let svg = document.getElementById('finger_svg');
    svg.style.color = colorCode;
  }
  // Add user
  $(document).on('click', '.user_add', function(){
    //user Info
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var matricula = $('#matricula').val();
    var sexo = $("input[name='sexo']:checked").val();
    var tardanzas = $('#tardanzas').val();
    //Additional Info
    var tardanzas = $('#tardanzas').val();
    var ausencias = $('#ausencias').val();
    var curso = $('#curso').val();
    var isMaestro = $('#maestro').is(':checked') ? 1 : 0;
    

    $.ajax({
      url: 'manage_users_conf.php',
      type: 'POST',
      data: {
        'Add': 1,
        'nombre': nombre,
        'apellido': apellido,
        'matricula': matricula,
        'sexo': sexo,
        'tardanzas': tardanzas,
        'ausencias': ausencias,
        'curso': curso,
        'maestro': isMaestro
      },
      success: function(response){
        restoreInputs();

        $('#alert').fadeIn(500);
        let responseObject = JSON.parse(response)
        $('#alert').text(responseObject.message);

        if(responseObject.warning){
          changeSVGColor('#FFBF00');
        }
        if (responseObject.error){
          changeSVGColor('#C40F0F');
        }
        if (responseObject.success){
          changeSVGColor('#ADD8E6');
          buttonState.setSave();
          getFingerPrintId();
          disableInputs();
          fetchTable();
        }
      }
    });
  });
  // Add user Fingerprint
  $(document).on('click', '.fingerid_add', function(){

    restoreInputs();
    disableInputs();
    deleteButton.removeButton();
    getFingerPrintId();
    var fingerid = $('#fingerid').val();
    $.ajax({
      url: 'manage_users_conf.php',
      type: 'POST',
      data: {
        'Add_fingerID': 1,
        'fingerid': fingerid,
      },
      
      success: function(response){
        let responseObject = JSON.parse(response);
        $('#alert').fadeIn(500);
        $('#alert').text(responseObject.message);
      
        if (responseObject.warning) {
          enableInputs();
          let previousFingerId = $('#fingerid').val() - 1;
          $('#currentFingerPrintId').text('FPUID:' + previousFingerId);
          changeSVGColor('#FFBF00');
        }
        if (responseObject.success) {
        changeSVGColor('#ADD8E6');
        enableInputs();
        buttonState.setSave();
        
        }
        if (responseObject.error) {
          changeSVGColor('#C40F0F');
          disableInputs();
        }

        fetchTable();
      }
    });
  });
  // Update user
  $(document).on('click', '.user_upd', function(){
    //user Info
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var matricula = $('#matricula').val();
    var sexo = $("input[name='sexo']:checked").val();
    var tardanzas = $('#tardanzas').val();
    //Additional Info
    var tardanzas = $('#tardanzas').val();
    var ausencias = $('#ausencias').val();
    var curso = $('#curso').val();
    var isMaestro = $('#maestro').is(':checked') ? 1 : 0;

    $.ajax({
      url: 'manage_users_conf.php',
      type: 'POST',
      data: {
        'Update': 1,
        'nombre': nombre,
        'apellido': apellido,
        'matricula': matricula,
        'sexo': sexo,
        'tardanzas': tardanzas,
        'ausencias': ausencias,
        'curso': curso,
        'maestro': isMaestro
      },
      success: function(response){
        let responseObject = JSON.parse(response);
        $('#alert').fadeIn(500);
        $('#alert').text(responseObject.message);
      
        if (responseObject.warning) {
          enableInputs();
          changeSVGColor('#FFBF00');
        }
        if (responseObject.success) {
          changeSVGColor('#ADD8E6');
          restoreInputs();
          disableInputs();
        }
        if (responseObject.error) {
          changeSVGColor('#C40F0F');
          disableInputs();
        }
        
        fetchTable();
      }
    });   
  });
  // delete user
  $(document).on('click', '.user_rmo', function(){
  	$.ajax({
  	  url: 'manage_users_conf.php',
  	  type: 'POST',
  	  data: {
    	'delete': 1,
      },
      success: function(response){
        
        
        responseObject = JSON.parse(response);

        if (responseObject.warning) {
          changeSVGColor('#FFBF00');
        }
        if (responseObject.error) {
          changeSVGColor('#C40F0F');
          disableInputs()
        }
        if (responseObject.success) {
          changeSVGColor('#801818');
          restoreInputs();
          disableInputs();
          getFingerPrintId();
        }
        restoreInputs();
        disableInputs();
        
        buttonState.setSave();
        deleteButton.removeButton();


        $('#alert').fadeIn(500);
        $('#alert').text(responseObject.message);
        
        
        fetchTable();
      }
  	});
  });
  // select user
  $(document).on('click', '.user_id', function(){
    var Finger_id = $(this).attr("id");
    $.ajax({
      url: 'manage_users_conf.php',
      type: 'GET',
      data: {
      'select': 1,
      'Finger_id': Finger_id,
      },
      success: function(response){

        let responseObject = JSON.parse(response);

        if (responseObject.warning) {
          
          changeSVGColor('#FFBF00');
        }
        if (responseObject.success) {
          changeSVGColor('#ADD8E6');
          fetchTable();
          disableInputs();
          $.ajax({
            url: "services/get_user_by_id.php",
            method: 'GET',
            data: {
              'Finger_id': Finger_id,
            },
            success: function(response) {
              
              const user = response;
              buttonState.setUpdate();
              deleteButton.createButton();
              restoreInputs();
              $('#nombre').val(user.nombre);
              $('#apellido').val(user.apellido);
              $('#matricula').val(user.matricula);
              
              if (user.sexo == 'Masculino') {
                $('#male').prop('checked', true);
              }
              else if (user.sexo == 'Femenino') {
                $('#female').prop('checked', true);
              }

              if (parseInt(user.maestro)){
                $('#maestro').prop('checked', true);
              }

              $('#curso option').each(function(){
                if (this.value == user.id_curso) {
                    $(this).prop('selected', true); // Selects the option
                    return false; // breaks the loop
                }
            });
 
              $('#tardanzas').val(user.tardanzas);
              $('#ausencias').val(user.ausencias);

              
              enableInputs();


              $('#alert').fadeIn(500);
              $('#alert').text("Usuario seleccionado");
            }

          });

        }

        if (responseObject.error) {
          changeSVGColor('#C40F0F');
          
        }

        $('#alert').fadeIn(500);
        $('#alert').text(response.message);

        fetchTable();
      }
    });
  });
});
