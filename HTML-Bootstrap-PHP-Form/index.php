<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .error {
            color: red;
            font-weight: bold;
        }
    </style>




    <title>HTML-Bootstrap-PHP Form</title>

</head>

<body>
    <?php

    $nameErrorMessage = "";
    $emailErrorMessage = "";
    $webError ="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $email = $age = $website = $comment = $gender = "";

        if (empty($_POST["name"])) {
            $nameErrorMessage = "İsim alanı boş bırakılmaz.";
        } else if (empty($_POST["email"])) 
        {
            $emailErrorMessage = "E-mail is required.";
        } 
        else if (!preg_match("/^[a-zA-Z-' ]*$/", security($_POST["name"]))) 
        {
            $nameErrorMessage = "The name field does not contain special characters.";
        }
         else if (!filter_var(security($_POST["email"]), FILTER_VALIDATE_EMAIL)) 
         {
            $emailErrorMessage = "This e-mail is not valid.";
        } 
        else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",security($_POST["website"]))) {
            $webError="Please enter valid url.";
        } 
        else {
            echo "girmiş olduğunuz veriler <br>";
            $name = security($_POST["name"]);
            $email = security($_POST["email"]);
            $age = security($_POST["age"]);
            $website = security($_POST["website"]);
            $comment = security($_POST["comment"]);
            $gender = security($_POST["gender"]);

            echo $name . "<br>" . $email . "<br>" . $age . "<br>" . $website . "<br>" . $comment . "<br>" . $gender;
        }
    }

    function security($value)
    {

        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mt-3 bg-light">
                    <div class="card-body">
                        <span class="error">* Required Fields</span> <br> <br>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="mb-3">
                                <label>Your Name</label>
                                <input type="text" class="form-control" name="name">
                                <div id="emailHelp" class="form-text text-muted">* </div>
                                <small class="error"> <?php echo $nameErrorMessage; ?></small>
                            </div>
                            <div class="mb-3">
                                <label>E-mail</label>
                                <input type="text" class="form-control" name="email">
                                <div id="emailHelp" class="form-text text-muted">* </div>
                                <small class="error"> <?php echo $emailErrorMessage; ?></small>

                            </div>

                            <div class="mb-3">
                                <label>Web Site</label>
                                <input type="text" class="form-control" name="website">
                                <small class="error"> <?php echo $webError; ?></small>
                            </div>

                            <div class="mb-3">
                                <label>Age</label>
                                <select class="form-select" name="age">
                                    <option selected>Your Age</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="55">55</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Your Comment</label>
                                <textarea name="comment" class="form-control mb-3" rows=5"></textarea>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Women">
                                <label class="form-check-label">Women</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Man">
                                <label class="form-check-label">Man</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Other">
                                <label class="form-check-label">Other</label>
                            </div>
                            <br><br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>