class Productos {
    constructor(nombre, precio, data){
        this.nombre = nombre;
        this.precio = precio;
        this.data = data;
    }
}

class UI{
    AgregarProducto(producto){
       const listaProductos = document.getElementById('lista-productos');
       const elemento = document.createElement('div');
       elemento.innerHTML = `
            <div class="card text-center mb-4">
                <div class="card-body">
                    <strong>Producto</strong>: ${producto.nombre}
                    <strong>Precio</strong>: ${producto.precio}
                    <strong>Año</strong>: ${producto.data}
                    <a href="#" class="btn btn-danger ml-2 rounded" name="delete">delete</a>
                </div>
            </div>
       `;
       listaProductos.appendChild(elemento);
       this.resetearProductos(); //Resetea el formulario.

    }
    resetearProductos(){
        document.getElementById('form-productos').reset();
    }
    EliminarProducto(element){
        if(element.name === 'delete'){
            element.parentNode.parentNode.parentNode.remove() //Eliminamos el div creado accediendo a los elementos padres
            this.mostrarMensajes('Eliminado exitosamente', 'danger');
        }
    }
    mostrarMensajes(mensaje, estiloMensaje){

        const div = document.createElement('div');
        div.className = `alert alert-${estiloMensaje} mt-3`; //Agregamos 
        div.appendChild(document.createTextNode(mensaje)); //al div le agregamos el mensaje
        //Mostrando el mensaje
        const container = document.querySelector('.container');
        const app = document.querySelector('#app'); //obtenemos el id=app del index
        container.insertBefore(div, app); //insertar el div antes de app
        //Removemos el alert
        setTimeout(function(){
            document.querySelector('.alert').remove();
        }, 2000);
    }
}
//DOM eventos
//capturamos el evento submit del formulario, en este ejemplo manejamos id porque no utilizamos otra archivo (html,js, etc..)
document.getElementById('form-productos').addEventListener('submit', function(e){

    const nombre = document.getElementById('nombre').value;
    const precio = document.getElementById('precio').value;
    const data = document.getElementById('data').value;

    const producto = new Productos(nombre,precio,data); //Pasamos datos a la clase
    const ui = new UI(); //instanciamos un objeto de la clase UI
    if(nombre == '' || precio == '' || data == ''){
        return ui.mostrarMensajes('Completa los campos', 'primary')
    }        
    ui.AgregarProducto(producto);
    ui.mostrarMensajes('Agregado exitosamente', 'success');

    e.preventDefault();
})

document.getElementById('lista-productos').addEventListener('click', function(e){
    const ui = new UI();
    ui.EliminarProducto(e.target);
})
