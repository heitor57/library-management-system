<?php
function nomeesenha(){
	 return "<input type='hidden' name = 'nome' value='".$_POST["nome"]."'' /> <input type='hidden' name = 'senha' value='".$_POST["senha"]."'/>";
}
function isAdm(){

	if($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['senha']) > 0 && strlen($_POST['nome']) > 0){
	$con= new PDO('mysql:host=localhost;dbname=empresa','root','');
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $con->prepare('SELECT NOME,SENHA FROM ADMINISTRADOR WHERE NOME = ? AND SENHA = ? ');
	$stmt->bindParam(1,$_POST["nome"]);
	$stmt->bindParam(2,$_POST["senha"]);
	$stmt->execute();
	$retorno = $stmt->fetch();
		if(strlen($retorno[0])>0){
			return true;
		}
	
	}	
	return false;
}

if(isAdm() == true){
?>
<form id="form"  method = "POST" action="./site_CEE.php">
	<div style="text-align: center;"><h1>Começando sessão de administrador</h1></div>
	<?php echo "<input type='hidden' name = 'nome' value='".$_POST["nome"]."'' /> <input type='hidden' name = 'senha' value='".$_POST["senha"]."'/>"   ?>

</form>
<script type="text/javascript">
  document.getElementById('form').submit();
</script>
<?php


}else {
header("location:./site_Gerencia.php");
}
?>