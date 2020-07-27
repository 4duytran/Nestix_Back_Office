<nav class="navbar navbar-expand navbar-dark navbar-inner">  
    <a class="navbar-brand" href="">Nestix Admin Panel</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link <?= $page == 'dashboard' ? 'active':'';?>" href="dashboard">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $page == 'files' ? 'active':'';?>" href="files">Files</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?= (in_array($page,['user', 'adduser', 'edituser'])) ? 'active':'';?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Users
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="user">All users</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="adduser">Add users</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?= ($page == 'media' || $page == 'music' || $page == 'book') ? 'active':'';?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Medias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            
            <a class="dropdown-item" href="media">All medias</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="film">Films</a>
            <a class="dropdown-item" href="music">Musics</a>
            <a class="dropdown-item" href="book">Books</a>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $page == 'proposition' ? 'active':'';?>" href="proposition">Proposition</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout">LogOut</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="" method="POST">
      <input type="hidden" name="csrf" value="<?= $token ?>">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search" id="search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>