function cargar(){

    $(document).ready(function(){
        $.ajax({
            url: 'datos.txt',
            Type: 'POST',
            success : function(respuesta){
                document.getElementById('datos').innerHTML = respuesta;
            },
            error: function(){
                document.write('No sirvio esta petición');
            }
        });
    });
}


let btn = document.getElementById('cargar');
btn.addEventListener('click', cargar);
