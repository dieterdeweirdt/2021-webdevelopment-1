<div class="checkbox-list">
    <?php foreach($makes as $make) :
        $make = (object) $make; 
        $checked = '';
        if(isset($where['makes']) && in_array($make->id, $where['makes'])) {
            $checked = ' checked';
        }
?>
    <label class="checkbox"><input type="checkbox" name="make[]" value="<?= $make->id ?>"<?= $checked; ?>> <?= $make->name ?> <span class="count"><?= $make->total ?></span></label>
    <?php endforeach; ?>
</div>