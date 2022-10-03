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

                <form action="<?php echo base_url();?>/productos/insertar" method="POST" autocomplete="off">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="codigo">Código</label>
                                <input class="form-control" id="codigo" name="codigo" type="text" autofocus required>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" id="nombre" name="nombre" type="text" 
                                value="<?php echo set_value("nombre") ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="id_unidad">Unidad</label>
                                <select class="form-control" id="id_unidad" name="id_unidad" required>
                                    <option value="">Seleccionar unidad</option>
                                    <?php foreach($unidades as $unidad){ ?>
                                        <option value="<?php echo $unidad['id']; ?>">
                                            <?php echo $unidad['nombre']; ?>
                                        </option>

                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="id_categoria">Categorias</label>
                                <select class="form-control" id="id_categoria" name="id_categoria" required>
                                    <option value="">Seleccionar categoria</option>
                                    <?php foreach($categorias as $categoria){ ?>
                                        <option value="<?php echo $categoria['id']; ?>">
                                            <?php echo $categoria['nombre']; ?>
                                        </option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="precio_venta">Precio venta</label>
                                <input class="form-control" id="precio_venta" name="precio_venta" type="text" 
                                autofocus value="<?php echo set_value("precio_venta") ?>" required>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="precio_compra">Precio compra</label>
                                <input class="form-control" id="precio_compra" name="precio_compra" type="text"
                                value="<?php echo set_value("precio_compra") ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="stock">Stock minimo</label>
                                <input class="form-control" id="stock" name="stock" type="text" 
                                autofocus value="<?php echo set_value("stock") ?>" required>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="inventariable">Es inventariable</label>
                                <select name="inventariable" id="inventariable" class="form-control">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>/productos" class="btn btn-primary">Regresar</a>
                    <button type="submit" class="btn badge-success">Guardar</button>

                </form>
                
            </div>
    </main>
