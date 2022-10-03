<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\CajasModel;
use App\Models\RolesModel;


class Usuarios extends BaseController
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
            'usuario' => [ //validadciones para el campo usuario
                'rules' => 'required|is_unique[usuarios.usuario]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} ya existe.'
                ]
            ], 'password' => [ //validaciones para el password
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'repassword' => [ //validaciones para el repassword
                'rules' => 'required|matches[password]', //matches -> tiene que ser igual a
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'matches' => 'Usuario o contraseña incorrecta.'
                ]
            ], 'nombre' => [ //validaciones para el nombre
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'id_caja' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'id_rol' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
        ];
        //Reglas de validacion de usuarios.
        $this->regla = [ 
            'usuario' => [ //validadciones para el campo usuario
                'rules' => 'required|is_unique[usuarios.usuario]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} debe ser único '
                ]
            ],  'nombre' => [ //validaciones para el nombre
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'id_caja' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], 'id_rol' => [ //validaciones para el campo_corto
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
        ];
        //Reglas de validación de login.
        $this->reglasLogin = [
            'usuario' => [ //validadciones para el campo usuario
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ], 'password' => [ //validaciones para el password
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
                ];
        $this->reglasUpdate = [
            'password' => [ //validaciones para el password
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],'repassword' => [ //validaciones para el repassword
                'rules' => 'required|matches[password]', //matches -> tiene que ser igual a
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.'
                ]
            ]
                ]   ;
    }
    //Plantilla inicial con todos los productos de la categoria usuarios
    public function index($activo = 1)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $usuarios = $this->usuarios->where('activo', $activo)->findAll(); //'activo'->nombre de la columna,
        // $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Usuarios", 'datos' => $usuarios]; // Guardamos data: asignamos nombre a $titulo
        // y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('usuarios/usuarios', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos muestra la lista de los productos eliminados
    public function eliminados($activo = 0)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $usuarios = $this->usuarios->where('activo', $activo)->findAll(); //'activo'->nombre de la columna,
        // $activo dato a filtrar
        //findAll() devuelve todos los resultados activos
        $data = ['titulo' => "Usuarios eliminados", 'datos' => $usuarios]; // Guardamos data: asignamos nombre 
        //a $titulo y valores a $datos

        //view mostrar datos
        echo view('header');
        echo view('usuarios/eliminados', $data); //pasamos data a la view
        echo view('footer');
    }
    //Plantilla para agregar un nuevo producto
    public function nuevo()
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $cajas = $this->cajas->where('activo', 1)->findAll();
        $roles = $this->roles->where('activo', 1)->findAll();

        $data = ['titulo' => "Agregar usuario", 'cajas' => $cajas, 'roles' => $roles]; // Asignamos nombre a título
        echo view('header');
        echo view('usuarios/nuevo', $data); //pasamos data a la view
        echo view('footer');
    }
    // Inserta un usuario a la Bd.
    public function insertar()
    {
        //Validamos los campos al insertar una usuario, verificando el método post y sus campos
        //obligatorios en la variable reglas
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {

            $hash =  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT); //generamos un hash
            //el metodo password_hash(parametro a cifrar, metodo de cifrado) => nos cifra la clave del usuario.

            $this->usuarios->save([
                'usuario' => $this->request->getPost('usuario'),
                'password' => $hash, //clave ya convertida.
                'nombre' => $this->request->getPost('nombre'), //Con save los guardamos en $usuarios
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol'),
            ]);
            // con getPost obtenemos los valores tecleados y asignamos a cada atributo de la Bd.
            return redirect()->to(base_url() . '/usuarios');

        } else {
            // Asignamos nombre a título
            //Validator envía las validaciones que no se cumplieron
            $cajas = $this->cajas-> where('activo', 1)->findAll();
            $roles = $this->roles-> where('activo', 1)->findAll();
            $data = ['titulo' => "Agregar usuario", 'cajas'=> $cajas, 'roles'=> $roles,
             'validation' => $this->validator];

            echo view('header');
            echo view('usuarios/nuevo', $data); //pasamos data a la view
            echo view('footer');
        }
    }
    public function insertarUsuario()
    {
        //Validamos los campos al insertar una usuario, verificando el método post y sus campos
        //obligatorios en la variable reglas
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {

            $hash =  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT); //generamos un hash
            //el metodo password_hash(parametro a cifrar, metodo de cifrado) => nos cifra la clave del usuario.

            $this->usuarios->save([
                'usuario' => $this->request->getPost('usuario'),
                'password' => $hash, //clave ya convertida.
                'nombre' => $this->request->getPost('nombre'), //Con save los guardamos en $usuarios
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol'),
            ]);
            // con getPost obtenemos los valores tecleados y asignamos a cada atributo de la Bd.
            return redirect()->to(base_url().'/usuarios/login');

        } else {
            // Asignamos nombre a título
            //Validator envía las validaciones que no se cumplieron
            $cajas = $this->cajas-> where('activo', 1)->findAll();
            $roles = $this->roles-> where('activo', 1)->findAll();
            $data = ['titulo' => "Nuevo usuario", 'cajas'=> $cajas, 'roles'=> $roles,
             'validation' => $this->validator];

            echo view('nuevoUser', $data); //pasamos data a la view
            echo view('footer');
        }
    }
    //Plantilla de Editar usuario
    public function editar($id, $valid = null)
    {
        if(!isset($this->session->id_usuario)){ //si no existe el id_usuario de la sesion, regresame a la siguiente dirección
            return redirect()->to( base_url());
        }
        $cajas = $this->cajas-> where('activo', 1)->findAll();
        $roles = $this->roles-> where('activo', 1)->findAll();
        $usuario = $this->usuarios->where('id', $id)->first(); //'activo'->nombre de la columna, $activo dato a filtrar

        if ($valid != null) {
            $data = ['titulo' => 'Editar usuario', 'cajas'=> $cajas, 'roles' => $roles, 'usuario' => $usuario,
             'validation' => $valid]; // guardamos datos en un array

        } else {
            $data = ['titulo' => 'Editar usuario','cajas'=> $cajas, 'roles' => $roles, 'usuario' => $usuario]; 
            // guardamos datos en un array

        }
        echo view('header');
        echo view('usuarios/editar', $data); //pasamos data a la view
        echo view('footer');
    }
    //Nos permite actualizar un producto.
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->regla)) {
            $this->usuarios->update($this->request->getPost('id'), [
                'usuario' => $this->request->getPost('usuario'),
                'nombre' => $this->request->getPost('nombre'),
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol')
            
            ]); //nombre => valor de nombre 
            return redirect()->to(base_url() . '/usuarios');
        } else {
            //En caso de que no envíe el id, o las validaciones,se la envía.
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    //Nos perimite desactivar un producto (se envía a los productos eliminados)
    public function eliminar($id)
    {
        $this->usuarios->update($id, ['activo' => 0]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/usuarios');
    }
    //Nos permite reactivar un producto (pasa de eliminados a la lista de usuarios)
    public function reingresar($id)
    {
        $this->usuarios->update($id, ['activo' => 1]); //nombre => valor de nombre 
        return redirect()->to(base_url() . '/usuarios');
    }

    public function login(){ //Función de inicio de logeo.
        echo view('login');
    }

    public function nuevoUser(){ //Función de inicio de logeo.

        $cajas = $this->cajas->where('activo', 1)->findAll();
        $roles = $this->roles->where('activo', 1)->findAll();

        $data = ['titulo' => "Nuevo usuario", 'cajas' => $cajas, 'roles' => $roles]; // Asignamos nombre a título
        echo view('nuevoUser', $data); //pasamos data a la view
        echo view('footer');

    }

    public function validar(){ //Función para validar usuarios.

        if($this->request->getMethod() =="post" && $this->validate($this->reglasLogin)){
            $usuario = $this->request->getPost("usuario"); //Traemos el usuario digitado por el form.
            $password = $this->request->getPost("password");
            $datoUsuario = $this->usuarios->where('usuario', $usuario)->first(); // sql -> where 'usuario' 
            //de la bd compara con $usuario, trae el primero

            if($datoUsuario != null){ //Usuario existe != diferente de null
                //pass_verfidy metodo para verificar pass
                //pass ingresada por teclado, $datoUsuario[''] es el de la bd.
                if(password_verify($password, $datoUsuario['password'])){

                    $dataSesion = [ //Guardamos en array los datos del la sesion.
                        'id_usuario' => $datoUsuario['id'],
                        'nombre' => $datoUsuario['nombre'],
                        'id_caja' => $datoUsuario['id_caja'],
                        'id_rol' => $datoUsuario['id_rol']
                    ];
                    $sesion =session(); // start sesion.
                    $sesion->set($dataSesion); //data a la sesion
                    return redirect()->to(base_url().'/configuracion'); //todo OK inicia sesión
                } else {
                    $data['error'] = 'Usuario o contraseña incorrecta'; 
                    echo view('login', $data);
                }
            } 
            else{
                $data['error'] = 'El usuario no existe';
                echo view('login', $data);
            }
        } 
        else{
            $data = ['validation' => $this->validator];
            echo view('login', $data);
        }
    }

    public function cerrarSesion(){ //Cerrar sesión de usuario
        $sesion = session();
        $sesion-> destroy();
        return redirect()->to(base_url());
    }

    public function cambiarPassword(){
        $sesion = session();
        $usuario = $this->usuarios-> where('id', $sesion->id_usuario)->first();
        $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario];

        echo view('header');
        echo view('usuarios/cambiarPassword', $data);
        echo view('footer');
    }

    public function updatePassword(){ //Actualizar contraseña usuario

        if ($this->request->getMethod() == "post" && $this->validate($this->reglasUpdate)) {
            
            $sesion = session();
            $idUsuario = $sesion-> id_usuario;
            $hash =  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT); //generamos un hash
            //el metodo password_hash(parametro a cifrar, metodo de cifrado) => nos cifra la clave del usuario.

            $this->usuarios->update($idUsuario, [
                'password' => $hash, //clave ya convertida.
            ]);
            // con where obtenemos el id de la bd y trae el primer resutado.
            $usuario = $this->usuarios-> where('id', $sesion->id_usuario)->first();
              $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario, 'mensaje' => 'Cambios efectuados'];

            echo view('header');
            echo view('usuarios/cambiarPassword', $data);
            echo view('footer');

        } else {
            $sesion = session();
            $usuario = $this->usuarios-> where('id', $sesion->id_usuario)->first();
            $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario, 'validation' => $this-> validator];
    
            echo view('header');
            echo view('usuarios/cambiarPassword', $data);
            echo view('footer');
        }
    }
}
