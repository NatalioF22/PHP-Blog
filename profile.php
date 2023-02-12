<?php include 'inc/header.php';?>
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


$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,'login_db');

$id = htmlspecialchars($user["id"]);

$query_2 = "INSERT IGNORE INTO user_details (id,f_name,l_name, email) SELECT id, f_name, l_name,email FROM user WHERE id = '$id';";

$query_run_2 = mysqli_query($connection,$query_2);



//$query = "SELECT * FROM todolist WHERE checked='$id'";

$query = "SELECT * FROM user_details
WHERE id = {$_SESSION["user_id"]}";
$query_run = mysqli_query($connection, $query);
?>
<?php
        if($query_run && $query_run_2){
    while ($row = mysqli_fetch_array($query_run)) {
            ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
</head>
<body>

    

    <form method='post'>  
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold"><?php echo $row['f_name'];?> <?php echo $row['l_name'];?></span><span class="text-black-50"> <?= htmlspecialchars($user["email"]) ?></p></span><span> </span></div>
                </div>
                <div class="col-md-5 border-right ">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">First Name</label>
                                <input type="text" name = "" class=" form-control"  value="<?php echo $row['f_name'];?>" readonly>
                            </div>
                            <div class="col-md-6"><label class="labels">Last Name</label><input type="text" name="l_name" class="form-control" value="<?php echo $row['l_name'];?>" readonly></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Mobile Number</label>
                                <input type="text" name="mobile" class="form-control" value="<?php echo $row['mobile'];?>"readonly>
                            </div>
                            <div class="col-md-12"><label class="labels">Address Line 1</label>
                                <input type="text" name="address_line_1" class="form-control" value="<?php echo $row['address_1'];?>"readonly >
                            </div>
                            <div class="col-md-12"><label class="labels">Address Line 2</label>
                                <input type="text" name="address_line_2" class="form-control" value="<?php echo $row['address_2'];?>"readonly >
                            </div>
                            <div class="col-md-12"><label class="labels">Postcode</label>
                                <input type="text" name="zip_code" class="form-control" value="<?php echo $row['zip'];?>"readonly >
                            </div>
                
                            
                        </div>
                        
                        
                    </div>
                </div>
                <div class="col-md-4 mt-1">
                    <div class="p-3 py-5">
                    <div class="row mt-5">
                            <div class="col-md-6"><label class="labels">Country</label><input type="text" name="country" class="form-control" value="<?php echo $row['country'];?>"readonly></div>
                            <div class="col-md-6"><label class="labels">State/Region</label><input type="text" name="state" class="form-control" value="<?php echo $row['state'];?>"readonly></div>
                            
                            <div class="col-md-12 mb-2"><label class="labels">Email </label><input type="text" name="email" class="form-control " placeholder="enter email id" value="<?php echo $row['email'];?>" readonly></div>
                            
                            <h5 class="text-right">Education</h5>
                            <div class="col-md-12"><label class="labels">School</label><input type="text"name="school" class="form-control" value="<?php echo $row['school'];?>"readonly></div>
                            <div class="col-md-12"><label class="labels">Major</label><input type="text" name="major" class="form-control" value="<?php echo $row['major'];?>" readonly></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 text-center">
                <a class="btn btn-success profile-button" href="profile_editor.php">Update</a>
                <a class="btn btn-danger profile-button" href="index.php">Cancel</a>
            </div>
        </div>
        <?php
    }}
    else{
    echo "No record found";
    }

    
        ?>

        
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
</body>
</html>

