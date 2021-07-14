
<div class="container">

<h2 class="is-size-3">Új osztály</h2>


<form method="post" action="/schoolclass/new">

<input type="hidden" name="_token" value="<?=csrf_token() ?>" />

<div class="field">
    <label class="label" for="nev">Név</label>
    <div class="control">
      <input class="input" type="text" placeholder="Osztály neve" name="nev" value="<?=old('nev') ?>">
      <p class="is-size-7 is-italic has-text-grey">Maximális hossz: 30</p>
      <?php foreach($errors->get('nev') as $message): ?>
        <p class="has-text-danger is-size-7"><span class="icon"><i class="fas fa-exclamation"></i></span><?=$message ?></p>
      <?php endforeach; ?>
    </div>
</div>

<div class="field">
    <label class="label" for="rovid_nev">Rövid név</label>
    <div class="control">
      <input class="input" type="text" placeholder="Osztály rövid neve" name="rovid_nev" value="<?=old('rovid_nev') ?>">
      <p class="is-size-7 is-italic has-text-grey">Maximális hossz: 10</p>      
      <?php foreach($errors->get('rovid_nev') as $message): ?>
        <p class="has-text-danger is-size-7"><span class="icon"><i class="fas fa-exclamation"></i></span><?=$message ?></p>
      <?php endforeach; ?>
    </div>
</div>

<div class="field">
    <label class="label" for="evfolyam">Évfolyam</label>
    <div class="control">
      <input class="input" type="text" placeholder="Évfolyam száma" name="evfolyam" value="<?=old('evfolyam') ?>">
      <p class="is-size-7 is-italic has-text-grey">Csak egy szám. A megfelelő sorbarendezáshez kell. Pl: 9</p>
      <?php foreach($errors->get('evfolyam') as $message): ?>
        <p class="has-text-danger is-size-7"><span class="icon"><i class="fas fa-exclamation"></i></span><?=$message ?></p>
      <?php endforeach; ?>
    </div>
</div>

<div class="field">
    <label class="label" for="betujel">Betűjel</label>
    <div class="control">
      <input class="input" type="text" placeholder="Osztály betűjele" name="betujel" value="<?=old('betujel') ?>">
      <p class="is-size-7 is-italic has-text-grey">Csak egy karakter. A megfelelő sorbarendezáshez kell. Pl: a</p>
      <?php foreach($errors->get('betujel') as $message): ?>
        <p class="has-text-danger is-size-7"><span class="icon"><i class="fas fa-exclamation"></i></span><?=$message ?></p>
      <?php endforeach; ?>
    </div>
</div>

<div class="field">
    <div class="control">
      <button class="button is-info" type="submit">Mentés</button>
    </div>
</div>

</form>

</div>

