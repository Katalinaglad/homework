<?php
// Проверяем, был ли запрос отправлен методом POST (т.е. пользователь отправил форму)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы, удаляя лишние пробелы в начале и конце строки
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $messageText = trim($_POST['message']);
    
    // Проверяем, чтобы все поля были заполнены
    if (!empty($name) && !empty($email) && !empty($messageText)) {
        // Создаем объект DateTime с текущей датой и временем в часовом поясе Москвы
        $dateTime = new DateTime('now', new DateTimeZone('Europe/Moscow'));

        // Преобразуем спецсимволы в HTML-сущности для защиты от XSS-атак
        $name = htmlspecialchars($name, ENT_QUOTES);
        $email = htmlspecialchars($email, ENT_QUOTES);
        $messageText = htmlspecialchars($messageText, ENT_QUOTES);

        // Заменяем переносы строк специальным маркером (чтобы корректно сохранялись в файл)
        $messageText = str_replace("\n", '{{nl}}', $messageText);

        // Форматируем дату и время в удобный для чтения формат
        $currentDateTime = $dateTime->format('Y-m-d H:i:s');

        // Формируем строку для записи в файл (разделяем данные символом `|`)
        $newEntry = $name . '|' . $email . '|' . $currentDateTime . '|' . $messageText . PHP_EOL;

        // Записываем новую запись в файл `data.txt`, добавляя в конец файла (режим FILE_APPEND)
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
    <!-- Форма для отправки сообщения -->
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
    // Проверяем, существует ли файл с сообщениями
    if (file_exists('data.txt')) {
        // Читаем все строки из файла в массив
        $allMessages = file('data.txt'); 

        // Разворачиваем массив, чтобы новые сообщения были сверху
        $allMessages = array_reverse($allMessages);

        // Проходим по каждому сообщению
        foreach ($allMessages as $singleMessage) {
            // Разбиваем строку сообщения на части (разделитель — `|`)
            list($name, $email, $dateTime, $text) = explode('|', $singleMessage);

            // Восстанавливаем переносы строк (заменяем `{{nl}}` на `\n`)
            $text = str_replace('{{nl}}', "\n", $text);

            // Преобразуем переносы строк в HTML (`<br>`) для корректного отображения
            $text = nl2br($text);

            // Выводим сообщение на страницу
            echo "<div>";
            echo "<strong>{$name}</strong> <br> {$email} <br> {$dateTime} <br>";
            echo "<p>- {$text}</p>";
            echo "</div><hr>";
        }
    } else {
        // Если файл еще не создан, выводим сообщение, что записей пока нет
        echo "<p>Пока нет сообщений.</p>";
    }
    ?>
</body>
</html>

