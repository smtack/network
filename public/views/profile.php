<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="sidebar">
    <div class="info">
      <img src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($profile_info->user_profile_picture)?>">
      <h2><?=escape($profile_info->user_name)?></h2>
      <h5>@<?=escape($profile_info->user_username)?></h5>
      <h6>Joined on <?=date('j F Y \a\t H:i', strtotime(escape($profile_info->user_joined)))?></h6>

      <?php if(loggedIn()): ?>
        <?php if($profile_info->user_id !== $user_info->user_id): ?>
          <?php if(!findValue($follows_data, 'follow_user', $user_info->user_id)): ?>
            <a href="/follow/<?=escape($profile_info->user_id)?>"><button id="follow">Follow</button></a>
          <?php else: ?>
            <a href="/unfollow/<?=escape($profile_info->user_id)?>"><button id="follow">Unfollow</button></a>
          <?php endif; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
  
  <?php if(loggedIn()): ?>
    <div class="posts submit">
      <div class="form">
        <form enctype="multipart/form-data" action="<?php $self; ?>" method="POST">
          <div class="form-group">
            <?php if(isset($error)): ?>
              <p class="error"><?=$error?></p>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <textarea class="post-content" name="post_content" placeholder="Make a post..."></textarea>
            <p id="counter-text"><span id="counter"></span>/1000</p>
          </div>
          <div class="form-group">
            <label for="post_image"><img id="upload-image" src="<?=BASE_URL?>/public/img/Image.svg" alt="Upload Image"></label>
            <input id="post_image" type="file" name="post_image">
            <p id="file-name"></p>
          </div>
          <div class="form-group">
            <input type="hidden" name="token" value="<?=generate('token')?>">
            <input id="submit" type="submit" name="submit" value="Post">
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>

  <div class="posts">
    <?php if(!$posts): ?>
      <h3 class="message">Make a post on <?=escape($profile_info->user_name)?>'s profile...<h3>
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

          <?php if(loggedIn() && $post->post_by == $user_info->user_id): ?>
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