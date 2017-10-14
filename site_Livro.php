<?php
$metodo = $_SERVER['REQUEST_METHOD'];
$con= new PDO('mysql:host=localhost;dbname=empresa','root','');
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		<title>Copia Libri</title>
		<style type="text/css">

			body{
				background-image: url(eka-01-l.jpg);
			}
			a{
				text-decoration: none;
				color: white;
			}
			a:hover{
				opacity: 0.5;
				cursor: pointer;
			}
			.inline-block{
				display: inline-block;
			}
			.menu1{
				text-shadow: 5px 5px 5px black;
				border-radius: 5px;
				text-align: center;
				width: 70%;
				font-size: 150%;
				color: black;
				background: black;
				border-radius: 5px;font-family: "Century Gothic",CenturyGothic,AppleGothic,sans-serif;margin-left: 17%;
			}
			.margem-menu-componentes{
				margin-left: 4%;
				margin-right: 4%;
				text-shadow: 0.1em 0.1em 0.2em black;
			}
			.capa
			{
				margin-left: auto;
				margin-right: auto;
				width: 70%;
				height: 200px;
				text-align: center;
			}
			.fontecapa
			{
				font-size: 95pt;
				font-family:"arial black";
				color: white;
				text-shadow: 5px 5px 5px black;
			}
			*{
			margin: 0;
			padding: 0;
			}
			.nav_tabs{
			width: 600px;
			height: auto;
			margin: auto; 
			background-color: white;
			position: relative;
			}

			.nav_tabs ul{
			list-style: none;
			}

			.nav_tabs ul li{
			float: left;
			}

			.tab_label{
			display: block;
			width: 100px;
			background-color: black;
			padding: 25px;
			font-size: 20px;
			color:white;
			cursor: pointer;
			text-align: center;
			}


			.nav_tabs .rd_tab { 
			display:none;
			position: absolute;
			}

			.nav_tabs .rd_tab:checked ~ label { 
			background-color: gray;
			color: white;}

			.tab-content{
			border-top: solid 5px gray;
			background-color:white;
			display: none;
			position: absolute;
			height: auto;
			width: 600px;
			left: 0;	
			}

			.rd_tab:checked ~ .tab-content{
			display: block;
			}
			.tab-content h2{
			padding: 10px;
			color: black;
			}
			.tab-content article{
			padding: 10px;
			color: black;
			}
			table 
			{
				font-family: arial, sans-serif;
				font-size: 8pt;
    			border-collapse: collapse;
    			width: 100%;
    			background-color: white;
			}

			td, th {
    			border: 1px solid #dddddd;
    			text-align: left;
    			padding: 8px;
			}

			tr:nth-child(even) {
    			background-color: #dddddd;
			}
			.capal
			{
				margin-left: 150px;
				width: 300px;
				height: 400px;
			}

		</style>
	</head>
	<body>

		<div class="menu1">
			<div class="inline-block margem-menu-componentes"><a href="index.php">Inicio</a></div>
			<div class="inline-block margem-menu-componentes"><a href="site_Livros.php">Livros</a></div>
			<div class="inline-block margem-menu-componentes"><a href="site_Gerencia.php">Gerência</a></div>
			<div class="inline-block margem-menu-componentes"><a href="#">Sobre</a></div>
			<div class="inline-block margem-menu-componentes"><a href="#">Contato</a></div>
		</div>
		
		<div class="capa">
			<div class="fontecapa">Copia Libri</div>
		</div>
		<?php if($metodo == "POST" && isset($_POST['isbn'])){
					$stmt = $con->prepare("SELECT * FROM LIVRO WHERE isbn = ?");
					$stmt->bindParam(1,$_POST["isbn"]);
					$stmt->execute();
					$fetch= $stmt->fetch();		

		 ?>
			<nav class="nav_tabs">
			<ul>
				<li>
					<input type="radio" id="tab1" class="rd_tab" name="tabs" checked>
					<label for="tab1" class="tab_label">Capa</label>
					<div class="tab-content">
						<article>
							<img class = "capal" src=<?php echo "'uploads/".$fetch['Capa']."'"; ?>></td>
						</article>
					</div>
				</li>
				<li>
					<input type="radio" name="tabs" class="rd_tab" id="tab2">
					<label for="tab2" class="tab_label">Detalhes</label>
					<div class="tab-content">
						<article>
							<table>
								<tr>
									<th>Título</th>
									<td><?php echo $fetch['Titulo']; ?></td>
								</tr>
								<tr>
									<th>Autor</th>
									<td><?php echo $fetch['Autor']; ?></td>
								</tr>
								<tr>
									<th>Editora</th>
									<td><?php echo $fetch['Editora']; ?></td>
								</tr>
								<tr>
									<th>Ano</th>
									<td><?php echo $fetch['Ano']; ?></td>
								</tr>
								<tr>
									<th>Assunto</th>
									<td><?php echo $fetch['Assunto']; ?>a</td>
								</tr>	
								<tr>
									<th>ISBN</th>
									<td><?php echo $fetch['ISBN']; ?></td>
								</tr>
								<tr>
									<th>País de Produção</th>
									<td><?php echo $fetch['PaisDeProducao']; ?></td>
								</tr>
								<tr>
									<th>N° de páginas</th>
									<td><?php echo $fetch['Paginas']; ?></td>
								</tr>
								<tr>
									<th>Idioma</th>
									<td><?php echo $fetch['Idioma']; ?></td>
								</tr>
								<tr>
									<th>Edição</th>
									<td><?php echo $fetch['Edicao']; ?></td>
								</tr>

								<tr>
									<th>Faixa etária</th>
									<td><?php echo $fetch['FaixaEtaria']; ?></td>
								</tr>
								<tr>
									<th>Altura</th>
									<td><?php echo $fetch['Altura']; ?></td>
								</tr>
								<tr>
									<th>Comprimento</th>
									<td><?php echo $fetch['Comprimento']; ?></td>
								</tr>
								<tr>
									<th>Peso</th>
									<td><?php echo $fetch['Peso']; ?></td>
								</tr>
								<tr>
									<th>Encadernação</th>
									<td><?php echo $fetch['Encadernacao']; ?></td>
								</tr>
								<tr>
									<th>Preço</th>
									<td>R$<?php echo $fetch['Preco']; ?></td>
								</tr>
							</table>
						</article>
					</div>
				</li>
			</ul>
		</nav>
		<?php } ?>
	</body>
</html>

