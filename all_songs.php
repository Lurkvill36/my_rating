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

// Handle form submission to add a song
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_song'])) {
    $song_genre = trim($_POST['song_genre']);
    $song_title = trim($_POST['song_title']);
    $song_artist = trim($_POST['song_artist']);
    $song_rating = trim($_POST['song_rating']);

    if (!empty($song_genre) && !empty($song_title) && !empty($song_artist) && !empty($song_rating)) {
        // Insert the new song into the database using a prepared statement
        $stmt = $db->prepare("INSERT INTO my_song (song_genre, song_title, song_artist, song_rating) 
                              VALUES (:genre, :title, :artist, :rating)");
        $stmt->execute([
            ':genre' => $song_genre,
            ':title' => $song_title,
            ':artist' => $song_artist,
            ':rating' => $song_rating
        ]);
        echo "New song added successfully!";
    } else {
        echo "All fields are required.";
    }
}

// Fetch the song list from the database
$songs_1 = [];
try {
    $stmt = $db->query("SELECT * FROM my_song ORDER BY song_rating ASC");
    $songs_1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching songs: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="project.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <title>All Songs</title>
</head>
<body>
<div id="wrapper">
    <header>
        <div><img src="images/logo.png" alt="logo" class="logo" width="10%"></div>
        <h1>All Songs</h1>
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
    <main class="body_1">
        <h1>Song List</h1>

        <!-- Form to add a song -->
        <form method="post" action="">
            <label for="song_genre">Song Genre:</label>
            <input type="text" id="song_genre" name="song_genre" required>
            <label for="song_title">Song Title:</label>
            <input type="text" id="song_title" name="song_title" required>
            <label for="song_artist">Artist:</label>
            <input type="text" id="song_artist" name="song_artist" required>
            <label for="song_rating">Rating:</label>
            <input type="range" min="0" max="5" id="song_rating" name="song_rating" list="value" required>
            <button type="submit" name="add_song">Add Song</button>
        </form>
        <h2>Current Songs:</h2>
        <?php if (!empty($songs_1)): ?>
            <table class="body_1">
                <thead>
                <tr>
                    <th>Genre</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Rating</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($songs_1 as $song): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($song['song_genre']); ?></td>
                        <td><?php echo htmlspecialchars($song['song_title']); ?></td>
                        <td><?php echo htmlspecialchars($song['song_artist']); ?></td>
                        <td><?php echo htmlspecialchars($song['song_rating']); ?></td>
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