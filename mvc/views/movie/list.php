
<h1>Movies</h1>
<?php foreach ($movies as $movie) { ?>
    <p><a href="<?= BASE_URL; ?>/movie/detail/<?= $movie['movie_id']; ?>">
        <?= $movie['title']; ?>
    </a></p>
<?php } ?>

<a href="<?= BASE_URL; ?>/">&lt; Back</a>

