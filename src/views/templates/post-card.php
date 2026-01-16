<?php $post_user = $user->getUser($post_data->post_profile) ?>

<div class="post card" onclick="location.href='<?= base_url('post/') . escape($post_data->post_id) ?>'">
    <div class="post-user">
        <div class="post-user-picture">
            <img class="post-profile-picture rounded-circle" src="<?= base_url('uploads/profile-pictures/' . $post_data->user_profile_picture) ?>" alt="Profile Picture">
        </div>
        <div class="post-user-info">
            <h4><a href="<?= base_url('profile/') . escape($post_data->user_username) ?>"><?= escape($post_data->user_firstname) ?> <?= escape($post_data->user_surname) ?></a></h4>
            <h5><a href="<?= base_url('profile/') . escape($post_data->user_username) ?>">@<?= escape($post_data->user_username) ?></a></h5>
    
            <span class="date">
                <?= date('j F Y H:i', strtotime(escape($post_data->post_date))) ?>
                on <a href="<?= base_url('profile/') . $post_user->user_username ?>"><?= $post_user->user_firstname ?>'s Profile</a>
            </span>
        </div>
    </div>
    <div class="post-content">
        <?php if(strlen($post_data->post_content) > 140): ?>
            <p><?= substr(escape($post_data->post_content), 0, 140) . '...' ?></p>
        <?php else: ?>
            <p><?= escape($post_data->post_content) ?></p>
        <?php endif; ?>

        <?php if($post_data->post_image): ?>
            <img src="<?= base_url("uploads/post-images/$post_data->post_image") ?>">
        <?php endif; ?>

        <?php if($post_data->post_by == $user_info->user_id): ?>
            <span class="options">
                <a href="<?= base_url('edit/') . escape($post_data->post_id) ?>">Edit</a>
            </span>
        <?php endif; ?>
    </div>
</div>