//Creando Nodos
let elemento = document.createElement("li"),
    contenido = document.createTextNode("contenido del Li creado")

elemento.appendChild(contenido);
 //AppenChild agrega contenido al elemento.
// elemento.setAttribute("align") --> atributos al elemento.

let padre = document.getElementsByTagName("li")[0].parentNode, //de los <li> obtenmé el elemento padre de la posición 0
primerElemento = document.getElementsByTagName("li")[0]; // Obtengo la posicion del elemento <li>
referencia = document.getElementsByTagName("li")[1]; 
//parentNode -> Devuelve el elemento padre.

padre.insertBefore(elemento, primerElemento) //Agrega el elemento creado con su contenido, y la ubicación
// insertBefore -> agrega un elemento hasta el inicio de padre,
// donde elemento -> elemento a agregar
// primerElemento -> referencia / ubicación.

padre.replaceChild(primerElemento,referencia) // Nos reemplaza Nodos del DOM.

//Pero no se aplica el removeChild
padre.removeChild(referencia) // Elimina un Nodo del DOM.