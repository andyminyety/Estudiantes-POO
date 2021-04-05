$(document).ready(function(){

   $(".btn-delete").on("click",function(){
    
    let Id = $(this).data("id");

    if(confirm("Estás seguro que deseas eliminar a este estudiante?")){

        if(Id !== null && Id !== undefined && Id !== "" ){
            window.location.href = "Estudiantes/Eliminar.php?id=" + Id;            
        }        
    } 
   });

});