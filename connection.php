<?php
$koneksi = mysqli_connect("localhost", "root", "", "pbi_rw07");

// Check connection
if (mysqli_connect_errno()) {
	echo "Error Connection On  : " . mysqli_connect_error();
}
