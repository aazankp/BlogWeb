<?php
    require_once "../vendor/Library.php";
    $Library = new Library();
    $Library->Header("Blog Web");
?>
    <style>
        body{
            background-color: rgb(86, 135, 179);
        }

        form{
        background-color: white;
        height: 400px;
        width: 40%;
        margin: auto;
        padding: 25px;
        margin-top: 80px;
        }
    </style>
    <div class="container">
        <form action="" method="post" class="border border-dark p-3 mt-5 w-50 h-75 bg-white m-auto" id="login_data"> 
            <h1 class="text-center">Login Here</h1>
            <div class="input-group mb-3 mt-3">
            <input type="email" class="form-control" placeholder="Username" name="uname">
            </div>
            <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="upass">
            </div>
            <div class="icheck-primary">
              <input type="checkbox" name="remember">
              <label for="remember">
               <b> Remember me</b>
              </label>
            </div>
            <div class="col-4">
                <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block mt-2">
                <span class="or"> - OR - </span>
                <a href="register.php" class="btn btn-success btn-block mt-1">Create New account</a>
            </div>
        </form>
    </div>
<?php
    $Library->Footer();
?>