<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="sidebar">
    <div class="info">
      <img src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($user_info->user_profile_picture)?>">
      <h2><?=escape($user_info->user_name)?></h2>
      <h5>@<?=escape($user_info->user_username)?></h5>
    </div>
    <div class="info">
      <h3>Your Follows</h3>

      <?php if(!$follows): ?>
        <p>You aren't following anyone yet</p>
      <?php else: ?>
        <?php foreach($follows as $follow): ?>
          <a href="/profile/<?=escape($follow->user_username)?>"><img class="follow-img" src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($follow->user_profile_picture)?>"></a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
  
  <div class="posts">
    <?php if(!$posts): ?>
      <h3 class="message">Welcome to network. Make a post or follow a user.</h3>
    <?php else: ?>
      <?php foreach($posts as $post): ?>
        <div class="post" onclick="location.href='/post/<?=escape($post->post_id)?>'">
          <h5><a href="/profile/<?=escape($post->user_username)?>"><?=escape($post->user_name)?></a></h5>
          <h6><?=date('j F Y H:i', strtotime(escape($post->post_date)))?></h6>

          <?php if(strlen($post->post_content) > 140): ?>
            <p><?=substr(escape($post->post_content), 0, 140) . '...'?></p>
          <?php else: ?>
            <p><?=escape($post->post_content)?></p>
          <?php endif; ?>

          <?php if($post->post_image): ?>
            <img src="<?=BASE_URL?>/uploads/post-images/<?=escape($post->post_image)?>">
          <?php endif; ?>

          <?php if($post->post_by == $user_info->user_id): ?>
            <span class="options">
              <a href="/edit/<?=escape($post->post_id)?>">Edit</a>
              <a href="/delete/<?=escape($post->post_id)?>">Delete</a>
            </span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      <div class="pagination">
        <?php for($x = 1; $x <= $pages; $x++): ?>
          <a href="?p=<?=$x?>"<?php if($page === $x) { echo 'class="selected"'; } ?>><?=$x?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>