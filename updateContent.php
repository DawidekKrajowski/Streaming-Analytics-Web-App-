<!DOCTYPE html>
<html>
<head>
    <title>Update Content</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'connectdb.php'; ?>

<h2>Update Content</h2>

<form method="post">
Content ID: <input name="id"><br>
New Title: <input name="title"><br>
New Age Rating: <input name="rating"><br>
New Language: <input name="language"><br>

<input type="submit">
</form>

<?php
if ($_POST) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $rating = $_POST['rating'];
    $lang = $_POST['language'];

    $q = "UPDATE content 
          SET title='$title', ageRating='$rating', language='$lang'
          WHERE contentID=$id";

    if ($conn->query($q)) {
        echo "Updated!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
<li><a href="index.php">Browse Content</a></li>

</body>
</html>
