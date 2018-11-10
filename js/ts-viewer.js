function hideEmptyChannel() {
  $(document).ready(function() {
      $('.empty-channel').attr('hidden', 'hidden');
      $("#server-viewer-emptytoggle").attr("onclick","showEmptyChannel()");
      $("#server-viewer-emptytoggle").attr("data-original-title","Leere Channel einblenden");
      $("#server-viewer-emptytoggle").tooltip('hide');
      $("#server-viewer-emptytoggle").html('<i class="fas fa-eye-slash"></i>');
  });
}

$('#serverstatus');
function showEmptyChannel() {
  $(document).ready(function() {
      $('.empty-channel').removeAttr('hidden');
      $("#server-viewer-emptytoggle").attr("onclick","hideEmptyChannel()");
      $("#server-viewer-emptytoggle").attr("data-original-title","Leere Channel ausblenden");
      $("#server-viewer-emptytoggle").tooltip('hide');
      $("#server-viewer-emptytoggle").html('<i class="fas fa-eye"></i>');
  });
}
