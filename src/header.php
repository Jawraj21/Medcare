<header>
  <nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo2.png" alt="Logo" width="100" height="auto">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
          <i class="fa fa-bars"></i>
        </span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item<?= isset($_GET['page']) && $_GET['page'] == 'home' ? ' active' : '' ?>">
            <a class="nav-link" href="index.php?page=home"><i class="fa fa-fw fa-home"></i> Home</a>
          </li>

          <li class="nav-item<?= isset($_GET['page']) && $_GET['page'] == 'appointment' ? ' active' : '' ?>">
            <a class="nav-link" href="my_appointments.php?page=my_appointments"><i class="fa fa-calendar"></i> My Appointments</a>
          </li>
          
          <li class="nav-item<?= isset($_GET['page']) && $_GET['page'] == 'reports' ? ' active' : '' ?>">
            <a class="nav-link" href="reports.php"><i class="fa fa-file"></i> My Reports</a>
          </li>

          <li class="nav-item<?= isset($_GET['page']) && $_GET['page'] == 'prescriptions' ? ' active' : '' ?>">
            <a class="nav-link" href="prescriptions.php"><i class="fas fa-file-prescription"></i> My Prescriptions</a>
          </li>
        </ul>
      </div>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="profile.php"><i class="fa fa-user-circle"></i> Profile</a>
        </li>
        <li class="nav-item<?= isset($_SESSION['user_id']) ? ' active' : '' ?>">
          <?php if (isset($_SESSION['user_id'])) { 
            $first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';  
          ?>
            <a class="nav-link" href="login.php"><i class="fa fa-user-circle"></i><?php echo " " . $first_name . " (Logout)" ?></a>
          <?php } else { ?>
            <a class="nav-link" href="login.php"><i class="fa fa-user-circle"></i> Log In</a>
          <?php } ?>
        </li>
      </ul>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</header>
