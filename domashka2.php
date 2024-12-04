<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $messageText = trim($_POST['message']);
    
    if (!empty($name) && !empty($email) && !empty($messageText)) {
        $dateTime = new DateTime('now', new DateTimeZone('Europe/Moscow'));
        $name = htmlspecialchars($name, ENT_QUOTES);
        $email = htmlspecialchars($email, ENT_QUOTES);
        $messageText = htmlspecialchars($messageText, ENT_QUOTES);
        $messageText = str_replace("\n", '{{nl}}', $messageText); 
        $currentDateTime = $dateTime->format('Y-m-d H:i:s');
        $newEntry = $name . '|' . $email . '|' . $currentDateTime . '|' . $messageText . PHP_EOL;
        file_put_contents('data.txt', $newEntry, FILE_APPEND);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Гостевая книга</title>
</head>
<body>
    <h1>Оставьте ваше сообщение</h1>
    <form method="post" action="">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Электронная почта:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="message">Текст сообщения:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>
        <button type="submit">Отправить</button>
    </form>

    <h2>Сообщения гостей</h2>

    <?php
    if (file_exists('data.txt')) {
        $allMessages = file('data.txt'); 
        $allMessages = array_reverse($allMessages);     
        foreach ($allMessages as $singleMessage) {
            list($name, $email, $dateTime, $text) = explode('|', $singleMessage);
            $text = str_replace('{{nl}}', "\n", $text); 
            $text = nl2br($text); 
            echo "<div>";
            echo "<strong>{$name}</strong> <br> {$email} <br> {$dateTime} <br>";
            echo "<p>- {$text}</p>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>Пока нет сообщений.</p>";
    }
    ?>
</body>
</html>

