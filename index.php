<?php
$conn = mysqli_connect("localhost","root","","spk_motor");
$motor = mysqli_query($conn, "SELECT * FROM motor");
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
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SPK Memilih Sepeda Motor</title>
</head>
<body>
	<form action="" method="post">
		<input type="text" name="nama" placeholder="Nama Motor" required="">
		<select name="harga" id="id_harga" required="">
			<option value="5"> Harga > 15jt</option>
			<option value="4"> 12jt - 15jt</option>
			<option value="3"> 10jt - 12jt</option>
			<option value="2"> Harga < 10jt</option>
		</select>
		<select name="cc" id="cc">
			<option value="5"> > 150 cc</option>
			<option value="4"> 125cc - 150cc </option>
			<option value="3"> 110cc - 120cc </option>
			<option value="2"> < 110cc</option>
		</select>
		<select name="desain" id="desain">
			<option value="5"> Bagus</option>
			<option value="3"> Lumayan</option>
			<option value="1"> Jelek </option>
		</select>
		<select name="tahun" id="tahun">
			<option value="5"> > 5th lalu</option>
			<option value="3"> 2th - 5th lalu</option>
			<option value="1"> tahun ini - 2th lalu </option>
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
				<th>Aksi</th>
			</tr>
			<?php $i = 1; while ( $row = mysqli_fetch_assoc($motor)): ?>
			<tr>
				<td><?= $i++; ?></td>
				<td><?= $row['nama'];?></td>
				<td><?= $row['harga'];?></td>
				<td><?= $row['cc'];?></td>
				<td><?= $row['desain'];?></td>
				<td><?= $row['tahun_keluar'];?></td>
				<td><a href="index.php?hapus_id=<?= $row['id']; ?>" onclick="return confirm('Hapus data ? ');">Hapus</a></td>
			</tr>
		<?php endwhile; ?>
		</table>
	</div>
</body>
</html>
<?php 
	
?>