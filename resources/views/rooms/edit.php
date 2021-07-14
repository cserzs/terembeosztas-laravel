
<div class="container">

<h2 class="is-size-3">Terem: <?= $terem['rovid_nev']; ?></h2>

<form method="post" action="/room/edit/<?=$terem->id ?>">

<input type="hidden" name="_token" value="<?=csrf_token() ?>" />
<input type="hidden" name="_method" value="PUT">

<div class="field">
    <label class="label" for="nev">Név</label>
    <div class="control">
      <input class="input" type="text" placeholder="Terem neve" name="nev" value="<?=$terem->nev ?>">
      <p class="is-size-7 is-italic has-text-grey">Maximális hossz: 25</p>
      <?php foreach($errors->get('nev') as $message): ?>
        <p class="has-text-danger is-size-7"><span class="icon"><i class="fas fa-exclamation"></i></span><?=$message ?></p>
      <?php endforeach; ?>
    </div>
</div>

<div class="field">
    <label class="label" for="rovid_nev">Rövid név</label>
    <div class="control">
      <input class="input" type="text" placeholder="Terem rövid neve" name="rovid_nev" value="<?=$terem->rovid_nev ?>">
      <p class="is-size-7 is-italic has-text-grey">Maximális hossz: 10</p>      
      <?php foreach($errors->get('rovid_nev') as $message): ?>
        <p class="has-text-danger is-size-7"><span class="icon"><i class="fas fa-exclamation"></i></span><?=$message ?></p>
      <?php endforeach; ?>
    </div>
</div>

<div class="field">
    <label class="label" for="megjegyzes">Megjegyzés</label>
    <div class="control">
      <input class="input" type="text" placeholder="Megjegyzés" name="megjegyzes" value="<?=$terem->megjegyzes ?>">
      <p class="is-size-7 is-italic has-text-grey">Maximális hossz: 50</p>      
      <?php foreach($errors->get('megjegyzes') as $message): ?>
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
