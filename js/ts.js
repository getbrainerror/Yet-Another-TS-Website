$(document).ready(function () {
    checkStatus();
    checkGroupList();
    $('[data-toggle="tooltip"]').tooltip();

    var intervalid = setInterval(function () {
        checkStatus();
        checkGroupList();
    }, 30 * 1000);
});
function checkStatus() {
    $.ajax({
        url: "api/status.php",
        success: function (json) {
            console.log(json);
            if (json.data && json.success) {
                var clientsonline = json.data.clientsonline;
                var maxclients = json.data.maxclients;
                var clientsprecent = Math.round(json.data.clientsonline * 100 / json.data.maxclients);
                var version = json.data.version;
                var platform = json.data.platform;
                var uptime = json.data.uptime;
                var averagePacketloss = Math.round(json.data.averagePacketloss * 100) / 100;
                var averagePing = Math.round(json.data.averagePing * 100) / 100;

                var allOnlineUsers = "";
                json.data.onlineUsers.forEach(function(i, idx, array){
                   if (idx === array.length - 1){
                     allOnlineUsers = allOnlineUsers + i;
                   } else {
                     allOnlineUsers = allOnlineUsers + i +", ";
                   }
                });
                showServerInfo(clientsonline, maxclients, clientsprecent, uptime, averagePing, averagePacketloss, version, allOnlineUsers);

              } else {
                if(json.message){
                  displayErrorServerInfo(json.message);
                } else {
                  displayErrorServerInfo("Server is Offline");
                }
            }
            fillServerInfoGenerated(json.generated);


        },
        error: function (result) {
          displayErrorServerInfo(json.message);
        }
    })

}
function showServerInfo(clientsonline, maxclients, clientsprecent, uptime, averagePing, averagePacketloss, version, allOnlineUsers){
  hideServerInfoSpinner();
  $('#serverstatus').removeAttr('hidden');
  $('#serverstatus-error').attr('hidden', 'hidden');

  $('#status-online-users').html(clientsonline + ' / ' + maxclients + ' (' + clientsprecent + '%)');
  $('#status-uptime').html(uptime);
  $('#status-ping').html(averagePing + 'ms');
  $('#status-packet-loss').html(averagePacketloss + ' %');
  $('#status-version').html(version);
  $('#status-all-users').tooltip('hide')
  $('#status-all-users').attr('data-original-title', allOnlineUsers);
}

function fillServerInfoGenerated(resultStatusGenerated){
  if(resultStatusGenerated){
    resultStatusGenerated = 'Zuletzt aktuallisiert: ' + resultStatusGenerated;

  } else {
    resultStatusGenerated = 'Error';

  }
  $('#status-last-refresh').tooltip('hide')
            .attr('data-original-title', resultStatusGenerated);
}

function showServerInfoSpinner(){
  $('#serverstatus-spinner').removeAttr('hidden');
}

function hideServerInfoSpinner(){
  $('#serverstatus-spinner').prop('hidden', 'hidden');
}

function displayErrorServerInfo(message) {
  showServerInfoSpinner();
  $('#serverstatus').attr('hidden', 'hidden');
  $('#serverstatus-error').removeAttr('hidden');
  $('#serverstatus-error').html('<p><i class="fas fa-2x fa-fw fa-exclamation-triangle "></i></p><p class="pull-right">' + message + '</p>');
}

function checkGroupList() {
    $.ajax({
        url: "api/grouplist.php",
        success: function (json) {
            hideGrouplistSpinner();
            showGrouplist();
            console.log(json);
            if (json.data && json.success) {
              var result = '';


                json.data.forEach(function(group) {
                  result += '<h5 class="mt-3"><img src="' + group['groupIcon'] + '" alt="" /> ' + group['groupName'] + '</h5><hr />';
                  result += '<ul class="list-group mb-4">';
                  group.users.forEach(function(user) {
                    if(user.isOnline){
                      if(user.isAfk){
                        result += '<li class="list-group-item d-flex justify-content-between align-items-center" data-toggle="tooltip" data-placement="top" data-html="true" title="Online seit ' + user['onlineTime'] + '<br />AFK seit ' + user['afkTime'] + '"><span><i class="fas fa-fw fa-circle text-success"></i> ' + user['nickname'] + '</span><span class="badge badge-pill badge-secondary">AFK</span></li>';

                      } else {
                        result += '<li class="list-group-item d-flex justify-content-between align-items-center" data-toggle="tooltip" data-placement="top" title="Online seit  ' + user['onlineTime'] + '"><span><i class="fas fa-fw fa-circle text-success"></i> ' + user['nickname'] + '</span><span class="badge badge-success">Online</span></li>';
                      }
                    } else {
                      result += '<li class="list-group-item d-flex justify-content-between align-items-center" data-toggle="tooltip" data-placement="top"><span><i class="far fa-fw fa-circle text-muted"></i> ' + user['nickname'] + '</span><span class="badge badge-danger">Offline</span></li>';
                    }




                    console.log(group['groupName'] + ": " + user['nickname'] + " -> " + user['isOnline']);


                  });
                  result += '</ul>';
                });
                $('#grouplist').html(result);
                $('[data-toggle="tooltip"]').tooltip();
              } else {
                if(json.message){
                  displayErrorGrouplist(json.message);
                } else {
                  displayErrorGrouplist("Server is Offline");
                }
            }



        },
        error: function (result) {
          displayErrorGrouplist(json.message);
        }
    })

}

function showGrouplistSpinner(){
    $('#grouplist-spinner').removeAttr('hidden');
}

function hideGrouplistSpinner(){
    $('#grouplist-spinner').prop('hidden', 'hidden');
}

function displayErrorGrouplist(message) {
  showGrouplistSpinner();
  $('#grouplist').attr('hidden', 'hidden');
  $('#grouplist-error').removeAttr('hidden');
  $('#grouplist-error').html('<p><i class="fas fa-2x fa-fw fa-exclamation-triangle "></i></p><p class="pull-right">' + message + '</p>');
}

function showGrouplist(){
  hideServerInfoSpinner();
  $('#grouplist').removeAttr('hidden');
  $('#grouplist-error').attr('hidden', 'hidden');

}
