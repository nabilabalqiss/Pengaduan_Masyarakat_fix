<?php
$db = mysqli_connect("tiduapnl.com","u901156130_masyarakat","PengaduanMasyarakat1111","u901156130_masyarakat");
if(!$db){
echo "Gagal koneksi";
}

function logged_admin() {
    global $db, $admin_login, $divisi, $id_admin;
    
    $sql = "SELECT * FROM admin, divisi WHERE admin.username = ? AND admin.divisi = divisi.id_divisi";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $admin_login);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    while ($col = $result->fetch_assoc()) {
        $divisi = $col['nama_divisi'];
        $id_admin = $col['id_admin'];
    }
}
?>