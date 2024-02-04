<?php


if ( isset($_POST['delete']) && isset($_POST['user_id']) ) {
    echo "-----------delete--------";
    $sql = "DELETE FROM users WHERE user_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['user_id']));
}

?>