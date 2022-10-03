<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"> <?php echo $titulo; ?> </h4>
            <div class="container-fluid">
                
                <?php if (isset($validation)) { ?>
                    <!-- si existe validation mostrar el alert con listErrors-->
                    <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                    </div>
                <?php } ?>

                <form action="<?php echo base_url(); ?>/usuarios/updatePassword" method="POST" autocomplete="off">
 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="usuario">Usuario</label>
                                <input class="form-control" id="usuario" name="usuario" type="text" 
                                value="<?php echo $usuario['usuario'] ?>" disabled>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" id="nombre" name="nombre" 
                                type="text" value="<?php echo $usuario['nombre'] ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="password">Contraseña</label>
                                <input class="form-control" id="password" name="password" type="password" 
                                required>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="repassword">Cambiar contraseña</label>
                                <input class="form-control" id="repassword" name="repassword" 
                                type="password" required>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-primary">Regresar</a>
                    <button type="submit" class="btn badge-success">Guardar</button>

                    <?php if (isset($mensaje)) { ?>
                    <!-- si existe validation mostrar el alert con listErrors-->
                    <div class="alert alert-success mt-3">
                        <?php echo $mensaje; ?>
                    </div>
                    <?php } ?>

                </form>

            </div>
    </main>