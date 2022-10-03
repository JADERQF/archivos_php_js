<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="container-fluid">
                <h4 class="mt-4"> <?php echo $titulo; ?> </h4>
                <?php if (isset($validation)) { ?>
                    <!-- si existe validation mostrar el alert con listErrors-->
                    <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                    </div>
                <?php } ?>

                <form action="<?php echo base_url(); ?>/clientes/actualizar" method="POST" autocomplete="off">

                    <input type="hidden" value="<?php echo $cliente['id']; ?>" name="id" />

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="codigo">Nombre</label>
                                <input class="form-control" id="nombre" name="nombre" type="text" 
                                value="<?php echo $cliente['nombre']; ?>" autofocus >
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="nombre">Dirección</label>
                                <input class="form-control" id="direccion" name="direccion" type="text" 
                                value="<?php echo $cliente['direccion'] ?>">
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="telefono">Teléfono</label>
                                <input class="form-control" id="telefono" name="telefono" type="text" 
                                autofocus value="<?php echo $cliente['telefono'] ?>" >
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="correo">Correo electrónico</label>
                                <input class="form-control" id="correo" name="correo" type="text"
                                value="<?php echo $cliente['correo'] ?>">
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>/clientes" class="btn btn-primary">Regresar</a>
                    <button type="submit" class="btn badge-success">Guardar</button>

                </form>
            </div>
    </main>