<?php
$conn = mysqli_connect("localhost","root","","spk_motor");
$motor = mysqli_query($conn, "SELECT * FROM motor");
$cost_harga = mysqli_fetch_row(mysqli_query($conn, "SELECT MIN(harga) FROM motor"));
$cost_tahun = mysqli_fetch_row(mysqli_query($conn, "SELECT MIN(tahun_keluar) FROM motor"));
$benf_cc = mysqli_fetch_row(mysqli_query($conn, "SELECT MAX(cc) FROM motor"));
$benf_desain = mysqli_fetch_row(mysqli_query($conn, "SELECT MAX(desain) FROM motor"));

if (isset($_POST['submit'])) 
	{
		$nama = $_POST['nama'];
		$harga = $_POST['harga'];
		$cc = $_POST['cc'];
		$desain = $_POST['desain'];
		$tahun_keluar = $_POST['tahun'];
		$query = "INSERT INTO motor VALUES ('','$nama','$harga','$cc','$desain',$tahun_keluar)";
		mysqli_query($conn,$query);
		echo "<meta http-equiv='refresh' content='0'>";
	} 
if (isset($_GET['hapus_id'])) {
	# code...
	$id = $_GET['hapus_id'];
	$query = "DELETE FROM motor WHERE id = $id ";
	mysqli_query($conn,$query);
	echo "<script>
	alert('Data berhasil dihapus');
	document.location.href = 'index.php';
	</script>";
}
$list_harga = [
	5 => " Harga lebih 15jt",
	4 => "12.000.001 - 15.000.000",
	3 => "10.000.000 - 12.000.000",
	2 => "  Kurang dari 10.000.000 "
];
$list_cc = [
	5 => " > 150cc",
	4 => "125cc - 150cc",
	3 => "110cc - 124cc",
	2 => "  Kurang dari 110cc "
];
$list_desain = [
	5 => " Sangat bagus",
	3 => "Bagus",
	1 => " Jelek "
];$list_tahun = [
	5 => " Lebih 5th lalu",
	3 => " 2th - 5th lalu",
	1 => "  kurang dari 2th lalu  "
];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SPK Memilih Sepeda Motor</title>
</head>
<body>
	<div>
		<h1>SPK Metode SAW untuk mencari Motor paling sesuai</h1>
	</div>
	<form action="" method="post">
		<input type="text" name="nama" placeholder="Nama Motor" required="">
		<select name="harga" id="id_harga" required="">
			<option value="5"> Harga lebih 15jt</option>
			<option value="4"> 12.000.001 - 15.000.000</option>
			<option value="3"> 10.000.000 - 12.000.000</option>
			<option value="2"> Harga < 10.000.000</option>
		</select>
		<select name="cc" id="cc">
			<option value="5"> > 150 cc</option>
			<option value="4"> 125cc - 150cc </option>
			<option value="3"> 110cc - 124cc </option>
			<option value="2"> < 110cc</option>
		</select>
		<select name="desain" id="desain">
			<option value="5">Sangat Bagus</option>
			<option value="3"> Bagus</option>
			<option value="1"> Jelek </option>
		</select>
		<select name="tahun" id="tahun">
			<option value="5"> > 5th lalu</option>
			<option value="3"> 2th - 5th lalu</option>
			<option value="1"> Kurang dari 2th lalu </option>
		</select>	
		<button name="submit" type="submit">Submit</button>
	</form>
	<div style="margin-top: 20px;">
		<table border="1" cellpadding="10px" cellspacing="0">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Harga</th>
				<th>CC</th>
				<th>Desain</th>
				<th>Tahun</th>
				<th>Value</th>
				<th>Aksi</th>
			</tr>
			<?php $i = 1; while ( $row = mysqli_fetch_assoc($motor)): ?>
			<tr>
				<td><?= $i++; ?></td>
				<td><?php echo $row['nama']; ?></td>
				<td><?php echo $list_harga[$row['harga']]; $v1 = $cost_harga[0]/$row['harga']; ?></td>
				<td><?php echo $list_cc[$row['cc']]; $v2 = $row['cc']/$benf_cc[0]; ?></td>
				<td><?php echo $list_desain[$row['desain']]; $v3 = $row['desain']/$benf_desain[0]; ?></td>
				<td><?php echo $list_tahun[$row['tahun_keluar']]; $v4 = $cost_tahun[0]/$row['tahun_keluar']; ?></td>
				<td><?php echo $w = ($v1*0.4)+($v2*0.3)+($v3*0.1)+($v4*0.2); ?></td>
				<td><a href="index.php?hapus_id=<?= $row['id']; ?>" onclick="return confirm('Hapus data ? ');">Hapus</a></td>
			</tr>
		<?php endwhile; ?>
		</table>
	</div>
</body>
</html>
<?php 
	
?>