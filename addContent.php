<!DOCTYPE html>
<html>
<head>
    <title>Add Content</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'connectdb.php'; ?>

<h2>Add Content</h2>

<form method="post">
Title: <input name="title"><br>
Type:
<select name="type">
    <option value="movie">Movie</option>
    <option value="series">TV Series</option>
</select><br>

Year: <input name="year"><br>
Age Rating: <input name="rating"><br>
Language: <input name="language"><br>
Duration (minutes only): <input name="duration"><br>

<input type="submit" value="Add">
</form>

<?php
if ($_POST) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $year = $_POST['year'];
    $rating = $_POST['rating'];
    $lang = $_POST['language'];
    $duration = $_POST['duration'];

    if ($type == "movie") {
        $q = "INSERT INTO content (title,type,releaseYear,ageRating,language,duration)
              VALUES ('$title','$type',$year,'$rating','$lang',$duration)";
    } else {
        $q = "INSERT INTO content (title,type,releaseYear,ageRating,language)
              VALUES ('$title','$type',$year,'$rating','$lang')";
    }


    if ($conn->query($q)) {
        echo "Content added!";
	$id = $conn->insert_id;	
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<li><a href="index.php">Browse Content</a></li>

</body>
</html>
