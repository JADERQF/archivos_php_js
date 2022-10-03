<?php 

namespace App\Models; //Poder trabajar con diferentes modelos

use CodeIgniter\Model; //Trabajar correctamente ci CodeIgniter

class ConfiguracionModel extends Model{

    protected $table      = 'configuracion'; //Nombre de la tabla.
    protected $primaryKey = 'id'; //primaryKey de la tabla.

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //Cuando se haga consulta como se regresa la informacion.
    protected $useSoftDeletes = false; //eliminacion de filas 
    protected $useSoftUpdates = false; //eliminacion de filas 
    protected $useSoftCreates = false; //eliminacion de filas 
    
    protected $allowedFields = ['nombre', 'valor']; //Ingresa el nombre de las columnas a ingresar

    protected $useTimestamps = true; // tipo de fecha 
    protected $createdField  = null; //
    protected $updatedField  = null;
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

} 


?>