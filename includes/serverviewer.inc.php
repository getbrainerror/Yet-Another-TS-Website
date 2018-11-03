<?php
require_once(__DIR__ . '/tsutils.inc.php');
require_once(__DIR__ . '/../config/config.inc.php');
$tsAdmin = getTeamspeakConnection();


function generateServerViewer(){
  global $tsAdmin;
  $tsList = json_decode($tsAdmin->getViewer(new TeamSpeak3_Viewer_Json()));
  return generateTree($tsList);
}

function generateTree($datas, $parent = "ts3", $depth=0){
    global $config;
    $ni=count($datas);
    if($ni === 0 || $depth > 1000) return ''; // Make sure not to have an endless recursion
    $tree = '<ul>';
    for($i=0; $i < $ni; $i++){
        if($datas[$i]->parent == $parent){
            switch ($datas[$i]->class) {
              case 'server':
                $tree .= '<li class="server"><i class="fas fa-fw fa-server"></i> ';
                $tree .= htmlspecialchars($datas[$i]->name);
                $tree .= generateTree($datas, $datas[$i]->ident, $depth+1);
                $tree .= '</li>';
                break;

              case 'channel':
                if($datas[$i]->props->spacer == 'none'){
                } else {
                }

                switch ($datas[$i]->props->spacer) {
                  case 'none':
                    $tree .= '<li class="channel"><i class="fas fa-fw fa-hashtag"></i> ';
                    $tree .= htmlspecialchars($datas[$i]->name);
                    $tree .= generateTree($datas, $datas[$i]->ident, $depth+1);
                    $tree .= '</li>';
                    break;
                  case 'customrepeat':
                    if(!$config['serverViewer']['ignoreSpacer']){
                      $tree .= '<li class="spacer">';
                      $tree .= str_repeat(htmlspecialchars($datas[$i]->name), 30);
                      $tree .= generateTree($datas, $datas[$i]->ident, $depth+1);
                      $tree .= '</li>';

                    }
                    break;
                  default:
                    $tree .= '<li class="spacer">';
                    $tree .= htmlspecialchars($datas[$i]->name);
                    $tree .= generateTree($datas, $datas[$i]->ident, $depth+1);
                    $tree .= '</li>';
                    break;
                }
                break;

              case 'client':
                $tree .= '<li class="client"><i class="fas fa-fw fa-circle text-success"></i> ';
                $tree .= htmlspecialchars($datas[$i]->name);
                foreach ($datas[$i]->props->memberof as $group) {
                  if($group->icon > -0){
                    $groupicon = getGroupIconByName($group->name);
                    if($groupicon){
                      $tree .= '<img class="float-right" src="'. $groupicon . '" alt="' . $group->name . '" title="' . $group->name . '" data-toggle="tooltip" data-placement="top"/>';
                    }
                  }
                }
                $tree .= generateTree($datas, $datas[$i]->ident, $depth+1);
                $tree .= '</li>';
                break;
              default:
                $tree .= '<li>';
                $tree .= htmlspecialchars($datas[$i]->name);
                $tree .= generateTree($datas, $datas[$i]->ident, $depth+1);
                $tree .= '</li>';
                break;

            }
        }
    }
    $tree .= '</ul>';
    return $tree;
}

function getGroupIconByName($group) {
    global $tsAdmin;
    global $config;
    $group = $tsAdmin->serverGroupGetByName($group);
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
          $iconPath = __DIR__ . '/../img/ts3/viewer/group_icon_' . $group["iconid"] . '.png';
          $iconType = pathinfo($iconPath, PATHINFO_EXTENSION);
          $iconData = file_get_contents($iconPath);
          $icon = 'data:image/' . $iconType . ';base64,' . base64_encode($iconData);
        }
      }
      return $icon;

}

?>
