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

<?= view('component.header'); ?>

<?php if (session()->has('system_message')): ?>
<div class="notification is-warning">
    <button class="delete"></button>
    <?= session()->get('system_message'); ?>
</div>
<?php endif; ?>

<?php echo $_content ?? ""; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
    const $notification = $delete.parentNode;

    $delete.addEventListener('click', () => {
      $notification.parentNode.removeChild($notification);
    });
  });
});

</script>

</body>
</html>