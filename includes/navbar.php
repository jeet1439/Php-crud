<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand text-dark" href="/index.php">
      <img src="/images/logo.png" alt="My Store Logo" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-dark" href="/index.php">
            <i class="fas fa-home"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="/deals.php">
            <i class="fas fa-tags"></i> Deals
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="/about.php">
            <i class="fas fa-info-circle"></i> About
          </a>
        </li>
      </ul>

      <?php if($authenticated){ ?>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user"></i> Admin
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/profile.php">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
      <?php } else { ?>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="/register.php" class="btn btn-outline-dark me-2">
            <i class="fas fa-user-plus"></i> Register
          </a>
        </li>
        <li class="nav-item">
          <a href="/login.php" class="btn btn-outline-dark">
            <i class="fas fa-sign-in-alt"></i> Login
          </a>
        </li>
      </ul>
      <?php } ?>
    </div>
  </div>
</nav>