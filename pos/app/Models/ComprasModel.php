<?php 

namespace App\Models; //Poder trabajar con diferentes modelos

use CodeIgniter\Model; //Trabajar correctamente ci CodeIgniter

class ComprasModel extends Model{

    protected $table      = 'compras'; //Nombre de la tabla.
    protected $primaryKey = 'id'; //primaryKey de la tabla.

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //Cuando se haga consulta como se regresa la informacion.
    protected $useSoftDeletes = false; //eliminacion de filas 

    protected $allowedFields = ['folio', 'total', 'activo', 'id_usuario']; //Ingresa el nombre de las columnas a ingresar

    protected $useTimestamps = true; // tipo de fecha 
    protected $createdField  = 'fecha_alta'; //
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    //Inserta una compra en la tabla compras
    public function insertarCompra($id_compra, $total, $id_usuario){
        $this->insert([
            'folio' => $id_compra,
            'total' => $total,
            'id_usuario' => $id_usuario
        ]);

        return $this->insertID();
    }
} 


?>