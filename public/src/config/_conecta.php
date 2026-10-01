<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$banco = "cardapp";
	
	$conexao = new mysqli($host,$user,$pass,$banco) ;
	if($conexao->connect_errno){
		echo "nao conectado";
		echo "Erro ao conectar:(".$conexao->connect_errno.")".$conexao->connect_error;	
	}
	else{
		//echo "conectado!!";
	}
	
?>

