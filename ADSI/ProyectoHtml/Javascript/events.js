//Algunos eventos de Js
const ramdom = (numero) =>{
    return Math.floor(Math.random() * (numero +1));
}
function changeFont(){
    let color = 'rgb('+ramdom(25)+','+ramdom(255)+','+ramdom(255)+')'; //Genera el color aleatoria con ramdom
    document.body.style.backgroundColor = color; //Agregamos color de fondo al body
    console.log(color)
}

let btn = document.getElementById('btn');
btn.onclick = changeFont;

//otra manera es
btn.addEventListener('click', changeFont);


let nombre = document.getElementById('nombre');
let cel = document.getElementById('cel');
let email = document.getElementById('email');
let checkestudiante = document.getElementById('estudiante');
let div_nivel = document.getElementById('div-nivel');
let select = document.getElementById('nivel');
let formulario = document.getElementById('formulario');


nombre.onkeyup = function(){ //Entrada de teclado
    document.getElementById('lnombre').innerText = nombre.value;
}

email.onfocus = function(){ //En foco cuando esta dentro de un elemento
    document.getElementById('lemail').innerText = 'En foco'
}
email.onblur = function(){ // cuando esta fuera de ese elemento
    document.getElementById('lemail').innerText = 'ya salio del elemento'
}

checkestudiante.onchange = function(){
    if(checkestudiante.checked){
        div_nivel.style.display = 'inline';
    } else if(!checkestudiante.checked){
        div_nivel.style.display = 'none';
    }
}

select.onchange = function(){
    alert(select.value)
}

formulario.onsubmit = function(){
    if(nombre.value == '' || email.value == ''){
        alert("¡Complete los campos!");
        return false;
    }
}
