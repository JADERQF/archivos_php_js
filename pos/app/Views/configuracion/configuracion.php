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

                <form action="<?php echo base_url(); ?>/configuracion/actualizar" method="POST" autocomplete="off">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="tienda_nombre">Nombre de la tienda</label>
                                <input class="form-control" id="tienda_nombre" name="tienda_nombre" type="text"
                                 value="<?php echo $nombre['valor']; ?>" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="tienda_email">Correo electrónico</label>
                                <input class="form-control" id="tienda_email" name="tienda_email" 
                                type="text" value="<?php echo $email['valor']; ?>" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="tienda_telefono">Teléfono</label>
                                <input class="form-control" id="tienda_telefono" name="tienda_telefono" 
                                type="text" value="<?php echo $telefono['valor']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="tienda_direccion">Direccion</label>
                                <textarea class="form-control" id="tienda_direccion" name="tienda_direccion" 
                                type="text" required><?php echo $direccion['valor']; ?>" </textarea>
                            </div>
                            
                            <div class="col-12 col-sm-6">
                                <label for="tienda_factura">Factura</label>
                                <textarea class="form-control" id="tienda_factura" name="tienda_factura" 
                                type="text" required><?php echo $factura['valor']; ?> </textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn badge-success">Guardar</button>

                </form>
            </div>
        </div>
    </main>