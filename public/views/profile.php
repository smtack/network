<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="info">
    <img src="<?=BASE_URL?>/uploads/profile-pictures/<?=$profile_info->user_profile_picture?>">
    <h2><?=$profile_info->user_name?></h2>
    <h5>@<?=$profile_info->user_username?></h5>
    <h6>Joined on <?=date('j F Y \a\t H:i', strtotime($profile_info->user_joined))?></h6>

    <?php if(loggedIn()): ?>
      <?php if($profile_info->user_id !== $user_info->user_id): ?>
        <?php if(!findValue($follows_data, 'follow_user', $user_info->user_id)): ?>
          <a href="follow?u=<?=$profile_info->user_id?>"><button id="follow">Follow</button></a>
        <?php else: ?>
          <a href="unfollow?u=<?=$profile_info->user_id?>"><button id="follow">Unfollow</button></a>
        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  
  <?php if(loggedIn()): ?>
    <div class="posts submit">
      <div class="form">
        <form action="<?php $self; ?>" method="POST">
          <div class="form-group">
            <?php if(isset($error)): ?>
              <p class="error"><?=$error?></p>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <textarea name="post_content" placeholder="Make a post..."></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Post">
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>

  <div class="posts">
    <?php if(!$posts): ?>
      <h3 class="message">Make a post on <?=$profile_info->user_name?>'s profile...<h3>
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

          <?php if(loggedIn() && $post->post_by == $user_info->user_id): ?>
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