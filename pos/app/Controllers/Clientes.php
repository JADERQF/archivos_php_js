<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientesModel;


class Clientes extends BaseController
{
    protected $clientes;
    protected $reglas;


    public function __construct() //relacion modelo - controlador
    {
        $this->clientes = new ClientesModel(); //objeto de tipo ClientesModel
        $this->session = session();


        helper(['form']);

        $this->reglas = [
             'nombre' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }
    //Plantilla inicial con todos los clientes de la categoria clientes
    public function index($activo = 1)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $clientes = $this->clientes->where('activo', $activo)->findAll(); //'activo'->nombre de la columna, $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Clientes", 'datos' => $clientes]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('clientes/clientes', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos muestra la lista de los clientes eliminados
    public function eliminados($activo = 0)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $clientes = $this->clientes->where('activo', $activo)->findAll(); //'activo'->nombre de la columna, $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Clientes eliminados", 'datos' => $clientes]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('clientes/eliminados', $data); //pasamos data a la view
        echo view('footer');
    }
    //Plantilla para agregar un nuevo cliente
    public function nuevo()
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $data = ['titulo' => "Agregar cliente"]; // Asignamos nombre a título
        echo view('header');
        echo view('clientes/nuevo', $data); //pasamos data a la view
        echo view('footer');
    }
    // Inserta un cliente a la Bd.
    public function insertar()
    {
        //Validamos los campos al insertar una unidad, verificando el método post y sus campos obligatorios.
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas) ) {

            $this->clientes->save([
                'nombre' => $this->request->getPost('nombre'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'correo' => $this->request->getPost('correo')
            ]); // con getPost obtenemos los valores tecleados y asignamos a cada variable
            return redirect()->to(base_url() . '/clientes');
        } else {
            $data = [
                'titulo' => "Agregar cliente", 'validation' => $this->validator
            ];

            echo view('header');
            echo view('clientes/nuevo', $data); //pasamos data a la view
            echo view('footer');
        }
    }
    //Plantilla de Editar unidad
    public function editar($id, $valid = null)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $cliente = $this->clientes->where('id', $id)->first();
        if ($valid != null) {
            $data = ['titulo' => "Editar cliente", 'cliente' => $cliente, 'validation' => $valid]; // Asignamos nombre a título
        } else {
            $data = ['titulo' => "Editar cliente", 'cliente' => $cliente];
        }
        
        echo view('header');
        echo view('clientes/editar', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos permite actualizar un cliente.
    public function actualizar()
    {
        if($this->request->getMethod() == "post" && $this->validate($this->reglas)){
            
            $this->clientes->update($this->request->getPost('id'), [
                'nombre' => $this->request->getPost('nombre'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'correo' => $this->request->getPost('correo')
            ]);
            return redirect()->to(base_url() . '/clientes');
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    //Nos perimite desactivar un cliente (se envía a los clientes eliminados)
    public function eliminar($id)
    {
        $this->clientes->update($id, ['activo' => 0]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/clientes');
    }
    //Nos permite reactivar un cliente (pasa de eliminados a la lista de clientes)
    public function reingresar($id)
    {
        $this->clientes->update($id, ['activo' => 1]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/clientes');
    }

    public function autocompleteData(){

        $returnData = array();

        $valor = $this-> request ->getGet('term');

        $clientes = $this->clientes->like('nombre', $valor)->where('activo', 1)->findAll();
        // like() -> busca lo que se asemeje al termino buscado, donde esten activos trae todos los resultados.
        if(!empty($clientes)){

            foreach($clientes as $row){
                $data['id'] = $row['id'];
                $data['value'] = $row['nombre']; //nombre del cliente
                array_push($returnData, $data); //array_push — Inserta uno o más elementos al final de un array
            }
        }

        echo json_encode($returnData); //enviamos los datos de autocompletar
    }
}
