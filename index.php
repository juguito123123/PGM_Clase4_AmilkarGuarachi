<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de Series y Buscador de Palabras</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Generador de Series Numéricas</h1>
        <form method="post">
            <!-- Campo oculto para identificar el formulario -->
            <input type="hidden" name="formulario" value="series">
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
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["formulario"]) && $_POST["formulario"] === "series") {
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
        <h1>Buscar palabra en párrafo</h1>
        <form method="post">
            <!-- Campo oculto para identificar el formulario -->
            <input type="hidden" name="formulario" value="buscar">
            <div style="display: flex; gap: 10px; align-items: flex-end;">
                <div style="flex:2;">
                    <label for="parrafo">Párrafo:</label>
                    <textarea name="parrafo" id="parrafo" rows="3" style="width:100%;" required></textarea>
                </div>
                <div style="flex:1;">
                    <label for="palabra">Palabra:</label>
                    <input type="text" name="palabra" id="palabra" required>
                </div>
                <div>
                    <button type="submit">Comparar</button>
                </div>
            </div>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["formulario"]) && $_POST["formulario"] === "buscar" && isset($_POST["parrafo"]) && isset($_POST["palabra"])) {
            $parrafo = $_POST["parrafo"];
            $palabra = $_POST["palabra"];
            if (stripos($parrafo, $palabra) !== false) {
                echo "<div class='resultado'>La palabra <strong>$palabra</strong> SÍ existe en el párrafo.</div>";
            } else {
                echo "<div class='resultado'>La palabra <strong>$palabra</strong> NO existe en el párrafo.</div>";
            }
        }
        ?>
    </div>
</body>
</html>