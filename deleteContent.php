<!DOCTYPE html>
<html>
<head>
    <title>Delete Content</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'connectdb.php'; ?>

<h2>Delete Content</h2>

<form method="post" onsubmit="return confirm('Are you sure you want to delete this?');">
Content ID: <input name="id"><br>
<input type="submit" value="Delete">
</form>

<?php
if ($_POST) {
    $id = $_POST['id'];

    $q = "DELETE FROM content WHERE contentID=$id";

    if ($conn->query($q)) {
        echo "Deleted!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
<li><a href="index.php">Browse Content</a></li>

</body>
</html>
