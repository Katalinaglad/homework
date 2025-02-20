<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор дней</title>
</head>
<body>
    <!-- Форма для ввода дат -->
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <!-- Поле для ввода дня начала -->
        <label for="startDateDay">День начала:</label>
        <input type="number" name="startDateDay" id="startDateDay" min="1" max="31" required><br>
        
        <!-- Выпадающий список для выбора месяца начала -->
        <label for="startDateMonth">Месяц начала:</label>
        <select name="startDateMonth" id="startDateMonth">
            <option value="1" selected>Январь</option>
            <option value="2">Февраль</option>
            <option value="3">Март</option>
            <option value="4">Апрель</option>
            <option value="5">Май</option>
            <option value="6">Июнь</option>
            <option value="7">Июль</option>
            <option value="8">Август</option>
            <option value="9">Сентябрь</option>
            <option value="10">Октябрь</option>
            <option value="11">Ноябрь</option>
            <option value="12">Декабрь</option>
        </select><br>
        
        <!-- Поле для ввода года начала -->
        <label for="startDateYear">Год начала:</label>
        <input type="number" name="startDateYear" id="startDateYear" min="1970" max="2040" required><br>
        
        <!-- Поле для ввода дня окончания -->
        <label for="endDateDay">День окончания:</label>
        <input type="number" name="endDateDay" id="endDateDay" min="1" max="31" required><br>
        
        <!-- Выпадающий список для выбора месяца окончания -->
        <label for="endDateMonth">Месяц окончания:</label>
        <select name="endDateMonth" id="endDateMonth">
            <option value="1" selected>Январь</option>
            <option value="2">Февраль</option>
            <option value="3">Март</option>
            <option value="4">Апрель</option>
            <option value="5">Май</option>
            <option value="6">Июнь</option>
            <option value="7">Июль</option>
            <option value="8">Август</option>
            <option value="9">Сентябрь</option>
            <option value="10">Октябрь</option>
            <option value="11">Ноябрь</option>
            <option value="12">Декабрь</option>
        </select><br>
        
        <!-- Поле для ввода года окончания -->
        <label for="endDateYear">Год окончания:</label>
        <input type="number" name="endDateYear" id="endDateYear" min="1970" max="2040" required><br>

        <!-- Кнопка для отправки формы -->
        <button type="submit">Посчитать</button>
    </form>
    
    <?php
    // Проверяем, была ли отправлена форма и заданы ли все поля начальной даты
    if (isset($_POST['startDateDay']) && isset($_POST['startDateMonth']) && isset($_POST['startDateYear'])) {
        // Создаем строку с датой начала в формате ГГГГ-ММ-ДД
        $startDate = date("Y-m-d", strtotime("{$_POST['startDateDay']}-{$_POST['startDateMonth']}-{$_POST['startDateYear']}"));

        // Проверяем, была ли введена конечная дата
        if (isset($_POST['endDateDay']) && isset($_POST['endDateMonth']) && isset($_POST['endDateYear'])) {
            // Создаем строку с датой окончания в формате ГГГГ-ММ-ДД
            $endDate = date("Y-m-d", strtotime("{$_POST['endDateDay']}-{$_POST['endDateMonth']}-{$_POST['endDateYear']}"));

            // Преобразуем даты в метки времени (timestamp) и вычисляем разницу в секундах
            $timeDifference = abs(strtotime($endDate) - strtotime($startDate));

            // Переводим разницу в количество дней
            // 1 день = 24 часа * 60 минут * 60 секунд = 86400 секунд
            $days = floor($timeDifference / (60 * 60 * 24)); 

            // Вычисляем разницу в минутах
            // 1 минута = 60 секунд
            $totalMinutes = floor($timeDifference / 60);
            
            // Выводим результат на страницу
            echo "<h2>Разница между датами:</h2>";
            echo "Количество дней: " . $days . "<br>";
            echo "Общее количество минут: " . $totalMinutes . "<br>";
        } else {
            // Если конечная дата не введена или введена неверно
            echo "<h2>Неправильно введены конечные даты.</h2>";
        }
    }
    ?>
</body>
</html>


