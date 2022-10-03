<?php $id_compra = uniqid(); ?>
<!-- Genera un id aleatorio-->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="container-fluid py-3">

                <form method="POST" id="form_compra" name="form_compra" autocomplete="off" action="<?php echo base_url(); ?>/compras/guardar">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-4">

                                <input type="hidden" id="id_producto" name="id_producto" />
                                <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra; ?>" />

                                <label for="codigo">Código</label>
                                <input class="form-control" id="codigo" name="codigo" type="text" placeholder="Digita el código y presione Enter" autofocus onkeyup="buscarProducto(event, this, this.value)">

                                <!-- onkeyup ejecuta un script llamado por un key, dentro de esta la 
                            función llamada, event, this es el name del campo, this.value el valor digitado -->

                                <label id="resultado_error" style="color: red"></label>
                            </div>

                            <div class="col-12 col-sm-4">
                                <label for="nombre">Nombre del producto</label>
                                <input class="form-control" id="nombre" name="nombre" type="text" disabled>
                            </div>

                            <div class="col-12 col-sm-4">
                                <label for="cantidad">Cantidad</label>
                                <input class="form-control" id="cantidad" name="cantidad" type="text" onkeyup="cantidadProducto(event, this,this.value)" placeholder="Digita el cantidad y presione Enter">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <label for="precio_compra">Precio de compra</label>
                                <input class="form-control" id="precio_compra" name="precio_compra" type="text" disabled>
                            </div>
                            <div class="col-12 col-sm-4">
                                <label for="subtotal">Subtotal</label>
                                <input class="form-control" id="subtotal" name="subtotal" type="text" disabled>
                            </div>
                            <div class="col-12 col-sm-4 mt-4">
                                <button type="button" class="btn btn-primary mt-2" id="agregar" name="agregar" onclick="agregarProducto(id_producto.value, cantidad.value, '<?php echo $id_compra; ?>')">Agregar producto</button>
                            </div>

                        </div>
                    </div>

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

                    <div class="row">
                        <div class="col-12 col-sm-6 offset-md-6">
                            <label style="font-weight: bold; font-size: 2em; text-align: center;">Total $</label>

                            <input type="text" id="total" name="total" size="7" readonly="true" style="font-weight: bold; font-size: 2em; text-align: center;" value="0.00">

                            <button type="button" id="completa_compra" name="completa_compra" class="btn btn-success">Completar compra</button>
                        </div>
                    </div>
                </form>

            </div>
    </main>

    <script>
        $(document).ready(function() {
            var Boton = $('#completa_compra').click(function(e) { //al momento de hacer click en #completa_compra

                let nFila = $('#tablaProductos tbody tr').length; // cantidad de filas en la tabla (despues de agregar)

                if (nFila < 1) {
                    //mostramos el modal.
                    $('#completa_compra').prop("data-toggle", "modal"); //Agregamos un atributo, nombre y valor.
                    $('#completa_compra').prop("data-target", "#mi-modal");
                    $('#mi-modal').modal('show');
                } else {
                    $('#form_compra').submit();
                    alert('TRANSACCION EXITOSA');
                }
            });
        });


        function buscarProducto(e, tagCodigo, codigo) { //tagCodigo es el nombre del campo codigo, codigo es el valor digitado
            var enterKey = 13; //Enter es el 13 en ASCII.

            if (codigo != '') { // sí no es vacío es que ingresaron dato (código). 
                if (e.which == enterKey) { //evento es accionado. (enter)
                    $.ajax({ //contenido ajax
                        url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo,
                        type: 'POST',
                        dataType: 'json',
                        success: function(resultado) { //resultado retorna de la peticion cuando sale OK!
                            if (resultado == 0) { //si es true, es que no envío nada o algún error.
                                $(tagCodigo).val(''); //Vacíar el tagCodigo.
                            } else {

                                $("#resultado_error").html(resultado.error); //Muestra error en el id

                                if (resultado.existe) {
                                    $('#id_producto').val(resultado.datos.id);
                                    $('#nombre').val(resultado.datos.nombre);
                                    $('#cantidad').val(1);
                                    $('#precio_compra').val(resultado.datos.precio_compra);
                                    $('#subtotal').val(resultado.datos.precio_compra);
                                    $('#cantidad').focus();
                                } else {
                                    $('#id_producto').val('');
                                    $('#nombre').val('');
                                    $('#cantidad').val('');
                                    $('#precio_compra').val('');
                                    $('#subtotal').val('');
                                }
                            }
                        }
                    });
                }
            }
        }
        //cantidad producto nos multiplica la cantidad con el precio unitario y nos la muestra.

        function cantidadProducto(e, tag, cant) {
            let enterKey = 13;
            const codigo = document.getElementById('codigo').value;

            if (cant != '') {
                if (e.which == enterKey) { //evento es accionado. (enter)
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo,
                        type: 'POST',
                        dataType: 'json',
                        success: function(resultado) {
                            if (resultado == 0) {
                                $(tag).val(''); //Vacíar el tagCodigo.
                            } else {
                                if (resultado.existe) {
                                    $('#subtotal').val((resultado.datos.precio_compra * cant).toFixed(2));
                                }

                            }
                        }

                    })

                }
            }
        }

        function agregarProducto(id_producto, cantidad, id_compra) {

            if (id_producto != null && id_producto != 0 && cantidad > 0) {

                $.ajax({ //contenido ajax
                    url: '<?php echo base_url(); ?>/TemporalCompras/insertarCompra/' + id_producto + "/" +
                        cantidad + "/" + id_compra,
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
                                $('#cantidad').val('');
                                $('#precio_compra').val('');
                                $('#subtotal').val('');
                            }
                        }
                    }

                });
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
        </script>

    <!-- Modal-de validacion de producto-->
    <div class="modal fade" id="mi-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¡INGRESE UN PRODUCTO!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>¡Ups! Tenemos un problema.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>