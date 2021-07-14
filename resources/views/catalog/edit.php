<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/css/bulma.min.css">
    <title>Terembeosztás</title>
    <link href="/css/app.0bfef050.css" rel="preload" as="style">
    <link href="/js/app.e28df376.js" rel="preload" as="script">
    <link href="/js/chunk-vendors.d964c9d6.js" rel="preload" as="script">
    <link href="/css/app.0bfef050.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/eb51bc2636.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/stilus.css">
</head>
<body>
<noscript><strong>We're sorry but terembeosztas-front-end doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript>

<?= view('component.header'); ?>

<?php if (session()->has('system_message')): ?>
<div class="notification is-warning">
    <button class="delete"></button>
    <?= session()->get('system_message'); ?>
</div>
<?php endif; ?>

<div id="app" class="mt-3"></div>

<script src="/js/chunk-vendors.d964c9d6.js">
</script>
<script src="/js/app.e28df376.js">
</script>

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