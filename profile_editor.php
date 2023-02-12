<?php include 'inc/header.php';

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


$query = "SELECT * FROM user_details";
$query_run = mysqli_query($connection, $query);
    if($query_run){
        while($row = mysqli_fetch_array($query_run)){
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
</head>
<body>
 

    <form method='post'>  
        <div class="container rounded bg-white mt-5 mb-3">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold"><?php echo $row['f_name'];?> <?php echo $row['l_name'];?></span><span class="text-black-50"> <?= htmlspecialchars($user["email"]) ?></p></span><span> </span></div>
                </div>
                <div class="col-md-5 border-right ">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">First Name</label>
                                <input type="text" name = "f_name" class=" form-control"  value="<?php echo $row['f_name'];?>" >
                            </div>
                            <div class="col-md-6"><label class="labels">Last Name</label><input type="text" name="l_name" class="form-control" value="<?php echo $row['l_name'];?>" ></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Mobile Number</label>
                                <input type="text" name="mobile" class="form-control" value="<?php echo $row['mobile'];?>">
                            </div>
                            <div class="col-md-12"><label class="labels">Address Line 1</label>
                                <input type="text" name="address_line_1" class="form-control" value="<?php echo $row['address_1'];?>" >
                            </div>
                            <div class="col-md-12"><label class="labels">Address Line 2</label>
                                <input type="text" name="address_line_2" class="form-control" value="<?php echo $row['address_2'];?>" >
                            </div>
                            <div class="col-md-12"><label class="labels">Postcode</label>
                                <input type="text" name="zip_code" class="form-control" value="<?php echo $row['zip'];?>" >
                            </div>
                
                            
                        </div>
                        
                        
                    </div>
                </div>
                <div class="col-md-4 mt-1">
                    <div class="p-3 py-5">
                    <div class="row mt-5">
                            <div class="col-md-6"><label class="labels">Country</label><input type="text" name="country" class="form-control" value="<?php echo $row['country'];?>"></div>
                            <div class="col-md-6"><label class="labels">State/Region</label><input type="text" name="state" class="form-control" value="<?php echo $row['state'];?>"></div>
                            
                            <div class="col-md-12 mb-2"><label class="labels">Email </label><input type="text" name="email" class="form-control " placeholder="enter email id" value="<?php echo $row['email'];?>" ></div>
                            
                            <h5 class="text-right">Education</h5>
                            <div class="col-md-12"><label class="labels">School</label><input type="text"name="school" class="form-control" value="<?php echo $row['school'];?>"></div>
                            <div class="col-md-12"><label class="labels">Major</label><input type="text" name="major" class="form-control" value="<?php echo $row['major'];?>" ></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-0 text-center"><button class="btn btn-primary profile-button mt-0" name="submit" type="submit">Update Profile</button></div>
        </div>
        
        
    </form>

<?php

        // Check connection
        if (!$connection ) {
        die("Connection failed: " . mysqli_connect_error());
        }
        if(isset($_POST['submit'])){
            $first_name = $_POST['f_name'];
            $last_name = $_POST['l_name'];
            $mobile = $_POST['mobile'];
            $address_1 = $_POST['address_line_1'];
            $address_2 = $_POST['address_line_2'];
            $zip = $_POST['zip_code'];
            $country = $_POST['country'];
            $email = $_POST['email'];
            $id = htmlspecialchars($user["id"]);
            $state = $_POST['state'];
            $school = $_POST['school'];
            $major = $_POST['major'];
        
        $sql = "UPDATE user_details SET 
        f_name='$first_name',
        l_name='$last_name',
        mobile = '$mobile',
        address_1 = '$address_1',
        address_2 = '$address_2',
        zip = '$zip',
        country = '$country',
        email = '$email',
        state = '$state',
        school = '$school',
        major = '$major'
        WHERE id='$id'";

        if (mysqli_query($connection , $sql)){?>
        <div class="container-xxl">
            <div class="alert alert-success" role="alert">
           <?php echo "Record updated successfully";?>
           <a class="btn btn-primary profile-button" href="profile.php" type="submit">Click here to see the effect</a>
        </div>
            
            </div><?php
        
        } else {
        echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_close($connection);
    }
       
}}
else{
echo "No record found";
}
        
   ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
</body>
</html>