<?php
require 'classes/Database.php';
require 'classes/PostRepository.php';

$db_connection = new Database();

// Sanatize user inputs first
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if($post['submitPost']) {
  PostRepository::insertPost($post['title'], $post['body'], $db_connection);
}

if($post['updatePost']) {
  PostRepository::updatePost($post['id'], $post['title'], $post['body'], $db_connection);
}

if($_POST['deletePost']) {
  PostRepository::deletePost($post['post_id'], $db_connection);
}

$db_connection->prepareQuery("SELECT * FROM posts");
$rows = $db_connection->resultSet();
?>

<div>
<h1>Create or Update Post</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <label>Post ID:</label><br>
  <input type="number" name="id" placeholder="Enter ID for update..."/><br>
  <label>Post Title:</label><br>
  <input type="text" name="title" placeholder="Add a title..."/><br>
  <label>Post Message:</label><br>
  <textarea name="body" placeholder="Add a message..."></textarea><br>
  <input type="submit" name="submitPost" value="Submit post"/>
  <input type="submit" name="updatePost" value="Update post"/>
</form>
</div>

<h1>Posts</h1>
<div>
<?php foreach($rows as  $row): ?>
  <div>
    <h3><?php echo '<strong>' . $row['id'] . '</strong>: ' . $row['title']; ?></h3>
    <p><?php echo $row['body']; ?></p><br>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>"/>
        <input type="submit" name="deletePost" value="Delete post"/>
    </form>
  </div>
<?php endforeach; ?>
</div>