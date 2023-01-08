function init(){
    // mostrarNuevo(false);
    listar();

    $("#formulario").on("submit",function(e)
    {
        guardaryeditar(e);  
    })
}


const getPlatos = async () =>{
    const response = await fetch('../controller/plato.php?op=listar');
    return response.json();
}

function listar(){
    tabla=$('#platosTable').dataTable(
    {
        "aProcessing": true,
        "aServerSide": true,
        "dom": 'Bfrtip',
        "ajax":
                {
                    url: '../controller/plato.php?op=listar',
                    type : "get",
                    dataType : "json",                      
                    error: function(e){
                        console.log(e.responseText);    
                    }
                },
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]]
    }).DataTable();
}

init();