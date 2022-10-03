<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"> <?php echo $titulo; ?> </h4>

            <div>
                <p>
                    <a href="<?php echo base_url(); ?>/roles/nuevo" class="btn btn-info ">Agregar</a>
                    <a href="<?php echo base_url(); ?>/roles/eliminados" class="btn btn-warning ">Eliminados </a>
                </p>
            </div>
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable Example
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datos as $dato) { ?>
                                        <tr>
                                            <td><?php echo $dato['id']; ?></td>
                                            <td><?php echo $dato['nombre']; ?></td>

                                            <td><a href="<?php echo base_url().'/roles/editar/'.
                                            $dato['id']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i>
                                            </a></td>

                                            <td><a  href="#" data-href="<?php echo base_url().'/roles/eliminar/'.
                                            $dato['id']; ?>" data-toggle="modal"  data-target="#modal-confirmar" 
                                            data-placement="top" title="Eliminar registro" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                                            </a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal confirmación -->
    <div class="modal fade" id="modal-confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
                <div class="modal-body">
                    <p>¿Desea eliminar este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div> 
        </div>
    </div>
    
