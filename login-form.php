<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $loginErr = $usernameErr = $passwordErr = "";
        $loginSuccessful = $username = $password = "";
        $hasErr = false;
        $filepath = "data.txt";

        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            if(empty($_POST["username"]))
            {
                $usernameErr = "Username field is empty";
                $loginErr = "Login failed";
                $hasErr = true;
            }
            
            if(empty($_POST["password"]))
            {
                $passwordErr = "Password field is empty";
                $loginErr = "Login failed";
                $hasErr = true;
            }

            if(!$hasErr)
            {
                $username = $_POST["username"];
                $password = $_POST["password"];

                $file = file_get_contents($filepath);
                $file = json_decode($file);
                
                foreach($file as $obj)
                {
                    if($obj -> username === $username && $obj -> password === $password)
                    {
                        $hasErr = false;
                        $loginSuccessful = "Successfully logged in";
                        break;
                    }

                    else
                    {
                        $hasErr = true;
                    }

                }
            }

            if($hasErr)
            {
                $loginErr = "Login failed";
            }

        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">

        <fieldset>
            <legend>Login Page</legend>

            <label for = "username">Username: </label>
            <input type = "text" id = "username" name = "username">
            <span> *<?php echo $usernameErr; ?></span>
            <br><br>
            <label for = "password">Password: </label>
            <input type = "password" id = "password" name = "password">
            <span> *<?php echo $passwordErr; ?></span>
            <br><br>
            <?php echo $loginErr; ?>
            <?php echo $loginSuccessful; ?>
            <br><br>
            <input type = "submit" value = "Login">
            
        </fieldset>
    </form>

    <?php
        
    ?>
</body>
</html>