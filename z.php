
<? ob_clean(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: newsletter ::</title>
<style type="text/css">
<!--
body,td,th {
    color: #FFFFFF;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 9px;
}
#form1 #emails {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 9px;
    color: #666666;
}
#form1 #Enviar {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #333333;
    background-color: #999999;
}
.uaA {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 9px;
}
#form1 #html {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 9px;
    color: #FF0000;
}
body {
	background-color: #000000;
}
-->
</style>
</head>
<body>

<?php
@ignore_user_abort(TRUE);
error_reporting(0);
@set_time_limit(0);
ini_set("memory_limit","-1");
// Pega os valores dos forms para as vari&#1073;veis.
$enviar = $_POST['Enviar'];       // Pega o valor do bot&#1075;o Enviar caso ele seja pressionado.
$remetente = $_POST['remetente']; // Pega o email do remetente.
$nome = $_POST['nome'];           // Pega o nome do remetente.
$assunto = $_POST['assunto'];     // Pega o assunto.
$e_retorno = $_POST['returpath']; // Pega o email para retornar os erros (Return-Path)
$lista_emails = $_POST['emails']; // Pega a lsita de emails.
$lista_html = $_POST['html'];     // Pega os codigos html.
$emails_lista = explode("\n", $lista_emails); // Pegas os emails separados por quebra de linha "\n".
$numemails = count($emails_lista); // Pega a quantidade de emails da lista.
$mensagem = $lista_html;
$mensagem = stripslashes($mensagem); // Para ver mais http://www.supertrafego.com.br/php_stripslashes.asp
?>

<label>
<table align="center" width="847" border="0" align="center">
  <tr>
    <td width="841" align="center">

    <?php
    if ($enviar){
    echo ("Msg Enviada");
    }
    ?>    </td>
  </tr>
</table>
<table align="center" width="294" border="0" align="center" cellspacing="0">
  <tr>
    <td width="292">
<?php
if ($enviar){

// Cabe&#1079;alhos
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: $nome <$remetente>\r\n";
$headers .= "Return-Path: <$e_retorno>\r\n";
$headers .= "Reply-To: <$remetente>\r\n";

echo ('Nome do Remetente: ' . $nome . '<br>');
echo ('E-mail do Remetente: ' . $remetente . '<br>');
echo ('Assunto: ' . $assunto . '<br>');
echo ('E-mail de retorno: ' . $e_retorno . '<br>');
echo ('Quantidade de email: ' . $numemails . '<br>');
?>

</td>
  </tr>
  <tr>
    <td>
<?php
// Sistema para enviar os emails
for($x=0; $x<$numemails; $x++){
$quanti++;
$email_go = $emails_lista[$x];
$ass = "";
$ass = str_replace("[email]", $email_go, $assunto);
$bodyhtml = "";
$bodyhtml = str_replace("[email]", $email_go, $mensagem);
$mail = mail($email_go, $ass, $bodyhtml, $headers);
if ($mail==1) {
$okenviado++;
echo('<font color="#C0C0C0">Enviando: ' . $quanti . '&nbsp;<b>' . $email_go .  '</b></font><br>');
} else {
$erroenviado++;
echo('<font color="red">N&#1075;o enviado: ' . $quanti . '&nbsp;<b>' . $email_go .  '</b></font><br>');
sleep(1);}
}
echo('<font color="#0033FF" size="1" face="Verdana, Arial, Helvetica, sans-serif">FINALIZADO COM SUCESSO</font><br>');
echo ('Total de E-mals enviados com sucesso: ' . $okenviado . '<br>');
echo ('Total de E-mails n&#1075;o enviados: ' . $erroenviado . '<br>');
}
?>

</td>
  </tr>
</table>
</label>
<label>
<div align="center">
<table width="370" border="0" bgcolor="#C0C0C0">
  <tr align="center" >
    <td width="370" height="437" align="center" bgcolor="#000000"><form action="" method="post" name="form1" class="uaA" id="form1">

      <label>&nbsp;</label>
      <center><table align="center" width="370" border="0">
        <tr align="center" >
          <td width="180" height="15" align="center" bgcolor="#666666"><label> 
            Nome:</label></td>
          <td width="180" height="15" align="center" bgcolor="#666666"><label>
            Remetente:</label></td>
        </tr>
        <tr align="center" >

          <td align="center" bgcolor="#666666">
            <input name="nome" type="text" class="uaA" id="nome" size="30" value=""/></td>
          <td align="center" bgcolor="#666666">
            <input name="remetente" type="text" class="uaA" id="remetente" value="" size="30" /></td>
        </tr>
        <tr align="center" >
          <td height="15" align="center" bgcolor="#666666"><label>Assunto:</label></td>
          <td height="15" align="center" bgcolor="#666666"><label>Email de 
			retorno:</label></td>
        </tr>
        <tr align="center" >

          <td height="16" align="center" bgcolor="#666666"><label>
	   <input name="assunto" type="text" class="uaA" id="assunto" value="" size="36" />
          </label></td>
          <td height="16" align="center" bgcolor="#666666"><label>
            <input name="returpath" type="text" class="uaA" id="returpath" value="" size="30" />
          </label></td>
        </tr>
      </table>
      <label><br />

      <br />
      <br />
      C&#1091;digos HTML <br />
     <textarea name="html" cols="70" rows="15" id="html">

</textarea>
      <br />
      <br />
      Lista de emails <br />

      </label>
      <table  align="center" width="200" border="0">
        <tr align="center" >
          <td><textarea name="emails" cols="50" rows="6" id="emails">
</textarea></td>
        </tr>
      </table>
      <p>

        <input name="Enviar" type="submit" id="Enviar"value="Enviar" />
      </p>
    </form></td>
  </tr>
</table>

</div>
</body>
</html>
<? die; ?>
