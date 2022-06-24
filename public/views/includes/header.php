<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="180x180" href="<?=BASE_URL?>/public/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=BASE_URL?>/public/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?=BASE_URL?>/public/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?=BASE_URL?>/public/img/favicon/site.webmanifest">
  <link href="<?php echo BASE_URL; ?>/public/css/style.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;700&display=swap" rel="stylesheet">
  <script src="<?php echo BASE_URL; ?>/public/js/main.js" defer></script>
  <title><?=isset($page_title) ? 'network - ' . $page_title : 'network'?></title>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1 id="logo"><a href="/">network</a></h1>

      <?php if(loggedIn()): ?>
        <ul id="options">
          <li><img id="toggle-search" src="<?=BASE_URL?>/public/img/Search.svg" alt="Search"></li>
          <li><a href="/explore"><img src="<?=BASE_URL?>/public/img/Explore.svg" alt="Explore"></a></li>
          <li><img id="toggle-menu" src="/uploads/profile-pictures/<?=escape($user_info->user_profile_picture)?>" alt="Toggle Menu"></li>
        </ul>

        <div class="search">
          <form action="/search" method="POST">
            <input type="text" name="s" placeholder="Search" value="<?=isset($keywords) ? str_replace('%', '', $keywords) : ''?>">
          </form>
        </div>

        <div class="menu">
          <ul>
            <a href="/profile/<?=escape($user_info->user_username)?>"><li>Your Profile</li></a>
            <a href="/update"><li>Update Profile</li></a>
            <a href="/logout"><li>Log out</li></a>
          </ul>
        </div>
      <?php endif; ?>
    </div>