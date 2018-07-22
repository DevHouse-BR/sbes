# Banco de Dados prefeitura Rodando em localhost 
# phpMyAdmin SQL Dump
# version 2.5.4
# http://www.phpmyadmin.net
#
# Servidor: localhost
# Tempo de Generação: Jun 14, 2005 at 01:48 PM
# Versão do Servidor: 4.1.0
# Versão do PHP: 4.3.4
# 
# Banco de Dados : `prefeitura`
# 

# --------------------------------------------------------

#
# Estrutura da tabela `arquivo_programa_social`
#

CREATE TABLE `arquivo_programa_social` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL default '',
  `path` varchar(255) binary NOT NULL default '',
  `ext` varchar(4) NOT NULL default '',
  `tamanho` varchar(20) NOT NULL default '',
  `programa_social` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cd`),
  UNIQUE KEY `path` (`path`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `beneficios`
#

CREATE TABLE `beneficios` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `programa_social` int(10) unsigned NOT NULL default '0',
  `DOMICILIO` int(10) unsigned NOT NULL default '0',
  `PESSOA` int(10) unsigned default NULL,
  `data` datetime NOT NULL default '0000-00-00 00:00:00',
  `valor` decimal(10,2) NOT NULL default '0.00',
  `qtd` int(11) NOT NULL default '0',
  `nr_recibo` varchar(30) NOT NULL default '',
  `historico` varchar(255) NOT NULL default '',
  `usuario_sistema` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cd`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `domicilio_1`
#

