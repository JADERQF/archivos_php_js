<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\UnidadesModel;
use App\Models\CategoriasModel;
use tidy;

class productos extends BaseController
{
    protected $productos, $categorias;
    protected $reglas;


    public function __construct() //relacion modelo - controlador
    {
        $this->productos = new ProductosModel(); //objeto de tipo productosModel
        $this->unidades = new UnidadesModel(); //objeto de tipo unidadesModel
        $this->categorias = new CategoriasModel(); //objeto de tipo categoriasMdel
        $this->session = session();

        helper(['form']);

        $this->reglas = [
            'codigo' => [ //validadciones para el campo código
                'rules' => 'required|is_unique[productos.codigo]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} debe ser unico.'
                ]
            ], 'nombre' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'id_unidad' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'id_categoria' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'precio_venta' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'precio_compra' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'stock' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'inventariable' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }
    //Plantilla inicial con todos los productos de la categoria productos
    public function index($activo = 1)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $productos = $this->productos->where('activo', $activo)->findAll(); //'activo'->nombre de la columna, $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Productos", 'datos' => $productos]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('productos/productos', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos muestra la lista de los productos eliminados
    public function eliminados($activo = 0)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }

        $productos = $this->productos->where('activo', $activo)->findAll(); //'activo'->nombre de la columna, $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Productos eliminados", 'datos' => $productos]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('productos/eliminados', $data); //pasamos data a la view
        echo view('footer');
    }
    //Plantilla para agregar un nuevo producto
    public function nuevo()
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $unidades = $this->unidades->where('activo', 1)->findAll();
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $data = ['titulo' => "Agregar producto", 'unidades' => $unidades, 'categorias' => $categorias]; // Asignamos nombre a título
        echo view('header');
        echo view('productos/nuevo', $data); //pasamos data a la view
        echo view('footer');
    }
    // Inserta un producto a la Bd.
    public function insertar()
    {
        //Validamos los campos al insertar una unidad, verificando el método post y sus campos obligatorios.
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas) ) {

            $this->productos->save([
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'stock' => $this->request->getPost('stock'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('id_unidad'),
                'id_categoria' => $this->request->getPost('id_categoria')
            ]); // con getPost obtenemos los valores tecleados y asignamos a cada variable
            return redirect()->to(base_url() . '/productos');
        } else {
            //Validator envía las validaciones que no se cumplieron
            $unidades = $this->unidades->where('activo', 1)->findAll();
            $categorias = $this->categorias->where('activo', 1)->findAll();
            $data = [
                'titulo' => "Agregar producto", 'unidades' => $unidades, 'categorias' => $categorias,
                'validation' => $this->validator
            ];

            echo view('header');
            echo view('productos/nuevo', $data); //pasamos data a la view
            echo view('footer');
        }
    }
    //Plantilla de Editar unidad
    public function editar($id, $valid = null)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $unidades = $this->unidades->where('activo', 1)->findAll();
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $producto = $this->productos->where('id', $id)->first();

        if ($valid != null) {
            $data = [
                'titulo' => "Editar producto", 'unidades' => $unidades, 'categorias' => $categorias,
                'producto' => $producto, 'validation' => $valid
            ]; // Asignamos nombre a título
        } else{
            $data = [
                'titulo' => "Editar producto", 'unidades' => $unidades, 'categorias' => $categorias,
                'producto' => $producto
            ]; // Asignamos nombre a título
        }
        echo view('header');
        echo view('productos/editar', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos permite actualizar un producto.
    public function actualizar()
    {
        if($this->request->getMethod() == "post" && $this->validate($this->reglas)){
            
            $this->productos->update($this->request->getPost('id'), [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'stock' => $this->request->getPost('stock'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('id_unidad'),
                'id_categoria' => $this->request->getPost('id_categoria')
            ]);
            return redirect()->to(base_url() . '/productos');
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    //Nos perimite desactivar un producto (se envía a los productos eliminados)
    public function eliminar($id)
    {
        $this->productos->update($id, ['activo' => 0]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/productos');
    }
    //Nos permite reactivar un producto (pasa de eliminados a la lista de productos)
    public function reingresar($id)
    {
        $this->productos->update($id, ['activo' => 1]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/productos');
    }

    //Busca un producto por código.
    public function buscarPorCodigo($codigo){ //Recibe la variable
        $this->productos->select('*'); //select trae todo con *
        $this->productos->where('codigo', $codigo); //filtrar el codigo
        $this->productos->where('activo', 1); //y que esté activo 
        $datos = $this->productos->get()->getRow(); //obtenemos el registro (fila).

        $rest['existe'] = false;
        $rest['datos'] = '';
        $rest['error'] = '';

        if($datos){ //existe el registro?
            $rest['datos'] = $datos; //Asigna datos a rest.
            $rest['existe'] = true;
        } else { //de lo contrario
            $rest['error'] = 'No existe el producto';
            $rest['existe'] = false;
        }

        echo json_encode($rest); //devuelve un Json  (convierte)

    }
    //autocompleta los datos al buscar dentro de caja
    public function autocompleteData(){

        $returnData = array();

        $valor = $this-> request ->getGet('term');

        $productos = $this->productos->like('codigo', $valor)->where('activo', 1)->findAll();
        // like() -> busca lo que se asemeje al termino buscado, donde esten activos trae todos los resultados.
        if(!empty($productos)){

            foreach($productos as $row){
                $data['id'] = $row['id'];
                $data['value'] = $row['codigo']; //nombre del producto
                $data['label'] = $row['codigo']. ' - '. $row['nombre']; //nombre del producto
                $data['nombre'] = $row['nombre']; //nombre del cliente
                $data['precio'] = $row['precio_venta']; //precio de venta
                array_push($returnData, $data); //array_push — Inserta uno o más elementos al final de un array
            }
        }

        echo json_encode($returnData); //enviamos los datos de autocompletar
    }

    public function mostrarMinimo(){

        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        echo view('header');
        echo view('productos/ver_minimo');
        echo view('footer');
    }

    function generarMinimoPdf(){ //Genera el pdf con el formato de compra

        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        
        //con la líbreria fpdf
        $pdf = new \FPDF('P','mm', 'letter'); //P es la horientación, mm ->medida milimetros y tamaño letter
        $pdf -> AddPage(); //agregar una página
        $pdf -> SetMargins(10, 10 , 10); //Agrega margenes
        $pdf -> SetTitle(utf8_decode('Stock mínimo')); //título del pdf
        $pdf -> SetFont('Arial', 'B', 12); //fuente del pdf
        
        $pdf-> Cell(0, 5, utf8_decode('Reporte de productos'), 0, 1, 'C'); // 0 es sin bordes, C es centrado, 1 salto de línea.
        $pdf-> image(base_url(). '/pay.png', 10, 10, 25, 25, 'PNG');

        $pdf -> SetFont('Arial', 'B', 9); //fuente del pdf
        
        $pdf-> Ln(22);

        $pdf->SetFillColor(0,0,0); //Color del fondo de la celda
        $pdf-> SetTextColor(255,255,255); //color del texto.
        $pdf -> SetFont('Arial','B', 10); //fuente del pdf
        $pdf-> Cell(30, 5, utf8_decode('Código'), 1, 0, 'C',1); //50 es el width, 5 el height
        $pdf-> Cell(50, 5, utf8_decode('Nombre'), 1, 0, 'C',1); //50 es el width, 5 el height
        $pdf-> Cell(40, 5, utf8_decode('Precio de venta'), 1, 0, 'C',1); //50 es el width, 5 el height
        $pdf-> Cell(40, 5, utf8_decode('Existencias'), 1, 0, 'C',1); //50 es el width, 5 el height
        $pdf-> Cell(30, 5, utf8_decode('Stock Mínimo'), 1, 1, 'C',1); //50 es el width, 5 el height
        
        $datosProductos = $this->productos->productosMinimo(); //nos regresa los productos con existencias mayores a 1
        $pdf-> SetTextColor(10,55,10); //color del texto.
        $pdf -> SetFont('Arial', 'B', 9); //fuente del pdf
        //pintamos los datos     
        foreach( $datosProductos as $row){

            $pdf->Cell(30,5, $row['codigo'], 1, 0, 'C');
            $pdf->Cell(50,5, utf8_decode($row['nombre']), 1, 0, 'C');
            $pdf->Cell(40,5, utf8_decode($row['precio_venta']), 1, 0, 'C');
            $pdf->Cell(40,5, $row['existencias'], 1, 0, 'C');
            $pdf->Cell(30,5, $row['stock'], 1, 1, 'C');
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf ->Output('ticket.php','I'); //Visualizar el pdf, siendo el primer campo el nombre del pdf y I
        //funcion que manda el pdf al navegador.

    }
}
