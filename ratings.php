<!DOCTYPE html>
<html>
<head>
    <title>Ratings</title>
    <link rel="stylesheet" href="style.css">	
</head>
<body>

<?php include 'connectdb.php'; ?>

<h2>Add Rating</h2>

<?php
if (isset($_POST['rate'])) {

    $uid = $_POST['userID'];
    $cid = $_POST['contentID'];
    $rating = $_POST['rating'];

    // check if rating exists
    $check = "SELECT * FROM ratings WHERE userID=$uid AND contentID=$cid";
    $res = $conn->query($check);

    if ($res->num_rows > 0) {

        // UPDATE
        $q = "UPDATE ratings 
              SET rating=$rating 
              WHERE userID=$uid AND contentID=$cid";

        echo "Rating updated!";

    } else {

        // INSERT
        $q = "INSERT INTO ratings (userID, contentID, rating)
              VALUES ($uid, $cid, $rating)";

        echo "Rating added!";
    }

    // run query
    if (!$conn->query($q)) {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Rate Content</h2>

<form method="POST">

User:
<select name="userID">
<?php
$res = $conn->query("SELECT userID, name FROM users");
while ($row = $res->fetch_assoc()) {
    echo "<option value='".$row['userID']."'>".$row['name']."</option>";
}
?>
</select><br>

Content:
<select name="contentID">
<?php
$res = $conn->query("SELECT contentID, title FROM content");
while ($row = $res->fetch_assoc()) {
    echo "<option value='".$row['contentID']."'>".$row['title']."</option>";
}
?>
</select><br>

Rating (1–10):
<input type="number" name="rating" min="1" max="10"><br>

<input type="submit" name="rate" value="Submit Rating">

</form>
</body>
</html>
2 <li><a href="index.php">Browse Content</a></li>
</html>
