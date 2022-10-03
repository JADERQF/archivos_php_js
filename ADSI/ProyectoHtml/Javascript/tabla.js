

function Agregar(){

    let tabla = document.getElementById('tablaProductos');
    let ref = tabla.getElementsByTagName("tbody")[0]; //indice o
    let nuevaFila = ref.insertRow(ref.rows.length);  //Insertamos fila, obtenemos el tamaño de la fila

    let celda = nuevaFila.insertCell(0)
    celda.innerText = "Vaca" //Agregamosel texto a la celda en la posición 0
    let celda2 = nuevaFila.insertCell(1)
    celda2.innerText = "221"
    let celda3 = nuevaFila.insertCell(2)
    celda3.innerText = "$553"
    //insertRow inserta una fila.
}

function Eliminar(){
    let tabla = document.getElementById('tablaProductos')
    let numFila = tabla.rows.length;
    tabla.deleteRow(numFila -1); 
}