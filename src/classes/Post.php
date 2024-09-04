<?php
class Post {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function createPost($data) {
    if($this->db->insert('posts', $data)) {
      return true;
    }

    return false;
  }

  public function getHomepagePosts($user, $start) {
    $query = $this->db->query("SELECT
                                SQL_CALC_FOUND_ROWS
                                *
                              FROM
                                posts
                              LEFT JOIN
                                users
                              ON
                                users.user_id = posts.post_by
                              WHERE
                                (post_by = users.user_id AND users.user_id = ?)
                              OR
                                (post_by = users.user_id AND post_by
                              IN
                                (SELECT
                                  friend_friend
                                FROM
                                  friends
                                WHERE
                                  friend_user = ? AND friend_accepted = 1))
                                OR
                                 (post_by = users.user_id AND post_by
                                IN
                                  (SELECT
                                    friend_user
                                  FROM
                                    friends
                                  WHERE
                                    friend_friend = ? AND friend_accepted = 1))
                              ORDER BY
                                post_date
                              DESC
                              LIMIT
                                {$start}, 10
    ", [$user, $user, $user]);

    return $query->fetchAll();
  }

  public function getProfilePosts($profile, $start) {
    $query = $this->db->query("SELECT
                                SQL_CALC_FOUND_ROWS
                                *
                              FROM
                                posts
                              LEFT JOIN
                                users
                              ON
                                users.user_id = posts.post_by
                              WHERE
                                posts.post_profile = ?
                              ORDER BY
                                posts.post_date
                              DESC
                              LIMIT
                                {$start}, 10
    ", [$profile]);

    return $query->fetchAll();
  }

  public function getPublicPosts($start) {
    $query = $this->db->query("SELECT
                                SQL_CALC_FOUND_ROWS
                                *
                              FROM
                                posts
                              LEFT JOIN
                                users
                              ON
                                users.user_id = posts.post_by
                              ORDER BY
                                posts.post_date
                              DESC
                              LIMIT
                                {$start}, 10
    ");

    return $query->fetchAll();
  }

  public function getPost($post) {
    $query = $this->db->query("SELECT
                                *
                              FROM
                                posts
                              LEFT JOIN
                                users
                              ON
                                users.user_id = posts.post_by
                              WHERE
                                posts.post_id = ?
                              LIMIT 1
    ", [$post]);

    return $query->fetch();
  }

  public function editPost($data, $post) {
    if($this->db->update('posts', $data, array('post_id' => $post))) {
      return true;
    }

    return false;
  }

  public function deletePost($post) {
    if($this->db->delete('posts', array('post_id' => $post))) {
      return true;
    }

    return false;
  }

  public function createComment($data) {
    if($this->db->insert('comments', $data)) {
      return true;
    }

    return false;
  }

  public function getComments($post) {
    $query = $this->db->query("SELECT * FROM comments LEFT JOIN users ON users.user_id = comments.comment_by WHERE comment_post = ? ORDER BY comment_date DESC", [$post]);

    return $query->fetchAll();
  }

  public function getComment($comment) {
    if($stmt = $this->db->select('comments', array('comment_id' => $comment))) {
      return $stmt->fetch();
    }

    return false;
  }

  public function editComment($data, $comment) {
    if($this->db->update('comments', $data, array('comment_id' => $comment))) {
      return true;
    }

    return false;
  }

  public function deleteComment($comment) {
    if($this->db->delete('comments', array('comment_id' => $comment))) {
      return true;
    }

    return false;
  }

  public function like($like) {
    if($this->db->insert('likes', $like)) {
      return true;
    }

    return false;
  }

  public function unlike($like) {
    if($this->db->delete('likes', array('like_user' => $like['like_user'], 'like_post' => $like['like_post']))) {
      return true;
    }

    return false;
  }

  public function getLikesData($post) {
    if($stmt = $this->db->select('likes', array('like_post' => $post))) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return false;
  }
}