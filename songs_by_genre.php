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

// Fetch available genres for filtering
$genres = [];
try {
    $stmt = $db->query("SELECT DISTINCT song_genre FROM my_song ORDER BY song_genre ASC");
    $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching genres: " . $e->getMessage();
}

// Fetch songs based on genre filter or default to all songs
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';
$songs = [];
try {
    if ($genre) {
        $stmt = $db->prepare("SELECT * FROM my_song WHERE song_genre = :genre ORDER BY song_title ASC");
        $stmt->bindValue(':genre', $genre);
    } else {
        $stmt = $db->query("SELECT * FROM my_song ORDER BY song_rating ASC");
    }
    $stmt->execute();
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Songs by Genre</title>
</head>
<body>
<div id="wrapper">
    <header>
        <div><img src="images/logo.png" alt="logo" class="logo" width="10%"></div>
        <h1>Songs<?php echo $genre ? " in " . htmlspecialchars($genre) : ""; ?></h1>
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
    <main class="body_2">
        <!-- Genre Filter -->
        <form method="GET" action="">
            <label for="genre">Filter by Genre:</label>
            <select name="genre" id="genre" onchange="this.form.submit()">
                <option value="">All Genres</option>
                <?php foreach ($genres as $g): ?>
                    <option value="<?php echo htmlspecialchars($g['song_genre']); ?>"
                        <?php echo $genre === $g['song_genre'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($g['song_genre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
        <br>
        <!-- Songs Table -->
        <?php if (!empty($songs)): ?>
            <table class="body_1">
                <thead>
                <tr>
                    <th>Genre</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Rating</th>
                </tr>
                </thead>
                <tbody class="body_4">
                <?php foreach ($songs as $song): ?>
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
            <p>No songs found<?php echo $genre ? " for genre " . htmlspecialchars($genre) : ""; ?>!</p>
        <?php endif; ?>
    </main>
</div>
</body>
<footer>
    Copyright &copy; 2024 Song Rating
    <br>
    <a href="mailto:song.rating@gmail.com">
        Song.rating@gmail.com</a>
</footer>
</html>
