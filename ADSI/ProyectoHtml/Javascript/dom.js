let header = document.getElementById('header');

let parrafo = document.getElementById('parrafo');

let parrafo2 = document.getElementsByTagName('p'); //consulta mediante el tagName, las etiquetas o nodos

console.log(header.parentNode)

parrafo.style.color ="red"
parrafo2[2].style.textAlign = "right"

console.log(parrafo)
console.log(parrafo2[2].innerHTML) //

let nuevoParrafo = document.createElement('p'); //creamos un elemento
let textoParrafo = document.createTextNode('lo que va dentro de ese parrafo'); //lo que va en el elemento.
let datoNuevo = document.getElementById('datos'); //obtenemos el id donde vamo a asignar

datoNuevo.appendChild(nuevoParrafo); //asignamos el lugar donde poner el elemento creado p
nuevoParrafo.appendChild(textoParrafo); //asigamos lo que va dentro de ese p creado

function validar(){

    let nombre = document.getElementById('nombre').value;
    let radio = document.getElementsByName('sabes');
    let estudiante = document.getElementById('estudiante');
    let ValorRadio = '';

    for(let a=0; a<radio.length ; a++){
        if(radio[a].checked){
            ValorRadio = radio[a].value;
        }
    }
    if (estudiante.checked){
        estudiante = 'SI'
    }
    else if(!estudiante.checked){
        estudiante = 'NO'
    }

    console.log("Nombre: "+nombre+ "\nSabe programar: "+ValorRadio+ "\nEs estudiante: "+estudiante)
}

function limpiar(){

    let nombre = document.getElementById('nombre').value = "";
    let radio = document.getElementsByName('sabes');

    for(let a=0; a<radio.length ; a++){
        if(radio[a].checked){
            radio[a].checked =false;
        }
    }

    document.getElementById('estudiante').checked = false;
}