<?php
class User {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function register($data) {
    $hashed_password = password_hash($data['user_password'], PASSWORD_BCRYPT);

    try {
      $this->db->query(
        "INSERT INTO
          users (user_name, user_username, user_email, user_password)
        VALUES
          (?, ?, ?, ?)",
        [$data['user_name'], $data['user_username'], $data['user_email'], $hashed_password]
      );

      $user_id = $this->db->pdo->lastInsertId();

      $_SESSION['user_id'] = $user_id;

      return true;
    } catch(Exception $e) {
      return false;
    }
  }

  public function login($user, $remember = false) {
    if($this->db->exists('users', array('user_username' => $user['user_username']))) {
      $stmt = $this->db->select('users', array('user_username' => $user['user_username']));

      $row = $stmt->fetch();

      if(password_verify($user['user_password'], $row->user_password)) {
        $_SESSION['user_id'] = $row->user_id;

        if($remember) {
          $this->createRememberToken($row->user_id);
        }

        return true;
      }
    }

    return false;
  }

  public function createRememberToken($id) {
    $token = random(32);
    $hashed_token = password_hash($token, PASSWORD_DEFAULT);
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $expires = date('Y-m-d H:i:s', strtotime('+30 days'));

    $this->db->query("DELETE FROM remember_tokens WHERE remember_user = ?", [$id]);

    $this->db->query(
      "INSERT INTO
        remember_tokens (remember_user, remember_token, user_agent, expires_at)
      VALUES
        (?, ?, ?, ?)",
      [$id, $hashed_token, $user_agent, $expires]);

    setcookie('remember_token', $token, [
      'expires' => strtotime('+30 days'),
      'path' => '/',
      'secure' => true,
      'httponly' => true,
      'samesite' => 'Lax'
    ]);
  }

  public function checkRememberToken() {
    if(isset($_SESSION['user_id'])) {
      return;
    }

    if(!isset($_COOKIE['remember_token'])) {
      return;
    }

    $token = $_COOKIE['remember_token'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $query = $this->db->query(
      "SELECT
        remember_user, remember_token
      FROM
        remember_tokens
      WHERE
        user_agent = ?
      AND
        expires_at > NOW()
      LIMIT 1",
      [$user_agent]);

    $row = $query->fetch();

    if($row && password_verify($token, $row->remember_token)) {
      $_SESSION['user_id'] = $row->remember_user;

      $this->createRememberToken($row->remember_user);
    } else {
      setcookie('remember_token', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
      ]);
    }
  }

  public function isLoggedIn() {
    return isset($_SESSION['user_id']) ? true : false;
  }

  public function getLoggedInUserInfo() {
    $stmt = $this->db->select('users', array('user_id' => $_SESSION['user_id']));

    return $stmt->fetch();
  }

  public function logout() {
    if(isset($_SESSION['user_id'])) {
      $this->db->query("DELETE FROM remember_tokens WHERE remember_user = ?", [$_SESSION['user_id']]);
    }

    $_SESSION = [];

    session_destroy();

    if(isset($_COOKIE['remember_token'])) {
      setcookie('remember_token', '', time() - 3600, '/', '', true, true);
    }
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
    $query = $this->db->query(
      "SELECT
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
    $query = $this->db->query(
      "SELECT
        *
      FROM
        friends
      LEFT JOIN
        users
      ON
        users.user_id = friends.friend_user
      WHERE
        friend_friend = ?
      AND
        friend_accepted = 0
      ORDER BY
        friend_id
      DESC",
      [$user]
    );

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
    $query = $this->db->query(
      "SELECT
        *
      FROM
        friends
      LEFT JOIN
        users
      ON
        users.user_id = friends.friend_friend
      WHERE
        friends.friend_user = $user
      AND
        friends.friend_accepted = 1"
    );

    return $query->fetchAll();
  }

  public function friendsTo($user) {
    $query = $this->db->query(
      "SELECT 
        *
      FROM
        friends
      LEFT JOIN
        users
      ON
        users.user_id = friends.friend_user
      WHERE
        friends.friend_friend = $user
      AND
        friends.friend_accepted = 1"
    );

    return $query->fetchAll();
  }
}