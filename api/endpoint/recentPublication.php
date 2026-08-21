<?php
require_once __DIR__ . '/../core/conection.php';
require_once __DIR__ . '/../core/funtions.php';
setHeaders();


//find vehicles
$find = $conn->prepare('SELECT vehicle_id, brand, model, year, image, price, mileage, location, type
FROM vehicles
WHERE publication_date >= NOW() - INTERVAL 60 DAY
ORDER BY publication_date DESC;');

$find->execute();

$getResults = $find->get_result();

$response = [];

while($veh = $getResults->fetch_assoc()) {
    $vehicleData = [
        'id' => $veh['vehicle_id'],
        'brand' => $veh['brand'],
        'model' => $veh['model'],
        'year' => $veh['year'],
        'price' =>  $veh['price'],
        'mileage' => $veh['mileage'],
        'image' => $veh['image'],
        'location' => $veh['location'],
        'type' => $veh['type']
    ];

    $response[] = $vehicleData;
}

echo json_encode(['items' => $response]);