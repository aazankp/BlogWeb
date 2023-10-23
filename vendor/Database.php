<?php
Class Database {
    private $host_name = "localhost";
    private $rootname = "root";
    private $password = "";
    private $dbname = "blog_web";
    private $conn = null;
    private $query = null;
    private $result = null;

    public function __construct(){
        $this->conn = mysqli_connect($this->host_name, $this->rootname, $this->password, $this->dbname);
        if (mysqli_connect_errno()) {
            die("Connection Failed!");
        }
    }

    public function fetch_login($username, $pass) {
        $this->query = "SELECT * from register where email = '$username' AND password = '$pass'";
        $this->result = mysqli_query($this->conn, $this->query);
        return $this->result;
    }

    public function insert_registration($fname, $lname, $email, $password, $gender, $pwd, $profile_pic) {
        $this->query = "INSERT INTO `register`(`fname`, `lname`, `email`, `password`, `profile_picture`, `gender`) VALUES ('$fname','$lname','$email','$pwd', '$profile_pic','$gender')";
        $this->result = mysqli_query($this->conn, $this->query);
        return $this->result;
    }

    public function insert_blog_post($post_added_by, $content, $filename , $post_at) {
        $this->query = "INSERT INTO `blog_post` (`content`, `image`,`post_at`, `post_added_by`) VALUES ('$content', '$filename','$post_at', '$post_added_by')";
        $this->result = mysqli_query($this->conn, $this->query);
        return $this->result;
    }

    public function fetch_user($username) {
        $this->query = "SELECT * from register where email = '$username'";
        $this->result = mysqli_query($this->conn, $this->query);
        return $this->result;
    }

    public function fetch_posts() {
        $this->query = "SELECT
                        BP.*,
                        RG.`fname` AS first_name,
                        RG.`lname` AS last_name,
                        RG.`profile_picture` AS profile_pic
                        FROM blog_post AS BP
                        INNER JOIN register AS RG
                        ON RG.id = BP.post_added_by";
        $this->result = mysqli_query($this->conn, $this->query);
        return $this->result;
    }

    public function insert_comment($comment, $comment_at, $post_id, $comment_by) {
        $this->query = "INSERT INTO comments (`comment`, `comment_at`, `post_id`,`comment_by`) VALUES ('$comment', '$comment_at', '$post_id','$comment_by')";
        $this->result = mysqli_query($this->conn, $this->query);
        return $this->result;
    }

    public function fetch_comments($comment_post_id) {
        $this->query = "SELECT 
                        CM.*,
                        RG.`fname` AS first_name,
                        RG.`lname` AS last_name,
                        RG.`profile_picture` AS profile_pic 
                        FROM comments AS CM 
                        INNER JOIN register AS RG
                        ON RG.id = CM.comment_by
                        where post_id = '$comment_post_id'";
        $this->result = mysqli_query($this->conn, $this->query);
        return $this->result;
    }
}


?>