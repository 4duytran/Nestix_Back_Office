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

        <div class="col-md-12 col-lg-2 col-xl-2 w-100">
            <div class="card" style="max-width: 18rem;">
                <img class="card-img-top" src="<?= PATH ?>assets/images/avatar_admin.png" alt="admin_avatar">
                <div class="card-body">
                    <h5 class="card-title">Welcome back</h5>
                    <p class="card-text">Email: <?= $email ?></p>
                    <p class="card-text">Last login: <?= $log_time ?></p>
                    <p>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-5 col-xl-5">
            <div class="card text-white bg-info w-100">
                <div class="card-header font-weight-bold">Last 5 users</div>
                <div class="card-body">
                    <table class="table table-responsive text-white" style="max-height: 20rem;">
                        <tr>
                            <th scope="col">First Names</th>
                            <th scope="col">Last Names</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date registered</th>
                        </tr>
                        <?php foreach($listLastUser as $user): ?>
                        <tr>
                            <td class="td"><?= $user['firstname'] ?></td>
                            <td class="td"><?= $user['lastname'] ?></td>
                            <td class="td"><?= $user['email'] ?></td>
                            <td class="td"><?= dateConvert($user['creation']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-5 col-xl-5">
            <div class="card text-white bg-success w-100">
                <div class="card-header font-weight-bold">Last 5 Medias</div>
                <div class="card-body">
                    <table class="table table-responsive text-white" style="max-height: 20rem;">
                        <tr>
                            <th scope="col">Tilte</th>
                            <th scope="col">Year</th>
                            <th scope="col">Genre</th> 
                            <th scope="col">Media Type</th>                            
                        </tr>
                        <?php foreach($listLastMedias as $media): ?>
                        <tr>
                            <td class="td"><?= $media['media_title'] ?></td>
                            <td class="td"><?= $media['media_year'] ?></td>
                            <td class="td"><?= $media['media_genre'] ?></td>
                            <td class="td"><?= $media['media_type'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 offset-lg-2 col-lg-5 col-xl-5">
            <div class="card text-white bg-primary w-100">
                <div class="card-header font-weight-bold">Top 5 Medias</div>
                <div class="card-body">
                    <table class="table table-responsive text-white" style="max-height: 20rem;">
                        <tr>
                            <th scope="col">Tilte</th>
                            <th scope="col">Year</th>
                            <th scope="col">Genre</th> 
                            <th scope="col">Media Type</th>   
                            <th scope="col">Notes</th>                          
                        </tr>
                        
                        <?php foreach($listTopMedias as $media): ?>
                        <tr>
                            <td class="td"><?= $media['media_title'] ?></td>
                            <td class="td"><?= $media['media_year'] ?></td>
                            <td class="td"><?= $media['media_genre'] ?></td>
                            <td class="td"><?= $media['media_type'] ?></td>
                            <td class="td"><?= floor($media['review']*2)/2 ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-5 col-xl-5">
            <div class="card text-white bg-danger w-100">
                <div class="card-header font-weight-bold">Top 5 active user</div>
                <div class="card-body">
                    <table class="table text-white" style="max-height: 20rem;">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Comments</th> 
                                                      
                        </tr>
                        
                        <?php foreach($listActiveUser as $user): ?>
                        <tr>
                            <td class="td"><?= $user['name'] ?></td>
                            <td class="td"><?= $user['email'] ?></td>
                            <td class="td"><?= $user['comment'] ?></td>
                           
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
  <?php include_once 'views/includes/footer.php'?>
</body>
</html>