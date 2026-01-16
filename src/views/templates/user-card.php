<div class="post card" onclick="location.href='<?= base_url('profile/') . escape($user_data->user_username) ?>'">
    <div class="post-user">
        <div class="post-user-picture">
            <img class="post-profile-picture rounded-circle" src="<?= base_url('uploads/profile-pictures/' . $user_data->user_profile_picture) ?>" alt="Profile Picture">
        </div>
        <div class="post-user-info">
            <h4><a href="<?= base_url('profile/') . escape($user_data->user_username) ?>"><?= escape($user_data->user_firstname) . ' ' . escape($user_data->user_surname) ?></a></a></h4>
            <h5><a href="<?= base_url('profile/') . escape($user_data->user_username) ?>">@<?= escape($user_data->user_username) ?></a></h5>
    
            <span class="date">
                Joined on <?= date('j F Y H:i', strtotime(escape($user_data->user_joined))) ?>
            </span>
        </div>
    </div>
    <div class="post-content">
        <p><?=  $user_data->user_bio ?></p>

        <?php if($user->isFriendRequestPending($user_info->user_id, $user_data->user_id)): ?>
            <a href="<?= base_url('accept/') . escape($user_data->user_id) ?>"><button id="friend" class="btn btn-primary">Accept</button></a>
            <a href="<?= base_url('decline/') . escape($user_data->user_id) ?>"><button id="friend" class="btn btn-primary">Decline</button></a>
        <?php endif; ?>

        <?php if($user->isFriends($user_info->user_id, $user_data->user_id)): ?>
            <a href="<?= base_url('unfriend/') . escape($user_data->user_id) ?>"><button id="friend" class="btn btn-primary">Unfriend</button></a>
        <?php endif; ?>
    </div>
</div>