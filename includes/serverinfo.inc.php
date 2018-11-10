<div class="card mb-4">
  <div class="card-header"><h5><i class="fas fa-fw fa-server"></i> Server Status <span id="status-last-refresh" class="float-right" data-toggle="tooltip" data-placement="top" title="Zuletzt aktuallisiert:"><i class="fas fa-fw fa-info-circle"></i></span></h5></div>
    <div class="card-body">
      <p class="card-text">
        <ul class="list-group" id="serverstatus" hidden>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><i class="fas fa-fw fa-link"></i> Server Adresse: </span><span id="status-server-address"><a href="ts3server://<?php echo($config['teamspeak']['publicTeamspeakAdress'] . ':' . $config['teamspeak']['server_port']); ?>" class="badge badge-pill badge-primary"><?php echo($config['teamspeak']['publicTeamspeakAdress']); ?></a></span>
          </li>
          <li id="status-all-users" class="list-group-item d-flex justify-content-between align-items-center" data-html="true" data-toggle="tooltip" data-placement="top" title="">
            <span><i class="fas fa-fw fa-user"></i> Online: </span><span id="status-online-users" class="badge badge-pill badge-primary"></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><i class="fas fa-fw fa-chart-line"></i> Uptime: </span><span id="status-uptime" class="badge badge-pill badge-primary"></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><i class="fas fa-fw fa-signal"></i> Ping: </span><span id="status-ping" class="badge badge-pill badge-primary"></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><i class="fas fa-fw fa-dolly-flatbed"></i> Paketverlust: </span><span id="status-packet-loss" class="badge badge-pill badge-primary"></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><i class="fas fa-fw fa-code-branch"></i> Version: </span><span id="status-version" class="badge badge-pill badge-primary"></span>
          </li>
        </ul>
        <div id="serverstatus-spinner" class="alert center text-center mb-4">
          <i class="fas fa-fw fa-4x fa-spinner fa-spin"></i>
        </div>
        <div id="serverstatus-error" class="alert alert-danger text-center" role="alert" hidden>
          <i class="fas fa-2x fa-exclamation-triangle m"></i>
          <p>Error:</p>
        </div>

      </p>
    </div>
</div>
