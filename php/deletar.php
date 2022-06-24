<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CRUD</title>
    	<link rel="stylesheet" href="./css/style.css">
	</head>
	<body>
		<header>
			<?php include "header.php"; ?>
		</header>
		
		<?php 
			$id = $_POST['txtId']= (isset($_POST['txtId']) ) ? $_POST['txtId'] : null;	
		?>

		<div class="flex-container operacoes">
			<div class="texto-form">
				<h2>Excluir</h2><br>
				<form method="post">
					<label>Pesquise pelo id: <input type="text" name="txtId" value='<?php if(isset($_POST["excluir"])){ echo ""; }else{ echo $id; }?>'/></label><br></br>
					<input class="btn" type="submit" value="Selecionar" name="selecionar"/>
					<input class="btn" type="submit" value="Excluir" name="excluir"/><br></br>
				</form>

				<?php
					$user="root";
					$password="";
					$database="teste";
					$hostname="localhost";
					
					$conexao = mysql_connect($hostname, $user, $password)or die("erro na conexão"); //conecta com o servidor
					mysql_select_db($database)or die("erro na seleção do banco"); //seleciona o banco de dados
					
					if(isset($_POST["selecionar"])){	//se o botão 'selecionar' for apertado, selecionará os dados de 'cadfun' de acordo com id
						$query="SELECT DISTINCT codfun,nome,depto,funcao,imagem,salario From cadfun INNER JOIN cargos ON cargos.codC = cadfun.codC Where codfun={$id}";
						$result_query=mysql_query($query)or die("Erro na query: " . $query . " " . mysql_error());
						
						echo "<table border='0.1' align='center'>";
						while($row=mysql_fetch_array($result_query)){ 
							print "<tr><td>" . $row[0] . "</td>";
							print "<td>" . $row[1] . "</td>";
							print "<td>" . $row[2] . "</td>";
							print "<td>" . $row[3] . "</td>";
							print '<td><img src="data:image/gif;base64,' . $row[4] . '" width="35px"/></td>';
							print "<td> R$ " . $row[5] . "</td></tr>";
						}	
						echo "</table><br>";
					}
					else if(isset($_POST["excluir"])){ 	//se o botão 'excluir' for clicado, deletará os dados de acordo com id
						$query = "DELETE FROM cadfun WHERE codfun={$id}";
						$result_query=mysql_query($query)or die("Erro na query: " . $query . " " . mysql_error());
					}
				?>
			</div>
		</div>	

		<footer class="footer">
			<div class="dados">
				<h6> Desenvolvido por: Thais Garcia &#160&#160&#160
				<a href="https://www.instagram.com/tha_grc/" target="_blank"><img src="./images/instagram.png" class="svg-inline--fa"/></a>
				<a href="https://github.com/thaisgarcia" target="_blank"><img src="./images/github.png" class="svg-inline--fa"/></a>
				<a href="https://wa.link/qfbu73" target="_blank"><img src="./images/whatsapp.png" class="svg-inline--fa"/></a>
				<a href="https://www.linkedin.com/in/thais-garcia-6474a6217/" target="_blank"><img src="./images/linkedin.png" class="svg-inline--fa"/></a></h6><br>
				<h6> Etec Jacinto Ferreira de Sá - Ourinhos-SP | CEP: 19907-000 <br></br> &copy; 2022 | Operações CRUD </h6>
			</div>
		</footer>
	</body>
</html>