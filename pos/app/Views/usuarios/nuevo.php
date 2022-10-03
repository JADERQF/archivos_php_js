<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            
            <div class="container-fluid">
            <h4 class="mt-4"> <?php echo $titulo; ?> </h4>

            <?php if(isset($validation)){ ?> <!-- si existe validation mostrar el alert con listErrors-->
                <div class="alert alert-danger">
                    <?php echo $validation-> listErrors(); ?>
                </div>
            <?php } ?>

                <form action="<?php echo base_url();?>/usuarios/insertar" method="POST" autocomplete="off">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="usuario">Usuario</label>
                                <input class="form-control" id="usuario" name="usuario" type="text" 
                                value="<?php echo set_value('usuario') ?>" autofocus required>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" id="nombre" name="nombre" 
                                type="text" value="<?php echo set_value('nombre') ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="password">Contraseña</label>
                                <input class="form-control" id="password" name="password" type="password" 
                                value="<?php echo set_value('password') ?>" required>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="repassword">Verificar contraseña</label>
                                <input class="form-control" id="repassword" name="repassword" 
                                type="password" value="<?php echo set_value('repassword') ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="id_caja">Caja</label>
                                <select class="form-control" id="id_caja" name="id_caja" required>
                                    <option value="">Seleccionar caja</option>
                                    <?php foreach($cajas as $caja){ ?>
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
                                    <?php foreach($roles as $rol){ ?>
                                        <option value="<?php echo $rol['id']; ?>">
                                            <?php echo $rol['nombre']; ?>
                                        </option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-primary">Regresar</a>
                    <button type="submit" class="btn badge-success">Guardar</button>

                </form>
                
            </div>
    </main>
