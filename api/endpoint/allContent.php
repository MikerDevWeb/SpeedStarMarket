<?php
require_once __DIR__ . '/../core/conection.php';
require_once __DIR__ . '/../core/funtions.php';
setHeaders();


try {
    //find all vehicles
    $getVehicles = $conn->prepare('SELECT vehicle_id, brand, model, year, image, price, mileage, location, type FROM vehicles LIMIT 10');  
    $getVehicles->execute();
    
    $vehiclesData = $getVehicles->get_result();
    
    if($vehiclesData->num_rows < 1) {
        echo json_encode([
            'success' => true,
            'vehicles' => []
        ]);
        exit;
    }
    
    $response = [];
    
    while($vehicle = $vehiclesData->fetch_assoc()) {
        $vehicleInfo = [
            'id' => $vehicle['vehicle_id'],
            'brand' => $vehicle['brand'],
            'model' => $vehicle['model'],
            'year' => $vehicle['year'],
            'price' =>  $vehicle['price'],
            'mileage' => $vehicle['mileage'],
            'image' => $vehicle['image'],
            'location' => $vehicle['location'],
            'type' => $vehicle['type']
        ];
    
        $response[] = $vehicleInfo;
    }
    
    echo json_encode([
        'success' => true,
        'vehicles' => $response
    ]);
} catch (mysqli_sql_exception $e) {
    echo simpleJson(false, 'Error al conectar con el servicio');
}

?>