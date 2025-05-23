<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/img/favicon/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/img/favicon/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/img/favicon/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('public/img/favicon/site.webmanifest') ?>">

  <link href="<?= base_url('public/css/style.css') ?>" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

  <script src="<?= base_url('public/js/main.js') ?>" defer></script>

  <title><?= isset($page_title) ? "network - $page_title" : "network" ?></title>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1 id="logo"><a href="<?= base_url() ?>">network</a></h1>

      <?php if(loggedIn() && isset($user_info)): ?>
        <ul id="options">
          <li><img id="toggle-search" class="icon" src="<?= base_url('public/img/Search.svg') ?>" alt="Search"></li>
          <li><a href="<?= base_url('explore') ?>"><img class="icon" src="<?= base_url('public/img/Explore.svg') ?>" alt="Explore"></a></li>
          <li><a href="<?= base_url('likes') ?>"><img class="icon" src="<?= base_url('public/img/Like-Black.svg') ?>" alt="Likes"></a></li>
          <li><a href="<?= base_url('friends') ?>"><img class="icon" src="<?= base_url('public/img/Friends.svg') ?>" alt="Friends"></a></li>
          <li><img id="toggle-menu" src="<?= base_url("uploads/profile-pictures/$user_info->user_profile_picture") ?>" alt="Toggle Menu"></li>
        </ul>

        <div class="search">
          <form action="<?= base_url('search') ?>" method="GET">
            <input type="text" name="s" placeholder="Search" value="<?= isset($keywords) ? str_replace('%', '', $keywords) : '' ?>">
          </form>
        </div>

        <div class="menu">
          <ul>
            <a href="<?= base_url("profile/" . escape($user_info->user_username)) ?>"><li>Your Profile</li></a>
            <a href="<?= base_url('update') ?>"><li>Update Profile</li></a>
            <a href="<?= base_url('logout') ?>"><li>Log out</li></a>
          </ul>
        </div>
      <?php endif; ?>
    </div>