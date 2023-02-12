<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Signup</title>
    <script src="/js/validation.js" defer></script>
    <?php include "inc/header.php" ?>
</head>
<body>
   
    <div class="container-xxl ">
        <h1>Sign up to our website</h1>
        <form action="process_signup.php" method="post" id="signup">
    
            <div class="mb-3">
                <label for="f_name" class="form-label ">First Name</label>
                <input type="text" name="f_name" class="form-control" id="fname" required>
                <label for="l_name" class="form-label ">Last Name</label>
                <input type="text" name="l_name" class="form-control" id="lname" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="mb-3 ">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password"  name="password_confirmation" class="form-control" id="password_confirmation" required>
            </div>
            <button class="btn btn-primary">Sign Up</button>
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>