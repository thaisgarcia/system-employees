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
    
	<main>
		<p class="parte1">Seja bem-vindo(a)! <br> Este é um projeto PHP ligado com um banco de dados MySQL, realizado nas aulas de Programação Web II com orientação do professor Ronie Robson Campos. 
		<br> Curso: Desenvolvimento de Sistemas
		<br></br> Tipo de servidor: MariaDB
		<br> Versão do servidor: 10.1.37-MariaDB
		<br> Versão do PHP: 5.6.40 
		<br> Versão do PhpMyAdmin: 4.8.4 </p> <br>

		<hr>

		<p class="parte2"> 
		CREATE DATABASE teste; <br></br> CREATE TABLE cadfun (
		<br>&#160&#160&#160&#160 codfun int primary key auto_increment, 
		br>&#160&#160&#160&#160 nome varchar(40) not null,
		<br>&#160&#160&#160&#160 depto char(2),
		<br>&#160&#160&#160&#160 codC int,
		<br>&#160&#160&#160&#160 imagem  longblob
		<br>);<br></br>CREATE TABLE cargos (
		<br>&#160&#160&#160&#160 codC int primary key auto_increment, 
		<br>&#160&#160&#160&#160 funcao char(20),
		<br>&#160&#160&#160&#160 salario double
		<br>);<br></br>
		ALTER TABLE cadfun
		<br>&#160&#160&#160&#160 ADD CONSTRAINT codC FOREIGN KEY(codC) REFERENCES cargos(codC);
		</p>
    </main>
	
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