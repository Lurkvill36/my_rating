<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="project.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <title>Contact Us</title>
</head>
<body>
    <div id="wrapper">
        <header>
            <div><img src="images/logo.png" alt="logo" class="logo" width="10%"></div>
            <h1>Contact Us</h1>
        </header>
        <nav>
            <ul>
                <a href="index.php">Home</a>
                <a href="all_songs.php">All Songs</a>
                <a href="genre.php">Genre</a>
                <a href="contact_us.php">Contact Us</a>
                <a href="about_us.php">About Us</a>
            </ul>
        </nav>
        <br><br>
        <main class="body_3">
            <form action="contact_results.php" method="post">

                <fieldset>
                    <legend>Contact:</legend>
                <form>
                    First Name: <br>
                    <input type="text" name="fname" id="fname">
                    <br><br>

                    Last Name: <br>
                    <input type="text" name="lname" id="lname">
                    <br><br>

                    Email: <br>
                    <input type="email" name="email" id="email">
                    <br><br>

                    Phone Number: <br>
                    <input type="tel" name="tel" id="tel">
                    <br><br>

                        <p>Need help with:</p>
                        <input type="radio" name="heard_from" value="Rate">
                        Rating<br>
                        <input type="radio" name="heard_from" value="Mistake/Correction">
                        Mistake/Correct<br>
                        <input type=radio name="heard_from" value="Add Song">
                        Add Song<br>
                        <input type=radio name="heard_from" value="Help">
                        Help<br>
                        <input type=radio name="heard_from" value="Other">
                        Other<br>

                    <br>

                    Details:<br>
                    <textarea name="comments" rows="4" cols="40" placeholder=" Write Details Here"></textarea>
                    <br><br>

                    <input type="hidden" name="sendto" id="sendto" value="order@site.com">

                    <input type="submit" value="Submit">
                    <input type="reset">
                </form>
                </fieldset>
        </main>
        <br>
    </div>
</body>
    <footer class="footer">
        Copyright &copy; 2024 Song Rating
        <br>
        <a href="mailto:song.rating@gmail.com">
            Song.rating@gmail.com</a>
    </footer>
</html>