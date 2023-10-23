<?php
session_start();
class Library
{
    public function user(){
        require_once("Database.php");
        $Database = new Database;
        $email = $_SESSION["username"];
        $result = $Database->fetch_user($email);
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['fname'];
        $last_name = $row['lname'];
        $user_id = $row['id'];
        $user_name = $first_name." ".$last_name;
    
        $user_details = ["user_id"=>$user_id, "user_name"=>$user_name];
        return($user_details);
    }
    public function Header($title)
    { ?>
        <!DOCTYPE html>
        <title>
            <?php echo $title; ?>
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.31/sweetalert2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
        </head>
        <body>

        <?php
    }

    public function Header_Nav()
    { 
    $Library = new Library();
    $user_info = $Library->user();
        ?>
            <nav class="navbar navbar-expand-sm navbar-dark bg-success">
                <div class="container-fluid">
                    <a class="navbar-brand" href="javascript:void(0)">Blog App</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mynavbar">
                        <ul class="navbar-nav ms-auto">
                            <div class="dropdown" id="user_dropdown">
                                <button class="btn btn-secondary dropdown-toggle dropMenuButton" type="button" id="user_dropdownMenuButton" data-toggle="dropdown">
                                    <i class="bi bi-person-circle"> <?php echo $user_info["user_name"]; ?></i>
                                </button>
                                    <ul class="dropdown-menu" id="user_dropdown-menu" aria-labelledby="user_dropdownMenuButton">
                                        <li class="active">
                                            <span class="dropdown-item" style="color: ;"> <?php echo $user_info["user_name"]; ?> </span>
                                        </li>
                                        <li>
                                            <button class="btn btn-primary dropdown-item" type="button" id='signout'>Log Out <i class="bi bi-box-arrow-right"></i></button>
                                        </li>
                                    </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php
    }

    public function Footer()
    { ?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.31/sweetalert2.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
                <script src="../assets/js/custom.js"></script>
            </body>

            </html>

        <?php
    }
}

// $Library = new Library();
// $username = $Library->user();
// echo $username["user_id"];
// print_r($username); die;
// // $user
// // echo die;



?>