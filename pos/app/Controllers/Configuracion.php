<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;


class Configuracion extends BaseController
{
    protected $configuracion;
    protected $reglas;

    public function __construct() //relacion modelo - controlador
    {
        $this->configuracion = new ConfiguracionModel(); //objeto de tipo UnidadesModel
        $this->session = session();

        helper(['form']);

        $this->reglas = [
            'tienda_nombre' => [ //validadciones para el campo nombre
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],'tienda_direccion' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ], 'tienda_telefono' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'tienda_email' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ], 'tienda_factura' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }
    //Plantilla inicial con todos los productos de la categoria configuracion
    public function index()
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }

        $nombre = $this->configuracion->where('nombre', 'tienda_nombre')->first();
        $email = $this->configuracion->where('nombre', 'tienda_email')->first();
        $telefono = $this->configuracion->where('nombre', 'tienda_telefono')->first();
        $direccion = $this->configuracion->where('nombre', 'tienda_direccion')->first();
        $factura = $this->configuracion->where('nombre', 'tienda_factura')->first();

        $data = [
            'titulo' => "Configuracion", 'nombre' => $nombre, 'email' => $email,
            'telefono' => $telefono, 'direccion' => $direccion, 'factura' => $factura
        ];
        // Guardamos data: asignamos nombre a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('configuracion/configuracion', $data); //pasamos data a la view
        echo view('footer');
    }

    //Nos permite actualizar un producto.
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {

            $this->configuracion->whereIn('nombre', ['tienda_nombre'])->set(['valor' =>
            $this->request->getPost('tienda_nombre')])->update();
            // 'nombre' es el nombre de la tabla, ['tienda_nombre'] => valor a buscar
            // set -> agrega el valor, donde valor el la columna de la bd y la clave a agregar es el this-request

            $this->configuracion->whereIn('nombre', ['tienda_email'])->set(['valor' =>
            $this->request->getPost('tienda_email')])->update();

            $this->configuracion->whereIn('nombre', ['tienda_telefono'])->set(['valor' =>
            $this->request->getPost('tienda_telefono')])->update();

            $this->configuracion->whereIn('nombre', ['tienda_direccion'])->set(['valor' =>
            $this->request->getPost('tienda_direccion')])->update();

            $this->configuracion->whereIn('nombre', ['tienda_factura'])->set(['valor' =>
            $this->request->getPost('tienda_factura')])->update();

            return redirect()->to(base_url() . '/configuracion');
        } 
    }
}
