<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <link rel="icon" href="<?php echo base_url(); ?>/profileicon.png" type="image/png">
    <title>Registro</title>
    <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="<?php echo base_url(); ?>/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="dialog py-5" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content shadow">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="mt-3"> <?php echo $titulo; ?> </h4>
                </div>
                        <form action="<?php echo base_url(); ?>/usuarios/insertarUsuario" method="POST" autocomplete="off">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label for="usuario">Usuario</label>
                                            <input class="form-control" id="usuario" name="usuario" type="text" value="<?php echo set_value('usuario') ?>" autofocus>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label for="nombre">Nombre</label>
                                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo set_value('nombre') ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label for="password">Contraseña</label>
                                            <input class="form-control" id="password" name="password" type="password" value="<?php echo set_value('password') ?>" required>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label for="repassword">Verificar contraseña</label>
                                            <input class="form-control" id="repassword" name="repassword" type="password" value="<?php echo set_value('repassword') ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label for="id_caja">Caja</label>
                                            <select class="form-control" id="id_caja" name="id_caja" required>
                                                <option value="">Seleccionar caja</option>
                                                <?php foreach ($cajas as $caja) { ?>
                                                    <option value="<?php echo $caja['id']; ?>">
                                                        <?php echo $caja['nombre']; ?>
                                                    </option>

                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label for="id_rol">Rol</label>
                                            <select class="form-control" id="id_rol" name="id_rol" required>
                                                <option value="">Seleccionar rol</option>
                                                <?php foreach ($roles as $rol) { ?>
                                                    <option value="<?php echo $rol['id']; ?>">
                                                        <?php echo $rol['nombre']; ?>
                                                    </option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer d-flex">

                            <a href="<?php echo base_url(); ?>/usuarios/login" class="btn btn-primary">Regresar</a>
                            <button type="submit" class="btn badge-success">Guardar</button>

                            
                        </div>
                            <?php if(isset($validation)){ ?> <!-- si existe validation mostrar el alert con listErrors-->
                                <div class="alert alert-danger m-1">
                                <?php echo $validation-> listErrors(); ?>
                                </div>
                            <?php } ?>
                    </div>  
                </form>
            </div>
        </div>
</body>