<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"> <?php echo $titulo; ?> </h4>

            <div>
                <p>
                    <a href="<?php echo base_url(); ?>/ventas" class="btn btn-warning ">Ventas</a>
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
                                        <th>Fecha</th>
                                        <th>Código de venta</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th>Cajero</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datos as $dato) { ?>
                                        <tr>
                                        <td><?php echo $dato['id']; ?></td>
                                            <td><?php echo $dato['fecha_alta']; ?></td>
                                            <td><?php echo $dato['folio']; ?></td>
                                            <td><?php echo $dato['cliente']; ?></td>
                                            <td><?php echo $dato['total']; ?></td>
                                            <td><?php echo $dato['cajero']; ?></td>
                                            <td><a href="<?php echo base_url().'/ventas/muestraTicket/'.
                                            $dato['id']; ?>" class="btn btn-primary"><i class="fas fa-file"></i>
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
