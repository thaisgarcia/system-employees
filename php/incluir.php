<!DOCTYPE html>
<html lang='pt-br'>
	<head> 
		<meta charset="UTF-8"> 
		<meta name="viewport" content="width-device-width, initial-scale=1.0">
		<title>CRUD</title>
    	<link rel="stylesheet" href="./css/style.css">
	</head>
	
	<body>
		<header>
			<?php include "header.php"; ?>
		</header>

		<div class="flex-container operacoes">
			<div class="texto-form">
				<h2>Cadastrar:</h2><br>
				<form enctype="multipart/form-data" method="post">
					<label>Nome: <input type="text" name="txtNome"/></label><br></br>
					<label>Departamento: <input type="text" name="txtDepto"/></label><br></br>
					<label>Função: 
					<select name="options">
						<option value="1">Professor(a)</option>
						<option value="2">Diretor(a)</option>
						<option value="3">Coordenador(a)</option>
						<option value="4">Auxiliar de Limpeza</option>
					</select>
					</label>
					<br></br>
					<input type="file" name="foto"/><br></br>
					<input class="btn" type="submit" value="Enviar"/><br>
				</form>
			</div>
		</div>	
		
		<?php	
			$nome = $_POST['txtNome']= (isset($_POST['txtNome']) ) ? $_POST['txtNome'] : null;
			$depto = $_POST['txtDepto']= (isset($_POST['txtDepto']) ) ? $_POST['txtDepto'] : null;
			$funcao = $_POST['options']= (isset($_POST['options']) ) ? $_POST['options'] : null;
			$foto = $_FILES['foto']= (isset($_FILES['foto']) ) ? $_FILES['foto'] : null;
			
			if(is_array($foto)){
				$fotoName = $_FILES['foto']['name'];
				$fotoTmpName = $_FILES['foto']['tmp_name'];
				$fotoSize = $_FILES['foto']['size'];
				$fotoError = $_FILES['foto']['error'];
				$fotoType = $_FILES['foto']['type'];
				//using explode, strtolower and array to define the extension of the image
				$fotoExt = explode('.', $fotoName);
				$fotoActualExt = strtolower(end($fotoExt));
				$allowed = array('jpg', 'jpeg', 'png');//allowed types
					
				//this will check if the actual extension fit in the array $allowed types
				if (in_array($fotoActualExt, $allowed)) {
				//this will check for upload errors
				if ($fotoError === 0) {
				//this will check for the file size, remember that it's possible to do the same using a hidden input with MAX_FILE_SIZE on the form
				if ($fotoSize < 1000000) {
				//converting the picture into a evil string
				$image = file_get_contents($fotoTmpName);
				//converting now to a base64 string for storing, be warned it's 33% larger than the actual string
				$image = base64_encode($image);
					} else {
						echo "Arquivo muito grande.";
					}
					} else {
						echo "Erro com o upload.";
					}
					} else {
						echo "Não suportado. Use imagens do tipo jpg, jpeg ou png.";
					}	
					
				$user="root";
				$password="";
				$database="teste";
				$hostname="localhost";

				$conexao = mysql_connect($hostname, $user, $password)or die("erro na conexão"); //conecta com o servidor
				mysql_select_db($database)or die("erro na seleção do banco"); //seleciona o banco de dados
						
				$query = "insert into cadfun (codfun, nome, depto, codC, imagem) values (null, '{$nome}', '{$depto}', '{$funcao}', '{$image}');";
				$result_query=mysql_query($query)or die("Erro na query: " . $query . " " . mysql_error());
			}
		?>

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