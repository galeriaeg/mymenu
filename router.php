<?php
	
	switch ($page) {
	
		case "criar-conta":
		include_once "src/criar-conta/form.php";
		break;
		
		case "criar-conta&pl=3":
		include_once "src/criar-conta/form.php";
		break;

		case "criar-conta&pl=6":
		include_once "src/criar-conta/form.php";
		break;

		case "criar-conta&pl=12":
		include_once "src/criar-conta/form.php";
		break;
		
		case "confirma-conta":
		include_once "src/criar-conta/confirma.php";
		break;
		
		case "valida-conta":
		include_once "src/criar-conta/valida.php";
		break;
		
		case "login":
		include_once "src/fazer-login/form.php";
		break;		
		
		case "autentica":
		include_once "src/fazer-login/form-token.php";
		break;		
		
		case "planos":
		include_once "src/planos/planos.php";
		break;

		case "recuperar-senha":
		include_once "src/recuperar-senha/form.php";
		break;
		
		
		case "contato":
		include_once "src/contato/form.php";
		break;
		

		
		default:
		include_once "src/fazer-login/form.php";
	}				
	
?>