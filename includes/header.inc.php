<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Just the description">
    <meta name="author" content="getBrainError@github.io">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $config['siteName'] . " - " . $pageName; ?></title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <?php
      //Custom CSS from Config
      if(isset($config['customCSS']) && !empty($config['customCSS'])){
        echo($config['customCSS']);
      }
     ?>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- TeamSpeak Custom Style -->
    <link href="css/main.css" rel="stylesheet">
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <a class="navbar-brand" href="?page=home"><?php echo($config['navbarIcon'] . ' ' . $config['siteName']); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if($pageRequest == 'home'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=home"><i class="fas fa-fw fa-home"></i> Startseite<?php if($pageRequest == 'home'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                <li class="nav-item <?php if($pageRequest == 'server-viewer'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=server-viewer"><i class="fas fa-fw fa-list-ul"></i> Server Viewer<?php if($pageRequest == 'server-viewer'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                <li class="nav-item <?php if($pageRequest == 'rules'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=rules"><i class="fas fa-fw fa-gavel"></i> Regeln<?php if($pageRequest == 'rules'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                <!--
                <li class="nav-item <?php if($pageRequest == 'banner'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=banner"><i class="fas fa-fw fa-image"></i> Banner<?php if($pageRequest == 'banner'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                -->
                <li class="nav-item <?php if($pageRequest == 'group-assigner'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=group-assigner"><i class="fas fa-fw fa-bolt"></i> Gruppenzuweiser<?php if($pageRequest == 'group-assigner'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
              </ul>

              <ul class="navbar-nav ml-auto">

                <?php
                  if(!isset($_SESSION['userid'])) {
                ?>
                <li class="nav-item pull-right <?php if($pageRequest == 'login'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=login"><i class="fas fa-fw fa-sign-in-alt"></i> Login<?php if($pageRequest == 'login'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                <li class="nav-item pull-right <?php if($pageRequest == 'register'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=register"><i class="fas fa-fw fa-user-plus"></i> Registrieren<?php if($pageRequest == 'register'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                <?php
                } else {
                ?>
                <li class="nav-item dropdown active">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    Eingeloggt als <?php echo($_SESSION['nickname']); ?>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="?page=dashboard"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="dropdown-divider" style="list-style: none; list-style-type:none;"></li>
                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-fw fa-sign-out-alt"></i> Ausloggen</a></li>
                  </ul>
                </li>
                <?php
                }
                ?>
              </ul>
        </div>
      </nav>
    </header>
    <?php if(isset($_GET['logged-out'])){ ?>
      <div class="alert alert-primary" role="alert">
        Du wurdest ausgeloggt!
      </div>
    <?php } ?>

    <main role="main" class="container">
