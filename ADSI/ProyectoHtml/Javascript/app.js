/**
 * const y let
 */

 let variable=0;
 console.log(variable);
 variable="Nuevo valor";
 console.log(variable);
 const variable2=3; //Valor constante, sin poder modificar.
 //variable2=33.3;

 // function
 function fn1(a,b)
 {
     return a+b;
 }
 const resultado=fn1(3,4);
 console.log(resultado);
 
 //fat arrow  en fuction
 
 const fn2 = (a,b) => a+b; /*  () parámetros, => operacion(return).*/
 
 const resultado1 = fn2(3,6)
 console.log(resultado1);
 
 //otra manera de las fat arrows fuctions
 
 const fn3 = (a,b) => { //cuando utilizamos las llaves indicamos
    return a+b         //el valor a retornar (return).
}
const resultado2 = fn3(4,4)
console.log(resultado2);

 
/* object destructuring => nos sirve 
para obtener algunas propiedades de un objecto */

const servicios = {
    api:{},
    mailer:'soy mailer',
    apoyo:{},
}

const enviarcorreo = ({mailer}) => {
    console.log(mailer);
    //redactar lo que necesites para enviar correo.
}
enviarcorreo(servicios); //resultado: soy mailer.

//otra manera de utilizar object destructuring
const enviarcorreo2 = (argumento) => {
    const {mailer} = argumento
    console.log(mailer);
    //redactar lo que necesites para enviar correo.
}
enviarcorreo2(servicios); //resultado; soy mailer.


/*array spread operator => operador de propagación
 * Se utiliza cuando queremos separar o esparcir los elementos de un arreglo
 * cuando vayamos a llamar estos argumentos con las funciones, cuando con un arreglo
 * le queramos pasar estos argumentos a una función.
*/

const arr = [1,2]

const suma = (a,b) => a + b

const resultado3 = suma (...arr) //Los toma en cada parámetro

const arr2=[...arr] //copia de arr utilizando spread operator

arr.push(4) //Agregar un elemento a arr.

console.log(resultado3) //resultado 3.

console.log(arr2,arr) //resultado [1,2] y [1,2,4].

/* object spread operator => Copia de un objeto en  y asi no
mutar (push) los objetos que se tienen declarados previamente. */

const obj ={
a: 1,
b: 2,
}
const obj1 ={
    data: {
        ...obj,
    }
}

obj1.data['c']=3;

console.log(obj, obj1)


/* import React, { Component } from 'react';
import Cabecera from './components/Cabecera';
import './App.css';
import P from './components/P';

class App extends Component {
  state = {
    miau: 'Bienvenido a React.'
  }
  cambiarTextoDelEstado = () => {
    this.setState({miau:'Hola Mundo'})
  }
  
  manejaClick = texto =>{
    console.log(texto);
  }
    render (){
      const {miau} = this.state;
    //const texto = 'Bienvenido a miau';
  return (
    <div className = "App">
      <Cabecera miau = {miau} manejaClick = {this.manejaClick} />
        <P onClick={this.cambiarTextoDelEstado}>
          {miau}
        </P>
    </div>
  )
}
}

export default App;
 */