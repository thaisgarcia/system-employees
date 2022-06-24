<!DOCTYPE html>
<html lang="en">
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

	<div class="flex-container operacoes">
		<div class="texto-form">
			<h2>Alterar</h2><br>
			
			<form enctype="multipart/form-data" method="post" >
				<label>id: <input type="text" name="id"/></label><br></br>
				<label>Nome: <input type="text" name="txtNome"/></label><br></br>
				<label>Departamento: <input type="text" name="txtDepto"/></label><br></br>
				<label>Função:</label>
					<select name="options">
						<option value="1">Professor(a)</option>
						<option value="2">Diretor(a)</option>
						<option value="3">Coordenador(a)</option>
						<option value="4">Auxiliar de Limpeza</option>
					</select>				
				<br></br>
				<input type="file" name="foto"/><br></br>
				<input class="btn" type="submit" value="Alterar" name="alterar"><br>
			</form>
		</div>
	</div>	
	
	<?php
		$user="root";
		$password="";
		$database="teste";
		$hostname="localhost";
		
		$nome  = isset($_POST['txtNome']) ? $_POST['txtNome'] : '';
		$funcao = $_POST['options']= (isset($_POST['options']) ) ? $_POST['options'] : null;
		$depto = isset($_POST['txtDepto']) ? $_POST['txtDepto'] : '';
		$id = isset($_POST['id']) ? $_POST['id'] : false; 
		$foto = $_FILES['foto']= (isset($_FILES['foto']) ) ? $_FILES['foto'] : null;

		if(is_array($foto)){
			$conexao = mysql_connect($hostname, $user, $password)or die("erro na conexão"); //conecta com o servidor
			mysql_select_db($database)or die("erro na seleção do banco"); //seleciona o banco de dados
			
			//com o id, seleciona os dados da tabela 'cadfun'
			$busca=mysql_query("SELECT * FROM cadfun WHERE codfun='$id'"); 
			$dados = mysql_fetch_array($busca)or die;

			$fotoName = $_FILES['foto']['name'];
			$fotoTmpName = $_FILES['foto']['tmp_name'];
			$fotoSize = $_FILES['foto']['size'];
			$fotoError = $_FILES['foto']['error'];
			$fotoType = $_FILES['foto']['type'];
			//usando explode, strtolower e array para definir a extensão da imagem
			$fotoExt = explode('.', $fotoName);
			$fotoActualExt = strtolower(end($fotoExt));
			$allowed = array('jpg', 'jpeg', 'png');//tipos permitidos
		
			//isso verificará se a extensão real se encaixa nos tipos de array $allowed 
			if (in_array($fotoActualExt, $allowed)) {
			//isso verificará se há erros de upload
			if ($fotoError === 0) {
				//isso vai verificar o tamanho do arquivo, é possível fazer o mesmo usando uma entrada oculta com MAX_FILE_SIZE no formulário
			if ($fotoSize < 1000000) {
			//convertendo a imagem em uma string
			$image = file_get_contents($fotoTmpName);
			//convertendo agora para uma sequência base64 para armazenar
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

			$query = "update cadfun set nome='$nome',depto='$depto',codC='$funcao', imagem='$image' WHERE codfun='$id'";
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