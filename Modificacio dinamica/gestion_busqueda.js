$(document).ready(function(){
    $("#barra_busqueda").keyup(buscar);
    $("#barra_busqueda").keyup(sumar);
    $("#submit").click(input);


});



//////BUSCADOR DINAMICO
function buscar(){
    var textoBusqueda = $("#barra_busqueda").val();

    $.ajax({
        type: "POST",
        url: "/UF4/Modificacio dinamica/busqueda.php",
        data: {
            'texto' : textoBusqueda,
        dataType:"JSON",
        } ,
        success: function(data){
            // var tabla = "<table>";
            var cont = 0;
            for(var i = 1; i <= Object.keys(data).length; i++){
                document.getElementById('browsers').options[cont].value = data[cont];
                // tabla += "<tr><td>"+data[cont]+"</td></tr>";
                cont++;
            }  
            // tabla += "</table>";
            // $("#resultados_busqueda").html(tabla);
        }
    }); 
}

function sumar(){
    var textoBusqueda = $("#barra_busqueda").val();

    $.ajax({
        type: "POST",
        url: "/UF4/Modificacio dinamica/sumar.php",
        data: {
            'texto' : textoBusqueda,
        dataType:"JSON",
        } ,
        success: function(data){
            console.log(data);
        }
    }); 
}

function input(){
    var textoBusqueda = $("#barra_busqueda").val();

    $.ajax({
        type: "POST",
        url: "/UF4/Modificacio dinamica/busqueda.php",
        data: {
            'submit' : textoBusqueda,
        dataType:"JSON",
        } ,
        success: function(data){
            var tabla = "<link><div class='dropdown'>";
            tabla += "<table cellpadding=5 width=270>";
            tabla += "<tr class='trdesplegable'>";
            tabla += "<th class='desplegable'>Id</th>";
            tabla += "<th class='desplegable'>Paraula</th>";
            tabla += "<th class='desplegable'>Total</th>";
            tabla += "<th class='desplegable'>Ultima visita</th></tr>";
            var cont = 0;
            for(var i = 0; i < Object.keys(data).length; i++){
                tabla += "<tr><td>"+data[cont++]+"</td><td>"+data[cont++]+"</td><td>"+data[cont++]+"</td><td>"+data[cont++]+"</td></tr>";
                i = i + 3;
            }  
            tabla += "</table>";
            $("#resultados_busqueda").html(tabla);
            console.log(Object.keys(data).length);
        }
    }); }

// function ocultar_resultados(){
//     console.log("oculta");
//     refresh = setInterval(function(){
//         $("#resultados_busqueda").hide();
//     }, 100);
// }

// function ver_resultados(){
//     console.log("neseña");
//     clearInterval(refresh);
//     $("#resultados_busqueda").show();
// }