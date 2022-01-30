$(document).ready(function() {
    $("#btn-login").on('click', function(e) {
        e.preventDefault();
        if ($("#user").val() == '' || $("#pass").val() == '') {
            $("#error").text("Preencha os campos abaixo.").show();
        } else {
            var dados = {
                user: $("#user").val(),
                pass: $("#pass").val()
            }

            $.ajax({
                url: "login.php",
                type: "POST",
                data: dados,
                dataType: "JSON",
                success: function (r) {
                    if (r.code == 0) {
                        $("#error").text(r.message).show();
                    } else {
                        location.href = 'home.php';
                    }
                }
            });
        }
    });
});