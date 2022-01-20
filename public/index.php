<?php



require("../vendor/autoload.php");



$f3 = Base::instance();
$f3->set("ROOT", __DIR__."/../src/");
$f3->set("UI", __DIR__."/../src/views/");
$f3->set("LOGS", __DIR__."/../log/");


$f3->route("GET /list", function ($f3) {
    header('Content-type:application/json;charset=utf-8');
    $uuid = $f3->get("GET.uuid");
    $repo = new \repository\ListRepository();
    echo json_encode($repo->getAllCards($uuid), JSON_UNESCAPED_UNICODE);
});

$f3->route("GET /", function($f3) {
    echo "Hello world";
});

$f3->route("POST /vote", function($f3) {
    header('Content-type:application/json;charset=utf-8');
    $uuid = $f3->get("POST.uuid");
    $card_id = $f3->get("POST.id");
    $resolution = $f3->get("POST.resolution");

    try {
        $repo = new \repository\VoteRepository();

        if(!is_numeric($card_id)) throw new Exception("Неверный идентификатор");
        if($resolution != 1 && $resolution != 0) throw new Exception("Неверная резолюция");

        $c = $repo->vote($uuid, $card_id, $resolution);
        if($c == false) throw new Exception("Ошибка");
        echo json_encode(["status"=>"success"], JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        echo json_encode(["status"=>"error", "message"=>$e->getMessage()], JSON_UNESCAPED_UNICODE);
    }

});

$f3->route("GET /my-votes", function ($f3) {
    header('Content-type:application/json;charset=utf-8');
    $uuid = $f3->get("GET.uuid");
    $repo = new \repository\ListRepository();
    echo json_encode($repo->myVotes($uuid), JSON_UNESCAPED_UNICODE);
});

$f3->route("GET /add", function($f3) {
    $view = new View();
    $f3->set("CONTENT", "add.php");
    echo $view->render("layout.php");
});

$f3->route("POST /add", function ($f3) {
    $key = "891c39aa2eff0a4401ee4c33d02f5c99c141c810c1978fe281b79463d36d94b4";
    $password = $f3->get("POST.password");
    $joke = $f3->get("POST.joke");

    try {
        if(hash("sha256", $password) != $key) {
            throw new Exception("Не верный пароль");
        }
        if($joke == "") throw new Exception("Пустой анекдот");

        $repo = new \repository\JokeRepository();
        $result = $repo->add($joke) ? "success" : "error";

        if($result == false) throw new Exception("Ошибка при добавлении");

    } catch (Exception $e) {
        $result = "error";
        $message = $e->getMessage();
    }

    $view = new View();
    $f3->set("CONTENT", "add.php");
    $f3->set("RESULT", $result);
    $f3->set("MESSAGE", $message);
    echo $view->render("layout.php");

});

$f3->run();