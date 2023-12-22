<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lr4</title>
    <style>
        #forma {
            display: flex;
            align-items: center;
        }

        #but {
            position: relative;
            left: 5px;
        }
    </style>
</head>
<body>
    <span>Калькулятор</span>
    <form method="post" id="forma">
        <input type="number" name="number1" id="number1" required>
        <div>
            <input type="radio" name="calc" value="add" required>
            <label for="add">+</label>
            <br>
            <input type="radio" name="calc" value="sub">
            <label for="sub">-</label>
            <br>
            <input type="radio" name="calc" value="div">
            <label for="div">/</label>
            <br>
            <input type="radio" name="calc" value="mul">
            <label for="mul">*</label>
        </div>
        <input type="number" name="number2" id="number2" required>
        <input type="submit" value="Обрахувати" id="but">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num1 = $_POST["number1"];
            $num2 = $_POST["number2"];
            $operation = $_POST["calc"];

            if (is_numeric($num1) && is_numeric($num2)) {
                if ($operation == "add") {
                    $res = $num1 + $num2;
                    $op = "+";
                }
                if ($operation == "sub") {
                    $res = $num1 - $num2;
                    $op = "-";
                }
                if ($operation == "div") {
                    if ($num2 != 0) {
                        $res = $num1 / $num2;
                        $op = "/";
                    }
                    else {
                        echo "Ділення на нуль!<br><br>";
                    }
                }
                if ($operation == "mul") {
                    $res = $num1 * $num2;
                    $op = "*";
                }
                
                if (isset($res)) {
                    $fileRes = "$num1 $op $num2 = $res\n";
                    file_put_contents('history.txt', $fileRes, FILE_APPEND);
                    header('Location: index.php');
                    exit();
                }
            }
        }
        error_reporting(0);
        $history = file_get_contents('history.txt');
        if (!empty($history)) {
            echo "Історія:<br>";
            echo "<pre>$history</pre>";
        }
    ?>
</body>
</html>