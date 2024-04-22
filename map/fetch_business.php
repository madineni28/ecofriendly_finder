<?php
$host = '127.0.0.1';
$dbname = 'ecofriendly';
$username = 'root';
$password = '';

	try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to select necessary columns
    $sql = "SELECT business_id,latitude, longitude, name, image_url FROM businesses";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch data and format it as per the JSON structure
    $locations = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$business_name = str_replace(' ', '-',$row['name']);
        $locations[] = [
            'lat' => floatval($row['latitude']),
            'lng' => floatval($row['longitude']),
            'content' => "<div class='top-header'><div class='marker-name'>{$row['name']}</div><div class='lmorebtn'><a class='btn' href='business-shop/?id={$row['business_id']}'>Shop..</a></div></div><div class='win-img'><img src='images/businesses/{$row['image_url']}'></div>"
        ];
    }

    // Return JSON encoded data
    echo json_encode($locations);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

?>