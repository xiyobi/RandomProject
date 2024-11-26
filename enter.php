<?php
require 'DB.php';

$userarray = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['number'])) {

        $number = (int)$_POST['number'];
        if ($number > 0) {
            for ($i = 1; $i <= $number; $i++) {
                $userarray[] = $i;
            }
        } else {
            echo "<div class='alert alert-danger'>Iltimos, musbat butun son kiriting!</div>";
        }
    } elseif (!empty($_POST['name'])) {
        foreach ($_POST['name'] as $name) {
            $sql = "INSERT INTO randomuser (name) VALUES (:name)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            header('Location: enter.php');
        }
        echo "<div class='alert alert-success'>OK!</div>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Random</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="todo-body my-5 p-3">
        <h1 class="text-center">Random</h1>
        <p>Bu Randomga birinchi navbatda nechta oyinchi kiritmoqchisiz shuni yozasiz va keyingi ishingiz o'yinchilar ismini yozasiz </p>
        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="kiritgan soniz 3 dan katta boldin"
                       aria-label="Son kiriting" name="number" required>
                <button class="btn btn-primary" type="submit">Hosil qilish</button>
            </div>
        </form>
    </div>

    <div class="result">
        <?php if (!empty($userarray)): ?>
            <h4>Massiv qiymatlari:</h4>
            <form action="" method="post">
                <?php foreach ($userarray as $user): ?>
                    <div class="mb-3">
                        <label for="input<?= $user ?>" class="form-label"># <?= $user ?></label>
                        <input type="text" class="form-control" id="input<?= $user ?>" name="name[]"
                               placeholder="Nomi" required>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-success">Saqlash</button>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
