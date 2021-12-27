


<div class="checkbox-list">
    <?php 
    foreach($colors as $color) :
        $color = (object) $color; 
        $checked = '';
                if(isset($where['colors']) && in_array($color->color, $where['colors'])) {
            $checked = ' checked';
        }
        ?>
    <label class="checkbox"><input type="checkbox" name="color[]" value="<?= $color->color ?>"<?= $checked; ?>> <?= $color->color ?> <span class="count"><?= $color->total ?></span></label>
    <?php endforeach; ?>
</div>