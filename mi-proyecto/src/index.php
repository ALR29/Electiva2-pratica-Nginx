<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + MySQL en Docker</title>
    <!-- Importamos Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-lg w-full">
            
            <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">
                ¡Hola Mundo desde PHP!
            </h1>
            
            <p class="text-gray-600 mb-6 text-center">
                Esta página está siendo servida por Apache y PHP.
            </p>

            <!-- Sección de conexión a la BD -->
            <div class="p-4 rounded-lg">
                <?php
                    // ¡Hola Mundo en PHP!
                    echo "<p class='text-lg font-medium text-blue-700 mb-4'>Intentando conectar a MySQL...</p>";

                    // Leemos las variables de entorno que definimos en docker-compose.yml
                    $host = getenv('DB_HOST');
                    $db_name = getenv('DB_DATABASE');
                    $user = getenv('DB_USER');
                    $password = getenv('DB_PASSWORD');

                    try {
                        // Creamos una nueva conexión
                        // La conexión puede fallar las primeras veces mientras la BD se inicia
                        $conn = new mysqli($host, $user, $password, $db_name);

                        // Verificamos si hay un error de conexión
                        if ($conn->connect_error) {
                            throw new Exception("Error de conexión: " . $conn->connect_error);
                        }

                        // Si la conexión es exitosa
                        echo "<div class='bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg'>";
                        echo "<p class='font-bold'>¡Éxito!</p>";
                        echo "<p>Conectado correctamente a la base de datos: <strong>'$db_name'</strong> en <strong>'$host'</strong>.</p>";
                        echo "</div>";

                        // Cerramos la conexión
                        $conn->close();

                    } catch (Exception $e) {
                        // Si la conexión falla
                        echo "<div class='bg-red-100 border border-red-300 text-red-800 p-4 rounded-lg'>";
                        echo "<p class='font-bold'>Error de conexión</p>";
                        echo "<p>No se pudo conectar a la base de datos.</p>";
                        echo "<p class='text-sm mt-2'><strong>Mensaje:</strong> " . $e->getMessage() . "</p>";
                        echo "<p class='text-sm mt-2'><i>(Espera un minuto a que el servicio 'db' se inicie y luego refresca la página)</i></p>";
                        echo "</div>";
                    }
                ?>
            </div>

        </div>
    </div>

</body>
</html>