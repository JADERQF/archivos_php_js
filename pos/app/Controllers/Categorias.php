<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;

class Categorias extends BaseController
{
    protected $categorias;
    protected $reglas;

    public function __construct() //relacion modelo - controlador
    {
        $this-> categorias = new CategoriasModel(); //objeto de tipo CategoriasModel
        $this->session = session();

        helper(['form']);

        $this->reglas = [
            'nombre' => [ //validadciones para el campo nombre
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
                ];
        
    }
    //Plantilla inicial con todos los productos de la categoria Categorias
    public function index($activo = 1)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $categorias = $this-> categorias-> where('activo',$activo)-> findAll(); //'activo'->nombre de la columna, $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Categorias", 'datos' => $categorias]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('categorias/categorias', $data); //pasamos data a la view
        echo view('footer');
    } 
    //Nos muestra la lista de los productos eliminados
    public function eliminados($activo=0)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $categorias = $this-> categorias-> where('activo',$activo)-> findAll(); //'activo'->nombre de la columna, $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Categorias eliminados", 'datos' => $categorias]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('categorias/eliminados', $data); //pasamos data a la view
        echo view('footer');
    }
    //Plantilla para agregar un nuevo producto
    public function nuevo(){

        $data = ['titulo' => "Agregar categoria"]; // Asignamos nombre a título
        echo view('header');
        echo view('categorias/nuevo', $data); //pasamos data a la view
        echo view('footer');
    }
    // Inserta un producto a la Bd.
    public function insertar(){

        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)){

            $this-> categorias -> save(['nombre' => $this->request->getPost('nombre')]); // con getPost obtenemos los valores tecleados y asignamos a cada variable
            return redirect()->to(base_url().'/categorias');
        } else {
             // Asignamos nombre a título
            //Validator envía las validaciones que no se cumplieron
            $data = ['titulo' => "Agregar producto", 'validation' => $this->validator];

            echo view('header');
            echo view('categorias/nuevo', $data); //pasamos data a la view
            echo view('footer');
        }
    }
    //Plantilla de Editar unidad
    public function editar($id, $valid = null)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $unidad = $this->categorias->where('id', $id)->first(); //'activo'->nombre de la columna, $activo dato a filtrar
        if ($valid != null){

            $data = ['titulo' => 'Editar Categoria', 'datos' => $unidad, 'validation' => $valid]; // guardamos datos en un array
        
        } else {
            $data = ['titulo' => 'Editar Categoria', 'datos' => $unidad]; // guardamos datos en un array
        }

        echo view('header');
        echo view('categorias/editar', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos permite actualizar un producto.
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)){
            $this-> categorias -> update($this->request->getPost('id'),['nombre' =>
        $this->request->getPost('nombre')]); //nombre => valor de nombre 
        return redirect()->to(base_url().'/categorias');
        } else {
            //En caso de que no envíe el id, o las validaciones,se la envía.
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    //Nos perimite desactivar un producto (se envía a los productos eliminados)
    public function eliminar($id){
        $this-> categorias -> update($id,['activo' => 0 ]); //nombre => valor de nombre 
        return redirect()->to(base_url().'/categorias');
    }
    //Nos permite reactivar un producto (pasa de eliminados a la lista de Categorias)
    public function reingresar($id){ 
        $this-> categorias -> update($id,['activo' => 1 ]); //nombre => valor de nombre 
        return redirect()->to(base_url().'/categorias');
    }
}
