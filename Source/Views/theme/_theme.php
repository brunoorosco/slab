<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title><?= $title; ?></title>
  
    <link href="<?= asset('bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= asset('font-awesome/css/font-awesome.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css')?>"/>
</head>

<body class="login">
   
    <main class="main_content">
        <?= $v->section("content"); ?>
    </main>
    <footer class="main_footer">
        <?= SITE['name'] ?> - Todos os Direitos Reservados

    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <?= $v->section("scripts"); ?>
</body>

</html>