<?php

$dsn = 'mysql:host=localhost;dbname=my_rating';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('database_error.php');
    exit();
}
// Fetch the genre list from the database
$songs_1 = [];
try {
    $stmt = $db->query("SELECT * FROM my_song ORDER BY song_rating ASC");
    $songs_1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching genre: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="project.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <title>Genre</title>
</head>
<body>
<div id="wrapper">
    <header>
        <div><img src="images/logo.png" alt="logo" class="logo" width="10%"></div>
        <h1>Genre</h1>
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
    <main class="body_2">
        <h2>Current Genre List</h2>
        <?php if (!empty($songs_1)): ?>
            <table class="body_5">
                <thead>
                <tr>
                    <th>Genre:</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($songs_1 as $song): ?>
                    <tr>
                        <td>
                            <a href="songs_by_genre.php?genre=<?php echo urlencode($song['song_genre']); ?>">
                                <?php echo htmlspecialchars($song['song_genre']); ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No songs in the list!</p>
        <?php endif; ?>
    </main>
    <br>
</div>
</body>
<footer>
    Copyright &copy; 2024 Song Rating
    <br>
    <a href="mailto:song.rating@gmail.com">
        Song.rating@gmail.com</a>
</footer>
</html>
