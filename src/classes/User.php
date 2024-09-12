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

  public function deleteProfile($user) {
    if($this->db->delete('users', array('user_id' => $user))) {
      return true;
    }

    return false;
  }

  public function search($keywords, $start) {
    $query = $this->db->query("SELECT
                                SQL_CALC_FOUND_ROWS
                                *
                              FROM
                                users
                              WHERE
                                user_name
                              LIKE
                                ?
                              OR
                                user_username
                              LIKE
                                ?
                              ORDER BY
                                user_joined
                              DESC
                              LIMIT
                                {$start}, 10
    ", [$keywords, $keywords]);

    return $query->fetchAll();
  }

  public function friend($friend) {
    if($this->db->insert('friends', $friend)) {
      return true;
    }

    return false;
  }

  public function unfriend($friend) {
    if($this->db->delete('friends', ['friend_user' => $friend['friend_user'], 'friend_friend' => $friend['friend_friend']])) {
      $this->db->delete('friends', ['friend_user' => $friend['friend_friend'], 'friend_friend' => $friend['friend_user']]);

      return true;
    }

    return false;
  }

  public function getFriendRequests($user) {
    $query = $this->db->query("SELECT * FROM friends LEFT JOIN users ON users.user_id = friends.friend_user WHERE friend_friend = ? AND friend_accepted = 0 ORDER BY friend_id DESC", [$user]);

    return $query->fetchAll();
  }

  public function acceptFriendRequest($user, $friend) {
    if($this->db->update('friends', ['friend_accepted' => 1], ['friend_user' => $user, 'friend_friend' => $friend])) {
      return true;
    }

    return false;
  }

  public function declineFriendRequest($user, $friend) {
    if($this->db->delete('friends', ['friend_user' => $user, 'friend_friend' => $friend])) {
      return true;
    }

    return false;
  }

  public function isFriendRequestPending($user, $friend) {
    if($this->db->exists('friends', ['friend_user' => $friend, 'friend_friend' => $user, 'friend_accepted' => 0])) {
      return true;
    }

    return false;
  }
  
  public function isFriends($user, $friend) {
    if($this->db->exists('friends', ['friend_user' => $user, 'friend_friend' => $friend])) {
      return true;
    } else if($this->db->exists('friends', ['friend_user' => $friend, 'friend_friend' => $user])) {
      return true;
    } else {
      return false;
    }
  }

  public function friendsOf($user) {
    $query = $this->db->query("SELECT * FROM friends LEFT JOIN users ON users.user_id = friends.friend_friend WHERE friends.friend_user = $user AND friends.friend_accepted = 1");

    return $query->fetchAll();
  }

  public function friendsTo($user) {
    $query = $this->db->query("SELECT * FROM friends LEFT JOIN users ON users.user_id = friends.friend_user WHERE friends.friend_friend = $user AND friends.friend_accepted = 1");

    return $query->fetchAll();
  }
}