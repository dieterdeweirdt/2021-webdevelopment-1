<?php 
    $message = (object) $message;
    $full_name = $message->first_name . ' ' . $message->last_name;
    $user_name = '@' . strtolower(str_replace(' ', '_', $full_name));
    $formatted_date = strftime("%A %e %B %k:%M", strtotime($message->created_on) );
?>
<div class="message">
    <div class="avatar"><img src="https://picsum.photos/id/<?= $message->user_id ?>/100/100"></div>
    <div class="content">
        <div class="info">
        <a href="user.php?user_id=<?= $message->user_id ?>"><?= $full_name ?></a> &bull; 
            <?= $user_name; ?> &bull; 
            <?= $formatted_date; ?>
        </div>
        <div class="tweet">
            <?php if($message->photo) : ?>
                <img src="images/<?= $message->photo ?>">
            <?php endif; ?>
            <?= $message->message ?>
        </div>
    </div>
</div>