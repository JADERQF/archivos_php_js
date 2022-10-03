<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnidadesModel;


class Unidades extends BaseController
{
    protected $unidades;
    protected $reglas;

    public function __construct() //relacion modelo - controlador
    {
        $this->unidades = new UnidadesModel(); //objeto de tipo UnidadesModel
        $this->session = session();

        helper(['form']);

        $this->reglas = [
            'nombre' => [ //validadciones para el campo nombre
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'nombre_corto' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }
    //Plantilla inicial con todos los productos de la categoria Unidades
    public function index($activo = 1)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $unidades = $this->unidades->where('activo', $activo)->findAll(); //'activo'->nombre de la columna, $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Unidades", 'datos' => $unidades]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('unidades/unidades', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos muestra la lista de los productos eliminados
    public function eliminados($activo = 0)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $unidades = $this->unidades->where('activo', $activo)->findAll(); //'activo'->nombre de la columna, $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Unidades eliminados", 'datos' => $unidades]; // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('unidades/eliminados', $data); //pasamos data a la view
        echo view('footer');
    }
    //Plantilla para agregar un nuevo producto
    public function nuevo()
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }

        $data = ['titulo' => "Agregar unidad"]; // Asignamos nombre a título
        echo view('header');
        echo view('unidades/nuevo', $data); //pasamos data a la view
        echo view('footer');
    }
    // Inserta un producto a la Bd.
    public function insertar()
    {
        //Validamos los campos al insertar una unidad, verificando el método post y sus campos obligatorios en la variable reglas
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {

            $this->unidades->save([
                'nombre' => $this->request->getPost('nombre'), //Con save los guardamos en $unidades
                'nombre_corto' => $this->request->getPost('nombre_corto')
                ]); // con getPost obtenemos los valores tecleados y asignamos a cada variable
            return redirect()->to(base_url() . '/unidades');
        } else {
            // Asignamos nombre a título
            //Validator envía las validaciones que no se cumplieron
            $data = ['titulo' => "Agregar unidad", 'validation' => $this->validator];

            echo view('header');
            echo view('unidades/nuevo', $data); //pasamos data a la view
            echo view('footer');
        }
    }
    //Plantilla de Editar unidad
    public function editar($id, $valid = null)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $unidad = $this->unidades->where('id', $id)->first(); //'activo'->nombre de la columna, $activo dato a filtrar

        if ($valid != null) {
            $data = ['titulo' => 'Editar unidad', 'datos' => $unidad, 'validation' => $valid]; // guardamos datos en un array

        } else {
            $data = ['titulo' => 'Editar unidad', 'datos' => $unidad]; // guardamos datos en un array

        }
        echo view('header');
        echo view('unidades/editar', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos permite actualizar un producto.
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->unidades->update($this->request->getPost('id'), ['nombre' =>
            $this->request->getPost('nombre'), 'nombre_corto' =>
            $this->request->getPost('nombre_corto')]); //nombre => valor de nombre 
            return redirect()->to(base_url() . '/unidades');
        } else {
            //En caso de que no envíe el id, o las validaciones,se la envía.
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    //Nos perimite desactivar un producto (se envía a los productos eliminados)
    public function eliminar($id)
    {
        $this->unidades->update($id, ['activo' => 0]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/unidades');
    }
    //Nos permite reactivar un producto (pasa de eliminados a la lista de Unidades)
    public function reingresar($id)
    {
        $this->unidades->update($id, ['activo' => 1]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/unidades');
    }
}
