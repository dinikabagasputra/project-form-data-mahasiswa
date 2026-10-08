<?php

// Memastikan data dikirim menggunakan method POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form.html");
    exit;
}


// ==============================
// MENGAMBIL DATA DARI FORM
// ==============================

$nim = trim($_POST["nim"] ?? "");
$nama = trim($_POST["nama"] ?? "");
$email = trim($_POST["email"] ?? "");
$prodi = trim($_POST["prodi"] ?? "");
$jenis_kelamin = trim($_POST["jenis_kelamin"] ?? "");
$alamat = trim($_POST["alamat"] ?? "");


// Mengambil checkbox hobi
$hobi = $_POST["hobi"] ?? [];


// ==============================
// VALIDASI DATA
// ==============================

$errors = [];


// Validasi NIM
if ($nim === "") {
    $errors[] = "NIM wajib diisi.";
}


// Validasi Nama
if ($nama === "") {
    $errors[] = "Nama lengkap wajib diisi.";
}


// Validasi Email
if ($email === "") {
    $errors[] = "Email wajib diisi.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
}


// Validasi Program Studi
if ($prodi === "") {
    $errors[] = "Program studi wajib dipilih.";
}


// Validasi Jenis Kelamin
if ($jenis_kelamin === "") {
    $errors[] = "Jenis kelamin wajib dipilih.";
}


// Validasi Hobi
if (!is_array($hobi) || count($hobi) < 2) {
    $errors[] = "Silakan pilih minimal 2 hobi.";
}


// Validasi Alamat
if ($alamat === "") {
    $errors[] = "Alamat wajib diisi.";
}


// ==============================
// MENAMPILKAN ERROR
// ==============================

if (!empty($errors)) {

    echo '<!DOCTYPE html>';
    echo '<html lang="id">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Data Tidak Valid</title>';
    echo '<link rel="stylesheet" href="style.css">';
    echo '</head>';

    echo '<body>';

    echo '<div class="container result-container">';

    echo '<div class="header">';
    echo '<h1>Data Tidak Valid</h1>';
    echo '<p>Silakan periksa kembali data yang Anda masukkan.</p>';
    echo '</div>';

    echo '<div class="error-box">';

    echo '<h3>Terjadi Kesalahan:</h3>';

    echo '<ul>';

    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</li>';
    }

    echo '</ul>';

    echo '</div>';

    echo '<a href="form.html" class="btn-back">Kembali ke Form</a>';

    echo '</div>';

    echo '</body>';
    echo '</html>';

    exit;
}


// ==============================
// SANITASI DATA
// ==============================

$nim = htmlspecialchars($nim, ENT_QUOTES, 'UTF-8');
$nama = htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$prodi = htmlspecialchars($prodi, ENT_QUOTES, 'UTF-8');
$jenis_kelamin = htmlspecialchars($jenis_kelamin, ENT_QUOTES, 'UTF-8');
$alamat = htmlspecialchars($alamat, ENT_QUOTES, 'UTF-8');


// Sanitasi hobi
$hobi_bersih = [];

foreach ($hobi as $item) {

    $item = trim($item);

    if ($item !== "") {
        $hobi_bersih[] = htmlspecialchars(
            $item,
            ENT_QUOTES,
            'UTF-8'
        );
    }
}


// Menggabungkan hobi
$hobi_tampil = implode(", ", $hobi_bersih);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta 
        name="viewport" 
        content="width=device-width, initial-scale=1.0"
    >

    <title>Hasil Data Mhs By Dinika</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container result-container">

        <div class="success-header">

            <div class="success-icon">
                ✓
            </div>

            <h1>Data Berhasil Disimpan</h1>

            <p>
                Berikut adalah data mahasiswa yang telah Anda masukkan.
            </p>

        </div>


        <div class="table-wrapper">

            <table>

                <tr>
                    <th>NIM</th>
                    <td>
                        <?php echo $nim; ?>
                    </td>
                </tr>

                <tr>
                    <th>Nama Lengkap</th>
                    <td>
                        <?php echo $nama; ?>
                    </td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>
                        <?php echo $email; ?>
                    </td>
                </tr>

                <tr>
                    <th>Program Studi</th>
                    <td>
                        <?php echo $prodi; ?>
                    </td>
                </tr>

                <tr>
                    <th>Jenis Kelamin</th>
                    <td>
                        <?php echo $jenis_kelamin; ?>
                    </td>
                </tr>

                <tr>
                    <th>Hobi</th>
                    <td>
                        <?php echo $hobi_tampil; ?>
                    </td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>
                        <?php echo nl2br($alamat); ?>
                    </td>
                </tr>

            </table>

        </div>


        <div class="button-area">

            <a href="form.html" class="btn-back">
                Kembali ke Form
            </a>

        </div>

        <footer class="copyright">
                © 2026 Tugas Form Data Mhs — Dibuat oleh <strong>Dinika Bagas</strong>
            </footer>

    </div>

</body>

</html>