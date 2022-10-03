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

                <form action="<?php echo base_url();?>/unidades/insertar" method="POST" autocomplete="off">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" id="nombre" name="nombre" type="text" 
                                value="<?php echo set_value('nombre') ?>" autofocus required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="nombre_corto">Nombre corto</label>
                                <input class="form-control" id="nombre_corto" name="nombre_corto" 
                                type="text" value="<?php echo set_value('nombre_corto') ?>" required>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo base_url(); ?>/unidades" class="btn btn-primary">Regresar</a>
                    <button type="submit" class="btn badge-success">Guardar</button>

                </form>
                
            </div>
    </main>
