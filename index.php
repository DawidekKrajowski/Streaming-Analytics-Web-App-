<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dawid Streaming Platform</title>
    <link rel = "stylesheet" href = "style.css">
</head>

<body>

<?php
include 'connectdb.php';
?>

<h1>Streaming & Content Analytics Platform</h1>

<h2>Content</h2>
<ul>
    <li><a href="index.php">Browse Content</a></li>
    <li><a href="addContent.php">Add Movie or TV Series</a></li>
    <li><a href="updateContent.php">Update Content</a></li>
    <li><a href="deleteContent.php">Delete Content</a></li>
</ul>

<h2>Users</h2>
<ul>
    <li><a href="users.php">View User Viewing History</a></li>
</ul>

<h2>Ratings</h2>
<ul>
    <li><a href="ratings.php">Manage Ratings</a></li>
</ul>

<h2>Subscription Plans</h2>
<ul>
    <li><a href="plans.php">View / Update Plans</a></li>
</ul>

<hr>

<h2>All Content</h2>

<form method="get">
    Sort by:
    <select name="sort">
        <option value="title">Title</option>
        <option value="year">Year</option>
    </select>

    Order:
    <select name="order">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
    </select>

    <input type="submit" value="Sort">
</form>

<?php
$sort = $_GET['sort'] ?? 'title';
$order = $_GET['order'] ?? 'ASC';

if ($sort == 'year') {
    $sort = 'releaseYear';
}

$query = "SELECT * FROM content ORDER BY $sort $order";
$result = $conn->query($query);


echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Title</th>
        <th>Type</th>
        <th>Year</th>
        <th>Action</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
   echo "<tr>";  
     echo "<td><a href='viewContent.php?id=".$row['contentID']."'>".$row['title']."</a></td>";
    echo "<td>".$row['type']."</td>";
    echo "<td>".$row['releaseYear']."</td>";
 echo "<td><a href='index.php?edit=".$row['contentID']."'>Edit</a></td>";
    echo "</tr>";
}

echo "</table>";

if (isset($_GET['edit'])) {

    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM content WHERE contentID=$id");
    $row = $result->fetch_assoc();

    echo "<h2>Edit Content</h2>";

    echo "<form method='POST' action='index.php'>";

    // 🔒 THIS IS SAFE (hidden ID)
    echo "<input type='hidden' name='contentID' value='".$row['contentID']."'>";

    echo "Title: <input type='text' name='title' value='".$row['title']."'><br>";

    echo "Age Rating: <input type='text' name='ageRating' value='".$row['ageRating']."'><br>";

    echo "Language: <input type='text' name='language' value='".$row['language']."'><br>";

    echo "<button type='submit' name='update'>Update</button>";

    echo "</form>";
}

$conn->close();
?>

</body>
</html>
