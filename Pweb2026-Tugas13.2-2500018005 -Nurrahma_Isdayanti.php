<?php
// ==========================================
// 1. DEFINISI FUNCTION (Logika Bisnis)
// ==========================================

// Function untuk menghitung total belanjaan di keranjang
function hitungTotal($keranjang) {
    $total = 0;
    foreach ($keranjang as $item) {
        $total += $item['harga'] * $item['jumlah'];
    }
    return $total;
}

// Function untuk menghitung diskon berdasarkan total belanja
// Jika belanja > 100.000 dapat diskon 10%
function hitungDiskon($totalBelanja) {
    if ($totalBelanja >= 100000) {
        return $totalBelanja * 0.10; // Diskon 10%
    }
    return 0;
}

// Function untuk memformat angka menjadi Rupiah
function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

// ==========================================
// 2. PENERAPAN ARRAY (Data Aplikasi)
// ==========================================

// Array Multidimensi untuk menyimpan data Menu Restoran
$daftarMenu = [
    ["id" => 1, "nama" => "Nasi Goreng Spesial", "harga" => 25000, "kategori" => "Makanan"],
    ["id" => 2, "nama" => "Mie Ayam Jamur", "harga" => 20000, "kategori" => "Makanan"],
    ["id" => 3, "nama" => "Ayam Bakar Taliwang", "harga" => 35000, "kategori" => "Makanan"],
    ["id" => 4, "nama" => "Es Teh Manis", "harga" => 5000, "kategori" => "Minuman"],
    ["id" => 5, "nama" => "Jus Alpukat", "harga" => 15000, "kategori" => "Minuman"]
];

// Array Multidimensi untuk simulasi item yang dibeli oleh pelanggan (Keranjang Belanja)
$keranjangPelanggan = [
    ["nama" => "Nasi Goreng Spesial", "harga" => 25000, "jumlah" => 2],
    ["nama" => "Ayam Bakar Taliwang", "harga" => 35000, "jumlah" => 1],
    ["nama" => "Jus Alpukat", "harga" => 15000, "jumlah" => 3]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Kasir Restoran - Tugas 13</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        h2, h3 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; background: #fff; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .struk-container { background: #fff; padding: 20px; border: 2px dashed #333; max-width: 500px; }
        .flex-toko { display: flex; justify-content: space-between; }
    </style>
</head>
<body>

    <h2>Sistem Manajemen Restoran (Tugas Pertemuan 13)</h2>
    <hr>

    <h3>Daftar Menu Restoran</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($daftarMenu as $menu): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $menu['nama']; ?></td>
                <td><?= $menu['kategori']; ?></td>
                <td><?= formatRupiah($menu['harga']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Struk Pembayaran (Simulasi Transaksi)</h3>
    <div class="struk-container">
        <h4>** RESTO LEZAT MANTAP **</h4>
        <p>Tanggal: <?= date('d-m-Y H:i'); ?></p>
        <hr>
        
        <?php foreach ($keranjangPelanggan as $item): ?>
            <div class="flex-toko">
                <span><?= $item['nama']; ?> (x<?= $item['jumlah']; ?>)</span>
                <span><?= formatRupiah($item['harga'] * $item['jumlah']); ?></span>
            </div>
        <?php endforeach; ?>
        
        <hr>

        <?php
        // Memanggil fungsi-fungsi yang telah dibuat di atas
        $subtotal = hitungTotal($keranjangPelanggan);
        $diskon = hitungDiskon($subtotal);
        $totalAkhir = $subtotal - $diskon;
        ?>

        <div class="flex-toko">
            <strong>Subtotal:</strong>
            <span><?= formatRupiah($subtotal); ?></span>
        </div>
        
        <div class="flex-toko" style="color: red;">
            <strong>Diskon (10% jika > Rp100rb):</strong>
            <span>- <?= formatRupiah($diskon); ?></span>
        </div>
        <hr>
        
        <div class="flex-toko" style="font-size: 1.2em; font-weight: bold;">
            <span>Total Bayar:</span>
            <span><?= formatRupiah($totalAkhir); ?></span>
        </div>
    </div>

</body>
</html>