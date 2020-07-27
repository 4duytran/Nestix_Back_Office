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
    <?php include_once 'views/includes/header.php'?>
  </header>
  <div class="container mb-3 mt-3">
    <div class="row mx-auto justify-content-center loginPanel">
        <div class="col-12 col-md-8">
          <h1>Edit User Panel</h1>
          <br />
          <br />
          <form method="POST" action="">
            <input type="hidden" name="csrf" value="<?= $token ?>">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $user->u_firstname ?>" >
                <?php
                if($erroFirstname != ''): ?>
                <span class="text-danger has-error" ><?= $erroFirstname ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $user->u_lastname ?>" >
                <?php
                if($erroLastname != ''): ?>
                <span class="text-danger has-error" ><?= $erroLastname ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $user->u_email ?>" >
                <?php
                if($erroEmail != ''): ?>
                <span class="text-danger has-error" ><?= $erroEmail ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password (Optional)</label>
                <input type="password" class="form-control" id="password" name="password" value="">
                <?php
                if($erroPassword != ''): ?>
                <span class="text-danger has-error" ><?= $erroPassword ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password2">Confirm password (Optional)</label>
                <input type="password" class="form-control" id="password2" name="password2" value="">
            </div>


            <div class="form-group">
                <label for="rank">User Level</label>
                <select class="form-control selectpicker" data-live-search="true" id="rank" name="rank">
                    <?php foreach($rankList as $rank): ?>
                    <option value="<?= $rank['rank_id'] ?>" <?php if($user->u_rank === $rank['rank']) {echo 'selected';} ?>><?= $rank['rank'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="status">User status</label>
                <select class="form-control selectpicker" id="status" name="status">
                    
                    <option value="<?= 0 ?>" <?= $user->u_banned == 0 ? 'selected' : '' ?>>Active</option>
                    <option value="<?= 1 ?>" <?= $user->u_banned == 1 ? 'selected' : '' ?>>Banned</option>
                    
                </select>
            </div>
              
            <div class="row justify-content-between mt-5">
              <div class="col-4">
                <button type="button" class="btn btn-secondary"  onClick="document.location.href='user'">Cancel</button>
              </div>
              <div class="col-4">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
    
          </form>
        </div>
    </div>
  </div>


<?php include_once 'views/includes/footer.php'?>

<script>
<?php
if ($_GET['success'])
{
  echo '$(window).on("load",function(){
    $("#modalUpdateSuccess").modal("show");
});';
} else if($_GET['error'])
{
  echo '$(window).on("load",function(){
    $("#modalUpdateError").modal("show");
});';
} else if($_GET['invalidtoken'])
{
  echo '$(window).on("load",function(){
    $("#modalTokenError").modal("show");
});';
}
?>
</script>

</body>
</html>