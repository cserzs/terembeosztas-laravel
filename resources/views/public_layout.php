<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/eb51bc2636.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/stilus.css">

    <title>Terembeosztás</title>
</head>
<body>
<div class="container">
    <nav class="navbar is-info">
        <div class="navbar-brand">
            <h1 class="navbar-item has-text-white pl-5 is-size-2" style="display: inline-block;" >
                <a href="/" class="has-text-white"><span class="has-text-weight-semibold">Ferenczi</span></a>
                <span class="is-size-3 has-text-info-light">terembeosztás</span>
            </h1>
        </div>

        <div class="navbar-end">
            <a href="/login" class="navbar-item has-text-white home-enter-link">Belépés</a>
        </div>

    </nav>
</div>

<?php if (session()->has('system_message')): ?>
<div class="notification is-warning">
    <button class="delete"></button>
    <?= session()->get('system_message'); ?>
</div>
<?php endif; ?>

<div class="container mt-4">
    <div>
        <button class="button is-info" onclick="toggleClasslist()"><i class="far fa-clipboard"></i> <span class="px-4">Válassz osztályt!</span> <i class="fas fa-angle-down"></i></button>
    </div>
    <div id="classList" class="mt-2 tags are-medium">
    <?php foreach($osztalyok as $osztaly): ?>
        <a href="/view/<?=$osztaly->id?>" class="tag is-dark"><?=$osztaly->rovid_nev?></a>
    <?php endforeach;?>
    </div>
</div>


<?php echo $_content ?? ""; ?>

<script>
let classVisible = false;
document.addEventListener('DOMContentLoaded', () => {
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
    const $notification = $delete.parentNode;

    $delete.addEventListener('click', () => {
      $notification.parentNode.removeChild($notification);
    });
  });
  document.getElementById('classList').style.display = "none";
});

function toggleClasslist() {
    classVisible = !classVisible;
    if (classVisible) document.getElementById('classList').style.display = "block";
    else document.getElementById('classList').style.display = "none";
}
</script>

</body>
</html>