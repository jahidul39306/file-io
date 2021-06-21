
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>

    <?php
        $fname = $lname = $gender = $dob = $religion = $presAddress = $permAddress = $phone = $email = $website = $username = $password = "";
        $fnameErr = $lnameErr = $genderErr = $dobErr = $religionErr = $emailErr = $usernameErr = $passwordErr = "";
        $hasErr = false;
        $savingInput = false;
        $filepath = "data.txt";


        if($_SERVER["REQUEST_METHOD"] === "POST"){
           
            if(empty($_POST["fname"])){
               $fnameErr = "First name field is empty";
               $hasErr = true;
            }
                       
            if(empty($_POST["lname"])){
                $lnameErr = "Last name field is empty";
                $hasErr = true;
            }

            if(empty($_POST["gender"])){
                $genderErr = "Gender field is empty";
                $hasErr = true;
            }

            if(empty($_POST["dob"])){
                $dobErr = "Date of birth field is empty";
                $hasErr = true;
            }
            if(empty($_POST["religion"])){
                $religionErr = "Religion field is empty";
                $hasErr = true;
            }
            if(empty($_POST["email"])){
                $emailErr = "Email field is empty";
                $hasErr = true;
            }
            if(empty($_POST["username"])){
                $usernameErr = "User name field is empty";
                $hasErr = true;
            }
            if(empty($_POST["password"])){
                $passwordErr = "Password field is empty";
                $hasErr = true;
            }

            if(!$hasErr){
                $fname = test_input($_POST["fname"]);
                $lname = test_input($_POST["lname"]);
                $gender = test_input($_POST["gender"]);
                $dob = test_input($_POST["dob"]);
                $religion = test_input($_POST["religion"]);
                $presAddress = test_input($_POST["presAddress"]);
                $permAddress = test_input($_POST["permAddress"]);
                $phone = test_input($_POST["phone"]);
                $email = test_input($_POST["email"]);
                $website = test_input($_POST["website"]);
                $username = test_input($_POST["username"]);
                $password = test_input($_POST["password"]); 
                $savingInput = true;
            }

        }

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h1>Registration form</h1>
        
        <fieldset>
            <legend>Basic information:</legend>
            <br>
            <label for = "fname">First Name: </label>
            <input type = "text" id = "fname" name = "fname">
            <span class = "error"> *<?php echo $fnameErr?></span>
            <br><br>

            <label for = "lname">Last Name: </label>
            <input type = "text" id = "lname" name = "lname">
            <span class = "error"> *<?php echo $lnameErr?></span>
            <br><br>
            
            <label for = "gender">Gender: </label>
            <input type = "radio" id = "male" name = "gender" value = "male">
            <label for = "male">Male</label>
            <input type = "radio" id = "female" name = "gender" value = "female">
            <label for = "female">Female</label>
            <input type = "radio" id = "others" name = "gender" value = "others">
            <label for = "others">Others</label>
            <span class = "error"> *<?php echo $genderErr?></span>
            <br><br>

            <label for = "dob">Date of Birth: </label>
            <input type = "date" id = "dob" name = "dob">
            <span class = "error"> *<?php echo $dobErr?></span>
            <br><br>

            <label for = "religion">Religion: </label>
            <select name = "religion" id = "religion">
                <option value = "islam">Islam</option>
                <option value = "hindu">Hindu</option>
                <option value = "christan">Christan</option>
                <option value = "other">Other</option>
            </select>
            <span class = "error"> *<?php echo $religionErr?></span>
            <br>
        </fieldset>

        <br>

        <fieldset>
            <legend>Contact information:</legend>
            <br>

            <label for="presAddress">Present Address:</label>
            <br>
            <textarea id="presAddress" name="presAddress" rows="5" cols="70"></textarea>
            <br><br>

            <label for="permAdd">Permanent Address:</label>
            <br>
            <textarea id="permAddress" name="permAddress" rows="5" cols="70"></textarea>
            <br><br>

            <label for="phone">Phone: </label>
            <input type="tel" id="phone" name="phone">
            <br><br>

            <label for="email">Email: </label>
            <input type="email" id="email" name="email" pattern = ".+@+.+.com">
            <span class = "error"> *<?php echo $emailErr?></span>
            <br><br>
            
            
            <label for="website">Personel Website Link: </label>
            <input type="url" id="website" name="website">
            <br><br>

        </fieldset>

        <br>

        <fieldset>
            <legend>Account Information: </legend>
            <br>

            <label for = "username">Username: </label>
            <input type = "text" id = "username" name = "username">
            <span class = "error"> *<?php echo $usernameErr?></span>
            <br><br>

            <label for = "password">Password: </label>
            <input type = "password" id = "password" name = "password">
            <span class = "error"> *<?php echo $passwordErr?></span>
            <br><br>
        </fieldset>

        <br><br>
        <input type="submit" value="Submit">
        
    </form>
    <?php

    
    if($savingInput)
    {
        $tempFile = file_get_contents($filepath);
        $tempFile = json_decode($tempFile);
        $info = array("fname" => $fname, "lname" => $lname, "gender" => $gender,
                        "dob" => $dob, "religion" => $religion,
                         "presAddress" => $presAddress, "permAddress" => $permAddress,
                         "phone" => $phone, "email" => $email, "website" => $website,
                        "username" => $username, "password" => $password);
        $tempFile[] = $info;
        $infoBank = json_encode($tempFile, JSON_PRETTY_PRINT);
        $result = file_put_contents($filepath, $infoBank);
        if($result)
        {
            echo "<br>Successfully added.";
        }
    }
    
        
    ?>
        
</body>
</html>