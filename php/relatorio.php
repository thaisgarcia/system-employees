<?php
		$user="root";
		$password="";
		$database="teste";
		$hostname="localhost";
						
		$conexao = mysql_connect($hostname, $user, $password)or die("erro na conexão"); //cria a conexão com o banco de dados
		mysql_select_db($database)or die("erro na seleção do banco");
						
		$query="SELECT DISTINCT codfun,nome,depto,funcao,imagem,salario From cadfun INNER JOIN cargos ON cargos.codC = cadfun.codC;";	//consulta(seleciona) os dados da tabela 'cadfun'
		$result_query=mysql_query($query)or die("Erro na query: " . $query . " " . mysql_error());

        $html = "<table border='0.1' text-align='center'>";
		$html .= "<tr><th> CÓDIGO </th>";
		$html .= "<th> NOME </th>";
		$html .= "<th> DEPARTAMENTO </th>";
		$html .= "<th> FUNÇÃO </th>";
		$html .= "<th> FOTO </th>";
		$html .= "<th> SALÁRIO </th></tr>";
        while($row=mysql_fetch_array($result_query)){ //lista os dados para pdf
            $html .= "<tr><td width='90px' height='100px'>" . $row[0] . "</td>";
            $html .= "<td width='120px' height='100px'>" . $row[1] . "</td>";
            $html .= "<td width='90px' height='100px'>" . $row[2] . "</td>";
            $html .= "<td width='90px' height='100px'>" . $row[3] . "</td>";
            $html .= '<td width="90px" height="100px"><img src="data:image/gif;base64,' . $row[4] . '" width="35px"/></td>';
            $html .= "<td width='90px' height='100px'> R$ " . $row[5] . "</td></tr>";
        }	
        $html .= "</table>";
        
        //biblioteca utilizada
        use Dompdf\Dompdf;

        //include autoloader
        require_once("dompdf/autoload.inc.php");

        //Criando a Instancia
        $dompdf = new DOMPDF();
            
        //Carrega seu HTML
        $dompdf->load_html('
        <h2 style="text-align: center;">RELATÓRIO</h2> 
            '. $html .'
        ');

        //Renderizar o html
        $dompdf->render();

        //Exibir a página
        $dompdf->stream(
            "Relatório.pdf", 
            array(
                "Attachment" => true //realiza o download
            )
        );
?>