<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\DetalleCompraModel;
use App\Models\ConfiguracionModel;
use App\Models\TemporalCompraModel;
use App\Models\ProductosModel;
use App\Models\UsuariosModel;

class Compras extends BaseController
{
    protected $compras, $temporal_compra, $detalle_compra, $productos, $configuracion, $pdf;

    public function __construct() //relacion modelo - controlador
    {
        $this->compras = new ComprasModel(); //objeto de tipo UnidadesModel
        $this->detalle_compra = new DetalleCompraModel(); //objeto de tipo UnidadesModel
        $this->configuracion = new ConfiguracionModel();
        $this->session = session();

        helper(['form']);
    }

    public function index($activo =1){

        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        
        $compras = $this->compras->where('activo', $activo)->findAll(); 
        $data = ['titulo' => 'Compras', 'compras' => $compras];

        echo view('header');
        echo view('compras/compras', $data);
        echo view('footer');
    }

    public function eliminados($activo = 0)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $compras = $this->compras->where('activo', $activo)->findAll(); //'activo'->nombre de la columna, $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Compras eliminadas", 'compras' => $compras]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('compras/eliminados', $data); //pasamos data a la view
        echo view('footer');
    }

    public function eliminar($id)
    {
        $productos = $this->detalle_compra->where('id_venta', $id)->findAll();

        $this->productos = new ProductosModel();

        foreach($productos as $producto){
            $this->productos->actualizaStock($producto['id_producto'], $producto['cantidad'], '-');
        }
        $this->compras->update($id, ['activo' => 0]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/compras');
    }
    
    //Plantilla para agregar un nuevo compra
    public function nuevo()
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        echo view('header');
        echo view('compras/nuevo'); //pasamos data a la view
        echo view('footer');
    }
    // Inserta un producto a la Bd.
    public function guardar()
    {
        $id_compra = $this->request->getPost('id_compra'); //obtiene el campo id_compra de nuevo.php
        $total = preg_replace('/[\$,]/', '',$this->request->getPost('total')); //Obtiene el total de la compra de nuevo.php
        // preg_replace ->realiza una busqueda y sustituye las expresiones seleccionadas.
        $session = session();

        //resultadoID retorna el id de la venta.
        $resultadoId = $this->compras->insertarCompra($id_compra, $total, $session->id_usuario);

        $this->temporal_compra = new TemporalCompraModel(); //objeto de tipo UnidadesModel

        if($resultadoId){ //resultado es correcto, osea el id que retorna esta OK!

            $resultadoCompra = $this-> temporal_compra-> porCompra($id_compra);

            foreach($resultadoCompra as $compra){
                $this->detalle_compra->save([
                    'id_venta' => $resultadoId,
                    'id_producto' => $compra['id_producto'],
                    'nombre' => $compra['nombre'],
                    'cantidad' => $compra['cantidad'],
                    'precio' => $compra['precio'],
                ]);

                $this->productos = new ProductosModel(); 
                //Actualiza el stock de cada producto
                $this->productos->actualizaStock($compra['id_producto'], $compra['cantidad']);
            }
            //Elimina la compra por el id.
            $this->temporal_compra->eliminarCompra($id_compra); 
        }
        return redirect()->to(base_url()."/compras/muestraCompraPdf/". $resultadoId);     
    }

    function muestraCompraPdf($id_compra){ //funcion para mostrar la vista donde aparece pdf que crea en generaCompraPdf

        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $data['id_compra'] = $id_compra;
        echo view('header');
        echo view('compras/ver_compra_pdf', $data);
        echo view('footer');
    }

    function generarCompraPdf($id_compra){ //Genera el pdf con el formato de compra

        $this->usuarios = new UsuariosModel(); //Inicializamos modelos para usar en usuario
        
        $datos_compra = $this->compras->where('id', $id_compra)->first(); //traeme el id de la compra.
        $usuario = $this->usuarios->where('id', $datos_compra['id_usuario'])->first();
        $detalleCompra = $this->detalle_compra->select('*')->where('id_venta', $id_compra)->findAll();
        //$detalleCompra es una consulta donde me trea todos los detalle_compra donde sean iguales al id_compra y traeme toda ese registro.
        $nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        // nombreTienda trae la columna valor donde la columna nombre tiene valor de tienda_nombre y obtiene
        // la columna exactamente con el valor 'valor' que es el nombre de la tienda.
        $direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;
        
        //con la líbreria fpdf
        $pdf = new \FPDF('P','mm','letter'); //P es la horientación, mm ->medida milimetros y tamaño letter
        $pdf -> AddPage(); //agregar una página
        $pdf -> SetMargins(10, 10 , 10); //Agrega margenes
        $pdf -> SetTitle('Compras'); //título del pdf
        $pdf -> SetFont('Arial', 'B', 9); //fuente del pdf
        
        $pdf-> Cell(195, 5, 'Entrada de productos', 0, 1, 'C'); // 0 es sin bordes, C es centrado, 1 salto de línea.
        $pdf -> SetFont('Arial', 'B', 9); //fuente del pdf

        $pdf-> image(base_url(). '/pay.png', 175, 2, 25, 25, 'PNG');
        //Nombre de la tienda
        $pdf-> Cell(50, 5, utf8_decode($nombreTienda), 0, 1, 'L'); //50 es el width, 5 el height
        //Cajero
        $pdf-> Cell(20, 5, utf8_decode('Cajero: '), 0, 0, 'L'); //50 es el width, 5 el height
        $pdf -> SetFont('Arial', '', 9); //fuente del pdf
        $pdf-> Cell(50, 5, utf8_decode($usuario['nombre']), 0, 1, 'L'); //50 es el width, 5 el height
        //Direccion de tienda
        $pdf -> SetFont('Arial', 'B', 9); //fuente del pdf
        $pdf-> Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L'); //50 es el width, 5 el height
        $pdf -> SetFont('Arial','', 9); //fuente del pdf
        $pdf-> Cell(50, 5, utf8_decode($direccionTienda), 0, 1, 'L'); //50 es el width, 5 el height
        //Fecha
        $pdf -> SetFont('Arial','B', 9); //fuente del pdf
        $pdf-> Cell(20, 5, utf8_decode('Fecha: '), 0, 0, 'L'); 
        $pdf -> SetFont('Arial','', 9); //fuente del pdf
        $pdf-> Cell(50, 5, $datos_compra['fecha_alta'], 0, 1, 'L'); 
        
        $pdf-> Ln();
        
        $pdf-> SetFont('Arial','B', 8); //fuente del pdf
        $pdf->SetFillColor(0,0,0); //Color del fondo de la celda
        $pdf-> SetTextColor(255,255,255); //color del texto.
        $pdf-> SetFont('Arial','B', 7); //fuente del pdf
        
        $pdf-> Cell(196, 5, 'Detalle de productos', 1, 1, 'C', 1); 
        $pdf-> SetTextColor(0,0,0); //color del texto.
        $pdf->Cell(14,5, 'No', 1, 0, 'L');
        $pdf->Cell(25,5, utf8_decode('Código'), 1, 0, 'L');
        $pdf->Cell(77,5, 'Nombre', 1, 0, 'L');
        $pdf->Cell(25,5, 'Precio', 1, 0, 'L');
        $pdf->Cell(25,5, 'Cantidad', 1, 0, 'L');
        $pdf->Cell(30,5, 'Subtotal', 1, 1, 'L');
        
        $pdf-> SetFont('Arial','', 8); //fuente del pdf
        
        $contador= 1;
        
        foreach( $detalleCompra as $row){
            
            $pdf->Cell(14,5, $contador, 1, 0, 'L');
            $pdf->Cell(25,5, $row['id_producto'], 1, 0, 'L');
            $pdf->Cell(77,5, utf8_decode($row['nombre']), 1, 0, 'L');
            $pdf->Cell(25,5, $row['precio'], 1, 0, 'L');
            $pdf->Cell(25,5, $row['cantidad'], 1, 0, 'L');
            $subtotal = number_format($row['precio'] * $row['cantidad'], 2, '.', ',');
            $pdf->Cell(30,5, '$ '.$subtotal, 1, 1, 'R');
            $contador++;
        }
        
        $pdf-> Ln();
        $pdf-> SetFont('Arial','B', 8); //fuente del pdf
        $pdf-> Cell(195, 5, 'Total $ '. number_format($datos_compra['total'], 2, '.', ','), 0, 1, 'R');
        
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf ->Output('compra_pdf.php','I'); //Visualizar el pdf, siendo el primer campo el nombre del pdf y I
        //funcion que manda el pdf al navegador.

    }
}
