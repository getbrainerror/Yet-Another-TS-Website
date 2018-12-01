<?php
if(isset($_GET['action'])){
  session_start();
  require_once(__DIR__ . "/config/config.inc.php");
  require_once(__DIR__ . "/includes/tsutils.inc.php");
  switch ($_GET['action']) {
    case 'tsident':
      $tsAdmin = getTeamspeakConnection();
      foreach ($tsAdmin->clientList() as $client) {
        if($client['client_nickname'] == $_GET['nickname'] && str_replace(array('[', ']'), array(''), $client['connection_client_ip']) == str_replace(array('[', ']'), array(''), getRealIpAddr())){
          $code = '';
          if(isset($_SESSION['last-code-generation'])) {
            if(time() - $_SESSION['last-code-generation'] < 15){
              die('ERROR: Yeet come down, youre to fast');
            }
          }
          $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
          for ($i = 0; $i < 10; $i++) {
            $rand = mt_rand(0, count($characters) - 1);
            $code .= $characters[$rand];
          }

          $client->poke('Dein Bestätigunscode lautet: ' . $code);
          $_SESSION['last-code-generation'] = time();
          $_SESSION['code'] = $code;
          $_SESSION['tsident'] = $client['client_unique_identifier']->__toString();
          $_SESSION['tsident-verified'] = false;
          die("OK");
        }
      }
      die("Fehler: IP/Nickname stimmen nicht überein");
      break;
    case 'verify':
      if(
        isset($_GET['code']) &&
        isset($_SESSION['code']) &&
        isset($_SESSION['tsident-verified']) &&
        isset($_SESSION['tsident'])
      ) {
        if($_GET['code'] == $_SESSION['code']){
          $_SESSION['tsident-verified'] = true;
          unset($_SESSION['last-code-generation']);
          unset($_SESSION['code']);
          header('Location: .?page=group-assigner');
          die('OK');
        }
      }
      break;
    case 'build-cache':
      require_once(__DIR__ . '/config/config.inc.php');
      require_once(__DIR__ . '/includes/tsutils.inc.php');
      require_once(__DIR__ . '/lib/simplephpcache/cache.class.php');

      //date_default_timezone_set($config["general"]["timezone"]);
      $c = new Cache(array(
        'name'      => 'group-assigner',
        'path'      => __DIR__ . '/cache/',
        'extension' => '.cache'
      ));
      $c->eraseAll();
      $tsAdmin = getTeamspeakConnection();
      $groupList = array();
      foreach ($config['groupAssigner'] as $groupSourceData) {
        $group = $tsAdmin->serverGroupGetById($groupSourceData[0]);
        $icon = getGroupIcon($tsAdmin, $group);
        $name = $group->__toString();
        $level = $groupSourceData[1];
        $groupList[] = array(
          'name' => $name,
          'icon' => $icon,
          'level' => $level,
        );
      }
      $c->store('groups', $groupList);
      die('OK');
      break;

    case 'destroy':
      unset($_SESSION['code']);
      unset($_SESSION['tsident-verified']);
      unset($_SESSION['tsident']);
      unset($_SESSION['last-code-generation']);
      die('OK');
      break;
    default:
      header('Location: .?page=group-assigner');
      break;
  }



} else {
  header('Location: .?page=group-assigner');
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getGroupIcon($tsAdmin, $group) {
      $localIcons = array(100, 200, 300, 400, 500, 600);
      $icon = '';
      if ($group["iconid"]) {
        if (!$group->iconIsLocal("iconid")) {
          try {
              $groupicon = $group->iconDownload();
          } catch (TeamSpeak3_Exception $e) {
              $groupicon = false;
          }

          if ($groupicon) {
            $icon = 'data:image/' . TeamSpeak3_Helper_Convert::imageMimeType($groupicon) . ';base64,' . base64_encode($groupicon);
          }
        } elseif (in_array($group["iconid"], $localIcons)) {
          $iconPath = __DIR__ . '/img/ts3/viewer/group_icon_' . $group["iconid"] . '.png';
          $iconType = pathinfo($iconPath, PATHINFO_EXTENSION);
          $iconData = file_get_contents($iconPath);
          $icon = 'data:image/' . $iconType . ';base64,' . base64_encode($iconData);
        }
      }
      return $icon;
}

?>
