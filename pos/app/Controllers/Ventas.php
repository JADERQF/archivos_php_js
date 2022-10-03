<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\DetalleVentaModel;
use App\Models\ConfiguracionModel;
use App\Models\TemporalCompraModel;
use App\Models\ProductosModel;
use App\Models\CajasModel;
use App\Models\ClientesModel;
use App\Models\UsuariosModel;

class Ventas extends BaseController
{
    protected $ventas, $temporal_venta, $detalle_venta, $productos, $pdf, $configuracion, $cajas, $clientes;

    public function __construct() //relacion modelo - controlador
    {
        $this->ventas = new VentasModel(); //objeto de tipo UnidadesModel
        $this->detalle_venta = new DetalleVentaModel(); //objeto de tipo UnidadesModel
        $this->configuracion = new ConfiguracionModel(); //objeto de tipo ConfiguracionModel
        $this->cajas = new CajasModel(); //objeto de tipo CajasModel
        $this->productos = new ProductosModel(); 
        $this->session = session();

        helper(['form']);
    }    

    public function index()
    {   
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $datos = $this->ventas->obtener(1);
        $data = ['titulo' => 'Ventas', 'datos' => $datos];

        echo view('header');
        echo view('ventas/ventas', $data); //pasamos data a la view
        echo view('footer');


    }
    public function eliminar($id)
    {
        $productos = $this->detalle_venta->where('id_venta', $id)->findAll();

        $this->productos = new ProductosModel();

        foreach($productos as $producto){
            $this->productos->actualizaStock($producto['id_producto'], $producto['cantidad'], '+');
        }
        $this->ventas->update($id, ['activo' => 0]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/ventas');
    }

    public function eliminados($activo = 0)
    {   
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $datos = $this->ventas->obtener(0); //obtiene todas las ventas eliminadas

        $data = ['titulo' => "Ventas eliminadas", 'datos' => $datos]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('ventas/eliminados', $data); //pasamos data a la view
        echo view('footer');
    }
    //Plantilla para agregar un nuevo compra
    public function venta()
    {   
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        echo view('header');
        echo view('ventas/caja'); //pasamos data a la view
        echo view('footer');
    }
    // Inserta un producto a la Bd.

    public function guardar()
    {       
        $id_venta = $this->request->getPost('id_venta'); //obtiene el campo id_compra de nuevo.php
        
        $forma_pago = $this->request->getPost('forma_pago'); //obtiene el campo id_compra de nuevo.php
        $id_cliente = $this->request->getPost('id_cliente'); //obtiene el campo id_cliente de caja.php
        $total = preg_replace('/[\$,]/', '',$this->request->getPost('total')); //Obtiene el total de la compra de caja.php
        // preg_replace ->realiza una busqueda y sustituye las expresiones seleccionadas.
        $session = session();
        
        $caja = $this->cajas->where('id', $session->id_caja)->first(); //Trae el id_caja del usuario que inicio sesicon
        $folio = $caja['folio']; //buscamos el folio de esa caja
        
        
        //resultadoID retorna el id de la venta.
        $resultadoId = $this->ventas->insertarVenta($folio, $total, $session->id_usuario, $session->id_caja, $id_cliente, $forma_pago);
        $this->temporal_venta = new TemporalCompraModel(); //objeto de tipo 
        
        if($resultadoId){ //resultado es correcto, osea el id que retorna esta OK!

            $folio++;
            $this->cajas->update($session->id_caja,['folio' => $folio]); //aumentamos el valor del folio para 

            $resultadoVenta = $this-> temporal_venta-> porCompra($id_venta); //Trae el registro que corresponde a la venta 

            foreach($resultadoVenta as $venta){

                $this->detalle_venta->save([
                    'id_venta' => $resultadoId,
                    'id_producto' => $venta['id_producto'],
                    'nombre' => $venta['nombre'],
                    'cantidad' => $venta['cantidad'],
                    'precio' => $venta['precio'],
                ]);

                //Inicializamos el modelo productos, para usar sus metodos

                //Actualiza el stock de cada producto
                $this->productos->actualizaStock($venta['id_producto'], $venta['cantidad'], '-');
            }
            //Elimina la compra por el id.
            $this->temporal_venta->eliminarCompra($id_venta); 
        }
        return redirect()->to(base_url()."/ventas/muestraTicket/". $resultadoId);
    }

    function muestraTicket($id_venta){ //funcion para mostrar la vista donde aparece pdf que crea en generaCompraPdf

        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        
        $data['id_venta'] = $id_venta;
        echo view('header');
        echo view('ventas/ver_ticket', $data);
        echo view('footer');
    }

    function generarTicket($id_venta){ //Genera el pdf con el formato de compra

        $this->clientes = new ClientesModel();
        $this->usuarios = new UsuariosModel();
        
        $datos_venta = $this->ventas->where('id', $id_venta)->first(); //traeme el id de la compra.

        $cliente = $this->clientes->where('id', $datos_venta['id_cliente'])->first(); //nombre del cliente
        $usuario = $this->usuarios->where('id', $datos_venta['id_usuario'])->first(); //nombre del usuario
        
        $detalleVenta = $this->detalle_venta->select('*')->where('id_venta', $id_venta)->findAll();
        //$detalleCompra es una consulta donde me trea todos los detalle_compra donde sean iguales al id_compra y traeme toda ese registro.
        $nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        // nombreTienda trae la columna valor donde la columna nombre tiene valor de tienda_nombre y obtiene
        // la columna exactamente con el valor 'valor' que es el nombre de la tienda.
        $direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;

        $tienda_factura = $this->configuracion->select('valor')->where('nombre', 'tienda_factura')->get()->getRow()->valor;
        
        //con la líbreria fpdf
        $pdf = new \FPDF('P','mm',array(80, 200)); //P es la horientación, mm ->medida milimetros y tamaño letter
        $pdf -> AddPage(); //agregar una página
        $pdf -> SetMargins(4, 4 , 4); //Agrega margenes
        $pdf -> SetTitle('Venta'); //título del pdf
        $pdf -> SetFont('Arial', 'B', 11); //fuente del pdf

        $pdf-> image(base_url(). '/pay.png', 55, 0, 17, 17, 'PNG');
        
        $pdf-> Cell(70, 5, utf8_decode($nombreTienda), 0, 1, 'L'); // 0 es sin bordes, C es centrado, 1 salto de línea.
        $pdf -> SetFont('Arial', 'B', 9); //fuente del pdf
        
        $pdf-> Ln();

        //Cliente
        $pdf -> SetFont('Arial','B', 6); //fuente del pdf
        $pdf-> Cell(13, 5, utf8_decode('Cliente: '), 0, 0, 'L'); 
        $pdf -> SetFont('Arial','', 6); //fuente del pdf
        $pdf-> Cell(20, 5, utf8_decode($cliente['nombre']), 0, 0, 'L');
        //Cajero
        $pdf -> SetFont('Arial','B', 6); //fuente del pdf
        $pdf-> Cell(13, 5, utf8_decode('Cajero: '), 0, 0, 'L'); 
        $pdf -> SetFont('Arial','', 6); //fuente del pdf
        $pdf-> Cell(20, 5, utf8_decode($usuario['nombre']), 0, 1, 'L');
        //Fecha
        $pdf -> SetFont('Arial','B', 9); //fuente del pdf
        $pdf-> Cell(13, 5, 'Fecha: ', 0, 0, 'L'); 
        $pdf -> SetFont('Arial','', 9); //fuente del pdf
        $pdf-> Cell(50, 5, $datos_venta['fecha_alta'], 0, 1, 'L'); 
        //Direccion
        $pdf -> SetFont('Arial','', 9); //fuente del pdf
        $pdf-> Cell(70, 5, utf8_decode($direccionTienda), 0, 1, 'L'); //50 es el width, 5 el height
        //Numero del ticket
        $pdf -> SetFont('Arial','B', 9); //fuente del pdf
        $pdf-> Cell(13, 5, utf8_decode('Tickect: '), 0, 0, 'L'); 
        $pdf -> SetFont('Arial','', 9); //fuente del pdf
        $pdf-> Cell(50, 5, $datos_venta['folio'], 0, 1, 'L');
       
        
        $pdf-> Ln();
        
        $pdf-> SetFont('Arial','B', 7); //fuente del pdf
       
        $pdf-> SetTextColor(0,0,0); //color del texto.
        $pdf-> SetFont('Arial','B', 7); //fuente del pdf
        $pdf->Cell(7,5, 'Cant', 0, 0, 'L');
        $pdf->Cell(35,5, 'Nombre', 0, 0, 'L');
        $pdf->Cell(15,5, 'Precio', 0, 0, 'L');
        $pdf->Cell(15,5, 'Subtotal', 0, 1, 'L');
        
        $pdf-> SetFont('Arial','', 7); //fuente del pdf
        
        $contador= 1;
        
        foreach( $detalleVenta as $row){
            $pdf->Cell(7,5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(33,5, utf8_decode($row['nombre']), 0, 0, 'L');
            $pdf->Cell(15,5, $row['precio'], 0, 0, 'L');
            $subtotal = number_format($row['precio'] * $row['cantidad'], 2, '.', ',');
            $pdf->Cell(15,5, '$'.$subtotal, 0, 1, 'R');
            $contador++;
        }
        $pdf-> Ln();  //Salto de línea
        
        $pdf-> SetFont('Arial','B', 8); //fuente del pdf
        $pdf-> Cell(70, 5, 'Total $'. number_format($datos_venta['total'], 2, '.', ','), 0 , 1, 'R');
        
        $pdf-> Ln();  //Salto de línea
        $pdf->MultiCell(0,4, utf8_decode($tienda_factura), 0, 'C', 0);

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf ->Output('ticket.php','I'); //Visualizar el pdf, siendo el primer campo el nombre del pdf y I
        //funcion que manda el pdf al navegador.

    }

}
