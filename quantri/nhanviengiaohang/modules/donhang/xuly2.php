<?php  
	$id=$_GET['id'];
	$update="UPDATE donhang SET tinhTrang='4' WHERE idDonHang='".$id."'";
	$query=mysqli_query($conn,$update);
	header('location:index.php?quanly=donhang&ac=lietke');
?>