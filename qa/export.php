<?php
// Koneksi ke database
include 'koneksi.php';

// Debugging message untuk koneksi database
if (!$GLOBALS["___mysqli_ston"]) {
    error_log('Koneksi database gagal: ' . mysqli_connect_error());
    die('Koneksi database gagal!');
}

// Query data yang sama seperti digunakan untuk tampilan tabel dan grafik
$sql2 = "SELECT 
            agent_name, 
            EXTRACT(YEAR FROM score_date) AS year, 
            EXTRACT(MONTH FROM score_date) AS month, 
            (SUM(cnt_greeting) + SUM(cnt_verification) + SUM(cnt_tov) + SUM(cnt_pk) + SUM(cnt_cg)) AS Sum_total_finding, 
            SUM(cnt_greeting) AS finding_greeting,
            SUM(cnt_verification) AS finding_Verification,
            SUM(cnt_tov) AS finding_Tone_of_voice,
            SUM(cnt_pk) AS finding_product_knowledge,
            SUM(cnt_cg) AS finding_Closing_greeting,
            SUM(cnt_cp) AS Total_Complimentery
        FROM v_mistake 
        GROUP BY agent_name, year, month 
        ORDER BY agent_name, year, month";

$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql2);

// Cek apakah query berhasil dijalankan
if (!$result2) {
    error_log('Query error: ' . mysqli_error($GLOBALS["___mysqli_ston"]));
    die("Query error: " . mysqli_error($GLOBALS["___mysqli_ston"]));
}

// Nama file CSV yang akan dihasilkan
$filename = "mistake_trend_report_" . date('Ymd') . ".csv";

// Header untuk file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');

// Membuat file pointer untuk output
$output = fopen('php://output', 'w');

// Menulis header kolom ke file CSV
fputcsv($output, array('Agent Name', 'Year', 'Month', 'Total Finding', 'Finding Greeting', 'Finding Verification', 'Finding Tone of Voice', 'Finding Product Knowledge', 'Finding Closing Greeting', 'Complimentary'));

// Menulis data ke file CSV
while ($row2 = mysqli_fetch_assoc($result2)) {
    fputcsv($output, $row2);
}

// Tutup file pointer
fclose($output);
exit();
?>
