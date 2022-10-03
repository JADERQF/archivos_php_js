<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"> <?php echo $titulo; ?> </h4>

            <div>
                <p>
                    <a href="<?php echo base_url(); ?>/compras" class="btn btn-warning ">Compras</a>
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
                                        <th>Código de compra</th>
                                        <th>Total</th>
                                        <th>Fecha</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($compras as $compra) { ?>
                                        <tr>
                                            <td><?php echo $compra['id']; ?></td>
                                            <td><?php echo $compra['folio']; ?></td>
                                            <td><?php echo $compra['total']; ?></td>
                                            <td><?php echo $compra['fecha_alta']; ?></td>
                                            <td><a href="<?php echo base_url().'/compras/muestraCompraPdf/'.
                                            $compra['id']; ?>" class="btn btn-primary"><i class="fas fa-file"></i>
                                            </a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </main>
