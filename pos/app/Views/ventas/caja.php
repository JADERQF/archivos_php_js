<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <?php $id_venta = uniqid(); ?>

            <br>

            <form id="form_venta" name="form_venta" method="POST" class="form-horizontal" action="<?php echo base_url(); ?>/ventas/guardar" autocomplete="off">

                <input type="hidden" id="id_venta" name="id_venta" value="<?php echo $id_venta; ?>" />

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ui-widget">
                                <label for="cliente"> Cliente:</label>
                                <input type="hidden" id="id_cliente" name="id_cliente" value="1">

                                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Nombre del cliente" value="Cliente contado" onkeyup="" autocomplete="off" autofocus required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="forma_pago"> Forma de pago:</label>
                            <select name="forma_pago" id="forma_pago" class="form-control" required>
                                <option value="001">Efectivo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">

                            <label for="codigo">Código</label>
                            <input class="form-control" id="codigo" name="codigo" type="text" placeholder="Digita el código y presione Enter" onkeyup="agregarProducto(event, this.value, 1, '<?php echo $id_venta; ?>')">
                            <!-- onkeyup ejecuta un script llamado por un key, dentro de esta la 
                            función llamada, event, this es el name del campo, this.value el valor digitado -->
                            <!-- para cuando no encuentre el codigo -->

                            <div class="col-sm-2">
                                <label id="resultado_error" style="color: red"></label>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="nombre">Nombre del producto</label>
                            <input class="form-control" id="nombre" name="nombre" type="text" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                                <label for="subtotal">Subtotal</label>
                                <input class="form-control" id="subtotal" name="subtotal" type="text" disabled>
                        </div>
                        
                    </div>
                        <div class="col-12 col-sm-5 float-right">
                            <label style="font-weight: bold; font-size: 2em; text-align: center;">Total $</label>
                            <input type="text" id="total" name="total" size="7" readonly="true" style="font-weight: bold; font-size: 2em; text-align: center;" value="0.00">
                        </div>

                        <div class="form-group mt-2">
                            <button type="button" id="completa_venta" name="completa_venta" class="btn btn-success">Completar compra</button>
                        </div>
                </div>
                <!-- Tabla de productos cargados -->
                <div class="row">
                    <table id="tablaProductos" class="table table-hover table-striped 
                        table-responsive tablaProductos">
                        <thead class="thead-dark" width="100%">
                            <th>#</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th width="2%"></th>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>
                </div>
            </form>
        </div>
    </main>


    <script>
        $(function() {
            $('#cliente').autocomplete({ //funcion de auto completado
                source: "<?php echo base_url(); ?>/clientes/autocompleteData", //origne de los datos
                minLength: 2, //mínimo de datos para empezar autocompletar
                select: function(event, ui) {
                    event.preventDefault();
                    $('#id_cliente').val(ui.item.id); //asigna el id al type hidden
                    $('#cliente').val(ui.item.value); //asigna el valor nombre al cliente 
                }

            });
        });

        $(function() {
            $('#codigo').autocomplete({ //funcion de auto completado
                source: "<?php echo base_url(); ?>/productos/autocompleteData", //origne de los datos
                minLength: 1, //mínimo de datos para empezar autocompletar
                select: function(event, ui) {
                    event.preventDefault();
                    $('#codigo').val(ui.item.value); //asigna el id al type hidden
                    $('#nombre').val(ui.item.nombre); //asigna el valor nombre al cliente 
                    $('#subtotal').val(ui.item.precio); //asigna el valor nombre al cliente 
                    setTimeout(
                        function() {
                            e = jQuery.Event('keypress');
                            e.which = 13; //cuando se presione enter
                            agregarProducto(e, ui.item.id, 1, '<?php echo $id_venta; ?>');
                        }
                    )
                }

            });
        });


        function agregarProducto(e, id_producto, cantidad, id_venta) {

            let enterKey = 13;

            if (cantidad != '') {
                if (e.which == enterKey) {

                    if (id_producto != null && id_producto != 0 && cantidad > 0) {                        

                        $.ajax({ //contenido ajax
                            url: '<?php echo base_url(); ?>/TemporalCompras/insertar/' + id_producto + "/" +
                                cantidad + "/" + id_venta,
                            success: function(resultado) { //resultado retorna de la peticion cuando sale OK!

                                if (resultado == 0) { //si es true, es que no envío nada o algún error.
                                    $(tagCodigo).val(''); //Vacíar el tagCodigo.
                                } else {
                                    var resultado = JSON.parse(resultado);

                                    if (resultado.error == '') {
                                        $("#tablaProductos tbody").empty(); //limpia el tbody de la tablaProdutos
                                        $("#tablaProductos tbody").append(resultado.datos);
                                        $("#total").val(resultado.total);
                                        $('#id_producto').val('');
                                        $('#codigo').val('');
                                        $('#nombre').val('');
                                        $('#precio_compra').val('');
                                        $('#subtotal').val('');
                                    }
                                }
                            }
                        });
                    }
                }
            }
        }

        function eliminarProducto(id_producto, id_compra) { //tagCodigo es el nombre del campo codigo, codigo es el valor digitado

            $.ajax({ //contenido ajax
                url: '<?php echo base_url(); ?>/TemporalCompras/eliminar/' + id_producto + "/" + id_compra,
                type: 'POST',
                success: function(resultado) { //resultado retorna de la peticion cuando sale OK!
                    if (resultado == 0) { //si es true, es que no envío nada o algún error.
                        $(tagCodigo).val(''); //Vacíar el tagCodigo.
                    } else {
                        var resultado = JSON.parse(resultado);
                        $("#tablaProductos tbody").empty(); //limpia el tbody de la tablaProdutos
                        $("#tablaProductos tbody").append(resultado.datos); //append pinto los datos
                        $("#total").val(resultado.total);
                    }
                }
            });
        }

        $(function(){
            $('#completa_venta').click(function(){
                let nFila = $('#tablaProductos tbody tr').length;
                if(nFila < 1){
                    //mostramos el modal.
                    $('#completa_venta').prop("data-toggle", "modal"); //Agregamos un atributo, nombre y valor.
                    $('#completa_venta').prop("data-target", "#mi-modal");
                    $('#mi-modal').modal('show');

                } else{
                    $('#form_venta').submit(); //Envíamos el formulario


                }
            });
        });
    </script>

    
    <!-- Modal-de validacion de si agregaste un producto-->
    <div class="modal fade" id="mi-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¡INGRESE UN PRODUCTO!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <p>¡Ups! Tenemos un problema. <br>
                        Para completar la compra debe ingresar por lo menos un producto. <br>

                        Mediante el campo código, se ingresa el producto.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>