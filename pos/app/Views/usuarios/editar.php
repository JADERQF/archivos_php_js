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

                <form action="<?php echo base_url(); ?>/usuarios/actualizar" method="POST" autocomplete="off">

                    <input type="hidden" value="<?php echo $usuario['id']; ?>" name="id" />

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="nombre">Usuario</label>
                                <input class="form-control" id="usuario" name="usuario" type="text" 
                                value="<?php echo $usuario['usuario'] ?>" autofocus required>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="nombre_corto">Nombre</label>
                                <input class="form-control" id="nombre" name="nombre" 
                                type="text" value="<?php echo $usuario['nombre'] ?>" required>
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
                                        <option value="<?php echo $caja['id']; ?>" 
                                            <?php if ($caja['id'] == $usuario['id_caja'])
                                                { echo 'selected';} ?>>
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
                                        <option value="<?php echo $rol['id']; ?>"
                                        <?php if ($rol['id'] == $usuario['id_rol'])
                                                { echo 'selected';} ?>>
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