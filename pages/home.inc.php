
<div class="row">
  <div class="col-md-12">
    <h1 class="display-4 mb-4">News</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
      <?php
        require_once(__DIR__ . '/../includes/queries.inc.php');
        require_once(__DIR__ . '/../lib/parsedown/Parsedown.php');
        $pdo = new PDO('mysql:host=localhost;dbname=yatw', 'root', '');
        $statement = $pdo->prepare($pdoQueries['newsget']);
        $pageOffset = 0;
        if(isset($_GET['newspage']) && !empty($_GET['newspage'])){
          if($_GET['newspage'] > 0){
            $pageOffset = $_GET['newspage'] * $config['newsLimit'];
          }
        }
        $statement->bindParam(1, $config['newsLimit'], PDO::PARAM_INT);
        $statement->bindParam(2, $pageOffset, PDO::PARAM_INT);
        if($statement->execute()){
          while($row = $statement->fetch()) {
            $date = strtotime($row['create_time']);
            ?>
            <div class="card mb-4">
              <div class="card-header">
                <span class="float-md-left"><h5><?php echo($row['title']); ?></h5></span>
                <span class="float-md-right">
                  <i class="fas fa-fw fa-user"></i> <?php echo($row['nickname']); ?>
                  <i class="fas fa-fw fa-calendar"></i> <?php echo(date('d.m.Y', $date)); ?>
                  <i class="fas fa-fw fa-clock"></i> <?php echo(date('H:i', $date)); ?>
                </span>
              </div>
                <div class="card-body">
                  <p class="card-text">
                    <?php
                    $parsedown = new Parsedown();
                    echo($parsedown->text($row['text']));
                    ?>
                  </p>
                </div>
            </div>
          <?php
              }
            }
          ?>
          <nav>
            <ul class="pagination justify-content-center">
              <?php
                $statement = $pdo->prepare($pdoQueries['newscount']);
                $count = 0;
                $activePage = 0;
                if(isset($_GET['newspage'])){
                  $activePage = $_GET['newspage'];
                }
                if($statement->execute()){
                  while($row = $statement->fetch()) {
                    $count = $row['count'];
                  }
                }

                for ($i = 0; $i < $count / $config['newsLimit']; $i++) {
                    if($i == $activePage){
                      echo '<li class="page-item active"><a class="page-link" href="?newspage=' . $i . '">' . ($i + 1) . '</a></li>';                      
                    } else{
                      echo '<li class="page-item"><a class="page-link" href="?newspage=' . $i . '">' . ($i + 1) . '</a></li>';
                    }
                }
              ?>
            </ul>
          </nav>
  </div>
  <?php
    require_once(__DIR__ . '/../includes/sidebar.inc.php');
  ?>
</div>
