<?php
date_default_timezone_set('Europe/Kyiv');

$submitted = false;
$submitTime = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Отримуємо дані з форми
    $name  = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");

    $q1 = $_POST["q1"] ?? "";
    $q2 = $_POST["q2"] ?? "";
    $q3 = $_POST["q3"] ?? "";
    $q4 = $_POST["q4"] ?? "";

    // Дата і час
    $submitTime = date("Y-m-d H:i:s");

    // Формуємо масив даних
    $data = [
        "name" => $name,
        "email" => $email,
        "answers" => [
            "Якою мовою ви користуєтеся найчастіше?" => $q1,
            "Яку мову використовуєте в інтернеті?" => $q2,
            "Якою мовою навчаєтесь або працюєте?" => $q3,
            "Чи хотіли б ви покращити знання української мови?" => $q4
        ],
        "submitted_at" => $submitTime
    ];

    // Ім'я файлу з датою і часом
    $filename = "survey/survey_" . date("Y-m-d_H-i-s") . ".json";

    // Запис у файл
    file_put_contents($filename, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    $submitted = true;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Анкета опитування</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .container {
            max-width: 600px;
            background: #fff;
            padding: 20px;
            margin: 40px auto;
            border-radius: 8px;
        }
        label {
            font-weight: bold;
        }
        .question {
            margin-top: 15px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
        }
        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">

<?php if ($submitted): ?>

    <p class="success">
        Дякуємо за участь в опитуванні!<br>
        Дата та час заповнення: <strong><?= $submitTime ?></strong>
    </p>

<?php else: ?>

    <h2>Анкета: Якою мовою ви користуєтеся?</h2>

    <form method="POST" action="survey.php">

        <div class="question">
            <label>Ім’я:</label><br>
            <input type="text" name="name" required>
        </div>

        <div class="question">
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </div>

        <div class="question">
            <label>1. Якою мовою ви користуєтеся найчастіше?</label><br>
            <input type="radio" name="q1" value="Українська" required> Українська<br>
            <input type="radio" name="q1" value="Англійська"> Англійська<br>
            <input type="radio" name="q1" value="Інша"> Інша
        </div>

        <div class="question">
            <label>2. Яку мову використовуєте в інтернеті?</label><br>
            <input type="radio" name="q2" value="Українська" required> Українська<br>
            <input type="radio" name="q2" value="Англійська"> Англійська<br>
            <input type="radio" name="q2" value="Змішано"> Змішано
        </div>

        <div class="question">
            <label>3. Якою мовою навчаєтесь або працюєте?</label><br>
            <input type="radio" name="q3" value="Українська" required> Українська<br>
            <input type="radio" name="q3" value="Англійська"> Англійська<br>
            <input type="radio" name="q3" value="Інша"> Інша
        </div>

        <div class="question">
            <label>4. Чи хотіли б ви покращити знання української мови?</label><br>
            <input type="radio" name="q4" value="Так" required> Так<br>
            <input type="radio" name="q4" value="Ні"> Ні<br>
            <input type="radio" name="q4" value="Вже володію добре"> Вже володію добре
        </div>

        <button type="submit">Надіслати</button>

    </form>

<?php endif; ?>

</div>

</body>
</html>

