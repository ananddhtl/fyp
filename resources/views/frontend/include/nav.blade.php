<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

     
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  <!-- 
     Messages Dropdown Menu -->


  <!-- Message End -->

  </a>
  </li>
  </ul>
</nav>

<?php
if (session()->get('sessionUserId') == "") {
    header('Location: /login');
    exit();
}

$user = \DB::table('add_users')
    ->select('id', 'username')
    ->where('password', session()->get('sessionUserId'))
    ->get();

$id = $user[0]->id;
$count = \DB::select("select count('id')  from add_users where id='" . $id . "'");
?>