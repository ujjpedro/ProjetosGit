<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Lista de Alunos";
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
        <legend>Procurar Alunos</legend>
        <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <table>
	    <tr>
            <td><b>Código |</b></td>
            <td><b>Nome |</b></td> 
            <td><b>Data de Nascimento |</b></td>
            <td><b>Idade |</b></td>
            <td><b>Série</b></td>
        </tr>
        <?php
            $pdo = Conexao::getInstance(); 
            $consulta = $pdo->query("SELECT * FROM aluno 
                                     WHERE nome LIKE '$procurar%' 
                                     ORDER BY nome");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
                $hoje = date("Y");
                $nasc = date("Y",strtotime($linha['dataNascimento']));
                
        ?>
	    <tr>
            <td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['dataNascimento']));?></td>
            <td><?php echo $hoje - $nasc;?></td>
            <td><?php echo $linha['serie'];?></td>
	    </tr> 
        <?php } ?>    
        </table>
    </fieldset>
    </form>
</body>
</html>
