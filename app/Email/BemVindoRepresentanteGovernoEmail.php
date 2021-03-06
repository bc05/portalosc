<?php

namespace App\Email;

use App\Email\Email;

class BemVindoRepresentanteGovernoEmail extends Email
{
	public function enviar($destinatario, $assunto, $nomeUsuario)
	{
		$conteudo = $this->obterConteudo($nomeUsuario);
		return $this->enviarEmail($destinatario, $assunto, $conteudo);
	}
	
    public function obterConteudo($nomeUsuario)
    {
        return
        '<html>
		<head>
		<title>E-mail Boas Vindas</title>
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
		<h1 style="padding: 0.5em;margin: 0;"><font size="6" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Cadastro ativado!</font></h1>
		</td>
		</tr>
		<tr>
		<td  colspan="3" bgcolor="#FFFFFF" style="padding:20px;">
		<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Prezado(a) Sr(a) ' . $nomeUsuario . ',</font> </p>
		<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Comunicamos que o seu cadastro no Mapa das OSCs foi ativado com sucesso.</font> </p>
		<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">A partir de agora, o(a) senhor(a) está habilitado a carregar na página do Mapa os dados referentes às parcerias celebradas pelo seu Estado ou município com Organizações da Sociedade Civil (OSCs). </font> </p>
		<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">O envio dos dados pode ser feito clicando neste link <a target="_blank" href="https://mapaosc.ipea.gov.br/entrada-dados.html">https://mapaosc.ipea.gov.br/entrada-dados.html</a></font> </p>
		<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Os dados são fundamentais para dar publicidade e transparência às parcerias do governo com as OSCs, como preceitua o Novo Marco Legal das OSCs, na Lei n. 13.019/2014.</font> </p>
		<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Agradecemos a sua atuação para tornar os governos mais transparentes e para conhecermos melhor a atuação das OSCs no país.</font> </p>
		<p style="text-indent: 2.5em;text-align: justify;"> <font size="4" face="Roboto, arial narrow, helvetica condensed, helvetica, arial, sans-serif">Atenciosamente,</font> </p>
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
