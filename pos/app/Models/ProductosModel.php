<?php 

namespace App\Models; //Poder trabajar con diferentes modelos

use CodeIgniter\Model; //Trabajar correctamente ci CodeIgniter

class ProductosModel extends Model{

    protected $table      = 'productos'; //Nombre de la tabla.
    protected $primaryKey = 'id'; //primaryKey de la tabla.

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //Cuando se haga consulta como se regresa la informacion.
    protected $useSoftDeletes = false; //eliminacion de filas 

    protected $allowedFields = ['codigo', 'nombre', 'precio_venta','precio_compra',
    'existencias', 'stock', 'inventariable',
    'id_unidad','id_categoria', 'activo']; //Ingresa el nombre de las columnas a ingresar

    protected $useTimestamps = true; // tipo de fecha 
    protected $createdField  = 'fecha_alta'; //
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function actualizaStock($id_producto, $cantidad, $operador = '+'){

        $this->set('existencias', "existencias $operador $cantidad", FALSE);
        $this->where('id', $id_producto); //cuando id = id_producto
        $this->update();
    }

    public function productosMinimo(){
        
        return $this->select('productos.*')->findAll();

    }

    public function SinStockMinimo(){
        
        $this->select('productos.*');
            $this->where('existencias <= 0 AND inventariable = 1 AND activo = 1');
            $this->orderBy('productos.fecha_alta', 'DESC');
            $datos = $this->findAll();
            return $datos;
    }

} 


?>