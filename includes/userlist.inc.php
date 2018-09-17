<div class="card mb-4">
  <div class="card-header"><h5><i class="fas fa-fw fa-users"></i> Team <span class="float-right"data-toggle="tooltip" data-placement="top" title="Zuletzt aktuallisiert: 08-08-2018 19:13:56"><i class="fas fa-fw fa-info-circle"></i></span></h5></div>
    <div class="card-body">
      <p class="card-text">
        <?php if($tsServerInfo['success']) {?>
        <h5>Administrator</h5>
        <ul class="list-group mb-4">
          <li class="list-group-item d-flex justify-content-between align-items-center" data-toggle="tooltip" data-placement="top" title="Online seit 1d 4h 30m"><span><i class="fas fa-fw fa-circle text-success"></i> getBrainError </span></li>
        </ul>
        <h5>Moderator</h5>
        <ul class="list-group mb-4">
          <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-light"><span><i class="far fa-fw fa-circle"></i> prinzo_-53 </span></li>
          <li class="list-group-item d-flex justify-content-between align-items-center" data-toggle="tooltip" data-placement="top" data-html="true" title="Online seit 30m<br />AFK seit 10m"><span><i class="fas fa-fw fa-circle text-success"></i> Leon </span><span class="badge badge-pill badge-secondary">AFK</span></li>
        </ul>
        <h5>Supporter</h5>
        <ul class="list-group mb-4">
          <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-light"><span><i class="far fa-fw fa-circle"></i> Tony </span></li>
          <li class="list-group-item d-flex justify-content-between align-items-center"><span><i class="fas fa-fw fa-circle text-success"></i> Randi </span></li>
        </ul>
      <?php } else { ?>
        <div class="alert alert-danger" role="alert">
          <i class="fas fa-fw fa-exclamation-triangle"></i> Error: <?php echo($tsServerInfo['message']); ?></span>
        </div>
      <?php } ?>
      </p>
    </div>
</div>
