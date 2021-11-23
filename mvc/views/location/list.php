
<h1>Location</h1>
<?php foreach ($locations as $location) { ?>
    <p><a href="<?= BASE_URL; ?>/location/detail/<?= $location['location_id']; ?>">
        <?= $location['name']; ?>
    </a></p>
<?php } ?>

<a href="<?= BASE_URL; ?>/">&lt; Back</a>

