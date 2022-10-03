<?php 

namespace App\Models; //Poder trabajar con diferentes modelos

use CodeIgniter\Model; //Trabajar correctamente ci CodeIgniter

class TemporalCompraModel extends Model{

    protected $table      = 'compra_temporal'; //Nombre de la tabla.
    protected $primaryKey = 'id'; //primaryKey de la tabla.

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //Cuando se haga consulta como se regresa la informacion.
    protected $useSoftDeletes = false; //eliminacion de filas 

    protected $allowedFields = ['folio', 'id_producto', 'codigo','nombre','cantidad','precio','subtotal']; //Ingresa el nombre de las columnas a ingresar

    protected $useTimestamps = false; // tipo de fecha 
    protected $createdField  = ''; //
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    //Metodo me trae el los datos de un producto mediante un id y su codigo.
    public function porIdProductoCompra($id_producto, $folio){
        $this->select('*'); //seleccioname todo
        $this->where('folio', $folio); //la columna folio se le envia la variable folio.
        $this->where('id_producto', $id_producto); //la columna id_producto se le envia la variable id_producto.
        $datos = $this-> get()->getRow(); //guardamos la informacion de la consulta en datos
        return $datos;
    }
    //Método cargar la tabla con el id correspondiente.
    public function porCompra($folio){
        $this->select('*'); //seleccioname todo
        $this->where('folio', $folio); //la columna folio se le envia la variable folio.
        $datos = $this-> findAll(); //Obtiene todo como un array
        return $datos;
    }
    //Método actualiza los datos del producto al momento de eliminar una cantidad equis.
    public function actualizarProductoCompra($id_producto, $folio, $cantidad, $subtotal){
        $this->set('cantidad', $cantidad);
        $this->set('subtotal', $subtotal);
        $this->where('id_producto', $id_producto);
        $this->where('folio', $folio);
        $this->update();
    }
    //Método que elimina un producto de la tabla temporal generada en la venta (nuevo.php -> Compras)
    public function eliminarProductoCompra($id_producto, $folio){
        $this->where('id_producto', $id_producto);
        $this->where('folio', $folio);
        $this->delete();
    }
    //al terminar la compra se elimina el dato de la tabla compra_temporal
    public function eliminarCompra($folio){
        $this->where('folio', $folio);
        $this->delete();
    }
} 


?>