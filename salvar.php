<?php
	$conn = new mysqli("localhost","root","","myupload");
	
	$pasta = "arquivos/";
	
	$tmp_name = $_FILES["documento"]["tmp_name"];
	$nome = $_FILES["documento"]["name"];
	$cod = date("YmaHis") . "-" . $_FILES["documento"]["name"];
	$uploadfile = $pasta . basename($cod); // basename retorna o nome do arquivo
	print("$tmp_name");
	
	if(move_uploaded_file($tmp_name,$uploadfile)){
		$sql = "INSERT INTO arquivos (documento, `data`) VALUES ('".$cod."', '".date("Y-m-d")."')";
		$res = $conn->query($sql) or die($conn->error);
	}else{
		return header('Location: index.php?status=erro');
	}

	return header('Location: index.php?status=sucesso');
?>




