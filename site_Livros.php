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
				width: 100px;
				height: 150px;
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
			<nav class="nav_tabs">
			<ul>
				<li>
					<input type="radio" id="tab1" class="rd_tab" name="tabs" checked>
					<label for="tab1" class="tab_label">Buscar</label>
					<div class="tab-content">
						<article>
							<fieldset>
								<form method = "POST">
									<div>
										<div><label>Título</label></div>
										<div><input type="text" name="titulo" size="30"><br></div>
									</div>
									<div>
										<div><label>Autor</label></div>
										<div><input type="text" name="autor" size="30"><br></div>
									</div>
									<div>
										<div><label>Editora</label></div>
										<div><input type="text" name="editora" size="30"><br></div>
									</div>
									<div>
										<div><label>Ano</label></div>
										<div><input type="text" name="ano" size="30"><br></div>
									</div>
									<div>
										<div><label>Genêro</label></div>
										<div><input type="text" name="genero" size="30"><br></div>
									</div>
									<div>
										<div><label>ISBN</label></div>	
										<div><input type="text" name="isbn" size="30"><br></div>
									</div>
									<div>
										<div><label>Estado</label></div>	
										<div><input type="text" name="estado" size="30"><br></div>
									</div>
									<div>
										<div><label>Cidade</label></div>	
										<div><input type="text" name="cidade" size="30"><br></div>
									</div>
									<input type="submit" value="Enviar" name="submit">
								</form>
							</fieldset>
						</article>
					</div>
				</li>
				<li>
					<input type="radio" name="tabs" class="rd_tab" id="tab2">
					<label for="tab2" class="tab_label">Listar</label>
					<div class="tab-content">
						<article>
							<?php
							if($metodo == "POST" && isset($_POST['submit']) ){
								$who =array();
								$search = "";
								if(!empty($_POST['titulo'])){
									$search = $search."AND titulo = ?";
									array_push($who,'titulo');
								}
								if(!empty($_POST['autor'])){
									$search = $search."AND autor = ?";
									array_push($who,'autor');
								}
								if(!empty($_POST['editora'])){
									$search = $search."AND editora = ?";
									array_push($who,'editora');
								}
								if(!empty($_POST['ano'])){
									$search = $search."AND ano = ?";
									array_push($who,'ano');
								}
								if(!empty($_POST['genero'])){
									$search = $search."AND genero = ?";
									array_push($who,'genero');
								}
								if(!empty($_POST['isbn'])){
									$search = $search."AND isbn = ?";
									array_push($who,'isbn');
								}
								if(!empty($_POST['estado'])){
									$search = $search."AND li.estado = ?";
									array_push($who,'estado');
								}
								if(!empty($_POST['cidade'])){
									$search = $search."AND li.cidade = ?";
									array_push($who,'cidade');
								}
								$stmt = $con->prepare("select l.*,li.Estado,li.Cidade from livro l,livraria_livro ll, livraria li where li.CNPJ = ll.CNPJ AND ll.ISBN = l.ISBN ".$search);

								for($count = 0;$count < sizeof($who); $count++)
									$stmt->bindParam($count+1,$_POST[$who[$count]]);
								
								$stmt->execute();
								$fetchall= $stmt->fetchAll();
								for($i = 0;$i < sizeof($fetchall);$i++){

									echo "
									<table>
										<tr>
											<th>Capa</th>
											<th>Título</th>
											<th>Autor</th>
											<th>Editora</th>
											<th>Ano</th>
											<th>Genêro</th>
											<th>ISBN</th>
											<th>Preço</th>
										</tr>"."
										<tr>
										<form method = 'POST' action='./site_Livro.php'>
											<td><input type='image' alt='sem imagem Entrar' class = 'capal' src='uploads/".$fetchall[$i]['Capa']."'></td>
											<input type= 'hidden' name= 'isbn' value=".$fetchall[$i]['ISBN'].">
										</form>
											<td>".$fetchall[$i]['Titulo']."</td>
											<td>".$fetchall[$i]['Autor']."</td>
											<td>".$fetchall[$i]['Editora']."</td>
											<td>".$fetchall[$i]['Ano']."</td>
											<td>".$fetchall[$i]['Genero']."</td>
											<td>".$fetchall[$i]['ISBN']."</td>
											<td>".$fetchall[$i]['Preco']."</td>
										</tr>	
									</table>
									";
								}

							}else{
								$stmt = $con->prepare("SELECT * FROM LIVRO");
								$stmt->execute();
								$fetchall= $stmt->fetchAll();
								for($i = 0;$i < sizeof($fetchall);$i++){
									echo "
									<table>
										<tr>
											<th>Capa</th>
											<th>Título</th>
											<th>Autor</th>
											<th>Editora</th>
											<th>Ano</th>
											<th>Genêro</th>
											<th>ISBN</th>
											<th>Preço</th>
										</tr>"."
										<tr>
										<form method = 'POST' action='./site_Livro.php'>
											<td><input type='image' alt='sem imagem Entrar' class = 'capal' src='uploads/".$fetchall[$i]['Capa']."'></td>
											<input type= 'hidden' name= 'isbn' value=".$fetchall[$i]['ISBN'].">
										</form>
											<td>".$fetchall[$i]['Titulo']."</td>
											<td>".$fetchall[$i]['Autor']."</td>
											<td>".$fetchall[$i]['Editora']."</td>
											<td>".$fetchall[$i]['Ano']."</td>
											<td>".$fetchall[$i]['Genero']."</td>
											<td>".$fetchall[$i]['ISBN']."</td>
											<td>".$fetchall[$i]['Preco']."</td>
										</tr>	
									</table>
									";
								}
							}
							?>
						</article>
					</div>
				</li>
			</ul>
		</nav>

	</body>
</html>

