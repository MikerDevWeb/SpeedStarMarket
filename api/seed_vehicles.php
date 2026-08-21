<?php
/**
 * seed_vehicles.php
 * Registra 50 vehículos de prueba en la tabla `vehicles`.
 * Ejecutar una sola vez (php seed_vehicles.php) o vía navegador en local.
 */

$serverName = 'localhost';
$username   = 'root';
$password   = '';
$dbName     = 'speed_star_market';

$conn = new mysqli($serverName, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8mb4');

const FIXED_USER_ID = '0011223344';

// ---------------------------------------------------------
// Catálogos generales
// ---------------------------------------------------------
$colors = ['Blanco', 'Negro', 'Gris', 'Plata', 'Rojo', 'Azul', 'Azul marino', 'Verde', 'Café', 'Beige', 'Amarillo', 'Naranja'];

$cities = [
    'Guadalajara, Jalisco', 'Zapopan, Jalisco', 'Monterrey, Nuevo León',
    'Ciudad de México', 'Puebla, Puebla', 'Querétaro, Querétaro',
    'León, Guanajuato', 'Tijuana, Baja California', 'Mérida, Yucatán',
    'Toluca, Estado de México', 'Cancún, Quintana Roo', 'Aguascalientes, Aguascalientes',
    'Chihuahua, Chihuahua', 'Torreón, Coahuila', 'San Luis Potosí, San Luis Potosí',
    'Culiacán, Sinaloa', 'Morelia, Michoacán', 'Saltillo, Coahuila',
    'Hermosillo, Sonora', 'Veracruz, Veracruz'
];

$transmissions = ['manual', 'automática'];

// ---------------------------------------------------------
// Catálogo de vehículos: cada uno referencia una imagen real
// de las que subiste. Se reutilizan varias veces (permitido).
// ---------------------------------------------------------
$templates = [
    ['type' => 'bike', 'brand' => 'Honda',      'model' => 'CBR600RR',        'image' => '2006HondaCBR600RR-001.jpg',
        'year_min' => 2005, 'year_max' => 2015, 'price_min' => 65000,  'price_max' => 140000,  'mileage_min' => 3000,  'mileage_max' => 45000,  'fuel_fixed' => 'gasolina'],

    ['type' => 'bike', 'brand' => 'Suzuki',     'model' => 'GSX-R600',        'image' => 'gsxr600.jpg',
        'year_min' => 2012, 'year_max' => 2023, 'price_min' => 90000,  'price_max' => 190000,  'mileage_min' => 2000,  'mileage_max' => 40000,  'fuel_fixed' => 'gasolina'],

    ['type' => 'car', 'brand' => 'Dodge',       'model' => 'Challenger',      'image' => 'challenger.jpeg',
        'year_min' => 2015, 'year_max' => 2023, 'price_min' => 380000, 'price_max' => 680000,  'mileage_min' => 8000,  'mileage_max' => 90000],

    ['type' => 'car', 'brand' => 'Dodge',       'model' => 'Charger',         'image' => 'Dodge_Charger_Hirschaid-20220709-RM-113717.jpg',
        'year_min' => 2015, 'year_max' => 2022, 'price_min' => 320000, 'price_max' => 560000,  'mileage_min' => 10000, 'mileage_max' => 120000],

    ['type' => 'car', 'brand' => 'Ford',        'model' => 'Mustang',         'image' => 'FordMustang2023.jpg',
        'year_min' => 2022, 'year_max' => 2024, 'price_min' => 550000, 'price_max' => 780000,  'mileage_min' => 3000,  'mileage_max' => 40000],

    ['type' => 'car', 'brand' => 'Ford',        'model' => 'Mustang GT',      'image' => 'mustang.jpg',
        'year_min' => 2005, 'year_max' => 2015, 'price_min' => 180000, 'price_max' => 420000,  'mileage_min' => 40000, 'mileage_max' => 160000],

    ['type' => 'car', 'brand' => 'Mitsubishi',  'model' => 'Eclipse',         'image' => 'Mitsubishi-Eclipse-II-2G.jpg',
        'year_min' => 2010, 'year_max' => 2018, 'price_min' => 90000,  'price_max' => 220000,  'mileage_min' => 60000, 'mileage_max' => 180000],

    ['type' => 'car', 'brand' => 'Tesla',       'model' => 'Cybertruck',      'image' => 'Tesla-Cybeeertruck-CYBERTRUCKOWNERSCLUB.webp',
        'year_min' => 2024, 'year_max' => 2025, 'price_min' => 1200000,'price_max' => 1850000, 'mileage_min' => 1000,  'mileage_max' => 35000,  'fuel_fixed' => 'eléctrico'],

    ['type' => 'car', 'brand' => 'Nissan',      'model' => 'Sentra',          'image' => '448856185_1246848450030299_6893116846716976816_n.jpg',
        'year_min' => 2012, 'year_max' => 2023, 'price_min' => 130000, 'price_max' => 260000,  'mileage_min' => 20000, 'mileage_max' => 140000],

    ['type' => 'car', 'brand' => 'Toyota',      'model' => 'Corolla',         'image' => '450240880_451468501131061_8925650552756535058_n.jpg',
        'year_min' => 2013, 'year_max' => 2024, 'price_min' => 150000, 'price_max' => 290000,  'mileage_min' => 15000, 'mileage_max' => 150000],

    ['type' => 'car', 'brand' => 'Chevrolet',   'model' => 'Aveo',            'image' => '450510811_7838054462282212_5214947658628348637_n.jpg',
        'year_min' => 2014, 'year_max' => 2023, 'price_min' => 95000,  'price_max' => 190000,  'mileage_min' => 20000, 'mileage_max' => 160000],

    ['type' => 'car', 'brand' => 'Volkswagen',  'model' => 'Jetta',           'image' => '451145922_862339825949666_1526618538534262042_n.jpg',
        'year_min' => 2013, 'year_max' => 2023, 'price_min' => 140000, 'price_max' => 300000,  'mileage_min' => 15000, 'mileage_max' => 150000],

    ['type' => 'car', 'brand' => 'Kia',         'model' => 'Rio',             'image' => '451222872_876486011202338_1958847395317284923_n.jpg',
        'year_min' => 2014, 'year_max' => 2024, 'price_min' => 120000, 'price_max' => 240000,  'mileage_min' => 10000, 'mileage_max' => 130000],

    ['type' => 'car', 'brand' => 'Mazda',       'model' => '3',               'image' => '451487062_3221950947935008_8937915008995531596_n.jpg',
        'year_min' => 2014, 'year_max' => 2024, 'price_min' => 160000, 'price_max' => 320000,  'mileage_min' => 10000, 'mileage_max' => 140000],

    ['type' => 'car', 'brand' => 'Hyundai',     'model' => 'Elantra',         'image' => 'D_NQ_NP_737845-MLM77171183417_062024-O.webp',
        'year_min' => 2013, 'year_max' => 2024, 'price_min' => 150000, 'price_max' => 300000,  'mileage_min' => 12000, 'mileage_max' => 140000],

    ['type' => 'car', 'brand' => 'Honda',       'model' => 'Civic',           'image' => 'D_NQ_NP_742048-MLM76232523240_052024-O.webp',
        'year_min' => 2014, 'year_max' => 2024, 'price_min' => 170000, 'price_max' => 340000,  'mileage_min' => 10000, 'mileage_max' => 150000],

    ['type' => 'car', 'brand' => 'Renault',     'model' => 'Kwid',            'image' => 'D_NQ_NP_753668-MLM77742223659_072024-O.webp',
        'year_min' => 2019, 'year_max' => 2024, 'price_min' => 95000,  'price_max' => 170000,  'mileage_min' => 5000,  'mileage_max' => 90000],

    ['type' => 'car', 'brand' => 'Chevrolet',   'model' => 'Onix',            'image' => 'D_NQ_NP_778788-MLM77525435090_072024-O.webp',
        'year_min' => 2018, 'year_max' => 2024, 'price_min' => 130000, 'price_max' => 250000,  'mileage_min' => 8000,  'mileage_max' => 110000],

    ['type' => 'car', 'brand' => 'Toyota',      'model' => 'Hilux',           'image' => 'D_NQ_NP_850889-MLM77764148019_072024-O.webp',
        'year_min' => 2012, 'year_max' => 2023, 'price_min' => 280000, 'price_max' => 620000,  'mileage_min' => 15000, 'mileage_max' => 180000],

    ['type' => 'car', 'brand' => 'Ford',        'model' => 'Ranger',          'image' => 'D_NQ_NP_964081-MLM69481553304_052023-O.webp',
        'year_min' => 2013, 'year_max' => 2023, 'price_min' => 300000, 'price_max' => 650000,  'mileage_min' => 15000, 'mileage_max' => 180000],

    ['type' => 'car', 'brand' => 'Nissan',      'model' => 'Versa',           'image' => 'maxresdefault.jpg',
        'year_min' => 2013, 'year_max' => 2024, 'price_min' => 130000, 'price_max' => 260000,  'mileage_min' => 10000, 'mileage_max' => 140000],

    ['type' => 'car', 'brand' => 'Seat',        'model' => 'Ibiza',           'image' => 'Z941XpTaFnd2.7fSQaRxtE.jpg',
        'year_min' => 2012, 'year_max' => 2022, 'price_min' => 110000, 'price_max' => 220000,  'mileage_min' => 15000, 'mileage_max' => 130000],
];

// ---------------------------------------------------------
// Frases para armar descripciones tipo Marketplace
// ---------------------------------------------------------
$openers = [
    "Vendo mi %s %s %d, único dueño.",
    "Se vende %s %s %d en excelente estado.",
    "%s %s %d, muy cuidado, papeles en regla.",
    "Oportunidad: %s %s %d, todo pagado.",
    "Vendo %s %s %d por cambio de unidad.",
];

$bodyPhrases = [
    "Servicios de mantenimiento al corriente.",
    "Interior limpio, sin detalles.",
    "Llantas en buen estado.",
    "Motor y transmisión responden muy bien.",
    "Nunca chocado, factura original disponible.",
    "Listo para transferir, sin adeudos.",
    "Climas funcionando perfectamente.",
    "Se aceptan pruebas de manejo.",
];

$closers = [
    "Precio negociable dentro de lo razonable.",
    "Trato directo, no intermediarios.",
    "Interesados reales favor de escribir.",
    "Acepto tu auto a cuenta.",
    "No pierdas la oportunidad, se vende rápido.",
];

function randomDescription($brand, $model, $year, $bodyPhrases, $closers, $openers) {
    $opener = sprintf($openers[array_rand($openers)], $brand, $model, $year);
    $body1  = $bodyPhrases[array_rand($bodyPhrases)];
    $body2  = $bodyPhrases[array_rand($bodyPhrases)];
    $closer = $closers[array_rand($closers)];
    return "{$opener} {$body1} {$body2} {$closer}";
}

function generateUniqueVehicleId(mysqli $conn) {
    do {
        $newId = (string) random_int(1000000000, 9999999999);
        $stmt = $conn->prepare("SELECT id FROM vehicles WHERE vehicle_id = ? LIMIT 1");
        $stmt->bind_param('s', $newId);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
    } while ($exists);

    return $newId;
}

function randomPublicationDate() {
    // Fecha aleatoria dentro de los últimos 180 días
    $daysAgo = random_int(0, 180);
    $secondsAgo = random_int(0, 86399);
    $timestamp = time() - ($daysAgo * 86400) - $secondsAgo;
    return date('Y-m-d H:i:s', $timestamp);
}

// ---------------------------------------------------------
// Inserción
// ---------------------------------------------------------
$stmt = $conn->prepare(
    "INSERT INTO vehicles
        (vehicle_id, user_id, type, brand, model, year, color, fuel, transmission, price, mileage, location, description, image, publication_date)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
);

$stmt->bind_param(
    'sssssssssdissss',   // ← se agregó una 's' extra al final
    $vehicle_id, $user_id, $type, $brand, $model, $year, $color, $fuel, $transmission,
    $price, $mileage, $location, $description, $image, $publication_date
);

$totalVehicles = 50;
$inserted = 0;

for ($i = 0; $i < $totalVehicles; $i++) {
    $tpl = $templates[$i % count($templates)];

    $vehicle_id = generateUniqueVehicleId($conn);
    $user_id    = FIXED_USER_ID;
    $type       = $tpl['type'];
    $brand      = $tpl['brand'];
    $model      = $tpl['model'];
    $year       = (string) random_int($tpl['year_min'], $tpl['year_max']);
    $color      = $colors[array_rand($colors)];
    $fuel       = $tpl['fuel_fixed'] ?? ['gasolina', 'diesel', 'eléctrico'][array_rand(['gasolina', 'diesel', 'eléctrico'])];
    $transmission = $transmissions[array_rand($transmissions)];
    $price      = round(random_int($tpl['price_min'], $tpl['price_max']) / 500) * 500; // redondeado a múltiplos de 500
    $mileage    = random_int($tpl['mileage_min'], $tpl['mileage_max']);
    $location   = $cities[array_rand($cities)];
    $description = randomDescription($brand, $model, (int) $year, $bodyPhrases, $closers, $openers);
    $image      = $tpl['image'];
    $publication_date = randomPublicationDate();

    if ($stmt->execute()) {
        $inserted++;
    } else {
        echo "Error al insertar vehículo #{$i}: " . $stmt->error . "\n";
    }
}

$stmt->close();
$conn->close();

echo "Listo. Se insertaron {$inserted} de {$totalVehicles} vehículos.\n";