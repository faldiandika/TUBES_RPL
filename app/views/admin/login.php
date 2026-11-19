<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="login-page">
<form class="login-box" method="post" action="index.php?c=admin&a=login">
    <h1>Login Admin</h1>
    <?php if ($error): ?><p class="alert err"><?= e($error) ?></p><?php endif; ?>
    <?= csrf_field() ?>
    <label>Username</label>
    <input type="text" name="username" required autofocus>
    <label>Password</label>
    <input type="password" name="password" required>
    <button class="btn" type="submit">Masuk</button>
    <p><a href="index.php">&larr; Kembali ke beranda</a></p>
</form>
</body>
</html>