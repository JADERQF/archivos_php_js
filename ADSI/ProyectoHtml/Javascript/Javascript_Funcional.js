/* Array filter
Método que se encuentra dentro de los arreglos de Js, y nos regresa un arreglo de 
igual o menor tamaño al arrefglo inicial
*/

const num = [1,2,3,4,5,6,7,8]
const numfiltrados = num.filter(x => x<5); //filtra los numeros menores a 5.
console.log(numfiltrados);

const mascotas = [
    {nombre: 'Terry', edad:"5", tipo:'perro'},  
    {nombre: 'Tom', edad:"12", tipo:'perro'},  
    {nombre: 'Bufa', edad:"2", tipo:'gato'},
    {nombre: 'Thorin', edad:"4", tipo:'perro'},
];

const perros = mascotas.filter(x => x.tipo=='perro') // Nos retorna un array con los elemento tipo perro
console.log(perros);

/* Arrat map
Toma un arreglo de una cantidad determinada y nos devuelve otro arreglo de la misma longitud, con la 
diferencia que los elementos se cambian dependiendo de las funciones aplicadas a los elementos.
*/
const suma = (nnn) => {
    let acumulado=0;
    for (i = 0; i<nnn.length; i++)
    {
        acumulado += +nnn[i];
    }
    return acumulado;
}
const multiNum = num.map(x => x*2) //regresa un array con los num*2;
console.log(multiNum)
const edades = mascotas.map(x => x.edad) // Nos retorna un array con las edades del array mascotas.
const resultado = suma(edades)  // Suma las edades del arreglo edades.
console.log(resultado/edades.length)


/* Array reduce
Método que contienen los arrays de Js, nos permiten ejecutar funciones reducer, exacto, como se llaman
en Redux ---> funciones reducer.

reduce(reducer, inicial) // reducer---> funcion reducer, inicial --> valor inicial del iterador.
Reciben 2 argumentos:
1) Valor acumulado.
2) Elemento que esta iterando el arreglo.

funcion reducer
//const reducer = (acumulador, valorActual) => nuevoAcumulador
*/

const indexed = mascotas.reduce(( acc,el ) => ({ //acc = acumulador, el = iterador

    ...acc, //realiza una copia de mascota
    [el.nombre]: el, //indexed los datos del elemento.
    }), {})  //inicia en un arreglo vacío.

console.log(indexed['Terry']); //llamamos la función.

const anidado = [1, [2,3], 4, [5]]
const arrayplano = anidado.reduce((acc,el)=> acc.concat(el), [])
console.log(arrayplano)

// Closures -> forma de comoposición -> Combinación de una función y el alcance lexico que tiene una función.
// Los Clousures permiten generalizar y construir más rápido las apps.

const x = 'Jader'

const f = () => { //la función puede ingresar a varialbles fuera de ella.
    const y = 'José'
    console.log(x,y);
}
f();

require('isomorphic-fetch') ; //importa búsqueda isomorfica.
// Crear una función que me permita recibir el dominio al cual yo quiero
// ir a realizar consultas a través de una API y a la vez reciba la ruta a la cual yo quiero consumir estos recursos.  
const crudder = dominio => recursos =>{
    const url = `${dominio}/${recursos}`

    return(//devuelve un objeto
        {
            create: (x) => fetch(url, {
                method: 'POST',
                body: JSON.stringify(x),
            }).then(x => x.json()),
            get: () => fetch(url).then(x => x.json)

        }

    )
}

const Base = crudder("https://jsonplaceholder.typicode.com")//Le pasamos eo dominio.
const Todos = Base("todos")//Pasamos el recursos a consummir.
const Users = Base("users")

//Users.get().then(x => console.log(x[0]))
Todos.get().then(x => console.log(x[0]))

