<?php var_dump($this); ?>

<!DOCTYPE html>
<html lang="es-AR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->getViewModel()->title; ?></title>

        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="/public/css/bootstrap.min.css">
        
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript" src="/public/js/jquery-2.1.3.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <section id="header">
                <nav class="navbar navbar-inverse" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <!-- Boton para colapsar el menu -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- Logo de Apuntec -->
                            <a class="navbar-brand" href="index.php">Miali</a>
                        </div>
                        <div id="navbar-collapse-1" class="collapse navbar-collapse">
                            <!-- Items para navegas entre los paginas -->
                            <ul class="nav navbar-nav">
                            <?php foreach($this->getViewModel()->getNavegation() as $key => $value): ?>
                                <li>
                                    <a href="<?php echo $value; ?>"><?php echo $key; ?></a>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                            <!-- Para entrar al perfil -->
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="<?php echo \piola\mvc\ActionLink::create("usuario", "index", array("id" => 1)); ?>">
                                        <span class="glyphicon glyphicon-user"></span> NombreUsuario
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="index.php?do=/web/help">
                                                <span class="glyphicon glyphicon-book"></span> Ayuda
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.php?do=/web/contact">
                                                <span class="glyphicon glyphicon-envelope"></span> Contacto
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="index.php?do=/user/logout">
                                                <span class="glyphicon glyphicon-off"></span> Salir
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </section>
            <section id="main">
                <?php $this->getViewModel()->content; ?>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="/public/js/bootstrap.min.js"></script>
            </section>
        </div>
        <div class="footer hidden-print">
            <div class="container">
                <p class="text-center text-muted"><?php $this->getViewModel()->copyright; ?></p>
            </div>
        </div>
    </body>
</html>