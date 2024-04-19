<?php
include 'header.php';
?>

<div class="container-fluid" style="margin-top: 7px;">
    <h3 class="text-dark mb-4">Perfil de usuario</h3>
    <form action="./php/users/edit_users.php" method="post" autocomplete="off">
        <input type="hidden" name="user_id" value="<?= $user['user_id']?>">
        <div class="row mb-3">
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body text-center shadow">
                        <img id="cellImg" style="object-fit:cover;" class="rounded-circle mb-3 mt-2" width="250" height="250" alt="Image of the user" />
                        <div class="mb-3">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-target="#upload-picture-modal" data-bs-toggle="modal">Foto del usuario</button>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-primary fw-bold m-0">Rol/es asignados (en implementacion)</h6>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Prueba</h5>
                                <h6 class="text-muted card-subtitle small fw-bold">Rol asignado en: 2023/12/2</h6><a class="card-link" href="#">Ver info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Datos del usuario</p>
                            </div>
                            <div class="card-body">
                                
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Nombre de usuario</strong></label>
                                            <input id="username" readonly class="form-control" type="text" placeholder="username" name="username" value="<?= $user['username']?>"/></div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Correo electrónico</strong></label>
                                            <input id="email" required class="form-control" type="email" placeholder="user@example.com" name="email" value="<?= $user['correo']?>" /></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="first_name"><strong>Nombre</strong></label>
                                            <input id="first_name" required class="form-control" type="text" placeholder="John" name="first_name" value="<?= $user['nombre']?>" /></div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="last_name"><strong>Apellido</strong></label>
                                            <input id="last_name" required class="form-control" type="text" placeholder="Doe" name="last_name" value="<?= $user['apellido']?>" /></div>
                                        </div>
                                    </div>
                                <button class="btn btn-link btn-sm text-end float-start d-xxl-flex justify-content-xxl-end" type="submit">Desea cambiar la contraseña? (en implementacion)</button>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Informacion de contacto</p>
                            </div>
                            <div class="card-body">
                                <div class="mb-3"><label class="form-label" for="address">
                                    <strong>Dirección</strong></label>
                                    <input id="address" required class="form-control" type="address" placeholder="Sunset Blvd, 38" name="address" value="<?= $user['direccion']?>" /></div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="city"><strong>Ciudad</strong></label>
                                        <input id="city" required class="form-control" type="text" placeholder="Los Angeles" name="city" value="<?= $user['ciudad']?>" /></div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="phone"><strong>Teléfono</strong></label>
                                        <input id="phone" required class="form-control" type="tel" placeholder="849-209-3635" name="phone" value="<?= $user['telefono']?>" /></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary btn-sm text-end float-end d-xxl-flex justify-content-xxl-end" type="submit">Guardar cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<form action="/" id="uploadImageForm" method="post">
    <div class="modal fade" role="dialog" tabindex="-1" id="upload-picture-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-primary" style="background: var(--bs-link-color);margin-bottom: 13px;">
                    <h4 class="modal-title text-light" style="font-size: 17px;">Foto de perfil (png/jpg) · Max 250kb</h4>
                    <button class="btn-close btn-close-white" type="button" aria-label="Close" data-bs-dismiss="modal" ngbautofocus="" id="closeUpdateModal"></button>
                </div>
                <div class="alert alert-warning alert-dismissible fade show" style="margin-right: 32px; margin-left: 32px;" id="alertStatus">
                    No ha subido ninguna imagen
                </div>
                <div class="modal-body" style="padding: 9px;padding-bottom: 0px;">
                    <div class="dashed_upload">
                        <div class="wrapper">
                            <div class="drop">
                                <div class="cont">
                                    <i class="fa fa-cloud-upload"></i>
                                    <div class="tit">Arrastre una foto</div>
                                    <div class="desc">o</div>
                                    <div class="browse">Busque en sus archivos</div>
                                </div>
                            <input id="imageInput" accept="image/png, image/jpeg" name="image" type="file"  />
                    </div>
                </div>
            </div>
        </div>
    <div class="modal-footer" style="justify-content: center;margin-top: 17px;">
    <button class="btn btn-primary" type="submit">Guardar cambios</button></div>
</form>

<script>
const KILOBYTE_SIZE_THRESH = 250; 

$(document).ready(() => {

    if (!user_id){
        $("#cellImg").attr('src', './assets/img/Image_not_available.png');
    }
    $.ajax({
        url: "./php/profile/get_profile_pic.php?user_id=" + user_id,
        type: 'GET',
        success: function(response){
            // set the src of the img element to the response
            console.log(response);
            $('#cellImg').attr('src', response);
        },
        error: function(error){
            // handle error here
            console.log(error);
        }
    })
})

$(document).ready(function(){
    const alertStatus = $('#alertStatus');
    $('#imageInput').on('change', function() {
        var file = this.files[0];
        if (file) {
            if (file.size > KILOBYTE_SIZE_THRESH * 1024) {
                alertStatus.css('display', 'block');
                alertStatus.text("El archivo es demasiado grande");
                alertStatus.addClass('alert-danger');
                alertStatus.removeClass('alert-warning');  
                $(this).val('');
            }
            else if (file.type !='image/jpeg' && file.type != 'image/png'){
                alertStatus.css('display', 'block');
                alertStatus.text("El archivo no es una imagen");
                alertStatus.addClass('alert-danger');
                alertStatus.removeClass('alert-warning');  
                $(this).val('');
            }
            else {
                alertStatus.text("Nombre del archivo: " + file.name);
                alertStatus.addClass('alert-success');
                alertStatus.removeClass('alert-warning');  
                alertStatus.removeClass('alert-danger');
                alertStatus.css('display', 'block');         
            }
        }
    });


    $('#uploadImageForm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: './php/change_picture.php', 
            type: 'POST', 
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response){
                // set the src of the img element to the base64 string
                console.log(response);
                $('#cellImg').attr('src', 'data:image/png;base64,' + response);
                if ($('#imgValue').length) {
                    $('#imgValue').val(response);
                } else {
                    var input = $('<input>').attr({
                        type: 'hidden',
                        id: 'imgValue',
                        name: 'imgValue',
                        value: response
                    });
                    $('#cellImg').after(input);
                }
                $('#alertStatus').html('Imagen subida con exito');
                $('#alertStatus').removeClass('alert-warning');
                $('#alertStatus').addClass('alert-success');

                $('#closeUpdateModal').click();
            },
            error: function(error){
                // handle error here
                console.log(error);
            }
        });
    });
});
</script>