<?php
class User {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function createUser($data) {
    if($this->db->insert('users', $data)) {
      return true;
    }

    return false;
  }

  public function checkUser($user) {
    if($this->db->exists('users', array('user_username' => $user['user_username']))) {
      $stmt = $this->db->select('users', array('user_username' => $user['user_username']));

      $row = $stmt->fetch();

      if(password_verify($user['user_password'], $row->user_password)) {
        return true;
      }
    }

    return false;
  }

  public function logout() {
    session_destroy();

    return;
  }

  public function getUser($user) {
    if(is_numeric($user)) {
      $stmt = $this->db->select('users', array('user_id' => $user));
    } else {
      $stmt = $this->db->select('users', array('user_username' => $user));
    }

    return $stmt->fetch();
  }

  public function updateProfile($data, $user) {
    if($this->db->update('users', $data, array('user_id' => $user))) {
      return true;
    }

    return false;
  }

  public function updatePassword($password, $user) {
    if($this->db->update('users', $password, array('user_id' => $user))) {
      return true;
    }

    return false;
  }

  public function deleteProfile($user) {
    if($this->db->delete('users', array('user_id' => $user))) {
      return true;
    }

    return false;
  }

  public function search($keywords) {
    $sql = "SELECT * FROM users WHERE user_name LIKE ? OR user_username LIKE ? ORDER BY user_joined DESC";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);

    if($stmt->execute()) {
      return $stmt->fetchAll();
    }

    return false;
  }

  public function follow($follow) {
    if($this->db->insert('follows', $follow)) {
      return true;
    }

    return false;
  }

  public function unfollow($follow) {
    if($this->db->delete('follows', array('follow_user' => $follow['follow_user'], 'follow_follow' => $follow['follow_follow']))) {
      return true;
    }

    return false;
  }

  public function getFollowsData($user) {
    if($stmt = $this->db->select('follows', array('follow_follow' => $user))) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return false;
  }
}