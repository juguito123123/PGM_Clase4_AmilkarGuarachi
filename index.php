<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de Series</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Generador de Series Numéricas</h1>
        <form method="post">
            <label for="tipo">Selecciona la serie:</label>
            <select name="tipo" id="tipo">
                <option value="fibonacci">Fibonacci</option>
                <option value="pares">Pares</option>
                <option value="impares">Impares</option>
                <option value="primos">Primos</option>
            </select>
            <label for="cantidad">Cantidad de elementos:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" max="100" value="10" required>
            <button type="submit">Generar</button>
        </form>
        <?php
        function fibonacci($n) {
            $serie = [];
            $a = 0; $b = 1;
            for ($i = 0; $i < $n; $i++) {
                $serie[] = $a;
                $temp = $a + $b;
                $a = $b;
                $b = $temp;
            }
            return $serie;
        }
        function pares($n) {
            $serie = [];
            $num = 0;
            for ($i = 0; $i < $n; $i++) {
                $serie[] = $num;
                $num += 2;
            }
            return $serie;
        }
        function impares($n) {
            $serie = [];
            $num = 1;
            for ($i = 0; $i < $n; $i++) {
                $serie[] = $num;
                $num += 2;
            }
            return $serie;
        }
        function primos($n) {
            $serie = [];
            $num = 2;
            while (count($serie) < $n) {
                $esPrimo = true;
                for ($i = 2; $i <= sqrt($num); $i++) {
                    if ($num % $i == 0) {
                        $esPrimo = false;
                        break;
                    }
                }
                if ($esPrimo) $serie[] = $num;
                $num++;
            }
            return $serie;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tipo = $_POST["tipo"];
            $cantidad = intval($_POST["cantidad"]);
            switch ($tipo) {
                case "fibonacci":
                    $resultado = fibonacci($cantidad);
                    break;
                case "pares":
                    $resultado = pares($cantidad);
                    break;
                case "impares":
                    $resultado = impares($cantidad);
                    break;
                case "primos":
                    $resultado = primos($cantidad);
                    break;
                default:
                    $resultado = [];
            }
            echo "<div class='resultado'><strong>Serie $tipo:</strong> " . implode(", ", $resultado) . "</div>";
        }
        ?>
    </div>
</body>
</html>