<div class="product_detail">
  <div class="content">

    <h1><?= $product->name; ?></h1>

    <?= $product->description; ?>

    <h3>&euro; <?= $product->unit_price; ?> / <?= $product->unit; ?></h3>

  </div>
  <div class="form">

  <?php if(isset($order_id) && $order_id > 0) : ?>
    <h4>Bedankt voor uw bestelling</h4>

    Uw bestellingsnummer is <?= $order_id; ?>


    <?php else : ?>
  <h4>Plaats uw bestelling</h4>

  <form method="POST">
    <p>
      <label>
        Aantal<br>
        <input type="number" value="1" name="amount">
      </label>
    </p>
    <p>
      <label>
        Voornaam<br>
        <input type="text" value="" name="first_name" placeholder="Voornaam">
      </label>
    </p>
    <p>
      <label>
        Naam<br>
        <input type="text" value="" name="last_name" placeholder="Naam">
      </label>
    </p>
    <p>
      <label>
        E-mail<br>
        <input type="email" value="" name="email" placeholder="E-mail" required>
      </label>
    </p>
    <p>
      <button type="submit" name="submit_order">
        Plaats bestelling
      </button>
    </p>
  </form>
  <?php endif; ?>
  

  </div>
</div>