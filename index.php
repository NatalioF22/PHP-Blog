<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $session_in = true;
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}
if($session_in==false){
    header("Location:login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <?php include("inc/header.php")   ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
    <div class="container-lg">
        <h1>Home</h1>
        
        <?php if (isset($user)): ?>
            
            <p>Hello <?= htmlspecialchars($user["f_name"]) ?></p>
            
            
            
        <?php else: ?>
            
            <p><a href="login.php">Log in</a> or <a href="signup.php">sign up</a></p>
            
        <?php endif; ?>
        <section>
        <div class="row g-0 text-center bg-light  border border-2">
            <div class="col-9 col-sm-9 col-md-9 border border-2 ">
                <p>Feed</p>
                <div class="bg-primary text-start border rounded-3 p-3 mb-3">  
<?php
            $connection = mysqli_connect("localhost","root","");
            $db = mysqli_select_db($connection,'login_db');


            $date = "added_date";
            //$query = "SELECT * FROM todolist WHERE checked='$id'";
            if (isset($_POST['sort'])){
                $date = $_POST['sorting'];
            }

            $query = "SELECT * FROM post ORDER BY $date";
            $query_run = mysqli_query($connection, $query);
            ?>

    <?php
        if($query_run){
    while ($row = mysqli_fetch_array($query_run)) {
            ?>
            <div class="bg-secundary mb-3 border rounded-4 p-4">
        <h2 ><?php echo $row['content_header']; ?></h2>
        <hr>
        <p ><?php echo $row['content']; ?></p>
        <small class="text-muted">By <?php echo $row['author']; ?> | Posted on <?php echo $row['added_date']; ?></small>
        </div>
    
        <?php
    }}
    else{
    echo "No record found";
    }
    
        ?>
        </div>
        </div>
            <div class="col-3 col-sm-3 col-md-3 border border-2" >
                <p>Options</p>
                <a href="profile.php" class="btn btn-info my-3 m-5 d-block">My Profile</a>
                <a href="post.php" class="btn btn-info my-3 m-5 d-block">Post</a>
                <a href="logout.php" class="btn btn-danger my-3 m-5 d-block">Log out</a>
            </div>
        </div>
        </section>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
    
    