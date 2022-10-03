<?php 

namespace App\Models; //Poder trabajar con diferentes modelos

use CodeIgniter\Model; //Trabajar correctamente ci CodeIgniter

class CajasModel extends Model{

    protected $table      = 'cajas'; //Nombre de la tabla.
    protected $primaryKey = 'id'; //primaryKey de la tabla.

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //Cuando se haga consulta como se regresa la informacion.
    protected $useSoftDeletes = false; //eliminacion de filas 

    protected $allowedFields = ['numero_caja', 'nombre', 'folio', 'activo']; //Ingresa el nombre de las columnas a ingresar

    protected $useTimestamps = true; // tipo de fecha 
    protected $createdField  = 'fecha_alta'; //
    protected $updatedField  = 'fecha_edit';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

} 


?>