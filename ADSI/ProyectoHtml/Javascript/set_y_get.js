// function persona(nombre){
//     this.nombre = nombre
//     let cel = 3333;
//     console.log("Hola soy"+nombre)

//     this.getCel = function(){
//         return cel;
//     }
// }

// let obj = new persona("Hpta")
// console.log(obj.getCel())

// persona.prototype.getCel = function(){
//     return this.cel;
// 

let personaMap = new WeakMap();

class Hombre {

    constructor(nombre, edad){
        personaMap.set(this, {
            nombre,
            edad,
            cel : 'f',
        })  
    }

    set setCel(valor){
    personaMap.get(this).cel = valor;

    }
    get cel(){
        return personaMap.get(this).cel;
    }

    saludar(){
        console.log(
            "Hola soy "+personaMap.get(this).nombre+" tengo "+personaMap.get(this).edad+" años y mi cel es "+this.cel
        )
    }
}
let obj = new Hombre("perro", 2)
    obj.setCel = 32  //asignamos valor
    obj.saludar(); //llamamos el metodo de la clase
    obj.cel = 333;
    console.log(obj.cel)
