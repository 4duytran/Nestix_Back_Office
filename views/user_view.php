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
  <div class="container-fluid content">
    <div class="row">
      <div class="col-md-12 col-lg-12">

        <table class="table table-striped table-dark table-bordered text-white" id="example">
          <tr>
                
            <th scope="col">First Names</th>
            <th scope="col">Last Names</th>
            <th scope="col">Email</th>
            <th scope="col">Date registered</th>
            <th scope="col">Level</th>
            <th scope="col">Status</th>
            <th scope="col">Action edit</th>
            <th scope="col">Action delete</th>

          </tr>
            <?php foreach($listAllUsers as $user): ?>
          <tr>
                
            <td><?= $user->u_firstname ?></td>
            <td><?= $user->u_lastname ?></td>
            <td><?= $user->u_email ?></td>
            <td><?= dateConvert($user->u_date_registered) ?></td>
            <td><?= $user->u_rank ?></td>
            <td><?= $user->u_banned == 0 ? 'Active' : '<span class="text-danger">Banned</span>' ?></td>
            <td class="text-center">
            <form action="edituser?id=<?= $user->u_id ?>" method="POST">
            <input type="hidden" name="id" value="<?= $user->u_id ?>">
            <button type="submit" class="btn btn-warning">Full edit</button>
            </form>
            </td>
            <td class="text-center">
            <form method="POST" action="">
            <input type="hidden" name="csrf" value="<?= $token ?>">
            <input type="hidden" name="delete">
            <input type="hidden" name="id" value="<?= $user->u_id ?>">
            <button type="submit" name="delete" class="btn btn-danger">Delete User</button>
            </form>
            </td>
          </tr>
            <?php endforeach; ?>
        </table>

        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <li class="page-item <?= $previous>=1 ? '' : 'disabled'; ?>">
              <a class="page-link" href="user?nb=<?= $previous>=1 ? $previous : 1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <?php for( $i=1; $i<=$paginations; $i++ ): ?>
            <li class="page-item <?= $i == $pagination ? 'active' : ''; ?>"><a class="page-link" href="user?nb=<?= $i; ?>"><?= $i; ?></a></li>
            <?php endfor; ?>
            <li class="page-item <?= $next <= $paginations ? '' : 'disabled'; ?>">
              <a class="page-link" href="user?nb=<?= $next <= $paginations ? $next : $paginations; ?>">Next</a>
            </li>
          </ul>
        </nav>
               
      </div>
    </div>
  </div>



<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">DELETE CONFIRMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="document.location.href='user'">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Are you sure? !</h4>
      </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete" id="delete">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>

  <?php include_once 'views/includes/footer.php'?>


<script>
$('button[name="delete"]').on('click', function(e) {
  var $form = $(this).closest('form');
  e.preventDefault();
  $('#confirm').modal({
      backdrop: 'static',
      keyboard: false
  })
  .on('click', '#delete', function(e) {
      $form.trigger('submit');
      // $('#myform').submit();
    });
});
</script>


<script>
<?php
if ($_GET['success'])
{
  echo '$(window).on("load",function(){
    $("#modalDeleteSuccess").modal("show");
});';
} else if($_GET['error'])
{
  echo '$(window).on("load",function(){
    $("#modalDeleteError").modal("show");
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