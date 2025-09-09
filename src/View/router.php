<?php
// router.php
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // Sirva a requisição como está.
} else {
    include 'index.php'; // Inclui o nosso index.php para processar a rota.
}
?>