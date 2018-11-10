<?php


if(isset($_SESSION['userid'])){
  if(!(in_array('news-editor', $_SESSION['groups']) || in_array('news-editor-safemode', $_SESSION['groups']))){
    header('Location: ?page=home&noperm=1');
  }
} else {
  header('Location: ?page=login&needlogin=1');
}
?>
<div class="row">
  <div class="col-md-12">
    <h1 class="display-4 mb-4">News Editor</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <form action="news.php?action=new">
              <div class="form-group">
                <label for="title">Titel</label>
                <input type="title" class="form-control" id="title" name="title" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Nachricht</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                <small class="form-text text-muted">Hinweis: Die Nachricht kann mit Markdown formatiert werden.</small>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
