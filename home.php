<?php
session_start();

if (!$_SESSION["loggedin"]) {
    header("location: index.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="js/plugins/toastr.min.css">
    <title>URL Checker</title>
  </head>
  <body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body text-center">
                            <form action="cadastro.php" method="POST">
                            Cadastro de Urls
                            <div class="form-outline mb-4">
                                <input type="text" name="url" id="url" placeholder="http://www.google.com.br" class="form-control form-control-lg">
                            </div>
                            <button id="cadastrar" class="btn btn-primary btn-lg btn-block">Cadastrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center" style="padding-top: 50px;">
                <div class="col-12">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body text-center" style="color: #333333">
                            <table border="0" class="table table-striped" style="width:100%;margin-top:20px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Url</th>
                                        <th>Data</th>
                                        <th>Timestamp</th>
                                        <th>Status Code</th>
                                    <tr>
                                </thead>
                                <tbody id="listaUrls"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="js/plugins/toastr.min.js"></script>
    <script src="js/home.js"></script>
  </body>
</html>