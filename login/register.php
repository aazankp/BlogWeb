<?php
  require_once "../vendor/Library.php";
  $Library = new Library();
  $Library->Header("Blog Web");
?>
  <style>
    body {
      background-color: rgb(86, 135, 179);
    }

    form {
      color: white;
    }
  </style>
  <div class="container mt-4">
    <form action="" method="post" id="registration_data" enctype="multipart/form-data">
      <h2>Create an account.</h2>
      <div class="mb-3 mt-3">
        <label for="" class="form-label">First Name:</label>
        <input type="text" class="form-control" placeholder="Enter First Name" name="fname" required>
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Last Name:</label>
        <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" required>
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Email:</label>
        <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="pwd" class="form-label">Password:</label>
        <input type="password" class="form-control" placeholder="Enter password" name="pwd" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Upload Profile Picture:</label>
        <input type="file" class="form-control" name="profile_pic">
      </div>
      <div class="mb-3">
        <label for="form-check-label" class="form-label">Select Gender:</label><br>
        <input type="radio" class="form-check-input" name="gender" value="Male" checked> Male &nbsp;
        <input type="radio" class="form-check-input" name="gender" value="Female"> Female
      </div>
      <div class="form-check mb-3">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="remember">
          <p>By creating an account you agree to our <a href="#" style="color:white;">Terms & Privacy</a>.</p>
        </label>
      </div>
      <input type="submit" class="btn btn-success" name="register" value="Register">
    </form>
  </div>
<?php
  $Library->Footer();
?>