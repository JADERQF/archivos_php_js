<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\CajasModel;
use App\Models\RolesModel;


class Roles extends BaseController
{
    protected $usuarios, $cajas, $roles;
    protected $reglas, $regla, $reglasLogin, $reglasUpdate;

    public function __construct() //relacion modelo - controlador
    {
        $this->usuarios = new UsuariosModel(); //objeto de tipo UnidadesModel
        $this->cajas = new CajasModel(); //objeto de tipo CajasModel
        $this->roles = new RolesModel(); //objeto de tipo RolesModel
        $this->session = session();
        helper(['form']);

        $this->reglas = [
            'rol' => [ //validadciones para el campo usuario
                'rules' => 'required|is_unique[roles.nombre]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} ya existe.'
                ]
            ]
        ];
    }

    //Plantilla inicial con todos los productos de la categoria usuarios
    public function index($activo = 1)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $roles = $this->roles->where('activo', $activo)->findAll(); //'activo'->nombre de la columna,
        // $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Roles", 'datos' => $roles]; // Guardamos data: asignamos nombre a $titulo
        // y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('roles/roles', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos muestra la lista de los productos eliminados
    public function eliminados($activo = 0)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }

        $roles = $this->roles->where('activo', $activo)->findAll(); //'activo'->nombre de la columna,
        // $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Roles eliminados", 'datos' => $roles]; // Guardamos data: asignamos nombre 
        //a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('roles/eliminados', $data); //pasamos data a la view
        echo view('footer');
    }
    //Plantilla para agregar un nuevo producto
    public function nuevo()
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $data = ['titulo' => "Agregar rol"]; // Asignamos nombre a título
        echo view('header');
        echo view('roles/nuevo', $data); //pasamos data a la view
        echo view('footer');
    }
    // Inserta un usuario a la Bd.
    public function insertar()
    {
        //Validamos los campos al insertar una usuario, verificando el método post y sus campos
        //obligatorios en la variable reglas
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {

            $this->roles->save([
                'nombre' => $this->request->getPost('rol'),
            ]);

            // con getPost obtenemos los valores tecleados y asignamos a cada atributo de la Bd.
            return redirect()->to(base_url() . '/roles');
        } else {
            // Asignamos nombre a título
            //Validator envía las validaciones que no se cumplieron
            $data = [
                'titulo' => "Agregar rol",
                'validation' => $this->validator
            ];

            echo view('header');
            echo view('roles/nuevo', $data); //pasamos data a la view
            echo view('footer');
        }
    }
    //Plantilla de Editar usuario
    public function editar($id, $valid = null)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $rol = $this->roles->where('id', $id)->first(); //'activo'->nombre de la columna, $activo dato a filtrar

        if ($valid != null) {
            $data = [
                'titulo' => 'Editar rol', 'rol' => $rol,
                'validation' => $valid
            ]; // guardamos datos en un array

        } else {
            $data = ['titulo' => 'Editar rol', 'rol' => $rol];
            // guardamos datos en un array

        }
        echo view('header');
        echo view('roles/editar', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos permite actualizar un producto.
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->roles->update($this->request->getPost('id'), [
                'nombre' => $this->request->getPost('rol'),

            ]); //nombre => valor de nombre 
            return redirect()->to(base_url() . '/roles');
        } else {
            //En caso de que no envíe el id, o las validaciones,se la envía.
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    //Nos perimite desactivar un producto (se envía a los productos eliminados)
    public function eliminar($id)
    {
        $this->roles->update($id, ['activo' => 0]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/roles');
    }
    //Nos permite reactivar un producto (pasa de eliminados a la lista de usuarios)
    public function reingresar($id)
    {
        $this->roles->update($id, ['activo' => 1]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/roles');
    }
}
