<?php
require_once __DIR__ . '/../core/conection.php';
require_once __DIR__ . '/../core/funtions.php';
setHeaders();


$searchTerm = sanitizeString($_GET['search']);

if(empty($searchTerm)) {
    echo simpleJson(false, 'Sin resultados');
    exit;
}

$termPartial = "%{$searchTerm}%";
$results = [];

//find items
try {
    $find = $conn->prepare('SELECT vehicle_id, brand, model, year, image, price, mileage, location, type FROM vehicles WHERE brand LIKE ? OR model LIKE ? OR year = ? OR location = ?');
    $find->bind_param('ssss', 
        $termPartial,
        $termPartial,
        $searchTerm,
        $searchTerm
    );
    
    $find->execute();

    $getResults = $find->get_result();

    if($getResults->num_rows < 1) {
        echo json_encode([
            'success' => true,
            'items' => $results
        ]);
        exit;
    }

    while($item = $getResults->fetch_assoc()) {
        $vehicleData = [
            'id' => $item['vehicle_id'],
            'brand' => $item['brand'],
            'model' => $item['model'],
            'year' => $item['year'],
            'price' =>  $item['price'],
            'mileage' => $item['mileage'],
            'image' => $item['image'],
            'location' => $item['location'],
            'type' => $item['type']
        ];

        $results[] = $vehicleData;
    }

    echo json_encode([
        'success' => true,
        'items' => $results
    ]);

} catch (PDOException) {
    echo simpleJson(false, 'Error en el servicio');
}




// try {
//     $searchPartial = "%{$searchTerm}%";
//     $consult = $conn->prepare('SELECT vehicle_id, brand, model, year, image, price, mileage, location, type FROM vehicles WHERE brand LIKE ? OR model LIKE ? OR year = ?');
//     $consult->execute([$searchPartial, $searchPartial, $searchTerm]);
//     $resultSearch = $consult->get_result()->fetch_all(MYSQLI_ASSOC);

//     if ($resultSearch) {
        
//         echo json_encode($resultSearch);
//     } else {
//         die;
//     }
// } catch (PDOException $e) {
//     echo json_encode(["error" => "Error en la base de datos: " . $e->getMessage()]);
// }
?>
