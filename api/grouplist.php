<?php
// error_reporting(0);
header('Content-Type: application/json');
set_error_handler("exception_error_handler", E_ALL);

require_once(__DIR__ . "/../config/config.inc.php");
require_once(__DIR__ . "/../includes/tsutils.inc.php");
require_once(__DIR__ . '/../lib/simplephpcache/cache.class.php');

//date_default_timezone_set($config["general"]["timezone"]);
$c = new Cache(array(
  'name'      => 'serverstatus',
  'path'      => __DIR__ . '/../cache/',
  'extension' => '.cache'
));


$c->eraseExpired();
if(!$c->isCached('serverGroupList')) {
    $c->store('serverGroupList',getResult(), $config['expireTime']);
}
die ($c->retrieve('serverGroupList'));

// *********
//  METHODS
// *********
function getResult() {
    try {
        $start = microtime(true);
        $groupList = getGroupList();
        $stop = microtime(true);
        return json_encode(array(
            "success" => true,
            "data" => $groupList,
            "generated" => date('d-m-Y H:i:s'),
            "timeRequired" => $stop - $start
        ));
    } catch (Exception $e) {
        scriptFail($e);
    }
}
function scriptFail($error) {
    die(json_encode(array(
        "success" => false,
        "id" => "script_error",
        "message" => "There has been an error while retrieving the server status",
        "error" => $error
    )));
}

function serverIsOffline(){
  die(json_encode(array(
      "success" => false,
      "id" => "script_error",
      "message" => "Server is Offline",
  )));
}
function exception_error_handler($errno, $errstr, $errfile, $errline) {
    scriptFail("[$errfile @ $errline] " . $errstr);
}

function getGroupList() {
    global $config;
    $grouplist = $config["listedUserGroups"];
    $localIcons = array(100, 200, 300, 400, 500, 600);

        $tsAdmin = getTeamspeakConnection();
        if ($tsAdmin->isOffline()){
              serverIsOffline();
        }
        $return = Array();

        foreach ($grouplist as $group) {
            $groupNode = Array();

            if (!array_key_exists((string)$group, $tsAdmin->serverGroupList()))
                continue;

            $group = $tsAdmin->serverGroupGetById($group);

            $icon = '';
            if ($group["iconid"]) {
              if (!$group->iconIsLocal("iconid")) {
                $groupicon = getGroupIcon($tsAdmin, $group);
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

            $groupNode['groupName'] = $group->__toString ();
            $groupNode['groupIcon'] = $icon;
            $groupNode['users'] = Array();

            $clients = $group->clientList();
            if (empty($clients)) {
                continue;
            }

            foreach ($clients as $userInfo) {
                $user = getClientByDbid($tsAdmin, $userInfo['cldbid']);
                if($user["client_type"]) continue;
                if (!$user) {
                    $userNode['nickname'] = htmlspecialchars($userInfo['client_nickname']->toString());
                    $userNode['isOnline'] = false;
                    $groupNode['users'][] = $userNode;
                    continue;
                }

                $userNode = Array();
                $userNode['nickname'] = htmlspecialchars($user);
                $userNode['isOnline'] = true;
                $userNode['onlineTime'] = TeamSpeak3_Helper_Convert::seconds(time() - $user['client_lastconnected'], false, "%dd %02dh %02dm");
                if($user['client_away']) {
                  $userNode['isAfk'] = true;
                  $userNode['afkTime'] = TeamSpeak3_Helper_Convert::seconds($user['client_idle_time'], true, "%dd %02dh %02dm");
                  $userNode['afkMessage'] = htmlspecialchars($user["client_away_message"]);
                }

                $groupNode['users'][] = $userNode;
                //$onlineClients[] = '<p><img src="lib/TeamSpeak3/images/viewer/' . $user->getIcon() . '.png" alt="User status">' . '<span class="label label-primary">' . htmlspecialchars($user) . '</span>' . ($user['client_away'] ? '<span class="label label-warning pull-right" ' . $userAwayTitle . '>' . $userAway . '</span>' : '<span class="label label-success pull-right">' . translate($lang["adminlist"]["status"]["online"]) . '</span>') . '</p>';
            }
            $return[] = $groupNode;
        }
        return $return;

}
function getClientByDbid($tsAdmin, $cldbid) {
    try {
        return $tsAdmin->clientGetByDbid($cldbid);
    } catch (TeamSpeak3_Exception $e) {
        return false;
    }
}
function getGroupIcon($tsAdmin, $group) {
    try {
        return $group->iconDownload();
    } catch (TeamSpeak3_Exception $e) {
        return false;
    }
}

?>
