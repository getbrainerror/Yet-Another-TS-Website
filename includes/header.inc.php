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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- TeamSpeak Custom Style -->
    <link href="css/main.css" rel="stylesheet">
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <a class="navbar-brand" href="?page=home"><i class="fab fa-teamspeak"></i> TeamSpeak Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if($pageRequest == 'home'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=home"><i class="fas fa-fw fa-home"></i> Startseite<?php if($pageRequest == 'home'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                <li class="nav-item <?php if($pageRequest == 'serverbrowser'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=serverbrowser"><i class="fas fa-fw fa-list-ul"></i> Serverbrowser<?php if($pageRequest == 'serverbrowser'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                <li class="nav-item <?php if($pageRequest == 'rules'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=rules"><i class="fas fa-fw fa-gavel"></i> Regeln<?php if($pageRequest == 'rules'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                <li class="nav-item <?php if($pageRequest == 'banner'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=banner"><i class="fas fa-fw fa-image"></i> Banner<?php if($pageRequest == 'banner'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
                <li class="nav-item <?php if($pageRequest == 'group-assigner'){?>active<?php } ?>">
                  <a class="nav-link" href="?page=group-assigner"><i class="fas fa-fw fa-bolt"></i> Gruppenzuweiser<?php if($pageRequest == 'group-assigner'){?> <span class="sr-only">(aktuell Ausgewählt)</span><?php } ?></a>
                </li>
              </ul>
        </div>
      </nav>
    </header>

    <main role="main" class="container">
