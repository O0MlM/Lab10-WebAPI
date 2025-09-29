<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : array();

switch($method) {
    case 'GET':
        if (!empty($request) && is_numeric($request[0])) {
            getProduct($conn, $request[0]);
        } else {
            $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 0;
            getAllProducts($conn, $limit);
        }
        break;

    case 'POST':
        addProduct($conn);
        break;

    case 'PUT':
        if (!empty($request) && is_numeric($request[0])) {
            updateProduct($conn, $request[0]);
        } else {
            echo json_encode(array("message" => "Product ID is required"));
        }
        break;

    case 'DELETE':
        if (!empty($request) && is_numeric($request[0])) {
            deleteProduct($conn, $request[0]);
        } else {
            echo json_encode(array("message" => "Product ID is required"));
        }
        break;

    default:
        echo json_encode(array("message" => "Method not allowed"));
        break;
}

$conn->close();

// ฟังก์ชันทั้งหมด

function getAllProducts($conn, $limit) {
    $sql = "SELECT * FROM Product ORDER BY ProductID ASC";
    if ($limit > 0) {
        $sql .= " LIMIT " . $limit;
    }

    $result = $conn->query($sql);
    if (!$result) {
        http_response_code(500);
        echo json_encode(array("message" => "SQL Error: " . $conn->error));
        return;
    }

    $products = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = formatProduct($row);
        }
    }

    echo json_encode($products, JSON_PRETTY_PRINT);
}

function getProduct($conn, $id) {
    $sql = "SELECT * FROM Product WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode(formatProduct($product), JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Product not found"));
    }
}

function addProduct($conn) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['name']) || !isset($data['price']) || !isset($data['category'])) {
        http_response_code(400);
        echo json_encode(array("message" => "Missing required fields"));
        return;
    }

    $sql = "INSERT INTO Product (ProductName, CategoryName, Price, Stock, Size, Color) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $name = $data['name'];
    $category = $data['category'];
    $price = $data['price'];
    $stock = isset($data['stock']) ? $data['stock'] : 0;
    $size = isset($data['size']) ? $data['size'] : '';
    $color = isset($data['color']) ? $data['color'] : '';

    $stmt->bind_param("ssdiss", $name, $category, $price, $stock, $size, $color);

    if ($stmt->execute()) {
        $newId = $conn->insert_id;
        http_response_code(201);
        echo json_encode(array(
            "message" => "Product created successfully",
            "id" => $newId
        ));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Failed to create product"));
    }
}

function updateProduct($conn, $id) {
    $data = json_decode(file_get_contents("php://input"), true);

    $checkSql = "SELECT ProductID FROM Product WHERE ProductID = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if (!$checkResult || $checkResult->num_rows == 0) {
        http_response_code(404);
        echo json_encode(array("message" => "Product not found"));
        return;
    }

    $sql = "UPDATE Product SET ProductName=?, CategoryName=?, Price=?, Stock=?, Size=?, Color=? WHERE ProductID=?";
    $stmt = $conn->prepare($sql);

    $name = $data['name'];
    $category = $data['category'];
    $price = $data['price'];
    $stock = isset($data['stock']) ? $data['stock'] : 0;
    $size = isset($data['size']) ? $data['size'] : '';
    $color = isset($data['color']) ? $data['color'] : '';

    $stmt->bind_param("ssdissi", $name, $category, $price, $stock, $size, $color, $id);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Product updated successfully", "id" => $id));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Failed to update product"));
    }
}

function deleteProduct($conn, $id) {
    $checkSql = "SELECT ProductID FROM Product WHERE ProductID = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if (!$checkResult || $checkResult->num_rows == 0) {
        http_response_code(404);
        echo json_encode(array("message" => "Product not found"));
        return;
    }

    $sql = "DELETE FROM Product WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Product deleted successfully"));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Failed to delete product"));
    }
}

function formatProduct($row) {
    return array(
        "id" => (int)$row['ProductID'],
        "name" => $row['ProductName'],
        "category" => $row['CategoryName'],
        "price" => (float)$row['Price'],
        "stock" => (int)$row['Stock'],
        "size" => $row['Size'],
        "color" => $row['Color']
    );
}
?>