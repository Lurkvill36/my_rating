<?php
// get the data from the first name text input
$fname = filter_input(INPUT_POST, 'fname');

// get the data from the first name text input
$lname = filter_input(INPUT_POST, 'lname');

// get the data from the email text input
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//get the data from the phone number input
$phone = filter_input(INPUT_POST, 'tel');

//get the data from the radio input
$refer = filter_input(INPUT_POST, 'heard_from');

// get the comments from the textarea
$comments = filter_input(INPUT_POST, 'comments');
//$comments = nl2br($comments, false);
?>
<html>
<head>
    <title>Account Information</title>
    <link rel="stylesheet" href="project.css"/>
</head>
    <body>
    <div id="wrapper">
        <main class="body_1">
            <h1>Contact Information</h1>

            <label>First Name:</label>
            <span><?php echo htmlspecialchars($fname); ?></span><br>

            <label>Last Name:</label>
            <span><?php echo htmlspecialchars($lname); ?></span><br>

            <label>Email Address:</label>
            <span><?php echo htmlspecialchars($email); ?></span><br>

            <label>Phone Number:</label>
            <span><?php echo htmlspecialchars($phone); ?></span><br>

            <label>Need help with:</label>
            <span><?php
                if ($refer === null) {
                    $refer = 'unknown';
                }
                echo htmlspecialchars($refer); ?></span><br>

            <span>Comments:</span><br>
            <span><?php echo $comments; ?></span><br>
        </main>
    </div>
    </body>
</html>
