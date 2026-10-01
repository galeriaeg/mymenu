<?php
	ini_set( 'display_errors', 0 );
	
	function cont(){
		
		$id = $_GET["m"];
		
		
		switch ($id) {
		
			case 0:
			$titulo =  "Dashboard";
			include ("modules/dashboard/index.php");
			break;
			
			case 1:
			$titulo =  "Dashboard";
			include ("modules/dashboard/index.php");
			break;
			
			/******/
			
			case 2:
			$titulo = "Perfil";
			include ("modules/perfil/index.php");
			break;
			
			case 21:
			$titulo = "Perfil";
			include ("modules/perfil/cadastra.php");
			break;
			
			
			
			/******/
			
			case 3:
			$titulo = "Cardápio";
			include ("modules/cardapio/index.php");
			break;	
			
			case 31:
			$titulo = "Cardápio";
			include ("modules/cardapio/cadastra.php");
			break;		

			case 32:
			$titulo = "Cardápio";
			include ("modules/cardapio/edita.php");
			break;	

			case 33:
			$titulo = "Cardápio";
			include ("modules/cardapio/exclui.php");
			break;
			
			case 34:
			$titulo = "Cardápio";
			include ("modules/cardapio/remove.php");
			break;	

			case 35:
			$titulo = "Cardápio";
			include ("modules/cardapio/status.php");
			break;	
			
			/******/
			
			case 4:
			$titulo = "Categorias";
			include ("modules/categorias/index.php");
			break;
						
			case 41:
			$titulo = "Categorias";
			include ("modules/categorias/cadastra.php");
			break;
			
			case 42:
			$titulo = "Categorias";
			include ("modules/categorias/exclui.php");
			break;
			
			/******/
			
			case 5:
			$titulo = "Itens";
			include ("modules/itens/index.php");
			break;		
			
			case 51:
			$titulo = "Itens";
			include ("modules/itens/cadastra.php");
			break;
			
			case 52:
			$titulo = "Itens";
			include ("modules/itens/excluir.php");
			break;

			
			
			/******/
			
			
			case 6:
			$titulo = "Personalização";
			include ("modules/custumizacao/index.php");
			break;
			
			case 61:
			$titulo = "Personalização";
			include ("modules/custumizacao/cadastra.php");
			break;	

			
				
			
			/******/
			
			case 7:
			$titulo = "Links";
			include ("modules/links/index.php");
			break;
			
			case 71:
			$titulo = "Links";
			include ("modules/links/cadastra.php");
			break;			

			case 72:
			$titulo = "Links";
			include ("modules/links/exclui.php");
			break;	
			
			/******/
			
			case 8:
			$titulo = "Plano contratado";
			include ("modules/plano/index.php");
			break;
			
			case 81:
			$titulo = "Plano contratado";
			include ("modules/plano/confirma.php");
			break;			

			
			/******/
			
			case 9:
			include ("logout.php");
			break;
			
			
			case 999:
			$titulo = "qr";
			include ("modules/qr/index.php");
			break;
			


			
			default:
			include ("logout.php");
			break;
		}
	}
?>