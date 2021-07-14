<div class="container">

<h2 class="is-size-3">Termek</h2>

<p class="block"><a href="/room/new">Új terem</a></p>

<table class="table adattabla is-hoverable">
  <thead class="has-background-black-ter">
    <tr>
      <th>#</th>
      <th>Név</th>
      <th>Rövid név</th>
      <th>Megjegyzés</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($termek as $terem): ?>
    <tr>
        <td>#<?= $terem['id']; ?></td>
        <td><?= $terem['nev']; ?></td>
        <td><?= $terem['rovid_nev']; ?></td>
        <td><?= $terem['megjegyzes']; ?></td>
        <td><a href="/room/edit/<?=$terem['id']?>">Szerkesztés</a> <a href="javascript:void(0);" onClick="confirmDelete(<?= $terem['id']?>)">Törlés</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

</div>

<script>
let delurl="/room/delete/";
function confirmDelete(id) {
    if (confirm("Biztos törölni szeretnéd?"))
        window.location = delurl + id;
    else
        return false;    
}
</script>
