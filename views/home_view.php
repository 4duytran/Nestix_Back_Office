<!doctype html>
<html lang="en">
  <head>
  <?php include_once 'views/includes/head.php'?>
  <title><?= ucfirst($page) ?></title>
  <style>
    body {
      background-image: url('<?= PATH ?>assets/images/background_login.png');
      background-color: rgba(0,0,0,.9);
    }
  </style>
  </head>
  <body>
  <header>
    <?php include_once 'views/includes/header_login.php'?>
  </header>
  <div class="container mt-5 mb-3">
    <div class="row mx-auto justify-content-center loginPanel">
        <div class="col-12 col-md-8">
          <h1>Admin Login Panel</h1>
          <br />
          <?php
          if($error != ''): ?>
          <span class="p-3 bg-danger text-white has-error" ><?= $error ?></span>
          <?php endif; ?>
          <br /><br />
          <form method="POST" action="">

              <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" >
              </div>

              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" >
              </div>
              
              <!-- <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div> -->
              <input type="hidden" name="csrf" value="<?= $token ?>">
              <button type="submit" name="submit" class="btn btn-primary mt-5">Submit</button>
          </form>
        </div>
    </div>
  </div>

  <?php include_once 'views/includes/footer.php'?>

<script>
<?php
 if($_GET['invalidtoken'])
{
  echo '$(window).on("load",function(){
    $("#modalTokenError").modal("show");
});';
}
?>
</script>

</body>
</html>



