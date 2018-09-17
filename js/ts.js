$(document).ready(function () {
    checkStatus();

    var intervalid = setInterval(function () {
        checkStatus();
    }, 30 * 1000);
});

function checkStatus() {

    $.ajax({
        url: apiurl,
        success: function (json) {
            console.log(json);
            var resultStatus = "";
            var resultStatusGenerated ="";
            if (json.data && json.data.success) {

                var clientsonline = json.data.clientsonline;
                var maxclients = json.data.maxclients;
                var clientsprecent = Math.round(json.data.clientsonline * 100 / json.data.maxclients);
                var version = json.data.version;
                var platform = json.data.platform;
                var uptime = json.data.uptime;
                var averagePacketloss = Math.round(json.data.averagePacketloss * 100) / 100;
                var averagePing = Math.round(json.data.averagePing * 100) / 100;
                $('#serverstatus').removeAttr('hidden');
                $('#serverstatus-error').attr('hidden', 'hidden');
                $('#status-online-users').html(clientsonline + ' / ' + maxclients + ' (' + clientsprecent + '%)');
                $('#status-uptime').html(uptime);
                $('#status-ping').html(averagePing + 'ms');
                $('#status-packet-loss').html(averagePacketloss + ' %');
                $('#status-version').html(version);

              } else {
                $('#serverstatus').attr('hidden', 'hidden');
                $('#serverstatus-error').removeAttr('hidden');
                $('#serverstatus-error').html('<i class="fas fa-fw fa-exclamation-triangle"></i> Error: ' + json.message);
            }
            if(json.generated){
              resultStatusGenerated = 'Zuletzt aktuallisiert: ' + json.generated;

            } else {
              resultStatusGenerated = 'Error';

            }

            $('#status-last-refresh').tooltip('hide')
                      .attr('data-original-title', resultStatusGenerated);
        },
        error: function (result) {
            $("#serverstatus").html('<p><i class="fa fa-power-off fa-fw" aria-hidden="true"></i> ' + statusOnline + ': <span class="label label-danger">ERROR</span></p>');
        }
    })
}
