<?php
$f3 = Base::instance();
$result = $f3->get("RESULT");
$message = $f3->get("MESSAGE");

$message = $message == "" ? "Ошибка" : $message;

?>

<style>
    .container {
        max-width: 640px;
    }
</style>

<div class="container">

    <div class="row">
        <div class="col-12">
            <h1>Добавление анекдота</h1>
            <form action="/add" method="post">
                <div class="row mb-3">
                    <div class="col-12">
                        <textarea name="joke" id="joke" cols="30" rows="10" class="form-control" placeholder="Анекдот"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <input type="password" name="password" class="form-control" placeholder="пароль">
                    </div>
                </div>
                <?php if($result != ""): ?>
                <div class="row mb-3">
                    <div class="col-12 <?= $result ? "success" : "error" ?>">
                        <?= $result == "success" ? "Анекдот успешно загружен" : $message; ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <div class="col-12">
                        <input type="submit" value="Add" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div>

</div>
