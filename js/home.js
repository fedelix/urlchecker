$(document).ready(function() {
    listUrl();

    $("#cadastrar").on('click', function(e) {
        e.preventDefault();
        if ($("#url").val() == '') {
            toastr.error('Por favor preencha o campo para cadastrar uma URL', 'Erro!')
        } else {
            if (!isValidURL($("#url").val())) {
                toastr.error('Por favor preencha uma URL válida.', 'Erro!')
            } else {
                var dados = {
                    url: $("#url").val()
                }
    
                $.ajax({
                    url: "cadastrar.php",
                    type: "POST",
                    data: dados,
                    dataType: "JSON",
                    success: function (r) {
                        if (r.code == 0) {
                            toastr.error(r.message, 'Erro!');
                        } else {
                            listUrl();
                            toastr.success(r.message, 'Sucesso!');
                        }
                        $("#url").val("");
                    }
                });
            }
        }
    });
});

setInterval(listUrl, 60000);

function isValidURL(string) {
    var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    return (res !== null);
};

function listUrl() {
    $("#listaUrls").html("");
    $.get("listar.php", function(data, status) {
        if (data.length == 0) {
            $("#listaUrls").html("<tr><td colspan='5'>Nenhuma Url cadastrada.</td></tr>");
        } else {
            for(let i = 0; data.length > i; i++ ) {
                
                $("#listaUrls").append( "<tr><td>"+data[i].id+"</td>"
                    +"<td>"+data[i].url+"</td>"
                    +"<td>"+data[i].data+"</td>"
                    +"<td>"+data[i].timestamp+"</td>"
                    +"<td>"+data[i].statuscode+"</td></tr>" );

            }
        }
    });
}