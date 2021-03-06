<?php

namespace App\Email;

use App\Email\Email;

class InformeCadastroRepresentanteOscIpeaEmail extends Email
{
	public function enviar($destinatario, $assunto, $representanteOsc, $osc)
	{
		$conteudo = $this->obterConteudo($representanteOsc, $osc);
		return $this->enviarEmail($destinatario, $assunto, $conteudo);
	}
	
    public function obterConteudo($representanteOsc, $osc)
    {
        $nomeOsc = $osc->tx_nome_osc;
        $emailOsc = $osc->tx_email ?: '';
        $nomeUsuario = $representanteOsc->nome;
        $email = $representanteOsc->email;
        $cpf = $representanteOsc->cpf;
        
        return
        '<html>
    	<head>
    	<title>E-mail Informativo ao Ipea</title>
    	</head>
    	<body bgcolor="#FFFFFF" style="margin: 0 auto; font-size: 16px;">
    	<table id="Table_01" border="0" align="center" cellpadding="0" cellspacing="0" style="border: 2px solid #f4f4f4; min-width:300px; width:100%; max-width:700px; margin:20px auto;">
    	<tbody>
    	<tr>
    	<td colspan="3" style="padding:20px;">
    	<img src="https://github.com/Plataformas-Cidadania/mapa-osc-client/blob/master/img/logo.png?raw=true" height="97" alt=""/>
    	</td>
    	</tr>
    	<tr>
    	<td height="27" colspan="3" bgcolor="#F4F4F4" style="padding:10px 20px;">
    	<h1 style="padding: 0.5em;margin: 0;"><font size="6" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">E-mail Informativo ao Ipea</font></h1>
    	</td>
    	</tr>
    	<tr>
    	<td  colspan="3" bgcolor="#FFFFFF" style="padding:20px;">
    	<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Um representante da  <b> ' . $nomeOsc . '</b> se cadastrou no Mapa das OSCs.</font> </p>
    	<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Abaixo seguem os dados do cadastro. Um email com as seguintes informações foi enviado para:<b>' . $emailOsc . '</b>.</font> </p>
    	<br/>
    	<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif"><strong>Dados do Representante:</strong></font></p>
    	<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Nome: ' . $nomeUsuario . ' </font></p>
    	<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">CPF: ' . $cpf . ' </font></p>
    	<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">E-mail: ' . $email . ' </font></p>
    	</td>
    	</tr>
    	<tr>
    	<td width="auto"></td>
    	<td valign="middle" align="right" style="padding:20px;">
    	<img src="https://github.com/Plataformas-Cidadania/mapaosc/blob/master/src/main/webapp/imagens/loading.png?raw=true" height="71" width="71" alt=""/>
    	</td>
    	<td width="420" bgcolor="#FFFFFF" valign="middle" style="padding: 20px 0;">
    	<p style="text-align: justify; margin: 0;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Equipe do Mapa das OSCs</font> </p>
    	<p style="text-align: justify; margin: 0;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif"><a href="https://mapaosc.ipea.gov.br">Mapa das OSCs</a> - ' . $this->capturarData() . '.</font> </p>
    	</td>
    	</tr>
    	</tbody>
    	</table>
    	</body>
    	</html>';
    }
}