CREATE TABLE `domicilio_1` (
  `DOMICILIO` int(10) unsigned NOT NULL auto_increment,
  `COD_DOMICILIAR` varchar(10) NOT NULL default '',
  `TIP_LOGRAD_DOMIC` varchar(10) NOT NULL default '',
  `NOM_LOGRADOURO_DOMIC` varchar(50) NOT NULL default '',
  `NUM_RESIDENCIA_DOMIC` varchar(7) NOT NULL default '',
  `NOM_COMPL_RESIDENCIA_DOMIC` varchar(15) NOT NULL default '',
  `NOM_BAIRRO_RESIDENCIA_DOMIC` varchar(40) NOT NULL default '',
  `CEP_RESIDENCIA_DOMIC` varchar(8) NOT NULL default '',
  `NOM_LOCALIDADE_DOMIC` varchar(35) NOT NULL default '',
  `SIG_UF_RESIDENCIA_DOMIC` char(2) NOT NULL default '',
  `COD_DDD_RESIDENCIA_DOMIC` varchar(4) NOT NULL default '',
  `NUM_TEL_CONTATO_DOMIC` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`DOMICILIO`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `domicilio_2`
#

CREATE TABLE `domicilio_2` (
  `DOMICILIO` int(10) unsigned NOT NULL default '0',
  `TIP_LOCAL_DOMIC` tinyint(4) NOT NULL default '0',
  `NUM_DOMICILIO_COBERTO_DOMIC` tinyint(4) NOT NULL default '0',
  `SIT_DOMICILIO_DOMIC` tinyint(4) NOT NULL default '0',
  `TIP_DOMICILIO_DOMIC` tinyint(4) NOT NULL default '0',
  `NUM_COMODOS_DOMIC` tinyint(4) default NULL,
  `TIP_CONSTRUCAO_DOMIC` tinyint(4) NOT NULL default '0',
  `TIP_ABASTECIMENTO_AGUA_DOMIC` tinyint(4) NOT NULL default '0',
  `TIP_TRATAMENTO_AGUA_DOMIC` tinyint(4) NOT NULL default '0',
  `TIP_ILUMINACAO_DOMIC` tinyint(4) NOT NULL default '0',
  `TIP_ESCOAMENTO_SANITARIO_DOMIC` tinyint(4) NOT NULL default '0',
  `TIP_DESTINO_LIXO_DOMIC` tinyint(4) NOT NULL default '0',
  `TIP_ESTADO_DOMIC` tinyint(4) NOT NULL default '0',
  `TIP_VIA_ACESSO_DOMIC` tinyint(4) NOT NULL default '0',
  `TIP_BANHEIRO_DOMIC` tinyint(4) NOT NULL default '0',
  `COD_CRECHE_DOMIC` char(1) NOT NULL default '',
  `COD_ESCOLA_DOMIC` char(1) NOT NULL default '',
  `QTD_TEMPO_MORAR_ANOS_PESSOA` tinyint(4) default NULL,
  `QTD_TEMPO_MORAR_MESES_PESSOA` tinyint(4) default NULL,
  PRIMARY KEY  (`DOMICILIO`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `domicilio_3`
#

CREATE TABLE `domicilio_3` (
  `DOMICILIO` int(10) unsigned NOT NULL default '0',
  `VAL_DESP_MENSAIS_ALUGUEL_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_DESP_PREST_HAB_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_DESP_ALIMENT_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_DESP_AGUA_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_DESP_LUZ_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_DESP_TRANSPOR_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_DESP_MEDICAMENTOS_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_DESP_GAS_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_OUTRAS_DESP_PESSOA` float(16,2) NOT NULL default '0.00',
  `NUM_PESSOAS_RENDA_PESSOA` tinyint(4) NOT NULL default '0',
  `TXT_ELETRO_FAMILIA` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`DOMICILIO`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `domicilio_programa_social`
#

CREATE TABLE `domicilio_programa_social` (
  `DOMICILIO` int(10) unsigned NOT NULL default '0',
  `programa_social` int(10) unsigned NOT NULL default '0',
  `dt_inicio` date NOT NULL default '0000-00-00',
  `dt_termino` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`DOMICILIO`,`programa_social`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `historicos`
#

CREATE TABLE `historicos` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `DOMICILIO` int(10) unsigned default NULL,
  `PESSOA` int(10) unsigned default NULL,
  `data` date NOT NULL default '0000-00-00',
  `historico` text NOT NULL,
  PRIMARY KEY  (`cd`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `pessoa_1`
#

CREATE TABLE `pessoa_1` (
  `PESSOA` int(10) unsigned NOT NULL auto_increment,
  `DOMICILIO` int(10) unsigned NOT NULL default '0',
  `NOM_PESSOA` varchar(70) NOT NULL default '',
  `DTA_NASC_PESSOA` date default NULL,
  `COD_SEXO_PESSOA` char(1) NOT NULL default '',
  `NUM_NIS_PESSOA` varchar(11) NOT NULL default '',
  `COD_CERTID_CIVIL_PESSOA` tinyint(4) NOT NULL default '0',
  `COD_TERMO_CERTID_PESSOA` varchar(8) NOT NULL default '',
  `COD_LIVRO_TERMO_CERTID_PESSOA` varchar(8) NOT NULL default '',
  `COD_FOLHA_TERMO_CERTID_PESSOA` varchar(4) NOT NULL default '',
  `DTA_EMISSAO_CERTID_PESSOA` date default NULL,
  `SIG_UF_CERTID_PESSOA` char(2) NOT NULL default '',
  `NOM_CARTORIO_PESSOA` varchar(48) NOT NULL default '',
  `NUM_IDENTIDADE_PESSOA` varchar(16) NOT NULL default '',
  `TXT_COMPLEMENTO_PESSOA` varchar(5) NOT NULL default '',
  `DTA_EMISSAO_IDENT_PESSOA` date default NULL,
  `SIG_UF_IDENT_PESSOA` char(2) NOT NULL default '',
  `SIG_ORGAO_EMISSAO_PESSOA` varchar(10) NOT NULL default '',
  `NUM_CART_TRAB_PREV_SOC_PESSOA` varchar(7) NOT NULL default '',
  `NUM_SERIE_TRAB_PREV_SOC_PESSOA` varchar(5) NOT NULL default '',
  `DTA_EMISSAO_CART_TRAB_PESSOA` date default NULL,
  `SIG_UF_CART_TRAB_PESSOA` char(2) NOT NULL default '',
  `NUM_CPF_PESSOA` varchar(11) NOT NULL default '',
  `NUM_TITULO_ELEITOR_PESSOA` varchar(13) NOT NULL default '',
  `NUM_ZONA_TIT_ELEITOR_PESSOA` varchar(4) NOT NULL default '',
  `NUM_SECAO_TIT_ELEITOR_PESSOA` varchar(4) NOT NULL default '',
  `SIT_PESSOA` char(1) NOT NULL default '',
  PRIMARY KEY  (`PESSOA`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `pessoa_2`
#

CREATE TABLE `pessoa_2` (
  `PESSOA` int(10) unsigned NOT NULL auto_increment,
  `COD_NACIONALIDADE_PESSOA` tinyint(4) NOT NULL default '0',
  `NOM_PAIS_ORIGEM_PESSOA` varchar(50) NOT NULL default '',
  `DTA_CHEGADA_PAIS_PESSOA` date default NULL,
  `COD_UF_MUNIC_NASC_PESSOA` char(2) NOT NULL default '',
  `NOM_LOCALIDADE_NASC_PESSOA` varchar(35) NOT NULL default '',
  `NOM_COMPLETO_PAI_PESSOA` varchar(70) NOT NULL default '',
  `NOM_COMPLETO_MAE_PESSOA` varchar(70) NOT NULL default '',
  `COD_PAPEL_PESSOA` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`PESSOA`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `pessoa_3`
#

CREATE TABLE `pessoa_3` (
  `PESSOA` int(10) unsigned NOT NULL default '0',
  `COD_QUALIF_ESCOLAR_PESSOA` tinyint(4) NOT NULL default '0',
  `COD_GRAU_INSTRUCAO_PESSOA` tinyint(4) NOT NULL default '0',
  `NUM_SERIE_ESCOLAR_PESSOA` tinyint(4) NOT NULL default '0',
  `NOM_ESCOLA_PESSOA` varchar(115) NOT NULL default '',
  `COD_CENSO_INEP_PESSOA` varchar(8) NOT NULL default '',
  `SIT_MERCADO_TRAB_PESSOA` tinyint(4) NOT NULL default '0',
  `NOM_EMPRESA_TRAB_PESSOA` varchar(115) NOT NULL default '',
  `NUM_CNPJ_EMPRESA_PESSOA` varchar(14) NOT NULL default '',
  `DTA_ADMIS_EMPRESA_PESSOA` date default NULL,
  `NOM_OCUPACAO_EMPRESA_PESSOA` varchar(115) NOT NULL default '',
  `VAL_REMUNER_EMPREGO_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_RENDA_APOSENT_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_RENDA_SEGURO_DESEMP_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_RENDA_PENSAO_ALIMEN_PESSOA` float(16,2) NOT NULL default '0.00',
  `VAL_OUTRAS_RENDAS_PESSOA` float(16,2) NOT NULL default '0.00',
  PRIMARY KEY  (`PESSOA`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `pessoa_4`
#

CREATE TABLE `pessoa_4` (
  `PESSOA` int(10) unsigned NOT NULL default '0',
  `COD_ESTADO_CIVIL_PESSOA` tinyint(4) NOT NULL default '0',
  `COD_RACA_COR_PESSOA` tinyint(4) NOT NULL default '0',
  `NUM_ROUPA_PESSOA` tinyint(4) NOT NULL default '0',
  `NUM_CALCADO_PESSOA` tinyint(4) NOT NULL default '0',
  `COD_MEIO_TRANSP_PESSOA` tinyint(4) NOT NULL default '0',
  `NOM_EMAIL_PESSOA` varchar(50) NOT NULL default '',
  `COD_CRIANCA_0_6_ANOS_PESSOA` tinyint(4) NOT NULL default '0',
  `COD_GRAVIDA_PESSOA` tinyint(4) NOT NULL default '0',
  `COD_AMAMENTANDO_PESSOA` char(1) NOT NULL default '',
  `COD_PRE_NATAL_PESSOA` char(1) NOT NULL default '',
  `COD_METOD_ANTI_CONCEP_PESSOA` char(1) NOT NULL default '',
  `COD_CARTEIRA_VACINA_PESSOA` char(1) NOT NULL default '',
  `NOM_DEPEN_QUIMICA_PESSOA` varchar(100) NOT NULL default '',
  `TXT_DOENCAS_PESSOA` text NOT NULL,
  PRIMARY KEY  (`PESSOA`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `pessoa_programa_social`
#

CREATE TABLE `pessoa_programa_social` (
  `PESSOA` int(10) unsigned NOT NULL default '0',
  `programa_social` int(10) unsigned NOT NULL default '0',
  `dt_inicio` date NOT NULL default '0000-00-00',
  `dt_termino` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`PESSOA`,`programa_social`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `programa_social`
#

CREATE TABLE `programa_social` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `codigo` varchar(30) binary NOT NULL default '',
  `descricao` varchar(255) NOT NULL default '',
  `dt_inicio` date default NULL,
  `dt_termino` date default NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY  (`cd`),
  UNIQUE KEY `codigo` (`codigo`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `usuario_programa_social`
#

CREATE TABLE `usuario_programa_social` (
  `usuario` int(10) unsigned NOT NULL default '0',
  `programa_social` int(10) unsigned NOT NULL default '0',
  `funcao` varchar(100) NOT NULL default '',
  `regiao` varchar(100) NOT NULL default '',
  `dt_inicio` date NOT NULL default '0000-00-00',
  `dt_termino` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`usuario`,`programa_social`)
) TYPE=MyISAM CHARSET=latin1;

# --------------------------------------------------------

#
# Estrutura da tabela `usuarios_sistema`
#

CREATE TABLE `usuarios_sistema` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL default '',
  `id_social` varchar(50) NOT NULL default '',
  `usuario` varchar(50) NOT NULL default '',
  `senha` varchar(50) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `ativo` char(1) NOT NULL default '',
  `administrador` char(1) NOT NULL default '',
  `assistente_social` char(1) NOT NULL default '',
  `operador` char(1) NOT NULL default '',
  `secretario` char(1) NOT NULL default '',
  PRIMARY KEY  (`cd`)
) TYPE=MyISAM CHARSET=latin1;
    