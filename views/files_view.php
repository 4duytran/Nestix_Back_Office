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
    .img-icon:hover {opacity: 0.7;}
    
  </style>
  </head>
  <body>
  <header>
    <?php include_once 'views/includes/header.php'?>
  </header>
  <div class="container content">

    <div class="row">
        <div class="col-md-12 col-lg-12">
            
            <a href="addfile" class="btn btn-info my-3 float-right" role="button">Add new file</a>

            <table class="table table-striped table-dark table-bordered text-white" id="example">
            <tr>
                    
                <th scope="col">Poster</th>
                <th scope="col">Date created</th>
                <th scope="col">Action delete</th>

            </tr>
                <?php foreach($listAllFiles as $file): ?>
            <tr>

                <td><img src="assets/files/<?= $file->file_chemin ?>" class="img-icon" alt="image" /></td>              
                <td><?= dateConvert($file->date_create) ?></td>
                <td class="text-center">
                <form method="POST" action="">
                <input type="hidden" name="csrf" value="<?= $token ?>">
                <input type="hidden" name="delete">
                <input type="hidden" name="id" value="<?= $file->file_id ?>">
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
                <?php endforeach; ?>
            </table>

            <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $previous>=1 ? '' : 'disabled'; ?>">
                <a class="page-link" href="files?nb=<?= $previous>=1 ? $previous : 1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php for( $i=1; $i<=$paginations; $i++ ): ?>
                <li class="page-item <?= $i == $pagination ? 'active' : ''; ?>"><a class="page-link" href="files?nb=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?= $next <= $paginations ? '' : 'disabled'; ?>">
                <a class="page-link" href="files?nb=<?= $next <= $paginations ? $next : $paginations; ?>">Next</a>
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

<div class="modal fade" id="img-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
        <img class="img-fluid" />
      
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
$('.img-icon').on('click', function(e) {
  var $image = $(this).attr("src");
  e.preventDefault();
  $('#img-modal').modal()
  $('.modal-content img').attr('src',$image);
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