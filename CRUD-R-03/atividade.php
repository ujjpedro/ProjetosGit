<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Lista de Atividades";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<?php include "menu.php"; ?>
    <form method="post">
    <fieldset>
        <legend>Procurar Matérias</legend>
        <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <table>
	    <tr>
            <td><b>Código |</b></td>
            <td><b>Matéria |</b></td> 
            <td><b>Prazo de Entrega</b></td>
        </tr>
        <?php
            $pdo = Conexao::getInstance(); 
            $consulta = $pdo->query("SELECT * FROM atividade 
                                     WHERE materia LIKE '$procurar%' 
                                     ORDER BY materia");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
                $hoje = date("Y");
                
        ?>
	    <tr>
            <td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['materia'];?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['prazoEntrega']));?></td>
	    </tr> 
        <?php } ?>     
        </table>
    </fieldset>
    </form>
</body>
</html>
