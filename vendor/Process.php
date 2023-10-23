<?php
require_once "Database.php";
require_once "Library.php";
$Database = new Database();
$Library = new Library();
$user_info = $Library->user();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "login_data") {
    $username = $_REQUEST['uname'];
    $password = $_REQUEST['upass'];
    $pass = md5($password);
    if ($username && $password != "") {
        $result = $Database->fetch_login($username, $pass);
        $count = mysqli_num_rows($result);
        if($count > 0)
        {
            $user = $_SESSION['username'] = $username;
            if (isset($_REQUEST['remember'])) {
                date_default_timezone_set('Asia/Karachi');
                setcookie('user', $user, time() + (86400 * 30), '/');
            }
            if ($user) {
                echo 1;
            }
        }
        else
        {
            echo 0;
        }
    }
}

elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == "registration_data") {
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $gender = $_POST['gender'];
    $pwd = md5($password);
    $dir = "../Images";
    $profile_pic = $dir."/".rand(00000,99999).'_'.$_FILES['profile_pic']["name"];
    if ($fname != "" && $lname != "" && $email != "" && $password != "" && $gender != "") {
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $tempname = $_FILES['profile_pic']['tmp_name'];
        move_uploaded_file($tempname, $dir."/". $profile_pic);
        $result = $Database->insert_registration($fname, $lname, $email, $password, $gender, $pwd, $profile_pic);
        if($result)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
}

elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == "publish_post") {
    $post_added_by = $_REQUEST['post_added_by'];
    $content = $_REQUEST['content'];
    $dir = "../Images";
    $filename = $dir."/".rand(00000,99999).'_'.$_FILES['img']['name'];
    $tempname = $_FILES['img']['tmp_name'];
    if ($content != "" && $filename != "") {
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        move_uploaded_file($tempname, $dir."/". $filename);
        date_default_timezone_set('Asia/Karachi');
        $post_at = date("Y-m-d h:i:sa");
        $result = $Database->insert_blog_post($post_added_by, $content, $filename , $post_at);
        if ($result > 0) {
          echo 1;
        } else {
          echo 0;
        }
    }
}

elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == "view_post") {
    date_default_timezone_set('Asia/Karachi');
    $result = $Database->fetch_posts();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $profile_picture = $row["profile_pic"];
            $content = $row["content"];
            $post_image = $row["image"];
            $post_at = $row["post_at"];
            $post_id = $row["id"];
            $post_added_by = $row["post_added_by"];

            $postTime = strtotime($post_at);
            $currentTime = time();
            $timeDifference = $currentTime - $postTime;

            $minute = 60;
            $hour = $minute * 60;
            $day = $hour * 24;
            $month = $day * 30;
            $year = $day * 365;

            if ($timeDifference < $minute) {
                $formattedTimeAgo = "just now";
            } elseif ($timeDifference < $hour) {
                $minutesAgo = floor($timeDifference / $minute);
                $formattedTimeAgo = $minutesAgo . " minute" . ($minutesAgo > 1 ? "s" : "") . " ago";
            } elseif ($timeDifference < $day) {
                $hoursAgo = floor($timeDifference / $hour);
                $formattedTimeAgo = $hoursAgo . " hour" . ($hoursAgo > 1 ? "s" : "") . " ago";
            } elseif ($timeDifference < $month) {
                $daysAgo = floor($timeDifference / $day);
                $formattedTimeAgo = $daysAgo . " day" . ($daysAgo > 1 ? "s" : "") . " ago";
            } elseif ($timeDifference < $year) {
                $monthsAgo = floor($timeDifference / $month);
                $formattedTimeAgo = $monthsAgo . " month" . ($monthsAgo > 1 ? "s" : "") . " ago";
            } else {
                $yearsAgo = floor($timeDifference / $year);
                $formattedTimeAgo = $yearsAgo . " year" . ($yearsAgo > 1 ? "s" : "") . " ago";
            }

            $comments = $Database->fetch_comments($post_id);
            $numb_cmnt_post = mysqli_num_rows($comments);
            if ($numb_cmnt_post > 0 && $numb_cmnt_post == 1) {
                $cmnt_on_post = $numb_cmnt_post." Comment";
            } else if ($numb_cmnt_post > 1) {
                $cmnt_on_post = $numb_cmnt_post." Comments";
            } else {
                $cmnt_on_post = "No Comments";
            }

            echo '<div class="card mx-auto mb-4" style="width: 40rem;">
                <div class="card-body">
                    <div class="row g-0">
                        <div class="col-md-1">
                            <img src="'. $profile_picture .'" class="img-fluid" style="width: 51px; border-radius: 50%; height: 55px;">
                        </div>
                        <div class="col-md-8">
                            <div class="ms-2">
                                <span class="card-title h5" style="line-height: 0.1;">'. $first_name . " " . $last_name .'</span>
                                <p class="card-text"><small class="text-muted">'. $formattedTimeAgo .'</small></p>
                            </div>
                        </div>
                    </div>
                    <p class="card-text mt-3">'. $content .'</p>
                </div>
                <img src="'. $post_image .'" class="mb-3" style="height: 450px;">
                <div class="container text-end">
                    <span class="me-2">'. $cmnt_on_post .'</span>
                    <hr width="100%">
                    <form action="" method="POST" id="add_comment">
                        <div class="input-group mb-3">
                            <input type="text" name="comment" class="form-control" placeholder="Comment">
                            <input type="hidden" name="post_id" value="'. $post_id .'">
                            <input type="hidden" name="comment_by" value="'. $user_info["user_id"] .'">
                            <div class="input-group-text">
                                <button type="submit" name="submit" style="border: none; background: none;"><i class="bi bi-send"></i></button>
                            </div>
                        </div>
                        <button type="button" id="view_comments_id" value="'. $post_id .'" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#mycomments">
                            View Comments
                        </button>
                    </form>
                </div>
            </div>';
        }

        echo '<div class="modal fade" id="mycomments">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">All Comments</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body mt-2" id="modal_body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>';
    }
}

elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == "comments") {
    $comment = $_REQUEST["comment"];
    $post_id = $_REQUEST["post_id"];
    $comment_by = $_REQUEST["comment_by"];
    date_default_timezone_set('Asia/Karachi');
    $comment_at = date("Y-m-d h:i:sa");
    $result = $Database->insert_comment($comment, $comment_at, $post_id, $comment_by);
    if ($result) {
        echo 1;
    }else{
        echo 0;
    }
}

elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == "view_comments") {
    
    $comment_post_id = $_REQUEST["view_comments_id"];
    $result = $Database->fetch_comments($comment_post_id);
    date_default_timezone_set('Asia/Karachi');
    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row["comment"];
        $comment_at = $row["comment_at"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $profile_picture = $row["profile_pic"];

        $CommentTime = strtotime($comment_at);
        $currentTime = time();
        $timeDifference = $currentTime - $CommentTime;

        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $month = $day * 30;
        $year = $day * 365;

        if ($timeDifference < $minute) {
            $formattedTimeAgo = "just now";
        } elseif ($timeDifference < $hour) {
            $minutesAgo = floor($timeDifference / $minute);
            $formattedTimeAgo = $minutesAgo . " minute" . ($minutesAgo > 1 ? "s" : "") . " ago";
        } elseif ($timeDifference < $day) {
            $hoursAgo = floor($timeDifference / $hour);
            $formattedTimeAgo = $hoursAgo . " hour" . ($hoursAgo > 1 ? "s" : "") . " ago";
        } elseif ($timeDifference < $month) {
            $daysAgo = floor($timeDifference / $day);
            $formattedTimeAgo = $daysAgo . " day" . ($daysAgo > 1 ? "s" : "") . " ago";
        } elseif ($timeDifference < $year) {
            $monthsAgo = floor($timeDifference / $month);
            $formattedTimeAgo = $monthsAgo . " month" . ($monthsAgo > 1 ? "s" : "") . " ago";
        } else {
            $yearsAgo = floor($timeDifference / $year);
            $formattedTimeAgo = $yearsAgo . " year" . ($yearsAgo > 1 ? "s" : "") . " ago";
        }

        foreach ($comments as $key => $value) { }
        echo '<div class="container">
            <div class="row mx-1">
                <div class="card-body">
                    <div class="row g-0">
                        <div class="col-md-1">
                            <img src="'. $profile_picture .'" class="img-fluid" style="width: 51px; border-radius: 50%; height: 40px;">
                        </div>
                        <div class="col-md-11">
                            <div class="ms-2" style="background-color: #F0F2F5; border-radius: 10px;">
                                <span class="card-title h6 ms-2" style="line-height: 0.1;">'. $first_name . " " . $last_name .'</span>
                                <p class="card-text ms-2">'. $value .'</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer"><span class="float-end me-2"><small>'. $formattedTimeAgo .'</small></span></div>
            </div>
        </div>';
    }
}


?>