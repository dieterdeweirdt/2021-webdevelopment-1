
<h1>Edit movie</h1>
<form method="POST">
<p>
    <label for="title">Title:</label><br>
    <input type="text" id="" name="title" value="<?= $movie->title; ?>">
</p>
<p>
    <label for="description">Description:</label><br>
    <textarea type="text" id="description" name="description"><?= $movie->description; ?></textarea>
</p>
<p>
    <label for="yt_trailer">Trailer:</label><br>
    <input type="text" id="yt_trailer" name="yt_trailer" value="<?= $movie->yt_trailer; ?>">
</p>
<p>
    <label for="photo">Photo:</label><br>
    <input type="text" id="photo" name="photo" value="<?= $movie->photo; ?>">
</p>
<button type="submit" name="btnUpdate">Edit</button>
</form>

<a href="<?= BASE_URL; ?>/movie">&lt; Back</a>
