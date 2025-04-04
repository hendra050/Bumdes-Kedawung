<?php
include __DIR__ . '/header.php';
include '../koneksi.php';

// Ambil data operator dengan role_operator
$operator = mysqli_query($koneksi, "SELECT user_username, role_operator FROM user WHERE user_level = 'pertashop-op'");

// Inisialisasi array untuk menyimpan gaji
$gaji_data = [];

while ($op = mysqli_fetch_array($operator)) {
    $username = $op['user_username'];
    $role_operator = $op['role_operator']; // Menggunakan kolom yang baru ditambahkan

    // Ambil total penjualan per operator
    $query = mysqli_query($koneksi, "SELECT SUM(output_jual) as total_liter FROM omset_pertashop WHERE username = '$username'");
    $result = mysqli_fetch_array($query);
    $total_liter = $result['total_liter'] ?? 0;

    // Atur gaji pokok dan target
    if ($role_operator == "operator") {
        $gaji_pokok = 1200000;
        $target = 1000; // Target liter penjualan
    } else { // Jika operator magang
        $gaji_pokok = 900000;
        $target = 0; // Operator magang tidak mendapatkan bonus
    }

    // Hitung bonus
    $bonus = 0;
    if ($total_liter > $target && $role_operator == "operator") {
        $bonus = floor(($total_liter - $target) / 100) * 100000;
    }

    // Total gaji
    $total_gaji = $gaji_pokok + $bonus;

    // Simpan ke array
    $gaji_data[] = [
        'username' => $username,
        'role_operator' => ucfirst(str_replace('_', ' ', $role_operator)), // Menampilkan dalam format rapi
        'total_liter' => $total_liter,
        'gaji_pokok' => number_format($gaji_pokok),
        'bonus' => number_format($bonus),
        'total_gaji' => number_format($total_gaji)
    ];
}
?>

<div class="content-wrapper">
<section class="content-header">
    <h1>Perhitungan Gaji Operator</h1>
</section>

<section class="content">
    <div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Daftar Gaji Operator</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
        <thead>
            <tr>
            <th>No</th>
            <th>Username</th>
            <th>Role</th>
            <th>Total Penjualan (Liter)</th>
            <th>Gaji Pokok</th>
            <th>Bonus</th>
            <th>Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($gaji_data as $gaji) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $gaji['username']; ?></td>
                <td><?php echo $gaji['role_operator']; ?></td>
                <td><?php echo $gaji['total_liter']; ?> L</td>
                <td>Rp <?php echo $gaji['gaji_pokok']; ?></td>
                <td>Rp <?php echo $gaji['bonus']; ?></td>
                <td>Rp <?php echo $gaji['total_gaji']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
    </div>
    </div>
</section>
</div>

<?php include __DIR__ . '/footer.php'; ?>
