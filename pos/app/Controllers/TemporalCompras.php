<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TemporalCompraModel;
use App\Models\ProductosModel;


class TemporalCompras extends BaseController
{
    protected $temporal_compra, $productos;

    public function __construct() //relacion modelo - controlador
    {
        $this->temporal_compra = new TemporalCompraModel(); //objeto de tipo TemporalCompraModel
        $this->productos = new ProductosModel();

        helper(['form']);
    }

    // Inserta un producto a la Bd.
    public function insertar($id_producto, $cantidad, $id_compra)
    {
        $error = '';
        $producto = $this->productos->where('id', $id_producto)->first(); //consulta de id -> primero que find
        
        if($producto){
            $datoExiste = $this->temporal_compra->porIdProductoCompra($id_producto,$id_compra);
            if($datoExiste){
                $cantidad = $datoExiste -> cantidad + $cantidad; //cantidad registra en tabla + la recibida en el metodo.
                $subtotal = $cantidad * $datoExiste -> precio; //total cantidad * precio del dato(producto).

                $this->temporal_compra->actualizarProductoCompra($id_producto, $id_compra, $cantidad, $subtotal);
            } else {
                $subtotal = $cantidad * $producto['precio_venta'];
                //en caso tal es para confirmar y evitar modificaciones cant * $producto[precio]

                $this-> temporal_compra->save([
                    'folio' => $id_compra,
                    'id_producto' => $id_producto,
                    'codigo' => $producto['codigo'],
                    'nombre' => $producto['nombre'],
                    'cantidad' => $cantidad,
                    'precio' => $producto['precio_venta'],
                    'subtotal' => $subtotal,

                ]);
            }
        } else {
            $error = 'No existe el producto';
        }

        $rest['datos'] = $this->cargarProducto($id_compra);
        $rest['total'] = number_format($this->totalProducto($id_compra), 2, '.', ',');//number format cambiamos el formtado de salida del total
        $rest['error'] =$error;
        echo json_encode($rest);     
    }
    public function insertarCompra($id_producto, $cantidad, $id_compra)
    {
        $error = '';
        $producto = $this->productos->where('id', $id_producto)->first(); //consulta de id -> primero que find
        
        if($producto){
            $datoExiste = $this->temporal_compra->porIdProductoCompra($id_producto,$id_compra);
            if($datoExiste){
                $cantidad = $datoExiste -> cantidad + $cantidad; //cantidad registra en tabla + la recibida en el metodo.
                $subtotal = $cantidad * $datoExiste -> precio; //total cantidad * precio del dato(producto).

                $this->temporal_compra->actualizarProductoCompra($id_producto, $id_compra, $cantidad, $subtotal);
            } else {
                $subtotal = $cantidad * $producto['precio_compra'];
                //en caso tal es para confirmar y evitar modificaciones cant * $producto[precio]

                $this-> temporal_compra->save([
                    'folio' => $id_compra,
                    'id_producto' => $id_producto,
                    'codigo' => $producto['codigo'],
                    'nombre' => $producto['nombre'],
                    'cantidad' => $cantidad,
                    'precio' => $producto['precio_compra'],
                    'subtotal' => $subtotal,

                ]);
            }
        } else {
            $error = 'No existe el producto';
        }

        $rest['datos'] = $this->cargarProducto($id_compra);
        $rest['total'] = number_format($this->totalProducto($id_compra), 2, '.', ',');//number format cambiamos el formtado de salida del total
        $rest['error'] =$error;
        echo json_encode($rest);     
    }
    //Carga el producto a la base de datos de compras temporales y pinta la tabla de cada compra.
    public function cargarProducto($id_compra){

        $resultado = $this->temporal_compra->porCompra($id_compra);
        $fila = '';
        $numFila = 0;

        foreach($resultado as $row){
            $numFila++;
            $fila .= "<tr id= 'fila".$numFila."'>";
            $fila .= "<td>".$numFila."</td>";
            $fila .= "<td>".$row['codigo']."</td>";
            $fila .= "<td>".$row['nombre']."</td>";
            $fila .= "<td>".$row['precio']."</td>";
            $fila .= "<td>".$row['cantidad']."</td>";
            $fila .= "<td>".$row['subtotal']."</td>";

            $fila .= "<td> <a onclick=\"eliminarProducto(".$row['id_producto'].", '".$id_compra."')\"
            class='borrar'> <span class='fas fa-fw fa-trash'></span> </a></td>";     
            $fila.="</tr>";
        }
        return $fila;
    }
    //Nos suma el total de cada producto.
    public function totalProducto($id_compra){

        $resultado = $this->temporal_compra->porCompra($id_compra);
        $total = 0;

        foreach($resultado as $row){
            $total += $row['subtotal'];
        }
        return $total;
    }
    //Elimina de la tabla el producto seleccionado.
    public function eliminar($id_producto, $id_compra){

        $datoExiste = $this->temporal_compra->porIdProductoCompra($id_producto,$id_compra); //existe el producto

        if($datoExiste){
            if($datoExiste->cantidad >1){ //si la cantidad es mayor que 1
                $cantidad = $datoExiste->cantidad -1; // cantidad se le asigna un valor menor a la cantidad que existe
                $subtotal = $cantidad * $datoExiste->precio;
                //la cantidad es mayor a 1 y se le resta uno.
                $this->temporal_compra->actualizarProductoCompra($id_producto, $id_compra, $cantidad, $subtotal);

            } else{
                //si la cantidad es igual a 1 ya se puede quitar del listado de la tabla.
                $this->temporal_compra->eliminarProductoCompra($id_producto, $id_compra);

            }
        }
        //cargaProducto carga el producto dependiendo del id_compra
        $rest['datos'] = $this->cargarProducto($id_compra);
        $rest['total'] = number_format($this->totalProducto($id_compra), 2, '.', ',');//number format cambiamos el formado de salida del total
        $rest['error'] = '';
        echo json_encode($rest);

    }
}
