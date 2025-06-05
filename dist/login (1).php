<?php
<?php
header('Access-Control-Allow-Origin: *'); // Ganti '*' dengan domain frontend kamu kalau sudah siap produksi
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$host = 'localhost';
$user = 'swis7914_sales_inventory';
$pass = 'Taecyeon123';
$db   = 'swis7914_sales_inventory';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

// Ambil data JSON dari POST body
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if (!$username || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and password are required']);
    exit();
}

// Query user dari DB (asumsi ada tabel users dengan kolom username dan password)
$sql = "SELECT id, username, password_hash, role FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid username or password']);
    exit();
}

$user = $result->fetch_assoc();

// Verifikasi password, asumsikan password disimpan hashed (misal pakai password_hash PHP)
if (!password_verify($password, $user['password_hash'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid username or password']);
    exit();
}

// Jika berhasil login, buat JWT token (sederhana, atau kamu bisa buat token manual)
// Untuk contoh ini, kita kirim data user saja
// Sebaiknya implementasi JWT dengan lib khusus di PHP, tapi ini contoh minimal

$tokenPayload = [
    'id' => $user['id'],
    'username' => $user['username'],
    'role' => $user['role'],
    'iat' => time(),
    'exp' => time() + 3600, // Token valid 1 jam
];

// Contoh encode JWT manual (sangat sederhana dan kurang secure, lebih baik pake library)
function base64UrlEncode($data) {
    return rtrim(strtr(b
