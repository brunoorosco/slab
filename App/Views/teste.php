<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
<div class="container-fluid">
    <div class="row py-3">
        <div class="col-lg-3 col-sm-3 mr-auto" id="sticky-sidebar">
            <div class="sticky-top">
                <div class="barra" style="padding-top: 100px">
                  <ul class="nav flex-column">
                    <li class="nav-item" >
                      <a id="cor" class="nav-link" href="#">Cadastro de Clientes</a>
                    </li>
                    <li class="nav-item" style="margin-top:-15px" >
                      <a id="cor" class="nav-link" href="#">Listar Clientes</a>
                    </li>
                    <li class="nav-item" style="margin-top:-15px">
                      <a id="cor" class="nav-link" href="#">Editar Clientes</a>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-sm-8 ml-auto" id="main">
           <div class="conteudo">
              <h2>Toggleable Tabs</h2>
              <br>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
                </li>
              </ul>
        </div>
    </div>
</div>
  
  </div>
</div>

</body>
</html>