<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="info">
    <img src="<?=BASE_URL?>/uploads/profile-pictures/<?=$user_info->user_profile_picture?>">
    <h2><?=$user_info->user_name?></h2>
    <h5>@<?=$user_info->user_username?></h5>
  </div>
  <div class="posts">
    <?php if(!$posts): ?>
      <h3 class="message">Welcome to network. Make a post or follow a user.</h3>
    <?php else: ?>
      <?php foreach($posts as $post): ?>
        <div class="post" onclick="location.href='/post?p=<?=$post->post_id?>'">
          <h5><a href="/profile?u=<?=$post->user_username?>"><?=$post->user_name?></a></h5>
          <h6><?=date('j F Y H:i', strtotime($post->post_date))?></h6>

          <?php if(strlen($post->post_content) > 140): ?>
            <p><?=substr($post->post_content, 0, 140) . '...'?></p>
          <?php else: ?>
            <p><?=$post->post_content?></p>
          <?php endif; ?>

          <?php if($post->post_by == $user_info->user_id): ?>
            <span class="options">
              <a href="/edit?p=<?=$post->post_id?>">Edit</a>
              <a href="/delete?p=<?=$post->post_id?>">Delete</a>
            </span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>