<?php 

namespace App\Models; //Poder trabajar con diferentes modelos

use CodeIgniter\Model; //Trabajar correctamente ci CodeIgniter

class VentasModel extends Model{

    protected $table      = 'ventas'; //Nombre de la tabla.
    protected $primaryKey = 'id'; //primaryKey de la tabla.

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //Cuando se haga consulta como se regresa la informacion.
    protected $useSoftDeletes = false; //eliminacion de filas 

    protected $allowedFields = ['folio', 'total', 'id_usuario','id_caja','id_cliente','forma_pago', 'activo']; //Ingresa el nombre de las columnas a ingresar

    protected $useTimestamps = true; // tipo de fecha 
    protected $createdField  = 'fecha_alta'; //
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    //Inserta una compra en la tabla ventas
    public function insertarVenta($id_venta, $total, $id_usuario, $id_caja, $id_cliente, $forma_pago){
        $this->insert([
            'folio' => $id_venta,
            'total' => $total,
            'id_usuario' => $id_usuario,
            'id_caja' => $id_caja,
            'id_cliente' => $id_cliente,
            'forma_pago' => $forma_pago,

        ]);

        return $this->insertID();
    }

    public function obtener($activo = 1){

            $this->select('ventas.*, u.usuario AS cajero, c.nombre AS cliente');
            $this->join('usuarios AS u', 'ventas.id_usuario = u.id'); //INNER JOIN 
            $this->join('clientes AS c', 'ventas.id_cliente = c.id'); //INNER JOIN 
            $this->where('ventas.activo', $activo);
            $this->orderBy('ventas.fecha_alta', 'DESC');
            $datos = $this->findAll();
            return $datos;
    }
} 


?>