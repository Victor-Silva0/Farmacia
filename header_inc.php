<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaX</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
      header { font-family: 'Montserrat', sans-serif;
      }
    </style>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<header>
  <nav class="navbar navbar-expand-lg bg-verde" data-bs-theme="dark">
    <div class="container-fluid">
      <img src="images/logo.png" style="width: 45px;" alt="logo">
    <a class="navbar-brand" href="index.php">&nbsp;PharmaX</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="estoque.php">Estoque</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              Área Administrativa
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="produto-list.php">Gerenciamento de Produtos</a></li>
              <li><a class="dropdown-item" href="venda-list.php">Gerenciamento de Vendas</a></li>
              <li><a class="dropdown-item" href="cliente-list.php">Gerenciamento de Clientes</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item d-flex align-items-center">
          <a class="nav-link" href="login.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"></path>
            </svg>
            <a class="nav-link" href="login.php">Login</a>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>





