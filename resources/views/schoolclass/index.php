<div class="container">

<h2 class="is-size-3">Osztályok</h2>

<p class="block"><a href="/schoolclass/new">Új osztály</a></p>

<table class="table adattabla is-hoverable">
  <thead class="has-background-black-ter">
    <tr>
      <th>#</th>
      <th>Név</th>
      <th>Rövid név</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($osztalyok as $osztaly): ?>
    <tr>
        <td>#<?= $osztaly['id']; ?></td>
        <td><?= $osztaly['nev']; ?></td>
        <td><?= $osztaly['rovid_nev']; ?></td>
        <td><a href="/schoolclass/edit/<?=$osztaly['id']?>">Szerkesztés</a> <a href="javascript:void(0);" onClick="confirmDelete(<?= $osztaly['id']?>)">Törlés</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

</div>

<script>
let delurl="/schoolclass/delete/";
function confirmDelete(id) {
    if (confirm("Biztos törölni szeretnéd?"))
        window.location = delurl + id;
    else
        return false;    
}
</script>
