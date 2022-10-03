    let users = {
        nombre : "Perro con perro",
        correo : "jjyatusabes@cdp.com",
        edad : 20,
        tel : 32094330
    };

    document.getElementById("datos").innerHTML = users['edad'];

let texto = ' { "empleados" : [' + //Simulación de Json
            ' { "nombre" : "Esteban", "edad" : 23, "cel" : 3145678906 },' +
            ' { "nombre" : "Javier", "edad" : 33, "cel" : 4234674621 },' +
            ' { "nombre" : "Carlos", "edad" : 27, "cel" : 6533687532 }' +
            '] }';  

            // Lo pasamos a formato Json

            let obj = JSON.parse(texto);

            //Convertimos a String con stringify

            let obj1 = JSON.stringify(texto);

            document.getElementById('datos').innerHTML = obj1;
            console.log(obj)

           let json = {  //Forma correcta de usar el Json
                "empleados": [{
                        "nombre": "Esteban",
                        "edad": 23,
                        "cel": 3145678906
                    },
                    {
                        "nombre": "Javier",
                        "edad": 33,
                        "cel": 4234674621
                    },
                    {
                        "nombre": "Carlos",
                        "edad": 27,
                        "cel": 6533687532
                    }
                ]
            }