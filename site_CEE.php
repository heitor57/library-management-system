
<?php
$con;
$cnpj_adm;
$metodo = $_SERVER['REQUEST_METHOD'];
$nome_final;
function uploadseguro(){
	global $nome_final;
	// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = 'uploads/';
	// Tamanho máximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
	// Array com as extensões permitidas
	$_UP['extensoes'] = array('jpg', 'png');
	// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
	$_UP['renomeia'] = false;
	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['capa']['error'] != 0) {
	  echo "Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['capa']['error']];
	  return false; // Para a execução do script
	}
	// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
	// Faz a verificação da extensão do arquivo
	$temporario_zzzz = explode('.', $_FILES['capa']['name']);
	$extensao = strtolower(end($temporario_zzzz));
	if (array_search($extensao, $_UP['extensoes']) === false) {
	  echo "Por favor, envie arquivos com as seguintes extensões: jpg, png";
	  return false;
	}
	// Faz a verificação do tamanho do arquivo
	if ($_UP['tamanho'] < $_FILES['capa']['size']) {
	  echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
	  return false;
	}
	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	// Primeiro verifica se deve trocar o nome do arquivo
	if ($_UP['renomeia'] == true) {
	  // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
	  $nome_final = md5(time()).'.jpg';
	} else {
	  // Mantém o nome original do arquivo
	  $nome_final = $_FILES['capa']['name'];
	}
	  
	// Depois verifica se é possível mover o arquivo para a pasta escolhida
	if (move_uploaded_file($_FILES['capa']['tmp_name'], $_UP['pasta'] . $nome_final)) {
		return true;
	} else {
	  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
	  echo "Não foi possível enviar o arquivo, tente novamente";
	  
	}
	return false;
}
function nomeesenha(){
	 return "<input type='hidden' name = 'nome' value='".$_POST["nome"]."'' /> <input type='hidden' name = 'senha' value='".$_POST["senha"]."'/>";
}
function isAdm(){
	global $con;
	global $cnpj_adm;
	if($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['senha']) > 0 && strlen($_POST['nome']) > 0){
	$con= new PDO('mysql:host=localhost;dbname=empresa','root','');
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $con->prepare('SELECT NOME,SENHA,CNPJ FROM ADMINISTRADOR WHERE NOME = ? AND SENHA = ? ');
	$stmt->bindParam(1,$_POST["nome"]);
	$stmt->bindParam(2,$_POST["senha"]);
	$stmt->execute();
	$retorno = $stmt->fetch();
		if(strlen($retorno[0])>0){
			$cnpj_adm = $retorno['CNPJ'];
			return true;
		}
	
	}	
	return false;
}
if(isAdm() == true){
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
			.obj0
			{
				margin-left: auto;
				margin-right: auto;
				width: 70%;
				height: 850px;
			}
			.obj1
			{
				margin-left: auto;
				margin-right: auto;
				width: 100%;
				height: 805px;
				background-color:white; 
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
			color: #black;
			}
			.tab-content article{
			padding: 10px;
			color: black;
			height: auto;
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
					<label for="tab1" class="tab_label">Cadastrar</label>
					<div class="tab-content">
						<article>
							<fieldset>
							<form method="POST" enctype="multipart/form-data">
								<?php echo nomeesenha(); ?>
								<b>Campos obrigatorios</b><br>
								ISBN <input type="text" name="isbn" autofocus><br>
								Paginas <input type="number" name="paginas"><br>
								Edição <input type="number" name="edicao"><br>
								Gênero <input type="text" name="genero"><br>
								Idioma <input type="text" name="idioma"><br>
								Assunto <input type="text" name="assunto"><br>
								Título <input type="text" name="titulo"><br>
								Autor <input type="text" name="autor"><br>
								<b>Campos opcionais</b><br>
								Preço <input type="number" name="preco"><br>
								Peso <input type="number" name="peso"><br>
								Altura <input type="number" name="altura"><br>
								Comprimento <input type="number" name="comprimento"><br>
								Pais de Produção <input type="text" name="paisdeproducao"><br>
								Encadernação <input type="text" name="encadernacao"><br>
								Editora <input type="text" name="editora"><br>
								Faixa Etaria <input type="text" name="faixaetaria"><br>
								Ano <input type="number" name="ano"><br>
								<input type="file" name="capa" style="width: auto;"><br>
								<input type="submit" name="submit" value="Cadastrar"><br>
								
							</form>
							</fieldset>
						</article>
					</div>
				</li>
				<li>
					<input type="radio" name="tabs" class="rd_tab" id="tab2">
					<label for="tab2" class="tab_label">Editar</label>
					<div class="tab-content">
						<article>
							<fieldset>
							<form method="POST" enctype="multipart/form-data">
								<?php echo nomeesenha(); ?>
								<b>Campos obrigatorios</b><br>
								ISBN <input type="text" name="isbnantigo" autofocus><br>
								<b>Campos opcionais</b><br>
								ISBN <input type="text" name="isbn" autofocus><br>
								Paginas <input type="number" name="paginas"><br>
								Edição <input type="number" name="edicao"><br>
								Gênero <input type="text" name="genero"><br>
								Idioma <input type="text" name="idioma"><br>
								Assunto <input type="text" name="assunto"><br>
								Título <input type="text" name="titulo"><br>
								Autor <input type="text" name="autor"><br>
								Preço <input type="number" name="preco"><br>
								Peso <input type="number" name="peso"><br>
								Altura <input type="number" name="altura"><br>
								Comprimento <input type="number" name="comprimento"><br>
								Pais de Produção <input type="text" name="paisdeproducao"><br>
								Encadernação <input type="text" name="encadernacao"><br>
								Editora <input type="text" name="editora"><br>
								Faixa Etaria <input type="text" name="faixaetaria"><br>
								Ano <input type="number" name="ano"><br>
								<input type="file" name="capa" style="width: auto;"><br>
								<input type="submit" name="submit" value="Editar"><br>
								
							</form>

						</fieldset>
						</article>
					</div>
				</li>
				<li>
					<input type="radio" name="tabs" class="rd_tab" id="tab3">
					<label for="tab3" class="tab_label">Excluir</label>
					<div class="tab-content">
						<article>
							<fieldset>
								<form method="POST">
									<?php echo nomeesenha(); ?>
									ISBN <input type="text" name="isbn" autofocus><br>
									<input type="submit" name="submit" value="Excluir"><br>
								
								</form>
						</fieldset>
						</article>
					</div>
				</li>
			</ul>
		</nav>

	</body>
</html>

<?php
if($metodo == "POST" && isset($_POST['submit'])){
	if($_POST['submit'] == "Cadastrar" ){
		if(isset($_POST['isbn']) && isset($_POST['paginas']) && isset($_POST['edicao']) && isset($_POST['idioma']) && isset($_POST['assunto']) && isset($_POST['titulo']) && isset($_POST['genero']) && isset($_POST['autor']) ){
			try{
				$stmt = $con->prepare("INSERT INTO `livro` (`ISBN`, `Encadernacao`, `Peso`, `Altura`, `Comprimento`, `Editora`, `Paginas`, `Edicao`, `FaixaEtaria`, `PaisDeProducao`, `Ano`, `Idioma`, `Assunto`, `Titulo`, `Capa`, `Genero`,`Preco`,`Autor`) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?,?, ?,?, ?, ?, ?, ?, ?, ?)");
				uploadseguro();
				$stmt->bindParam(1,$_POST["isbn"]);
				$stmt->bindParam(2,$_POST["encadernacao"]);
				$stmt->bindParam(3,$_POST["peso"]);
				$stmt->bindParam(4,$_POST["altura"]);
				$stmt->bindParam(5,$_POST["comprimento"]);
				$stmt->bindParam(6,$_POST["editora"]);
				$stmt->bindParam(7,$_POST["paginas"]);
				$stmt->bindParam(8,$_POST["edicao"]);
				$stmt->bindParam(9,$_POST["faixaetaria"]);
				$stmt->bindParam(10,$_POST["paisdeproducao"]);
				$stmt->bindParam(11,$_POST["ano"]);
				$stmt->bindParam(12,$_POST["idioma"]);
				$stmt->bindParam(13,$_POST["assunto"]);
				$stmt->bindParam(14,$_POST["titulo"]);
				$stmt->bindParam(15,$nome_final);
				$stmt->bindParam(16,$_POST["genero"]);
				$stmt->bindParam(17,$_POST["preco"]);
				$stmt->bindParam(18,$_POST["autor"]);
				$stmt->execute();
				$stmt = $con->prepare('INSERT INTO LIVRARIA_LIVRO(ISBN,CNPJ)  VALUES (?,?)');
				$stmt->bindParam(1,$_POST["isbn"]);
				$stmt->bindParam(2,$cnpj_adm);
				$stmt->execute();
			}catch(Exception $e){
				echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Ocorreu o seguinte erro:<br>";
				echo $e;
			}
		}
		
	}else if($_POST['submit'] == "Excluir"){
		try{
			$stmt = $con->prepare("DELETE FROM LIVRO WHERE ISBN = ?");
			$stmt->bindParam(1,$_POST["isbn"]);
			$stmt->execute();
		}catch(Exception $e){
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Ocorreu o seguinte erro:<br>";
			echo $e;
		}
	}else if($_POST['submit'] == "Editar"){
		if(isset($_POST['isbnantigo'])){
			try{
				$stmt = $con->prepare("SELECT * FROM LIVRO WHERE ISBN = ? ");
				$stmt->bindParam(1,$_POST["isbnantigo"]);
				$stmt->execute();
				$tempfetch= $stmt->fetch();
				$stmt = $con->prepare("UPDATE `livro` SET `ISBN`=?,`Encadernacao`=?,`Peso`=?,`Altura`=?,`Comprimento`=?,`Editora`=?,`Paginas`=?,`Edicao`=?,`FaixaEtaria`=?,`PaisDeProducao`=?,`Ano`=?,`Idioma`=?,`Assunto`=?,`Titulo`=?,`Capa`=?,`Genero`=?, `Preco`=?,`Autor`=? WHERE ISBN = ?");
				uploadseguro();
				$i = 1;
				if(!empty($_POST["isbn"]))
					$stmt->bindParam($i,$_POST["isbn"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["encadernacao"]))
					$stmt->bindParam($i,$_POST["encadernacao"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["peso"]))
					$stmt->bindParam($i,$_POST["peso"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["altura"]))
					$stmt->bindParam($i,$_POST["altura"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["comprimento"]))
					$stmt->bindParam($i,$_POST["comprimento"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["editora"]))
					$stmt->bindParam($i,$_POST["editora"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["paginas"]))
					$stmt->bindParam($i,$_POST["paginas"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["edicao"]))
					$stmt->bindParam($i,$_POST["edicao"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["faixaetaria"]))
					$stmt->bindParam($i,$_POST["faixaetaria"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["paisdeproducao"]))
					$stmt->bindParam($i,$_POST["paisdeproducao"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["ano"]))
					$stmt->bindParam($i,$_POST["ano"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["idioma"]))
					$stmt->bindParam($i,$_POST["idioma"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["assunto"]))
					$stmt->bindParam($i,$_POST["assunto"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["titulo"]))
					$stmt->bindParam($i,$_POST["titulo"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($nome_final))
					$stmt->bindParam($i,$nome_final);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["genero"]))
					$stmt->bindParam($i,$_POST["genero"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["preco"]))
					$stmt->bindParam($i,$_POST["preco"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;
				if(!empty($_POST["autor"]))
					$stmt->bindParam($i,$_POST["autor"]);
				else
					$stmt->bindParam($i,$tempfetch[$i-1]);
				$i++;

				$stmt->bindParam(19,$_POST["isbnantigo"]);
				$stmt->execute();
				$stmt = $con->prepare('UPDATE LIVRARIA_LIVRO SET ISBN = ? WHERE ISBN = ?');
				if(!empty($_POST["isbn"]))
					$stmt->bindParam(1,$_POST["isbn"]);
				else
					$stmt->bindParam(1,$tempfetch["ISBN"]);
				$stmt->bindParam(2,$isbnantigo);
				
				$stmt->execute();
			}catch(Exception $e){
				echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Ocorreu o seguinte erro:<br>";
				echo $e;
			}
		}
	}
}

}else {
header("location:./site_Gerencia.php");
}

?>
