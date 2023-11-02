<link href="http://<?php echo APP_HOST; ?>/public/css/style.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg bg-verde" data-bs-theme="dark">
    <div class="container-fluid">
    <img src="http://<?= APP_HOST ?>/public/images/logo.png" style="width: 45px;" alt="logo">
        <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>" >&nbsp;FarmaTech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item <?php if($viewVar['nameController'] == "HomeController") { ?> active <?php } ?>">
                    <a class="nav-link" href="http://<?php echo APP_HOST; ?>" >
                        <span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                    </a>
                </li>
                <li class="nav-item <?php if($viewVar['nameController'] == "ProdutoController") { ?> active <?php } ?>">
                    <a class="nav-link" href="http://<?php echo APP_HOST; ?>/produto/produtos">
                        <span class="glyphicon glyphicon-th-list"></span>&nbsp;Produtos
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]){ ?>
                    <li <?php if($viewVar['nameController'] == "LoginController") { ?> class="active" <?php } ?>>
                        <a class="nav-link" href="http://<?= APP_HOST ?>/login">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"></path>
                        </svg>Login</a>
                        </li>
                <?php } else { ?>
                    <div class="btn-group">
                        <li class="nav-item dropdown">
                            <button type="button" class="btn btn-primary navbar-btn dropdown-toggle" data-toggle="dropdown">
                                &nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;<?= htmlspecialchars($_SESSION["username"]) ?>&nbsp;
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">  
                                <li><a class="dropdown-item" href="http://<?= APP_HOST.'/login/dashboard' ?>">Dashboard</a></li>
                                <li><a class="dropdown-item" href="http://<?= APP_HOST ?>/usuario">Usuários</a></li>                
                                <li><a class="dropdown-item" href="http://<?= APP_HOST ?>/produto">Produtos</a></li>             
                                <li><a class="dropdown-item" href="http://<?= APP_HOST ?>/cliente">Clientes</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="http://<?= APP_HOST.'/login/logout' ?>">
                                    <span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a>
                                </li>
                            </ul>
                        </li>
                    </div>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
