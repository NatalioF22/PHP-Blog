<?php include "inc/header.php"; ?>
<?php

session_start();
$session_in = true;
if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Add Post</title>
</head>
<body>
    

<div class="container-lg">
        <h1>Home</h1>
    
        <div class="row g-0 text-center bg-light  border border-2">
            <div class="col-9 col-sm-9 col-md-9 border border-2 ">
                <p>Feed</p>
                <form method="post">
                <div class="bg-primary text-start border rounded-3 p-3 mb-3">  
                    <div class="bg-secundary mb-3 border rounded-4 p-4">
                        <div class="form-group row">
                            <label for="email" class="form-label">Post Title</label>
                            <input type="text" name="content_header"  class="form-control" id="title" require>
                        </div>
                        <div class="form-group row">
                            <label for="" class="form-label">Post Content</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" require></textarea>

                        </div>
                            <button class="btn btn-info my-4" name="post">Post</button>
                        
                        </div>          
                </div>
                </form>
               
        </div>
        <div class="col-3 col-sm-3 col-md-3 border border-2" >
                <p>Options</p>
                <a href="#" class="btn btn-info my-3 m-5 d-block">My Profile</a>
                <a href="index.php" class="btn btn-info my-3 m-5 d-block">Posts</a>
            </div>
        </div>
        </section>
        </div>



 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
 


<?php 
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"login_db");

    if(isset($_POST['post'])){
        
        
        $author = htmlspecialchars($user["f_name"]);
        $title = $_POST['content_header'];
        $content = $_POST['content'];
        $id = htmlspecialchars($user["id"]);
    
        $query =  "INSERT INTO `post`(id, author,content_header,content) VALUES ('$id','$author','$title','$content')";
        
        $query_run = mysqli_query($connection,$query);

        if($query_run){?>
            <div class="container-xxl">
                <div class="alert alert-success" role="alert">
                <?php echo "Added Successfully";?>
                </div>
            </div>
            <?php  
        }else{
            echo "Not Done";
        }
    }

?>

</body>
</html>