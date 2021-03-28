<?php
class PostRepository {
  static function insertPost($title, $body, $db_conn) {
    $db_conn->prepareQuery("INSERT INTO posts (title, body) VALUES(:title, :body)");
    $db_conn->bindQueryParam(':title', $title);
    $db_conn->bindQueryParam(':body', $body);
    $db_conn->excecuteQuery();
    if ($db_conn->fetchLastInsertId()) {
      header("Location: " . $_SERVER['PHP_SELF']);
    } else {
      echo "Ooops. Something got wrong. Please try again.";
    }
  }
  
  static function updatePost($post_id, $title, $body, $db_conn) {
    $db_conn->prepareQuery("UPDATE posts SET title = :title, body = :body WHERE id = :id");
    $db_conn->bindQueryParam(':id', $post_id);
    $db_conn->bindQueryParam(':title', $title);
    $db_conn->bindQueryParam(':body', $body);
    $db_conn->excecuteQuery();
    header("Location: " . $_SERVER['PHP_SELF']);
  }
  
  static function deletePost($post_id, $db_conn) {
    $db_conn->prepareQuery("DELETE FROM posts WHERE id = :id");
    $db_conn->bindQueryParam(':id', $post_id);
    $db_conn->excecuteQuery();
    header("Location: " . $_SERVER['PHP_SELF']);
  }
}