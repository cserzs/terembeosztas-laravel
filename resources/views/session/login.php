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
                <span class="has-text-weight-semibold">Ferenczi</span>
                <span class="is-size-3 has-text-info-light">terembeosztás</span>
            </h1>
        </div>

        <div class="navbar-end">
            <a href="/" class="navbar-item has-text-white home-enter-link">Kezdőlap</a>
        </div>

    </nav>
</div>

<?php if (session()->has('system_message')): ?>
<div class="notification is-warning">
    <button class="delete"></button>
    <?= session()->get('system_message'); ?>
</div>
<?php endif; ?>

<div class="container mt-4 has-text-centered">

<?php if ($errors->has('username') || $errors->has('password')): ?>
    <p class="block has-text-danger"><span class="icon"><i class="fas fa-exclamation"></i></span>Érvénytelen felhasználónév vagy jelszó!</p>
<?php endif; ?>


<form method="post" action="/login" class="loginform">

<input type="hidden" name="_token" value="<?=csrf_token() ?>" />

<div class="field">
    <label class="label" for="username">Felhasználónév</label>
    <div class="control has-icons-left">
      <input class="input" type="text" placeholder="Felhasználónév" name="username" value="<?=old('username') ?>">
      <span class="icon is-small is-left">      
        <i class="fas fa-user"></i>
      </span>
    </div>
</div>

<div class="field">
    <label class="label" for="password">Jelszó</label>
    <div class="control has-icons-left">
      <input class="input" type="password" placeholder="Jelszó" name="password" value="">
      <span class="icon is-small is-left">
        <i class="fas fa-lock"></i>
      </span>      
    </div>
</div>

<div class="field">
    <div class="control">
      <button class="button is-info" type="submit">Belépés</button>
    </div>
</div>

</form>

</div>


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