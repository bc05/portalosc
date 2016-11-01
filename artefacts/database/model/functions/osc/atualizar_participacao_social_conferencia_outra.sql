DROP FUNCTION IF EXISTS portal.atualizar_participacao_social_conferencia_outra(id INTEGER, idconferenciaoutra INTEGER, idconferenciadeclarada INTEGER, ftconferenciadeclarada TEXT, dtinicioconferencia DATE, ftdatainicioconferencia TEXT, dtfimconferencia DATE, ftdatafimconferencia TEXT, cdformaparticipacaoconferencia INTEGER, ftformaparticipacaoconferencia TEXT);

CREATE OR REPLACE FUNCTION portal.atualizar_participacao_social_conferencia_outra(id INTEGER, idconferenciaoutra INTEGER, idconferenciadeclarada INTEGER, ftconferenciadeclarada TEXT, dtinicioconferencia DATE, ftdatainicioconferencia TEXT, dtfimconferencia DATE, ftdatafimconferencia TEXT, cdformaparticipacaoconferencia INTEGER, ftformaparticipacaoconferencia TEXT)
 RETURNS TABLE(
	mensagem TEXT
)AS $$

BEGIN 

	UPDATE 
		osc.tb_participacao_social_conferencia_outra
	SET 
		id_conferencia_declarada = idconferenciadeclarada, 
		ft_conferencia_declarada = ftconferenciadeclarada, 
		id_osc = id, 
		dt_data_inicio_conferencia = dtinicioconferencia, 
		ft_data_inicio_conferencia = ftdatainicioconferencia, 
		dt_data_fim_conferencia = dtfimconferencia, 
		ft_data_fim_conferencia = ftdatafimconferencia, 
		cd_forma_participacao_conferencia = cdformaparticipacaoconferencia, 
		ft_forma_participacao_conferencia = ftformaparticipacaoconferencia
	
	WHERE 
		id_conferencia_outra = idconferenciaoutra;
	
	mensagem := 'Participação Social Conferencia Outra atualizada';
	RETURN NEXT;
END; 
$$ LANGUAGE 'plpgsql';