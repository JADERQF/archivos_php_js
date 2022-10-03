<?php 

namespace App\Models; //Poder trabajar con diferentes modelos

use CodeIgniter\Model; //Trabajar correctamente ci CodeIgniter

class DetalleCompraModel extends Model{

    protected $table      = 'detalle_compra'; //Nombre de la tabla.
    protected $primaryKey = 'id'; //primaryKey de la tabla.

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //Cuando se haga consulta como se regresa la informacion.
    protected $useSoftDeletes = false; //eliminacion de filas 

    protected $allowedFields = ['id_venta', 'id_producto', 'nombre', 'cantidad', 'precio']; //Ingresa el nombre de las columnas a ingresar

    protected $useTimestamps = true; // tipo de fecha 
    protected $createdField  = 'fecha_alta'; //
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

} 


?>