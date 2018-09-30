<?php
session_start();

require_once(__DIR__ . '/config/config.inc.php');
require_once(__DIR__ . '/config/pages.inc.php');

//Minimize HTML Code
if(!$config['debug']){
function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

ob_start("sanitize_output");
}

$pageRequest = 'home';

if(isset($_GET['page'])){
  $pageRequest = strtolower($_GET['page']);
}

if(isset($pages[$pageRequest])){
  $pageName = $pages[$pageRequest]['pageName'];
  require_once(__DIR__ . '/includes/header.inc.php');
  require_once(__DIR__ . '/'. $pages[$pageRequest]['pageFile']);
  require_once(__DIR__ . '/includes/footer.inc.php');
} else {
  $pageName = "Fehler: 404: nicht gefunden";
  http_response_code(404);
  require_once(__DIR__ . '/includes/header.inc.php');
  echo('<h1 class="display-3">Fehler: 404: nicht gefunden</h1>');
  require_once(__DIR__ . '/includes/footer.inc.php');
}
?>
