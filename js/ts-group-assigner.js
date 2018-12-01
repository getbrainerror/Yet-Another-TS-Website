$(document).ready(function() {
  $("#tsident-nickname").submit(function(event){
    event.preventDefault(); //prevent default action
    var post_url = $(this).attr("action"); //get form action url
    var request_method = $(this).attr("method"); //get form GET/POST method
    var form_data = $(this).serialize(); //Encode form elements for submission

    $.ajax({
      url : post_url,
      type: request_method,
      data : form_data
    }).done(function(result){
      if(result == 'OK'){
          $('#tsident-nickname-wrapper').attr('hidden', 'hidden');
          $('#tsident-code-wrapper').removeAttr('hidden');
          hideError();
      } else {
        showError(result);
      }

    });
  });
});

function showError(message) {
  $(document).ready(function() {
      $('#group-assigner-error').removeAttr('hidden');
      $("#group-assigner-error").html(message);
  });
}
function hideError() {
  $(document).ready(function() {
    $('#group-assigner-error').attr('hidden', 'hidden');
  });
}
