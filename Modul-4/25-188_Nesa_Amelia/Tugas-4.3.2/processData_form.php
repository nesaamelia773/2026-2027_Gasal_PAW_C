<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        fieldset {
            background-color: #ddddff;
            border: 1px solid #999;
            padding: 10px;
            width: 430px;
        }

        legend {
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        td {
            padding: 2px;
            vertical-align: top;
        }

        td:first-child {
            text-align: right;
            width: 120px;
        }

        input[type="text"],
        input[type="password"],
        textarea,
        select {
            font-family: Arial, sans-serif;
            font-size: 10px;
            width: 175px;
            box-sizing: border-box;
        }

        textarea {
            height: 35px;
            resize: vertical;
        }

        .buttons {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
$errors = array();

if (isset($_POST['surname']))
{
    require 'validate.inc';

    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'password');
    validateRequired($errors, $_POST, 'address');
    validateRequired($errors, $_POST, 'state');
    validateRequired($errors, $_POST, 'gender');

    if ($errors)
    {
        echo '<h1>Invalid, correct the following errors:</h1>';

        foreach ($errors as $field => $error)
            echo "$field $error<br/>";

        // tampilkan kembali form
        include 'form.inc';
    }
    else
    {
        echo 'Form submitted successfully with no errors';
    }
}
else
{
    // tampilkan kembali form
    include 'form.inc';
}
?>
</body>
</html>