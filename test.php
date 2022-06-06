<?php

/*
======================
Question 01: 
======================

Practice class 11

Create a own design registration form

Practice all things which already done in class 11
==================================================================
*/



function input_filter($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



// define variables and set to empty valuses
$name    = $userName = $email = $phone = $password = $gender = $maleChecked = $femaleChecked = $otherChecked = $educationStr = $Division = '';
$nameErr = $userNameErr = $emailErr = $phoneErr = $passErr = $genderErr = $educationErr = '';
$education[] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $_POST['name'];
    $userName = $_POST['userName'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = $_POST['password'];
    $Division = $_POST['Division'];

    //Condition for name input check
    if (empty($name)) {
        $nameErr = 'Name is required';
    } else {
        $name = input_filter($name);
        if (!preg_match('/^[a-zA-z ]*$/i', $name)) {
            $nameErr = 'Only alphabets and whitespace are allowed';
        }
    }
    // Condition for UserName filter  

    if (empty($userName)) {
        $userNameErr = 'User name is required';
    } else {
        $userName = input_filter($userName);
        if (!preg_match('/^[a-zA-Z0-9]*$/', $userName)) {
            $userNameErr = 'Alphabets with no spaces and numeric characters are allowed';
        }
    }

    // Condition for email input filter
    if (empty($email)) {
        $emailErr = 'Email is required';
    } else {
        $email = input_filter($email);
        // check if emmail is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = 'Invalid email format';
        }
    }
    // Condition for phone input check
    if (empty($phone)) {
        $phoneErr = 'Phone is required';
    } else {
        $phone = input_filter($phone);
        if (!preg_match("/^[0-9]{11}$/", $phone)) {
            $phoneErr = "Phone number must be a 11 digit numeric value";
        }
    }

    if (empty($password)) {
        $passErr = 'Password is required';
    }
    if (strlen($password) < 8) {
        $passErr = "Password must be atleast 8 characters";
    } else {
        $password = input_filter($password);


        $number       = preg_match('@[0-9]@', $password);
        $uppercase    = preg_match('@[A-Z]@', $password);
        $lowercase    = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);



        if (!$number || !$uppercase || !$lowercase || !$specialChars) {
            $passErr = "Password must be contain number,uppercase,lowercase,and special characters";
        }
    }

    if (empty($_POST['gender'])) {
        $genderErr = "Gender must be selected";
    }

    if (isset($_POST['gender'])) {
        $gender = $_POST["gender"];
        if ($gender == "Male") {
            $maleChecked = "checked = 'checked'";
        }
        if ($gender == "Female") {
            $femaleChecked = "checked = 'checked'";
        }
        if ($gender == "Others") {
            $otherChecked = "checked = 'checked'";
        }
    }

    if (empty($_POST['education'])) {
        $educationErr = "Education must be selected";
    }

    if (isset($_POST['education'])) {
        $education = $_POST['education'];
        $educationStr = implode(", ", $education);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <title>Form Validation</title>

    <style>
    .error-message {

        color: #FF0000;
    }
    </style>

</head>

<body>

    <div class="container shadow p-5 mt-3">
        <h2 class="text-center">Registration Form</h2>
        <p class="text-center">Please fill this form and choose your subject.</p>
        <form class="form " action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="row">

                <div class="col">


                    <label class="form-label" for="name"><b>Name :</b></label>
                    <input class="form-control" value="<?php echo $name; ?>" type="text" name="name" id="name"
                        placeholder="John Doe">
                    <span class="error-message"><?php if (isset($nameErr)) {
                                                    echo $nameErr;
                                                } ?></span><br>

                </div>
                <div class="col">
                    <label class="form-label" for="userName"><b>User Name :</b></label>
                    <input class="form-control" value="<?php echo $userName; ?>" type="text" name="userName"
                        id="userName" placeholder="johndoe09">
                    <span class="error-message"><?php if (isset($userNameErr)) {
                                                    echo $userNameErr;
                                                } ?></span><br>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <label class="form-label" for="email"><b>Email :</b></label>
                    <input class="form-control" value="<?php echo $email; ?>" type="text" name="email" id="email"
                        placeholder="johndoe@example.com">
                    <span class="error-message"><?php if (isset($emailErr)) {
                                                    echo $emailErr;
                                                } ?></span><br>
                </div>
                <div class="col">
                    <label class="form-label" for="password"><b>Password :</b></label>
                    <input class="form-control" type="password" name="password" id="password"
                        placeholder="Please type a strong password">
                    <span class="error-message"><?php if (isset($passErr)) {
                                                    echo $passErr;
                                                } ?></span>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <?php

                    $DivisionArr = ['Dhaka', 'Barishal', 'Sylhet', 'Chottogram', 'Khulna', 'Mymenshing', 'Rangpur', 'Rajshahi'];

                    ?>
                    <label class="form-label" for="Division"><b>Division :</b></label>
                    <select class="form-select" name="Division" id="Division">
                        <option value="Select Division">Select Division</option>
                        <?php
                        foreach ($DivisionArr as $list) {

                            if ($Division == $list) {
                                echo "<option selected>" . $list . "</option>";
                            } else {
                                echo "<option>" . $list . "</option>";
                            }
                        }

                        ?>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label" for="phone"><b>Phone :</b></label>
                    <input class="form-control" value="<?php echo $phone; ?>" type="text" name="phone" id="phone"
                        placeholder="017xxxxxxxx">
                    <span class="error-message"><?php if (isset($phoneErr)) {
                                                    echo $phoneErr;
                                                } ?></span>
                </div>
            </div><br><br>

            <div class="row">
                <div class="col">
                    <label for="gender"><b>Gender :</b></label><br>
                    <input type="radio" name="gender" id="gender" value="Male" <?php echo $maleChecked; ?>> Male
                    <input type="radio" name="gender" id="gender" value="Female" <?php echo $femaleChecked; ?>> Female
                    <input type="radio" name="gender" id="gender" value="Others" <?php echo $otherChecked; ?>> Others
                    <span class="error-message"><?php if (isset($genderErr)) {
                                                    echo $genderErr;
                                                } ?></span>
                </div>
                <div class="col">
                    <label class="form-check-label" for="education"><b>Education : </b></label>
                    <?php
                    $educationArr = [' CSE', ' EEE', ' BBA', ' B.Sc', ' M.Sc'];
                    foreach ($educationArr as $list) {
                        if (in_array($list, $education)) {
                            echo "<input class='form-check-input' type='checkbox' name='education[]' id='education' value='$list' checked= 'checked'> $list ";
                        } else {
                            echo "<input class='form-check-input' type='checkbox' name='education[]' id='education' value='$list'> $list ";
                        }
                    }


                    ?>

                    <span class="error-message"><?php if (isset($educationErr)) {
                                                    echo $educationErr;
                                                } ?></span>
                </div>

            </div>


            <br><br><input type="submit" name="submit" value="Submit" class="btn btn-primary">


        </form>
        <?php
        if (isset($_POST['submit'])) {
            if ($nameErr == "" && $userNameErr == "" && $emailErr == "" && $phoneErr == "" && $passErr == "" && $genderErr == "" && $educationErr == "") {

                $_POST = [];

                echo "<h3>Thank You! You have successfully registered</h3>";
                echo "<h3> Your Input : </h3>";
                echo '<b>Name :</b> ' . $name . '<br>';
                echo '<b>User Name :</b> ' . $userName . '<br>';
                echo '<b>Email :</b> '  . $email . '<br>';
                echo '<b>Phone :</b> ' . $phone . '<br>';
                echo '<b>Gender :</b> ' . $gender . '<br>';
                echo '<b>Division : </b>' . $Division . '<br>';
                echo '<b>Education : </b>' . $educationStr . '<br>';
            }
        }


        ?>






    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>