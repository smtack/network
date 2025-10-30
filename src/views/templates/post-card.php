<?php $post_user = $user->getUser($post->post_profile) ?>

<div class="post" onclick="location.href='<?= base_url('post/') . escape($post->post_id) ?>'">
    <h4><a href="<?= base_url('profile/') . escape($post->user_username) ?>"><?= escape($post->user_name) ?></a></h4>
    <h5><a href="<?= base_url('profile/') . escape($post->user_username) ?>">@<?= escape($post->user_username) ?></a></h5>
    
    <span class="date">
        <?= date('j F Y H:i', strtotime(escape($post->post_date))) ?>
        on <a href="<?= base_url('profile/') . $post_user->user_username ?>"><?= $post_user->user_name ?>'s Profile</a>
    </span>

    <?php if(strlen($post->post_content) > 140): ?>
        <p><?= substr(escape($post->post_content), 0, 140) . '...' ?></p>
    <?php else: ?>
        <p><?= escape($post->post_content) ?></p>
    <?php endif; ?>

    <?php if($post->post_image): ?>
        <img src="<?= base_url("uploads/post-images/$post->post_image") ?>">
    <?php endif; ?>

    <?php if($post->post_by == $user_info->user_id): ?>
        <span class="options">
            <a href="<?= base_url('edit/') . escape($post->post_id) ?>">Edit</a>
        </span>
    <?php endif; ?>
</div>