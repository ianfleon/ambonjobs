<?php

// Koneksi Database
require_once 'koneksi.php';

// --------------------- KONVERSI WAKTU -------------------- //

function ubahWaktu($waktu) {

    $date[] = explode('-', $waktu);

    $thn = $date[0][0];
    $bln = $date[0][1];
    $tgl = $date[0][2];

    if($bln < 10) {
        $bln = substr($bln, 1);
    }


    $bulan = array (1 =>   'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
        );

   $new_bulan = $bulan[$bln];

   $waktu = $tgl . " " . $new_bulan . " " . $thn;

   return $waktu;
}

// ------------------------- LIHAT DATA (SELECT SQL'S QUERY) ------------------- //

// Fungsi Lihat Data
function querySelect($query) {

	global $conn;
	// Exec Query SELECT
	$result = mysqli_query($conn, $query);

	$rows = [];

	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}

// ----------------------- UPLOAD GAMBAR FUNCTION ------------------------- //

// Fungsi Upload Gambar Ke Server
function uploadGambar($gambar) {

	$nama_gambar = $gambar["name"];
	$temp_gambar = $gambar["tmp_name"];
	$tipe_gambar = $gambar["type"];
	$ukuran_gambar = $gambar["size"];

	$ekstensi_gambar = explode(".", $nama_gambar);
	$ekstensi_gambar_baru = end($ekstensi_gambar);

	$nama_gambar_baru = uniqid() . '.' . $ekstensi_gambar_baru;

	$upImg = move_uploaded_file($temp_gambar, '../img/' . $nama_gambar_baru);

	return $nama_gambar_baru;
}

// -------------------------- TEMPAT ----------------------------- //

// Fungsi Tambah Tempat
function tambahTempat($data, $img) {

	global $conn;

	$nama = $data["nama"];
	$link_web = $data["link_web"];
	$telp = $data["telp"];
	$email = $data["email"];
	$tentang = $data["tentang"];

	$gambar_temp = $img["gambar"];
	$gambar = uploadGambar($gambar_temp);

	$query = "INSERT INTO tempat_tb VALUES (
		'', '$nama', '$gambar', '$link_web', '$telp', '$email', '$tentang' 
	)";

	$result = mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// -------------------------------------------------------------------- //

// Fungsi Edit Tempat
function editTempat($data, $img) {

	global $conn;

	$id = $data["id_t"];

	$nama = $data["nama"];
	$link_web = $data["link_web"];
	$telp = $data["telp"];
	$email = $data["email"];
	$tentang = $data["tentang"];

	$gambar_temp = $img["gambar"];
	$gambar = uploadGambar($gambar_temp);

	$query = "UPDATE tempat_tb SET
		nama_t = '$nama',
		gambar = '$gambar',
		link_web = '$link_web',
		telepon = '$telp',
		email = '$email',
		tentang = '$tentang'
		WHERE id_tempat = '$id'
	";

	$result = mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


// ----------------------- LOKER ----------------------------- //

// Fungsi Tambah Loker
function tambahLoker($data) {

	global $conn;

	$id_t = $data["id_t"];

	$nama = $data["nama"];
	$bidang = $data["bidang"];
	$gaji = $data["gaji"];
	$alamat = $data["alamat"];
	$buka = $data["buka"];
	$tutup = $data["tutup"];
	$waktu = $data["waktu"];
	$tipe = $data["tipe"];
	$lokasi = $data["lokasi"];
	$deskripsi = $data["deskripsi"];
	$persyaratan = $data["persyaratan"];
	$catatan = $data["catatan"];

	$query =  "INSERT INTO loker_tb VALUES (
		'', '$nama', '$bidang', '$gaji', '$alamat',
		'$buka', '$tutup',
		'$waktu', '$tipe', '$lokasi',
		'$deskripsi', '$persyaratan', '$catatan', '$id_t'
	)";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

// --------------------------------------------------------- //

// Fungsi Tambah Loker
function editLoker($data) {

	global $conn;

	$id_t = $data["id_t"];
	$id_l = $data["id_l"];

	$nama = $data["nama"];
	$bidang = $data["bidang"];
	$gaji = $data["gaji"];
	$alamat = $data["alamat"];
	$buka = $data["buka"];
	$tutup = $data["tutup"];
	$waktu = $data["waktu"];
	$tipe = $data["tipe"];
	$lokasi = $data["lokasi"];
	$deskripsi = $data["deskripsi"];
	$persyaratan = $data["persyaratan"];
	$catatan = $data["catatan"];

	$query = "UPDATE loker_tb SET
		nama_l = '$nama',
		bidang = '$bidang',
		gaji = '$gaji',
		alamat = '$alamat',
		waktu_buka = '$buka',
		waktu_tutup = '$tutup',
		waktu_pekerjaan = '$waktu',
		tipe_pekerjaan = '$tipe',
		lokasi = '$lokasi',
		deskripsi = '$deskripsi',
		persyaratan = '$persyaratan',
		catatan = '$catatan',
		id_tempat = '$id_t'
		WHERE id_loker = '$id_l'

	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}