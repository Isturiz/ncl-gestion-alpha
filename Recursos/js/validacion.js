function soloLetras(e){
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
  especiales = "8-37-39-46";
  tecla_especial = false
  for(var i in especiales){
    if(key == especiales[i]){
      tecla_especial = true;
       break;
     }
  }
  if(letras.indexOf(tecla)==-1 && !tecla_especial){
       return false;
  }
}


function ConfirmarEliminar(){
  var respuesta= confirm("¿Seguro que desea eliminar el registro?");
  if (respuesta==true) return true;
  else return false;
}

function select_marca()
{ 

 var ID_marca = $("#marcas").val();
    var ob = {ID_marca:ID_marca};
     $.ajax({
                type: "POST",
                url:"../../Controladores/Modelo/cargar_modelo.php",
                data: ob,
                beforeSend: function(objeto){
                },
                success: function(data)
                { 
                 
                 $("#tablaModelos").html(data);
            
                }
             });
}  
function asignar_modelo(nombre, id)
{
  $("#id_mode").val(id);
  $("#modelo").val(nombre);
}    

function select_cliente()
{ 

 var ID_cliente = $("#cliente").val();
    var ob = {ID_cliente:ID_cliente};
     $.ajax({
                type: "POST",
                url:"../../Controladores/Auto/cargar_auto.php",
                data: ob,
                beforeSend: function(objeto){
                },
                success: function(data)
                { 
                 
                 $("#tablaClientes").html(data);
            
                }
             });
}  
function asignar_auto(nombre, id)
{
  $("#id_auto").val(id);
  $("#auto").val("Placa "+nombre);
}    

function validar_factura(){
  var auto= $("#id_auto").val();
  var fecha= $("#fecha").val();
  var total= $("#subTotal").val();
  if (auto=="" || fecha=="" || total=="")
  { alert("Debe llenar todos los campos"); }
  else{  $("#form").submit(); }
}
