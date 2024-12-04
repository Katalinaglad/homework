<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор дней</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="startDateDay">День начала:</label>
        <input type="number" name="startDateDay" id="startDateDay" min="1" max="31" required><br>
        
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
        
        <label for="startDateYear">Год начала:</label>
        <input type="number" name="startDateYear" id="startDateYear" min="1970" max="2040" required><br>
        
        <label for="endDateDay">День окончания:</label>
        <input type="number" name="endDateDay" id="endDateDay" min="1" max="31" required><br>
        
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
        
        <label for="endDateYear">Год окончания:</label>
        <input type="number" name="endDateYear" id="endDateYear" min="1970" max="2040" required><br>
        <button type="submit">Посчитать</button>
    </form>
    
    <?php
    if (isset($_POST['startDateDay']) && isset($_POST['startDateMonth']) && isset($_POST['startDateYear'])) {
        $startDate = date("Y-m-d", strtotime("{$_POST['startDateDay']}-{$_POST['startDateMonth']}-{$_POST['startDateYear']}"));

        if (isset($_POST['endDateDay']) && isset($_POST['endDateMonth']) && isset($_POST['endDateYear'])) {
            $endDate = date("Y-m-d", strtotime("{$_POST['endDateDay']}-{$_POST['endDateMonth']}-{$_POST['endDateYear']}"));
            $timeDifference = abs(strtotime($endDate) - strtotime($startDate));
            $days = floor($timeDifference / (60 * 60 * 24));
            $totalMinutes = floor($timeDifference / 60);
            
            echo "<h2>Разница между датами:</h2>";
            echo "Количество дней: " . $days . "<br>";
            echo "Общее количество минут: " . $totalMinutes . "<br>";
        } else {
            echo "<h2>Неправильно введены конечные даты.</h2>";
        }
    }
    ?>
    
    <?php
    if (isset($_POST['startDateDay']) && isset($_POST['startDateMonth']) && isset($_POST['startDateYear'])) {
        session_start();
        $_SESSION['startDate'] = array('day' => $_POST['startDateDay'], 'month' => $_POST['startDateMonth'], 'year' => $_POST['startDateYear']);
    }
    ?>
</body>
</html>
