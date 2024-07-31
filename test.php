<?php
header('Content-Type: application/json');

// Função para retornar uma resposta JSON e sair
function jsonResponse($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

// Conexão com o banco de dados
$host = 'localhost';
$db   = 'grup3999_campanha_rima';
$user = 'grup3999_ti_construfacil';
$pass = 'Victor*3251';


$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    jsonResponse(['error' => $e->getMessage()], 500);
}

// Verifica se o quotation_id foi passado na query string
if (!isset($_GET['quotation_id'])) {
    jsonResponse(['error' => 'quotation_id is required'], 400);
}

$quotation_id = $_GET['quotation_id'];

try {
    // Prepara a consulta SQL
    $stmt = $pdo->prepare('SELECT qitem.quotation_item_id, qitem.quotation_id, qitem.iddetalhe, qitem.cdprincipal, qitem.dsdetalhe, qitem.qtitem FROM quotation_items AS qitem JOIN quotations AS quote ON quote.quotation_id =  qitem.quotation_id WHERE qitem.quotation_id = ? AND quote.status = true');
    $stmt->execute([$quotation_id]);

    // Obtém os resultados
    $quotationItems = $stmt->fetchAll();

    // Retorna os dados em formato JSON
    jsonResponse($quotationItems);

} catch (\PDOException $e) {
    jsonResponse(['error' => $e->getMessage()], 500);
}