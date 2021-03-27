<?php
require 'classes/Database.php';

$db_connection = new Database();
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if($post['submitPost']) {
  $title = $post['title'];
  $body = $post['body'];
  $db_connection->prepareQuery("INSERT INTO posts (title, body) VALUES(:title, :body)");
  $db_connection->bindQueryParam(':title', $title);
  $db_connection->bindQueryParam(':body', $body);
  $db_connection->excecuteQuery();
  if ($db_connection->fetchLastInsertId()) {
    header("Location: " . $_SERVER['PHP_SELF']);
  } else {
    echo "Ooops. Something got wrong. Please try again.";
  }
}

// select a specific entry
// $db_connection->prepareQuery("select * from posts where id = :id");
// $db_connection->bindQueryParam(':id', 1);
$db_connection->prepareQuery("SELECT * FROM posts");
$rows = $db_connection->resultSet();
?>
<h1>Create Post</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <label>Post Title:</label><br>
  <input type="text" name="title" placeholder="Add a title..."/><br>
  <label>Post Message:</label><br>
  <textarea name="body" placeholder="Add a message..."></textarea><br>
  <input type="submit" name="submitPost" value="Submit post"/>
</form>
<h1>Posts</h1>
<div>
<?php foreach($rows as  $row): ?>
  <div>
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['body']; ?></p>
  </div>
<?php endforeach; ?>
</div>