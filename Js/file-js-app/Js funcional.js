//FAt arrow fuctions
function fn1(a,b){
    return a+b
}
r = fn1(5,6)
console.log(r) //rta: 11

const fn2 = (a,b) => a+b
resultado = fn2(3,5)
console.log(resultado) //rta: 8

const fn3 = (a,b) => {
    return (a+b)
}
r2 = fn3(4,2)
console.log(r2) //rta 6

//Object Destructuring
//cuando queremos algunas propiedades de un objeto.

const services = {
    api: {},
    mailer : 'soy mailer',
    apolo : {}
}

const enviarCorreo = ({mailer}) => {
    console.log(mailer)
    //código que envía correo
}

enviarCorreo(services)

//Array Spread Operator
//se quiere separar los elementos de un arreglo

const arr = [1,2]

const suma = (a,b) => a+b


const arr1 = [...arr]

arr.push(3)
console.log(arr1,arr) //rta [1,2], [1,2,3]

//Object Spread Operator

const obj = {
    a: 1,
    b : 2
}
const obj1 ={
    data:{
        ...obj
    }
}
obj1['data']['c'] = '3',

console.log(obj, obj1)