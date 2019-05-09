--
-- PostgreSQL database dump
--

-- Dumped from database version 8.2.18
-- Dumped by pg_dump version 9.1.0
-- Started on 2013-11-08 09:53:16

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- TOC entry 544 (class 2612 OID 153981)
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: pgsql
--

CREATE OR REPLACE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO pgsql;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 179 (class 1259 OID 155119)
-- Dependencies: 5
-- Name: tbl_questionario_resposta_turno; Type: TABLE; Schema: public; Owner: assisti; Tablespace: 
--

CREATE TABLE tbl_questionario_resposta_turno (
    id_questionariorespostaturno integer NOT NULL,
    id_turno smallint NOT NULL,
    id_questionarioresposta integer
);


ALTER TABLE public.tbl_questionario_resposta_turno OWNER TO assisti;

--
-- TOC entry 178 (class 1259 OID 155117)
-- Dependencies: 5 179
-- Name: id_questionarior_esposta_turno_id_questionariorespostaturno_seq; Type: SEQUENCE; Schema: public; Owner: assisti
--

CREATE SEQUENCE id_questionarior_esposta_turno_id_questionariorespostaturno_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.id_questionarior_esposta_turno_id_questionariorespostaturno_seq OWNER TO assisti;

--
-- TOC entry 1910 (class 0 OID 0)
-- Dependencies: 178
-- Name: id_questionarior_esposta_turno_id_questionariorespostaturno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: assisti
--

ALTER SEQUENCE id_questionarior_esposta_turno_id_questionariorespostaturno_seq OWNED BY tbl_questionario_resposta_turno.id_questionariorespostaturno;


--
-- TOC entry 118 (class 1259 OID 153982)
-- Dependencies: 5
-- Name: tbl_beneficio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_beneficio (
    id_beneficio smallint NOT NULL,
    beneficio character varying NOT NULL
);


ALTER TABLE public.tbl_beneficio OWNER TO postgres;

--
-- TOC entry 119 (class 1259 OID 153987)
-- Dependencies: 118 5
-- Name: tbl_beneficio_id_beneficio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_beneficio_id_beneficio_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_beneficio_id_beneficio_seq OWNER TO postgres;

--
-- TOC entry 1913 (class 0 OID 0)
-- Dependencies: 119
-- Name: tbl_beneficio_id_beneficio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_beneficio_id_beneficio_seq OWNED BY tbl_beneficio.id_beneficio;


--
-- TOC entry 120 (class 1259 OID 153989)
-- Dependencies: 5
-- Name: tbl_campus; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_campus (
    id_campus smallint NOT NULL,
    campus character varying NOT NULL
);


ALTER TABLE public.tbl_campus OWNER TO postgres;

--
-- TOC entry 121 (class 1259 OID 153994)
-- Dependencies: 5 120
-- Name: tbl_campus_id_campus_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_campus_id_campus_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_campus_id_campus_seq OWNER TO postgres;

--
-- TOC entry 1916 (class 0 OID 0)
-- Dependencies: 121
-- Name: tbl_campus_id_campus_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_campus_id_campus_seq OWNED BY tbl_campus.id_campus;


--
-- TOC entry 122 (class 1259 OID 153996)
-- Dependencies: 5
-- Name: tbl_cidade; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_cidade (
    id_cidade smallint NOT NULL,
    id_uf smallint NOT NULL,
    nome character varying NOT NULL,
    gentilico character varying,
    latitude character varying NOT NULL,
    longitude character varying NOT NULL
);


ALTER TABLE public.tbl_cidade OWNER TO postgres;

--
-- TOC entry 123 (class 1259 OID 154001)
-- Dependencies: 122 5
-- Name: tbl_cidade_id_cidade_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_cidade_id_cidade_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_cidade_id_cidade_seq OWNER TO postgres;

--
-- TOC entry 1919 (class 0 OID 0)
-- Dependencies: 123
-- Name: tbl_cidade_id_cidade_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_cidade_id_cidade_seq OWNED BY tbl_cidade.id_cidade;


--
-- TOC entry 124 (class 1259 OID 154003)
-- Dependencies: 5
-- Name: tbl_curso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_curso (
    id_curso smallint NOT NULL,
    nome character varying NOT NULL
);


ALTER TABLE public.tbl_curso OWNER TO postgres;

--
-- TOC entry 125 (class 1259 OID 154008)
-- Dependencies: 124 5
-- Name: tbl_curso_id_curso_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_curso_id_curso_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_curso_id_curso_seq OWNER TO postgres;

--
-- TOC entry 1922 (class 0 OID 0)
-- Dependencies: 125
-- Name: tbl_curso_id_curso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_curso_id_curso_seq OWNED BY tbl_curso.id_curso;


--
-- TOC entry 126 (class 1259 OID 154010)
-- Dependencies: 5
-- Name: tbl_deficiencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_deficiencia (
    id_deficiencia smallint NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_deficiencia OWNER TO postgres;

--
-- TOC entry 127 (class 1259 OID 154015)
-- Dependencies: 5 126
-- Name: tbl_deficiencia_id_deficiencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_deficiencia_id_deficiencia_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_deficiencia_id_deficiencia_seq OWNER TO postgres;

--
-- TOC entry 1925 (class 0 OID 0)
-- Dependencies: 127
-- Name: tbl_deficiencia_id_deficiencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_deficiencia_id_deficiencia_seq OWNED BY tbl_deficiencia.id_deficiencia;


--
-- TOC entry 128 (class 1259 OID 154017)
-- Dependencies: 5
-- Name: tbl_distancia_residencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_distancia_residencia (
    id_distanciaresidencia smallint NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_distancia_residencia OWNER TO postgres;

--
-- TOC entry 129 (class 1259 OID 154022)
-- Dependencies: 128 5
-- Name: tbl_distancia_residencia_id_distanciaresidencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_distancia_residencia_id_distanciaresidencia_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_distancia_residencia_id_distanciaresidencia_seq OWNER TO postgres;

--
-- TOC entry 1928 (class 0 OID 0)
-- Dependencies: 129
-- Name: tbl_distancia_residencia_id_distanciaresidencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_distancia_residencia_id_distanciaresidencia_seq OWNED BY tbl_distancia_residencia.id_distanciaresidencia;


--
-- TOC entry 130 (class 1259 OID 154024)
-- Dependencies: 5
-- Name: tbl_escolaridade; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_escolaridade (
    id_escolaridade smallint NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_escolaridade OWNER TO postgres;

--
-- TOC entry 131 (class 1259 OID 154029)
-- Dependencies: 130 5
-- Name: tbl_escolaridade_id_escolaridade_seq_1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_escolaridade_id_escolaridade_seq_1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_escolaridade_id_escolaridade_seq_1 OWNER TO postgres;

--
-- TOC entry 1931 (class 0 OID 0)
-- Dependencies: 131
-- Name: tbl_escolaridade_id_escolaridade_seq_1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_escolaridade_id_escolaridade_seq_1 OWNED BY tbl_escolaridade.id_escolaridade;


--
-- TOC entry 132 (class 1259 OID 154031)
-- Dependencies: 5
-- Name: tbl_esta_cursando; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_esta_cursando (
    id_estacursando smallint NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_esta_cursando OWNER TO postgres;

--
-- TOC entry 133 (class 1259 OID 154036)
-- Dependencies: 132 5
-- Name: tbl_esta_cursando_id_estacursando_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_esta_cursando_id_estacursando_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_esta_cursando_id_estacursando_seq OWNER TO postgres;

--
-- TOC entry 1934 (class 0 OID 0)
-- Dependencies: 133
-- Name: tbl_esta_cursando_id_estacursando_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_esta_cursando_id_estacursando_seq OWNED BY tbl_esta_cursando.id_estacursando;


--
-- TOC entry 134 (class 1259 OID 154038)
-- Dependencies: 5
-- Name: tbl_estado_civil; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_estado_civil (
    id_estadocivil smallint NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_estado_civil OWNER TO postgres;

--
-- TOC entry 135 (class 1259 OID 154043)
-- Dependencies: 5 134
-- Name: tbl_estado_civil_id_estadocivil_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_estado_civil_id_estadocivil_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_estado_civil_id_estadocivil_seq OWNER TO postgres;

--
-- TOC entry 1937 (class 0 OID 0)
-- Dependencies: 135
-- Name: tbl_estado_civil_id_estadocivil_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_estado_civil_id_estadocivil_seq OWNED BY tbl_estado_civil.id_estadocivil;


--
-- TOC entry 175 (class 1259 OID 155030)
-- Dependencies: 5
-- Name: tbl_frequencia_id_frequencia_seq; Type: SEQUENCE; Schema: public; Owner: sistemas
--

CREATE SEQUENCE tbl_frequencia_id_frequencia_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_frequencia_id_frequencia_seq OWNER TO sistemas;

--
-- TOC entry 176 (class 1259 OID 155032)
-- Dependencies: 1801 5
-- Name: tbl_frequencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_frequencia (
    id_frequencia smallint DEFAULT nextval('tbl_frequencia_id_frequencia_seq'::regclass) NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_frequencia OWNER TO postgres;

--
-- TOC entry 136 (class 1259 OID 154045)
-- Dependencies: 5
-- Name: tbl_grau_parentesco; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_grau_parentesco (
    id_grauparentesco smallint NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_grau_parentesco OWNER TO postgres;

--
-- TOC entry 137 (class 1259 OID 154050)
-- Dependencies: 136 5
-- Name: tbl_grau_parentesco_id_grauparentesco_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_grau_parentesco_id_grauparentesco_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_grau_parentesco_id_grauparentesco_seq OWNER TO postgres;

--
-- TOC entry 1942 (class 0 OID 0)
-- Dependencies: 137
-- Name: tbl_grau_parentesco_id_grauparentesco_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_grau_parentesco_id_grauparentesco_seq OWNED BY tbl_grau_parentesco.id_grauparentesco;


--
-- TOC entry 181 (class 1259 OID 155272)
-- Dependencies: 5
-- Name: tbl_grupo_familiar; Type: TABLE; Schema: public; Owner: assisti; Tablespace: 
--

CREATE TABLE tbl_grupo_familiar (
    id_grupofamiliar integer NOT NULL,
    id_questionarioresposta integer NOT NULL,
    id_grauparentesco smallint NOT NULL,
    nome character varying NOT NULL,
    idade character(3) NOT NULL,
    rendamensal numeric,
    rendaaluguel numeric,
    rendapensaomorte numeric,
    rendapensaoalimenticia numeric,
    rendaajudaterceiros numeric,
    rendaoutros numeric,
    descricaooutro character varying,
    recebebolsafamilia character(1),
    rendabolsafamilia character varying(20),
    cpf character varying(11)
);


ALTER TABLE public.tbl_grupo_familiar OWNER TO assisti;

--
-- TOC entry 180 (class 1259 OID 155270)
-- Dependencies: 5 181
-- Name: tbl_grupofamiliar2_id_grupofamiliar_seq; Type: SEQUENCE; Schema: public; Owner: assisti
--

CREATE SEQUENCE tbl_grupofamiliar2_id_grupofamiliar_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_grupofamiliar2_id_grupofamiliar_seq OWNER TO assisti;

--
-- TOC entry 1944 (class 0 OID 0)
-- Dependencies: 180
-- Name: tbl_grupofamiliar2_id_grupofamiliar_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: assisti
--

ALTER SEQUENCE tbl_grupofamiliar2_id_grupofamiliar_seq OWNED BY tbl_grupo_familiar.id_grupofamiliar;


--
-- TOC entry 138 (class 1259 OID 154057)
-- Dependencies: 5
-- Name: tbl_imovel; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_imovel (
    id_imovel integer NOT NULL,
    id_questionarioresposta integer NOT NULL,
    id_tipoimovel smallint NOT NULL,
    id_grupofamiliar integer NOT NULL,
    id_cidade smallint NOT NULL,
    servederesidencia character(3)
);


ALTER TABLE public.tbl_imovel OWNER TO postgres;

--
-- TOC entry 139 (class 1259 OID 154059)
-- Dependencies: 5 138
-- Name: tbl_imovel_id_imovel_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_imovel_id_imovel_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_imovel_id_imovel_seq OWNER TO postgres;

--
-- TOC entry 1946 (class 0 OID 0)
-- Dependencies: 139
-- Name: tbl_imovel_id_imovel_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_imovel_id_imovel_seq OWNED BY tbl_imovel.id_imovel;


--
-- TOC entry 186 (class 1259 OID 156856)
-- Dependencies: 5
-- Name: tbl_pontuacao; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_pontuacao (
    id_pontuacao integer NOT NULL,
    aux_alimentacao smallint,
    aux_moradia smallint,
    aux_transportemunicipal smallint,
    aux_creche smallint,
    aux_atividade smallint,
    aux_transporteintermunicipal smallint,
    id_questionarioresposta integer
);


ALTER TABLE public.tbl_pontuacao OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 158915)
-- Dependencies: 5
-- Name: tbl_pontuacao_beneficio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_pontuacao_beneficio (
    id_pontuacaobeneficio integer NOT NULL,
    aux_alimentacao smallint,
    aux_moradia smallint,
    aux_transportemunicipal smallint,
    aux_creche smallint,
    aux_atividade smallint,
    aux_transporteintermunicipal smallint,
    id_questionarioresposta integer
);


ALTER TABLE public.tbl_pontuacao_beneficio OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 158917)
-- Dependencies: 187 5
-- Name: tbl_pontuacao_beneficio_id_pontuacao_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_pontuacao_beneficio_id_pontuacao_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_pontuacao_beneficio_id_pontuacao_seq OWNER TO postgres;

--
-- TOC entry 1950 (class 0 OID 0)
-- Dependencies: 188
-- Name: tbl_pontuacao_beneficio_id_pontuacao_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_pontuacao_beneficio_id_pontuacao_seq OWNED BY tbl_pontuacao_beneficio.id_pontuacaobeneficio;


--
-- TOC entry 184 (class 1259 OID 155456)
-- Dependencies: 5
-- Name: tbl_pontuacao_id_pontuacao_seq; Type: SEQUENCE; Schema: public; Owner: assisti
--

CREATE SEQUENCE tbl_pontuacao_id_pontuacao_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_pontuacao_id_pontuacao_seq OWNER TO assisti;

--
-- TOC entry 185 (class 1259 OID 156854)
-- Dependencies: 5 186
-- Name: tbl_pontuacao_id_pontuacao_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_pontuacao_id_pontuacao_seq1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_pontuacao_id_pontuacao_seq1 OWNER TO postgres;

--
-- TOC entry 1952 (class 0 OID 0)
-- Dependencies: 185
-- Name: tbl_pontuacao_id_pontuacao_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_pontuacao_id_pontuacao_seq1 OWNED BY tbl_pontuacao.id_pontuacao;


--
-- TOC entry 140 (class 1259 OID 154061)
-- Dependencies: 5
-- Name: tbl_questionario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_questionario (
    id_questionario integer NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_questionario OWNER TO postgres;

--
-- TOC entry 141 (class 1259 OID 154066)
-- Dependencies: 5
-- Name: tbl_questionario_beneficio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_questionario_beneficio (
    id_questionario_beneficio integer NOT NULL,
    id_beneficio smallint NOT NULL,
    id_questionario integer NOT NULL,
    id_campus smallint
);


ALTER TABLE public.tbl_questionario_beneficio OWNER TO postgres;

--
-- TOC entry 142 (class 1259 OID 154068)
-- Dependencies: 5 141
-- Name: tbl_questionario_beneficio_id_questionario_beneficio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_questionario_beneficio_id_questionario_beneficio_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_questionario_beneficio_id_questionario_beneficio_seq OWNER TO postgres;

--
-- TOC entry 1956 (class 0 OID 0)
-- Dependencies: 142
-- Name: tbl_questionario_beneficio_id_questionario_beneficio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_questionario_beneficio_id_questionario_beneficio_seq OWNED BY tbl_questionario_beneficio.id_questionario_beneficio;


--
-- TOC entry 143 (class 1259 OID 154070)
-- Dependencies: 5 140
-- Name: tbl_questionario_id_questionario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_questionario_id_questionario_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_questionario_id_questionario_seq OWNER TO postgres;

--
-- TOC entry 1958 (class 0 OID 0)
-- Dependencies: 143
-- Name: tbl_questionario_id_questionario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_questionario_id_questionario_seq OWNED BY tbl_questionario.id_questionario;


--
-- TOC entry 144 (class 1259 OID 154072)
-- Dependencies: 5
-- Name: tbl_questionario_periodo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_questionario_periodo (
    id_questionarioperiodo integer NOT NULL,
    id_questionario integer NOT NULL,
    id_campus smallint NOT NULL,
    datainicio date NOT NULL,
    datafim date
);


ALTER TABLE public.tbl_questionario_periodo OWNER TO postgres;

--
-- TOC entry 145 (class 1259 OID 154074)
-- Dependencies: 5 144
-- Name: tbl_questionario_periodo_id_questionarioperiodo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_questionario_periodo_id_questionarioperiodo_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_questionario_periodo_id_questionarioperiodo_seq OWNER TO postgres;

--
-- TOC entry 1961 (class 0 OID 0)
-- Dependencies: 145
-- Name: tbl_questionario_periodo_id_questionarioperiodo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_questionario_periodo_id_questionarioperiodo_seq OWNED BY tbl_questionario_periodo.id_questionarioperiodo;


--
-- TOC entry 146 (class 1259 OID 154076)
-- Dependencies: 1787 1788 1789 5
-- Name: tbl_questionario_resposta; Type: TABLE; Schema: public; Owner: assisti; Tablespace: 
--

CREATE TABLE tbl_questionario_resposta (
    id_questionarioresposta integer NOT NULL,
    id_questionario integer NOT NULL,
    id_curso smallint NOT NULL,
    id_campus smallint NOT NULL,
    id_usuario integer NOT NULL,
    id_tipousuario smallint NOT NULL,
    id_situacaoimovel smallint NOT NULL,
    id_distanciaresidencia smallint NOT NULL,
    id_deficiencia smallint,
    id_tipoescola smallint,
    id_estacursando smallint,
    id_situacaotrabalho smallint,
    id_situacaotrabalhopai smallint,
    id_escolaridade smallint,
    id_estadocivil smallint NOT NULL,
    id_cidade smallint NOT NULL,
    id_cidadefic smallint,
    id_situacaotrabalhomae smallint,
    id_grupofamiliar_provedor character varying(10),
    id_escolaridade_provedor smallint,
    numeromatricula character varying NOT NULL,
    logradouro character varying NOT NULL,
    numerocomplemento character varying NOT NULL,
    telefonefixo character(11),
    cep character(8) NOT NULL,
    anosemestreinicio character(7) NOT NULL,
    numerofilhos character(1) DEFAULT 0,
    filhosate6anos character(1) DEFAULT 0,
    anosescolapublica character(1) DEFAULT 0,
    despesaagua numeric,
    despesaluz numeric,
    despesatelefone numeric,
    despesacondominio numeric,
    despesaescolafaculdade numeric,
    despesaalimentacao numeric,
    despesasaudemedicamentos numeric,
    despesatransporte character varying,
    despesaaluguel character varying,
    despesafinanciamentoconsorcio numeric,
    despesafuncionarios numeric,
    despesaoutros numeric,
    rendapercapita numeric,
    id_status smallint NOT NULL,
    parenteestudacampus character(1) NOT NULL,
    possuifilhos character(1) NOT NULL,
    recebeuauxiliosemestreanterior character(1) NOT NULL,
    residecomfamilia character(1) NOT NULL,
    deficiencia character(1) NOT NULL,
    familiaassistidabeneficios character(1) NOT NULL,
    concluiusuperior character(1),
    bairro character varying(60),
    id_frequencia smallint,
    id_escolaridadepai smallint,
    id_escolaridademae smallint,
    localreside character varying,
    id_escolaridade_provedor_2 smallint,
    id_cidade2 smallint,
    cep2 character varying,
    id_uf2 smallint,
    bairro2 character varying,
    logradouro2 character varying,
    numerocomplemento2 character varying,
    id_auxilioanterior character varying,
    nummembrosfamiliar character varying
);


ALTER TABLE public.tbl_questionario_resposta OWNER TO assisti;

--
-- TOC entry 147 (class 1259 OID 154081)
-- Dependencies: 5
-- Name: tbl_questionario_resposta_beneficio; Type: TABLE; Schema: public; Owner: assisti; Tablespace: 
--

CREATE TABLE tbl_questionario_resposta_beneficio (
    id_questionariorespostabeneficio integer NOT NULL,
    id_beneficio smallint NOT NULL,
    id_questionarioresposta integer NOT NULL
);


ALTER TABLE public.tbl_questionario_resposta_beneficio OWNER TO assisti;

--
-- TOC entry 148 (class 1259 OID 154083)
-- Dependencies: 147 5
-- Name: tbl_questionario_resposta_beneficio_id_questionariorespostab994; Type: SEQUENCE; Schema: public; Owner: assisti
--

CREATE SEQUENCE tbl_questionario_resposta_beneficio_id_questionariorespostab994
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_questionario_resposta_beneficio_id_questionariorespostab994 OWNER TO assisti;

--
-- TOC entry 1965 (class 0 OID 0)
-- Dependencies: 148
-- Name: tbl_questionario_resposta_beneficio_id_questionariorespostab994; Type: SEQUENCE OWNED BY; Schema: public; Owner: assisti
--

ALTER SEQUENCE tbl_questionario_resposta_beneficio_id_questionariorespostab994 OWNED BY tbl_questionario_resposta_beneficio.id_questionariorespostabeneficio;


--
-- TOC entry 149 (class 1259 OID 154085)
-- Dependencies: 146 5
-- Name: tbl_questionario_resposta_id_questionarioresposta_seq; Type: SEQUENCE; Schema: public; Owner: assisti
--

CREATE SEQUENCE tbl_questionario_resposta_id_questionarioresposta_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_questionario_resposta_id_questionarioresposta_seq OWNER TO assisti;

--
-- TOC entry 1966 (class 0 OID 0)
-- Dependencies: 149
-- Name: tbl_questionario_resposta_id_questionarioresposta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: assisti
--

ALTER SEQUENCE tbl_questionario_resposta_id_questionarioresposta_seq OWNED BY tbl_questionario_resposta.id_questionarioresposta;


--
-- TOC entry 150 (class 1259 OID 154087)
-- Dependencies: 5
-- Name: tbl_situacao_imovel; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_situacao_imovel (
    id_situacaoimovel smallint NOT NULL,
    situacao character varying NOT NULL
);


ALTER TABLE public.tbl_situacao_imovel OWNER TO postgres;

--
-- TOC entry 151 (class 1259 OID 154092)
-- Dependencies: 5 150
-- Name: tbl_situacao_imovel_id_situacaoimovel_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_situacao_imovel_id_situacaoimovel_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_situacao_imovel_id_situacaoimovel_seq OWNER TO postgres;

--
-- TOC entry 1969 (class 0 OID 0)
-- Dependencies: 151
-- Name: tbl_situacao_imovel_id_situacaoimovel_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_situacao_imovel_id_situacaoimovel_seq OWNED BY tbl_situacao_imovel.id_situacaoimovel;


--
-- TOC entry 152 (class 1259 OID 154094)
-- Dependencies: 5
-- Name: tbl_situacao_trabalho; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_situacao_trabalho (
    id_situacaotrabalho smallint NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_situacao_trabalho OWNER TO postgres;

--
-- TOC entry 153 (class 1259 OID 154099)
-- Dependencies: 152 5
-- Name: tbl_situacao_trabalho_id_situacaotrabalho_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_situacao_trabalho_id_situacaotrabalho_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_situacao_trabalho_id_situacaotrabalho_seq OWNER TO postgres;

--
-- TOC entry 1972 (class 0 OID 0)
-- Dependencies: 153
-- Name: tbl_situacao_trabalho_id_situacaotrabalho_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_situacao_trabalho_id_situacaotrabalho_seq OWNED BY tbl_situacao_trabalho.id_situacaotrabalho;


--
-- TOC entry 154 (class 1259 OID 154101)
-- Dependencies: 5
-- Name: tbl_situacao_trabalho_pai; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_situacao_trabalho_pai (
    id_situacaotrabalhopai smallint NOT NULL,
    descricao character varying NOT NULL
);


ALTER TABLE public.tbl_situacao_trabalho_pai OWNER TO postgres;

--
-- TOC entry 155 (class 1259 OID 154106)
-- Dependencies: 154 5
-- Name: tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1 OWNER TO postgres;

--
-- TOC entry 1975 (class 0 OID 0)
-- Dependencies: 155
-- Name: tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1 OWNED BY tbl_situacao_trabalho_pai.id_situacaotrabalhopai;


--
-- TOC entry 177 (class 1259 OID 155047)
-- Dependencies: 5
-- Name: tbl_status; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_status (
    id_status smallint NOT NULL,
    status character varying(60)
);


ALTER TABLE public.tbl_status OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 159849)
-- Dependencies: 5
-- Name: tbl_teste; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_teste (
    id_teste integer NOT NULL,
    nome character varying,
    idade integer
);


ALTER TABLE public.tbl_teste OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 159847)
-- Dependencies: 190 5
-- Name: tbl_teste_id_teste_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_teste_id_teste_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_teste_id_teste_seq OWNER TO postgres;

--
-- TOC entry 1979 (class 0 OID 0)
-- Dependencies: 189
-- Name: tbl_teste_id_teste_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_teste_id_teste_seq OWNED BY tbl_teste.id_teste;


--
-- TOC entry 156 (class 1259 OID 154108)
-- Dependencies: 5
-- Name: tbl_tipo_escola; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipo_escola (
    id_tipoescola smallint NOT NULL,
    tipo character varying NOT NULL
);


ALTER TABLE public.tbl_tipo_escola OWNER TO postgres;

--
-- TOC entry 157 (class 1259 OID 154113)
-- Dependencies: 156 5
-- Name: tbl_tipo_escola_id_tipoescola_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_tipo_escola_id_tipoescola_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipo_escola_id_tipoescola_seq OWNER TO postgres;

--
-- TOC entry 1982 (class 0 OID 0)
-- Dependencies: 157
-- Name: tbl_tipo_escola_id_tipoescola_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tipo_escola_id_tipoescola_seq OWNED BY tbl_tipo_escola.id_tipoescola;


--
-- TOC entry 158 (class 1259 OID 154115)
-- Dependencies: 5
-- Name: tbl_tipo_imovel; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipo_imovel (
    id_tipoimovel smallint NOT NULL,
    tipo character varying NOT NULL
);


ALTER TABLE public.tbl_tipo_imovel OWNER TO postgres;

--
-- TOC entry 159 (class 1259 OID 154120)
-- Dependencies: 5 158
-- Name: tbl_tipo_imovel_id_tipoimovel_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_tipo_imovel_id_tipoimovel_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipo_imovel_id_tipoimovel_seq OWNER TO postgres;

--
-- TOC entry 1985 (class 0 OID 0)
-- Dependencies: 159
-- Name: tbl_tipo_imovel_id_tipoimovel_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tipo_imovel_id_tipoimovel_seq OWNED BY tbl_tipo_imovel.id_tipoimovel;


--
-- TOC entry 182 (class 1259 OID 155304)
-- Dependencies: 5
-- Name: tbl_tipo_veiculo_id_tipoveiculo_seq; Type: SEQUENCE; Schema: public; Owner: sistemas
--

CREATE SEQUENCE tbl_tipo_veiculo_id_tipoveiculo_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipo_veiculo_id_tipoveiculo_seq OWNER TO sistemas;

--
-- TOC entry 183 (class 1259 OID 155313)
-- Dependencies: 1804 5
-- Name: tbl_tipo_veiculo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipo_veiculo (
    id_tipoveiculo smallint DEFAULT nextval('tbl_tipo_veiculo_id_tipoveiculo_seq'::regclass) NOT NULL,
    tipo character varying NOT NULL
);


ALTER TABLE public.tbl_tipo_veiculo OWNER TO postgres;

--
-- TOC entry 160 (class 1259 OID 154122)
-- Dependencies: 5
-- Name: tbl_tipousuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipousuario (
    id_tipousuario smallint NOT NULL,
    tipousuario character varying NOT NULL
);


ALTER TABLE public.tbl_tipousuario OWNER TO postgres;

--
-- TOC entry 161 (class 1259 OID 154127)
-- Dependencies: 160 5
-- Name: tbl_tipousuario_id_tipousuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_tipousuario_id_tipousuario_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipousuario_id_tipousuario_seq OWNER TO postgres;

--
-- TOC entry 1989 (class 0 OID 0)
-- Dependencies: 161
-- Name: tbl_tipousuario_id_tipousuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tipousuario_id_tipousuario_seq OWNED BY tbl_tipousuario.id_tipousuario;


--
-- TOC entry 162 (class 1259 OID 154129)
-- Dependencies: 5
-- Name: tbl_turno; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_turno (
    id_turno smallint NOT NULL,
    turno character varying NOT NULL
);


ALTER TABLE public.tbl_turno OWNER TO postgres;

--
-- TOC entry 163 (class 1259 OID 154134)
-- Dependencies: 5 162
-- Name: tbl_turno_id_turno_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_turno_id_turno_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_turno_id_turno_seq OWNER TO postgres;

--
-- TOC entry 1992 (class 0 OID 0)
-- Dependencies: 163
-- Name: tbl_turno_id_turno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_turno_id_turno_seq OWNED BY tbl_turno.id_turno;


--
-- TOC entry 164 (class 1259 OID 154136)
-- Dependencies: 5
-- Name: tbl_uf; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_uf (
    id_uf smallint NOT NULL,
    sigla character(2) NOT NULL,
    nome character varying(50) NOT NULL
);


ALTER TABLE public.tbl_uf OWNER TO postgres;

--
-- TOC entry 165 (class 1259 OID 154138)
-- Dependencies: 164 5
-- Name: tbl_uf_id_uf_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_uf_id_uf_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_uf_id_uf_seq OWNER TO postgres;

--
-- TOC entry 1995 (class 0 OID 0)
-- Dependencies: 165
-- Name: tbl_uf_id_uf_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_uf_id_uf_seq OWNED BY tbl_uf.id_uf;


--
-- TOC entry 166 (class 1259 OID 154140)
-- Dependencies: 5
-- Name: tbl_usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_usuario (
    id_usuario integer NOT NULL,
    id_tipousuario smallint NOT NULL,
    email character varying NOT NULL,
    cpf character(11) NOT NULL,
    datanascimento date NOT NULL,
    carteiraidentidade character varying NOT NULL,
    orgaoexpedidor character varying NOT NULL,
    celular character(10) NOT NULL,
    senha character(32) NOT NULL,
    sexo character(1) NOT NULL,
    nome character varying(50),
    telefone character(10)
);


ALTER TABLE public.tbl_usuario OWNER TO postgres;

--
-- TOC entry 167 (class 1259 OID 154145)
-- Dependencies: 166 5
-- Name: tbl_usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_usuario_id_usuario_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_usuario_id_usuario_seq OWNER TO postgres;

--
-- TOC entry 1998 (class 0 OID 0)
-- Dependencies: 167
-- Name: tbl_usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_usuario_id_usuario_seq OWNED BY tbl_usuario.id_usuario;


--
-- TOC entry 168 (class 1259 OID 154147)
-- Dependencies: 5
-- Name: tbl_veiculo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_veiculo (
    id_veiculo integer NOT NULL,
    id_questionarioresposta integer NOT NULL,
    id_grupofamiliar integer NOT NULL,
    marca character varying NOT NULL,
    modelo character varying NOT NULL,
    ano character varying NOT NULL,
    utilidade character varying NOT NULL,
    valoripva numeric,
    id_tipoveiculo integer NOT NULL
);


ALTER TABLE public.tbl_veiculo OWNER TO postgres;

--
-- TOC entry 169 (class 1259 OID 154152)
-- Dependencies: 168 5
-- Name: tbl_veiculo_id_veiculo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_veiculo_id_veiculo_seq
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_veiculo_id_veiculo_seq OWNER TO postgres;

--
-- TOC entry 2001 (class 0 OID 0)
-- Dependencies: 169
-- Name: tbl_veiculo_id_veiculo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_veiculo_id_veiculo_seq OWNED BY tbl_veiculo.id_veiculo;


--
-- TOC entry 172 (class 1259 OID 154366)
-- Dependencies: 1769 5 395 395
-- Name: visao_chaves_das_tabelas; Type: VIEW; Schema: public; Owner: assisti
--

CREATE VIEW visao_chaves_das_tabelas AS
    SELECT columns.table_name AS nome_tabela, columns.column_name AS nome_chave FROM information_schema.columns WHERE ((((columns.table_schema)::text = 'public'::text) AND ((columns.ordinal_position)::integer = 1)) AND ((columns.is_nullable)::text = 'NO'::text));


ALTER TABLE public.visao_chaves_das_tabelas OWNER TO assisti;

--
-- TOC entry 174 (class 1259 OID 154372)
-- Dependencies: 1771 5
-- Name: visao_descricao_tabelas; Type: VIEW; Schema: public; Owner: assisti
--

CREATE VIEW visao_descricao_tabelas AS
    SELECT a.attnum, n.nspname AS schema_name, c.relname AS nome_tabela, a.attname AS nome_campo, t.typname AS "type", CASE WHEN (a.attlen = (-1)) THEN NULL::smallint ELSE a.attlen END AS length, CASE WHEN (a.atttypmod = (-1)) THEN NULL::integer ELSE (a.atttypmod - 4) END AS lengthvar, a.attnotnull AS "notnull", CASE WHEN (EXISTS (SELECT 1 FROM pg_constraint p WHERE (((p.conrelid = c.oid) AND (a.attnum = ANY (p.conkey))) AND (p.contype = 'p'::"char")))) THEN true ELSE false END AS primarykey FROM (((pg_class c JOIN pg_attribute a ON ((a.attrelid = c.oid))) JOIN pg_type t ON ((a.atttypid = t.oid))) JOIN pg_namespace n ON ((n.oid = c.relnamespace))) WHERE ((a.attnum > 0) AND (n.nspname = 'public'::name));


ALTER TABLE public.visao_descricao_tabelas OWNER TO assisti;

--
-- TOC entry 170 (class 1259 OID 154360)
-- Dependencies: 1767 5
-- Name: visao_sequencias_e_registros_das_tabelas; Type: VIEW; Schema: public; Owner: assisti
--

CREATE VIEW visao_sequencias_e_registros_das_tabelas AS
    SELECT pg_class.relname AS nome_tabela, (pg_class.reltuples)::integer AS num_registros, "substring"(pg_attrdef.adsrc, 10, (char_length(pg_attrdef.adsrc) - 21)) AS nome_sequencia FROM (pg_class JOIN pg_attrdef ON ((pg_class.oid = pg_attrdef.adrelid))) WHERE (pg_attrdef.adsrc ~~ '%_seq%'::text) ORDER BY pg_class.relname;


ALTER TABLE public.visao_sequencias_e_registros_das_tabelas OWNER TO assisti;

--
-- TOC entry 173 (class 1259 OID 154369)
-- Dependencies: 1770 395 395 5
-- Name: visao_tabelas_chaves_sequencias_registros; Type: VIEW; Schema: public; Owner: assisti
--

CREATE VIEW visao_tabelas_chaves_sequencias_registros AS
    SELECT visao_chaves_das_tabelas.nome_tabela, visao_chaves_das_tabelas.nome_chave, visao_sequencias_e_registros_das_tabelas.num_registros, visao_sequencias_e_registros_das_tabelas.nome_sequencia FROM visao_chaves_das_tabelas, visao_sequencias_e_registros_das_tabelas WHERE ((visao_chaves_das_tabelas.nome_tabela)::name = visao_sequencias_e_registros_das_tabelas.nome_tabela);


ALTER TABLE public.visao_tabelas_chaves_sequencias_registros OWNER TO assisti;

--
-- TOC entry 171 (class 1259 OID 154363)
-- Dependencies: 1768 395 5
-- Name: visao_tabelas_e_visoes; Type: VIEW; Schema: public; Owner: assisti
--

CREATE VIEW visao_tabelas_e_visoes AS
    SELECT DISTINCT columns.table_name AS nome FROM information_schema.columns WHERE ((columns.table_schema)::text = 'public'::text) ORDER BY columns.table_name;


ALTER TABLE public.visao_tabelas_e_visoes OWNER TO assisti;

--
-- TOC entry 1772 (class 2604 OID 154154)
-- Dependencies: 119 118
-- Name: id_beneficio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_beneficio ALTER COLUMN id_beneficio SET DEFAULT nextval('tbl_beneficio_id_beneficio_seq'::regclass);


--
-- TOC entry 1773 (class 2604 OID 154155)
-- Dependencies: 121 120
-- Name: id_campus; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_campus ALTER COLUMN id_campus SET DEFAULT nextval('tbl_campus_id_campus_seq'::regclass);


--
-- TOC entry 1774 (class 2604 OID 154156)
-- Dependencies: 123 122
-- Name: id_cidade; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_cidade ALTER COLUMN id_cidade SET DEFAULT nextval('tbl_cidade_id_cidade_seq'::regclass);


--
-- TOC entry 1775 (class 2604 OID 154157)
-- Dependencies: 125 124
-- Name: id_curso; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_curso ALTER COLUMN id_curso SET DEFAULT nextval('tbl_curso_id_curso_seq'::regclass);


--
-- TOC entry 1776 (class 2604 OID 154158)
-- Dependencies: 127 126
-- Name: id_deficiencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_deficiencia ALTER COLUMN id_deficiencia SET DEFAULT nextval('tbl_deficiencia_id_deficiencia_seq'::regclass);


--
-- TOC entry 1777 (class 2604 OID 154159)
-- Dependencies: 129 128
-- Name: id_distanciaresidencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_distancia_residencia ALTER COLUMN id_distanciaresidencia SET DEFAULT nextval('tbl_distancia_residencia_id_distanciaresidencia_seq'::regclass);


--
-- TOC entry 1778 (class 2604 OID 154160)
-- Dependencies: 131 130
-- Name: id_escolaridade; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_escolaridade ALTER COLUMN id_escolaridade SET DEFAULT nextval('tbl_escolaridade_id_escolaridade_seq_1'::regclass);


--
-- TOC entry 1779 (class 2604 OID 154161)
-- Dependencies: 133 132
-- Name: id_estacursando; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_esta_cursando ALTER COLUMN id_estacursando SET DEFAULT nextval('tbl_esta_cursando_id_estacursando_seq'::regclass);


--
-- TOC entry 1780 (class 2604 OID 154162)
-- Dependencies: 135 134
-- Name: id_estadocivil; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_estado_civil ALTER COLUMN id_estadocivil SET DEFAULT nextval('tbl_estado_civil_id_estadocivil_seq'::regclass);


--
-- TOC entry 1781 (class 2604 OID 154163)
-- Dependencies: 137 136
-- Name: id_grauparentesco; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_grau_parentesco ALTER COLUMN id_grauparentesco SET DEFAULT nextval('tbl_grau_parentesco_id_grauparentesco_seq'::regclass);


--
-- TOC entry 1803 (class 2604 OID 155274)
-- Dependencies: 181 180 181
-- Name: id_grupofamiliar; Type: DEFAULT; Schema: public; Owner: assisti
--

ALTER TABLE tbl_grupo_familiar ALTER COLUMN id_grupofamiliar SET DEFAULT nextval('tbl_grupofamiliar2_id_grupofamiliar_seq'::regclass);


--
-- TOC entry 1782 (class 2604 OID 154164)
-- Dependencies: 139 138
-- Name: id_imovel; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_imovel ALTER COLUMN id_imovel SET DEFAULT nextval('tbl_imovel_id_imovel_seq'::regclass);


--
-- TOC entry 1805 (class 2604 OID 156858)
-- Dependencies: 185 186 186
-- Name: id_pontuacao; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_pontuacao ALTER COLUMN id_pontuacao SET DEFAULT nextval('tbl_pontuacao_id_pontuacao_seq1'::regclass);


--
-- TOC entry 1806 (class 2604 OID 158919)
-- Dependencies: 188 187
-- Name: id_pontuacaobeneficio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_pontuacao_beneficio ALTER COLUMN id_pontuacaobeneficio SET DEFAULT nextval('tbl_pontuacao_beneficio_id_pontuacao_seq'::regclass);


--
-- TOC entry 1783 (class 2604 OID 154165)
-- Dependencies: 143 140
-- Name: id_questionario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_questionario ALTER COLUMN id_questionario SET DEFAULT nextval('tbl_questionario_id_questionario_seq'::regclass);


--
-- TOC entry 1784 (class 2604 OID 154166)
-- Dependencies: 142 141
-- Name: id_questionario_beneficio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_questionario_beneficio ALTER COLUMN id_questionario_beneficio SET DEFAULT nextval('tbl_questionario_beneficio_id_questionario_beneficio_seq'::regclass);


--
-- TOC entry 1785 (class 2604 OID 154167)
-- Dependencies: 145 144
-- Name: id_questionarioperiodo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_questionario_periodo ALTER COLUMN id_questionarioperiodo SET DEFAULT nextval('tbl_questionario_periodo_id_questionarioperiodo_seq'::regclass);


--
-- TOC entry 1786 (class 2604 OID 154168)
-- Dependencies: 149 146
-- Name: id_questionarioresposta; Type: DEFAULT; Schema: public; Owner: assisti
--

ALTER TABLE tbl_questionario_resposta ALTER COLUMN id_questionarioresposta SET DEFAULT nextval('tbl_questionario_resposta_id_questionarioresposta_seq'::regclass);


--
-- TOC entry 1790 (class 2604 OID 154169)
-- Dependencies: 148 147
-- Name: id_questionariorespostabeneficio; Type: DEFAULT; Schema: public; Owner: assisti
--

ALTER TABLE tbl_questionario_resposta_beneficio ALTER COLUMN id_questionariorespostabeneficio SET DEFAULT nextval('tbl_questionario_resposta_beneficio_id_questionariorespostab994'::regclass);


--
-- TOC entry 1802 (class 2604 OID 155121)
-- Dependencies: 179 178 179
-- Name: id_questionariorespostaturno; Type: DEFAULT; Schema: public; Owner: assisti
--

ALTER TABLE tbl_questionario_resposta_turno ALTER COLUMN id_questionariorespostaturno SET DEFAULT nextval('id_questionarior_esposta_turno_id_questionariorespostaturno_seq'::regclass);


--
-- TOC entry 1791 (class 2604 OID 154170)
-- Dependencies: 151 150
-- Name: id_situacaoimovel; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_situacao_imovel ALTER COLUMN id_situacaoimovel SET DEFAULT nextval('tbl_situacao_imovel_id_situacaoimovel_seq'::regclass);


--
-- TOC entry 1792 (class 2604 OID 154171)
-- Dependencies: 153 152
-- Name: id_situacaotrabalho; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_situacao_trabalho ALTER COLUMN id_situacaotrabalho SET DEFAULT nextval('tbl_situacao_trabalho_id_situacaotrabalho_seq'::regclass);


--
-- TOC entry 1793 (class 2604 OID 154172)
-- Dependencies: 155 154
-- Name: id_situacaotrabalhopai; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_situacao_trabalho_pai ALTER COLUMN id_situacaotrabalhopai SET DEFAULT nextval('tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1'::regclass);


--
-- TOC entry 1807 (class 2604 OID 159851)
-- Dependencies: 190 189 190
-- Name: id_teste; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_teste ALTER COLUMN id_teste SET DEFAULT nextval('tbl_teste_id_teste_seq'::regclass);


--
-- TOC entry 1794 (class 2604 OID 154173)
-- Dependencies: 157 156
-- Name: id_tipoescola; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_tipo_escola ALTER COLUMN id_tipoescola SET DEFAULT nextval('tbl_tipo_escola_id_tipoescola_seq'::regclass);


--
-- TOC entry 1795 (class 2604 OID 154174)
-- Dependencies: 159 158
-- Name: id_tipoimovel; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_tipo_imovel ALTER COLUMN id_tipoimovel SET DEFAULT nextval('tbl_tipo_imovel_id_tipoimovel_seq'::regclass);


--
-- TOC entry 1796 (class 2604 OID 154175)
-- Dependencies: 161 160
-- Name: id_tipousuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_tipousuario ALTER COLUMN id_tipousuario SET DEFAULT nextval('tbl_tipousuario_id_tipousuario_seq'::regclass);


--
-- TOC entry 1797 (class 2604 OID 154176)
-- Dependencies: 163 162
-- Name: id_turno; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_turno ALTER COLUMN id_turno SET DEFAULT nextval('tbl_turno_id_turno_seq'::regclass);


--
-- TOC entry 1798 (class 2604 OID 154177)
-- Dependencies: 165 164
-- Name: id_uf; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_uf ALTER COLUMN id_uf SET DEFAULT nextval('tbl_uf_id_uf_seq'::regclass);


--
-- TOC entry 1799 (class 2604 OID 154178)
-- Dependencies: 167 166
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_usuario ALTER COLUMN id_usuario SET DEFAULT nextval('tbl_usuario_id_usuario_seq'::regclass);


--
-- TOC entry 1800 (class 2604 OID 154179)
-- Dependencies: 169 168
-- Name: id_veiculo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE tbl_veiculo ALTER COLUMN id_veiculo SET DEFAULT nextval('tbl_veiculo_id_veiculo_seq'::regclass);


--
-- TOC entry 1838 (class 2606 OID 156338)
-- Dependencies: 146 146
-- Name: chaveprimaria; Type: CONSTRAINT; Schema: public; Owner: assisti; Tablespace: 
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT chaveprimaria PRIMARY KEY (id_questionarioresposta);


--
-- TOC entry 1809 (class 2606 OID 154181)
-- Dependencies: 118 118
-- Name: id_beneficio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_beneficio
    ADD CONSTRAINT id_beneficio PRIMARY KEY (id_beneficio);


--
-- TOC entry 1811 (class 2606 OID 154183)
-- Dependencies: 120 120
-- Name: id_campus; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_campus
    ADD CONSTRAINT id_campus PRIMARY KEY (id_campus);


--
-- TOC entry 1840 (class 2606 OID 155098)
-- Dependencies: 147 147
-- Name: id_chaveprimaria; Type: CONSTRAINT; Schema: public; Owner: assisti; Tablespace: 
--

ALTER TABLE ONLY tbl_questionario_resposta_beneficio
    ADD CONSTRAINT id_chaveprimaria PRIMARY KEY (id_questionariorespostabeneficio);


--
-- TOC entry 1868 (class 2606 OID 155279)
-- Dependencies: 181 181
-- Name: id_chaveprimaria_tbl_grupofamiliar; Type: CONSTRAINT; Schema: public; Owner: assisti; Tablespace: 
--

ALTER TABLE ONLY tbl_grupo_familiar
    ADD CONSTRAINT id_chaveprimaria_tbl_grupofamiliar PRIMARY KEY (id_grupofamiliar);


--
-- TOC entry 1866 (class 2606 OID 155123)
-- Dependencies: 179 179
-- Name: id_chaveprimaria_turno; Type: CONSTRAINT; Schema: public; Owner: assisti; Tablespace: 
--

ALTER TABLE ONLY tbl_questionario_resposta_turno
    ADD CONSTRAINT id_chaveprimaria_turno PRIMARY KEY (id_questionariorespostaturno);


--
-- TOC entry 1813 (class 2606 OID 154185)
-- Dependencies: 122 122
-- Name: id_cidade; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_cidade
    ADD CONSTRAINT id_cidade PRIMARY KEY (id_cidade);


--
-- TOC entry 1815 (class 2606 OID 154187)
-- Dependencies: 124 124
-- Name: id_curso; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_curso
    ADD CONSTRAINT id_curso PRIMARY KEY (id_curso);


--
-- TOC entry 1817 (class 2606 OID 154189)
-- Dependencies: 126 126
-- Name: id_deficiencia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_deficiencia
    ADD CONSTRAINT id_deficiencia PRIMARY KEY (id_deficiencia);


--
-- TOC entry 1819 (class 2606 OID 154191)
-- Dependencies: 128 128
-- Name: id_distanciaresidencia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_distancia_residencia
    ADD CONSTRAINT id_distanciaresidencia PRIMARY KEY (id_distanciaresidencia);


--
-- TOC entry 1821 (class 2606 OID 154193)
-- Dependencies: 130 130
-- Name: id_escolaridade; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_escolaridade
    ADD CONSTRAINT id_escolaridade PRIMARY KEY (id_escolaridade);


--
-- TOC entry 1823 (class 2606 OID 154195)
-- Dependencies: 132 132
-- Name: id_estacursando; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_esta_cursando
    ADD CONSTRAINT id_estacursando PRIMARY KEY (id_estacursando);


--
-- TOC entry 1825 (class 2606 OID 154197)
-- Dependencies: 134 134
-- Name: id_estadocivil; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_estado_civil
    ADD CONSTRAINT id_estadocivil PRIMARY KEY (id_estadocivil);


--
-- TOC entry 1862 (class 2606 OID 155039)
-- Dependencies: 176 176
-- Name: id_frequencia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_frequencia
    ADD CONSTRAINT id_frequencia PRIMARY KEY (id_frequencia);


--
-- TOC entry 1827 (class 2606 OID 154199)
-- Dependencies: 136 136
-- Name: id_grauparentesco; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_grau_parentesco
    ADD CONSTRAINT id_grauparentesco PRIMARY KEY (id_grauparentesco);


--
-- TOC entry 1829 (class 2606 OID 154203)
-- Dependencies: 138 138
-- Name: id_imovel; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_imovel
    ADD CONSTRAINT id_imovel PRIMARY KEY (id_imovel);


--
-- TOC entry 1831 (class 2606 OID 154205)
-- Dependencies: 140 140
-- Name: id_questionario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_questionario
    ADD CONSTRAINT id_questionario PRIMARY KEY (id_questionario);


--
-- TOC entry 1834 (class 2606 OID 154207)
-- Dependencies: 141 141 141 141
-- Name: id_questionariobeneficio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_questionario_beneficio
    ADD CONSTRAINT id_questionariobeneficio PRIMARY KEY (id_questionario_beneficio, id_beneficio, id_questionario);


--
-- TOC entry 1842 (class 2606 OID 154215)
-- Dependencies: 150 150
-- Name: id_situacaoimovel; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_situacao_imovel
    ADD CONSTRAINT id_situacaoimovel PRIMARY KEY (id_situacaoimovel);


--
-- TOC entry 1844 (class 2606 OID 154217)
-- Dependencies: 152 152
-- Name: id_situacaotrabalho; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_situacao_trabalho
    ADD CONSTRAINT id_situacaotrabalho PRIMARY KEY (id_situacaotrabalho);


--
-- TOC entry 1846 (class 2606 OID 154219)
-- Dependencies: 154 154
-- Name: id_situacaotrabalhopai; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_situacao_trabalho_pai
    ADD CONSTRAINT id_situacaotrabalhopai PRIMARY KEY (id_situacaotrabalhopai);


--
-- TOC entry 1864 (class 2606 OID 155050)
-- Dependencies: 177 177
-- Name: id_status; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_status
    ADD CONSTRAINT id_status PRIMARY KEY (id_status);


--
-- TOC entry 1848 (class 2606 OID 154221)
-- Dependencies: 156 156
-- Name: id_tipoescola; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipo_escola
    ADD CONSTRAINT id_tipoescola PRIMARY KEY (id_tipoescola);


--
-- TOC entry 1850 (class 2606 OID 154223)
-- Dependencies: 158 158
-- Name: id_tipoimovel; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipo_imovel
    ADD CONSTRAINT id_tipoimovel PRIMARY KEY (id_tipoimovel);


--
-- TOC entry 1852 (class 2606 OID 154225)
-- Dependencies: 160 160
-- Name: id_tipousuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipousuario
    ADD CONSTRAINT id_tipousuario PRIMARY KEY (id_tipousuario);


--
-- TOC entry 1870 (class 2606 OID 155320)
-- Dependencies: 183 183
-- Name: id_tipoveiculo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipo_veiculo
    ADD CONSTRAINT id_tipoveiculo PRIMARY KEY (id_tipoveiculo);


--
-- TOC entry 1854 (class 2606 OID 154227)
-- Dependencies: 162 162
-- Name: id_turno; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_turno
    ADD CONSTRAINT id_turno PRIMARY KEY (id_turno);


--
-- TOC entry 1856 (class 2606 OID 154229)
-- Dependencies: 164 164
-- Name: id_uf; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_uf
    ADD CONSTRAINT id_uf PRIMARY KEY (id_uf);


--
-- TOC entry 1858 (class 2606 OID 154231)
-- Dependencies: 166 166 166
-- Name: id_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT id_usuario PRIMARY KEY (id_usuario, id_tipousuario);


--
-- TOC entry 1860 (class 2606 OID 154233)
-- Dependencies: 168 168
-- Name: id_veiculo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_veiculo
    ADD CONSTRAINT id_veiculo PRIMARY KEY (id_veiculo);


--
-- TOC entry 1836 (class 2606 OID 210763)
-- Dependencies: 144 144
-- Name: pk_id_questionarioperiodo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_questionario_periodo
    ADD CONSTRAINT pk_id_questionarioperiodo PRIMARY KEY (id_questionarioperiodo);


--
-- TOC entry 1872 (class 2606 OID 157524)
-- Dependencies: 186 186
-- Name: questionarioResposta; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_pontuacao
    ADD CONSTRAINT "questionarioResposta" UNIQUE (id_questionarioresposta);


--
-- TOC entry 1876 (class 2606 OID 158926)
-- Dependencies: 187 187
-- Name: tbl_pontuacao_beneficio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_pontuacao_beneficio
    ADD CONSTRAINT tbl_pontuacao_beneficio_pkey PRIMARY KEY (id_pontuacaobeneficio);


--
-- TOC entry 1874 (class 2606 OID 156860)
-- Dependencies: 186 186
-- Name: tbl_pontuacao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_pontuacao
    ADD CONSTRAINT tbl_pontuacao_pkey PRIMARY KEY (id_pontuacao);


--
-- TOC entry 1878 (class 2606 OID 159856)
-- Dependencies: 190 190
-- Name: tbl_teste_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_teste
    ADD CONSTRAINT tbl_teste_pkey PRIMARY KEY (id_teste);


--
-- TOC entry 1832 (class 1259 OID 154477)
-- Dependencies: 141
-- Name: fki_tbl_campus_tbl_questionario_beneficio; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_tbl_campus_tbl_questionario_beneficio ON tbl_questionario_beneficio USING btree (id_campus);


--
-- TOC entry 1879 (class 2606 OID 154234)
-- Dependencies: 141 118 1808
-- Name: tbl_beneficio_tbl_questionario_beneficio_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_questionario_beneficio
    ADD CONSTRAINT tbl_beneficio_tbl_questionario_beneficio_fk FOREIGN KEY (id_beneficio) REFERENCES tbl_beneficio(id_beneficio) ON DELETE RESTRICT;


--
-- TOC entry 1901 (class 2606 OID 154239)
-- Dependencies: 118 147 1808
-- Name: tbl_beneficio_tbl_questionario_resposta_beneficio_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta_beneficio
    ADD CONSTRAINT tbl_beneficio_tbl_questionario_resposta_beneficio_fk FOREIGN KEY (id_beneficio) REFERENCES tbl_beneficio(id_beneficio) ON DELETE RESTRICT;


--
-- TOC entry 1881 (class 2606 OID 154472)
-- Dependencies: 120 141 1810
-- Name: tbl_campus_tbl_questionario_beneficio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_questionario_beneficio
    ADD CONSTRAINT tbl_campus_tbl_questionario_beneficio FOREIGN KEY (id_campus) REFERENCES tbl_campus(id_campus) ON DELETE RESTRICT;


--
-- TOC entry 1882 (class 2606 OID 154244)
-- Dependencies: 120 144 1810
-- Name: tbl_campus_tbl_questionario_periodo_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_questionario_periodo
    ADD CONSTRAINT tbl_campus_tbl_questionario_periodo_fk FOREIGN KEY (id_campus) REFERENCES tbl_campus(id_campus) ON DELETE RESTRICT;


--
-- TOC entry 1884 (class 2606 OID 154249)
-- Dependencies: 120 1810 146
-- Name: tbl_campus_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_campus_tbl_questionario_resposta_fk FOREIGN KEY (id_campus) REFERENCES tbl_campus(id_campus) ON DELETE RESTRICT;


--
-- TOC entry 1885 (class 2606 OID 154254)
-- Dependencies: 1812 146 122
-- Name: tbl_cidade_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_cidade_tbl_questionario_resposta_fk FOREIGN KEY (id_cidade) REFERENCES tbl_cidade(id_cidade) ON DELETE RESTRICT;


--
-- TOC entry 1886 (class 2606 OID 154259)
-- Dependencies: 122 1812 146
-- Name: tbl_cidade_tbl_questionario_resposta_fk1; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_cidade_tbl_questionario_resposta_fk1 FOREIGN KEY (id_cidade) REFERENCES tbl_cidade(id_cidade);


--
-- TOC entry 1887 (class 2606 OID 154264)
-- Dependencies: 122 1812 146
-- Name: tbl_cidade_tbl_questionario_resposta_fk2; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_cidade_tbl_questionario_resposta_fk2 FOREIGN KEY (id_cidade) REFERENCES tbl_cidade(id_cidade);


--
-- TOC entry 1888 (class 2606 OID 154269)
-- Dependencies: 124 146 1814
-- Name: tbl_curso_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_curso_tbl_questionario_resposta_fk FOREIGN KEY (id_curso) REFERENCES tbl_curso(id_curso) ON DELETE RESTRICT;


--
-- TOC entry 1889 (class 2606 OID 154274)
-- Dependencies: 126 146 1816
-- Name: tbl_deficiencia_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_deficiencia_tbl_questionario_resposta_fk FOREIGN KEY (id_deficiencia) REFERENCES tbl_deficiencia(id_deficiencia) ON DELETE RESTRICT;


--
-- TOC entry 1890 (class 2606 OID 154279)
-- Dependencies: 1818 128 146
-- Name: tbl_distancia_residencia_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_distancia_residencia_tbl_questionario_resposta_fk FOREIGN KEY (id_distanciaresidencia) REFERENCES tbl_distancia_residencia(id_distanciaresidencia) ON DELETE RESTRICT;


--
-- TOC entry 1891 (class 2606 OID 154284)
-- Dependencies: 1820 146 130
-- Name: tbl_escolaridade_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_escolaridade_tbl_questionario_resposta_fk FOREIGN KEY (id_escolaridade) REFERENCES tbl_escolaridade(id_escolaridade) ON DELETE RESTRICT;


--
-- TOC entry 1892 (class 2606 OID 154289)
-- Dependencies: 132 1822 146
-- Name: tbl_esta_cursando_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_esta_cursando_tbl_questionario_resposta_fk FOREIGN KEY (id_estacursando) REFERENCES tbl_esta_cursando(id_estacursando) ON DELETE RESTRICT;


--
-- TOC entry 1893 (class 2606 OID 154294)
-- Dependencies: 1824 146 134
-- Name: tbl_estado_civil_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_estado_civil_tbl_questionario_resposta_fk FOREIGN KEY (id_estadocivil) REFERENCES tbl_estado_civil(id_estadocivil) ON DELETE RESTRICT;


--
-- TOC entry 1903 (class 2606 OID 164479)
-- Dependencies: 187 1837 146
-- Name: tbl_pontuacao_beneficio_id_questionarioresposta_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_pontuacao_beneficio
    ADD CONSTRAINT tbl_pontuacao_beneficio_id_questionarioresposta_fkey FOREIGN KEY (id_questionarioresposta) REFERENCES tbl_questionario_resposta(id_questionarioresposta) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1899 (class 2606 OID 155198)
-- Dependencies: 176 146 1861
-- Name: tbl_questionario_resposta_id_frequencia_fkey; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_questionario_resposta_id_frequencia_fkey FOREIGN KEY (id_frequencia) REFERENCES tbl_frequencia(id_frequencia);


--
-- TOC entry 1900 (class 2606 OID 210769)
-- Dependencies: 144 146 1835
-- Name: tbl_questionario_resposta_id_questionario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_questionario_resposta_id_questionario_fkey FOREIGN KEY (id_questionario) REFERENCES tbl_questionario_periodo(id_questionarioperiodo);


--
-- TOC entry 1880 (class 2606 OID 154304)
-- Dependencies: 141 140 1830
-- Name: tbl_questionario_tbl_questionario_beneficio_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_questionario_beneficio
    ADD CONSTRAINT tbl_questionario_tbl_questionario_beneficio_fk FOREIGN KEY (id_questionario) REFERENCES tbl_questionario(id_questionario) ON DELETE CASCADE;


--
-- TOC entry 1883 (class 2606 OID 154309)
-- Dependencies: 1830 140 144
-- Name: tbl_questionario_tbl_questionario_periodo_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_questionario_periodo
    ADD CONSTRAINT tbl_questionario_tbl_questionario_periodo_fk FOREIGN KEY (id_questionario) REFERENCES tbl_questionario(id_questionario) ON DELETE CASCADE;


--
-- TOC entry 1894 (class 2606 OID 154319)
-- Dependencies: 146 150 1841
-- Name: tbl_situacao_imovel_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_situacao_imovel_tbl_questionario_resposta_fk FOREIGN KEY (id_situacaoimovel) REFERENCES tbl_situacao_imovel(id_situacaoimovel) ON DELETE RESTRICT;


--
-- TOC entry 1895 (class 2606 OID 154324)
-- Dependencies: 154 1845 146
-- Name: tbl_situacao_trabalho_pai_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_situacao_trabalho_pai_tbl_questionario_resposta_fk FOREIGN KEY (id_situacaotrabalhopai) REFERENCES tbl_situacao_trabalho_pai(id_situacaotrabalhopai) ON DELETE RESTRICT;


--
-- TOC entry 1896 (class 2606 OID 154334)
-- Dependencies: 1843 152 146
-- Name: tbl_situacao_trabalho_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_situacao_trabalho_tbl_questionario_resposta_fk FOREIGN KEY (id_situacaotrabalho) REFERENCES tbl_situacao_trabalho(id_situacaotrabalho) ON DELETE RESTRICT;


--
-- TOC entry 1897 (class 2606 OID 154339)
-- Dependencies: 146 1847 156
-- Name: tbl_tipo_escola_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_tipo_escola_tbl_questionario_resposta_fk FOREIGN KEY (id_tipoescola) REFERENCES tbl_tipo_escola(id_tipoescola) ON DELETE RESTRICT;


--
-- TOC entry 1902 (class 2606 OID 154344)
-- Dependencies: 1851 160 166
-- Name: tbl_tipousuario_tbl_usuario_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT tbl_tipousuario_tbl_usuario_fk FOREIGN KEY (id_tipousuario) REFERENCES tbl_tipousuario(id_tipousuario) ON DELETE RESTRICT;


--
-- TOC entry 1898 (class 2606 OID 154354)
-- Dependencies: 146 166 146 166 1857
-- Name: tbl_usuario_tbl_questionario_resposta_fk; Type: FK CONSTRAINT; Schema: public; Owner: assisti
--

ALTER TABLE ONLY tbl_questionario_resposta
    ADD CONSTRAINT tbl_usuario_tbl_questionario_resposta_fk FOREIGN KEY (id_usuario, id_tipousuario) REFERENCES tbl_usuario(id_usuario, id_tipousuario) ON DELETE RESTRICT;


--
-- TOC entry 1908 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: pgsql
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM pgsql;
GRANT ALL ON SCHEMA public TO pgsql;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- TOC entry 1909 (class 0 OID 0)
-- Dependencies: 179
-- Name: tbl_questionario_resposta_turno; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON TABLE tbl_questionario_resposta_turno FROM PUBLIC;
REVOKE ALL ON TABLE tbl_questionario_resposta_turno FROM assisti;
GRANT ALL ON TABLE tbl_questionario_resposta_turno TO assisti;
GRANT ALL ON TABLE tbl_questionario_resposta_turno TO sistemas;


--
-- TOC entry 1911 (class 0 OID 0)
-- Dependencies: 178
-- Name: id_questionarior_esposta_turno_id_questionariorespostaturno_seq; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON SEQUENCE id_questionarior_esposta_turno_id_questionariorespostaturno_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE id_questionarior_esposta_turno_id_questionariorespostaturno_seq FROM assisti;
GRANT ALL ON SEQUENCE id_questionarior_esposta_turno_id_questionariorespostaturno_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE id_questionarior_esposta_turno_id_questionariorespostaturno_seq TO sistemas;


--
-- TOC entry 1912 (class 0 OID 0)
-- Dependencies: 118
-- Name: tbl_beneficio; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_beneficio FROM PUBLIC;
REVOKE ALL ON TABLE tbl_beneficio FROM postgres;
GRANT ALL ON TABLE tbl_beneficio TO postgres;
GRANT ALL ON TABLE tbl_beneficio TO assisti;
GRANT ALL ON TABLE tbl_beneficio TO sistemas;


--
-- TOC entry 1914 (class 0 OID 0)
-- Dependencies: 119
-- Name: tbl_beneficio_id_beneficio_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_beneficio_id_beneficio_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_beneficio_id_beneficio_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_beneficio_id_beneficio_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_beneficio_id_beneficio_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_beneficio_id_beneficio_seq TO sistemas;


--
-- TOC entry 1915 (class 0 OID 0)
-- Dependencies: 120
-- Name: tbl_campus; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_campus FROM PUBLIC;
REVOKE ALL ON TABLE tbl_campus FROM postgres;
GRANT ALL ON TABLE tbl_campus TO postgres;
GRANT ALL ON TABLE tbl_campus TO assisti;
GRANT ALL ON TABLE tbl_campus TO sistemas;


--
-- TOC entry 1917 (class 0 OID 0)
-- Dependencies: 121
-- Name: tbl_campus_id_campus_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_campus_id_campus_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_campus_id_campus_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_campus_id_campus_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_campus_id_campus_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_campus_id_campus_seq TO sistemas;


--
-- TOC entry 1918 (class 0 OID 0)
-- Dependencies: 122
-- Name: tbl_cidade; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_cidade FROM PUBLIC;
REVOKE ALL ON TABLE tbl_cidade FROM postgres;
GRANT ALL ON TABLE tbl_cidade TO postgres;
GRANT ALL ON TABLE tbl_cidade TO assisti;
GRANT ALL ON TABLE tbl_cidade TO sistemas;


--
-- TOC entry 1920 (class 0 OID 0)
-- Dependencies: 123
-- Name: tbl_cidade_id_cidade_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_cidade_id_cidade_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_cidade_id_cidade_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_cidade_id_cidade_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_cidade_id_cidade_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_cidade_id_cidade_seq TO sistemas;


--
-- TOC entry 1921 (class 0 OID 0)
-- Dependencies: 124
-- Name: tbl_curso; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_curso FROM PUBLIC;
REVOKE ALL ON TABLE tbl_curso FROM postgres;
GRANT ALL ON TABLE tbl_curso TO postgres;
GRANT ALL ON TABLE tbl_curso TO assisti;
GRANT ALL ON TABLE tbl_curso TO sistemas;


--
-- TOC entry 1923 (class 0 OID 0)
-- Dependencies: 125
-- Name: tbl_curso_id_curso_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_curso_id_curso_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_curso_id_curso_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_curso_id_curso_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_curso_id_curso_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_curso_id_curso_seq TO sistemas;


--
-- TOC entry 1924 (class 0 OID 0)
-- Dependencies: 126
-- Name: tbl_deficiencia; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_deficiencia FROM PUBLIC;
REVOKE ALL ON TABLE tbl_deficiencia FROM postgres;
GRANT ALL ON TABLE tbl_deficiencia TO postgres;
GRANT ALL ON TABLE tbl_deficiencia TO assisti;
GRANT ALL ON TABLE tbl_deficiencia TO sistemas;


--
-- TOC entry 1926 (class 0 OID 0)
-- Dependencies: 127
-- Name: tbl_deficiencia_id_deficiencia_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_deficiencia_id_deficiencia_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_deficiencia_id_deficiencia_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_deficiencia_id_deficiencia_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_deficiencia_id_deficiencia_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_deficiencia_id_deficiencia_seq TO sistemas;


--
-- TOC entry 1927 (class 0 OID 0)
-- Dependencies: 128
-- Name: tbl_distancia_residencia; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_distancia_residencia FROM PUBLIC;
REVOKE ALL ON TABLE tbl_distancia_residencia FROM postgres;
GRANT ALL ON TABLE tbl_distancia_residencia TO postgres;
GRANT ALL ON TABLE tbl_distancia_residencia TO assisti;
GRANT ALL ON TABLE tbl_distancia_residencia TO sistemas;


--
-- TOC entry 1929 (class 0 OID 0)
-- Dependencies: 129
-- Name: tbl_distancia_residencia_id_distanciaresidencia_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_distancia_residencia_id_distanciaresidencia_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_distancia_residencia_id_distanciaresidencia_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_distancia_residencia_id_distanciaresidencia_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_distancia_residencia_id_distanciaresidencia_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_distancia_residencia_id_distanciaresidencia_seq TO sistemas;


--
-- TOC entry 1930 (class 0 OID 0)
-- Dependencies: 130
-- Name: tbl_escolaridade; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_escolaridade FROM PUBLIC;
REVOKE ALL ON TABLE tbl_escolaridade FROM postgres;
GRANT ALL ON TABLE tbl_escolaridade TO postgres;
GRANT ALL ON TABLE tbl_escolaridade TO assisti;
GRANT ALL ON TABLE tbl_escolaridade TO sistemas;


--
-- TOC entry 1932 (class 0 OID 0)
-- Dependencies: 131
-- Name: tbl_escolaridade_id_escolaridade_seq_1; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_escolaridade_id_escolaridade_seq_1 FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_escolaridade_id_escolaridade_seq_1 FROM postgres;
GRANT ALL ON SEQUENCE tbl_escolaridade_id_escolaridade_seq_1 TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_escolaridade_id_escolaridade_seq_1 TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_escolaridade_id_escolaridade_seq_1 TO sistemas;


--
-- TOC entry 1933 (class 0 OID 0)
-- Dependencies: 132
-- Name: tbl_esta_cursando; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_esta_cursando FROM PUBLIC;
REVOKE ALL ON TABLE tbl_esta_cursando FROM postgres;
GRANT ALL ON TABLE tbl_esta_cursando TO postgres;
GRANT ALL ON TABLE tbl_esta_cursando TO assisti;
GRANT ALL ON TABLE tbl_esta_cursando TO sistemas;


--
-- TOC entry 1935 (class 0 OID 0)
-- Dependencies: 133
-- Name: tbl_esta_cursando_id_estacursando_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_esta_cursando_id_estacursando_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_esta_cursando_id_estacursando_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_esta_cursando_id_estacursando_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_esta_cursando_id_estacursando_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_esta_cursando_id_estacursando_seq TO sistemas;


--
-- TOC entry 1936 (class 0 OID 0)
-- Dependencies: 134
-- Name: tbl_estado_civil; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_estado_civil FROM PUBLIC;
REVOKE ALL ON TABLE tbl_estado_civil FROM postgres;
GRANT ALL ON TABLE tbl_estado_civil TO postgres;
GRANT ALL ON TABLE tbl_estado_civil TO assisti;
GRANT ALL ON TABLE tbl_estado_civil TO sistemas;


--
-- TOC entry 1938 (class 0 OID 0)
-- Dependencies: 135
-- Name: tbl_estado_civil_id_estadocivil_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_estado_civil_id_estadocivil_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_estado_civil_id_estadocivil_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_estado_civil_id_estadocivil_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_estado_civil_id_estadocivil_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_estado_civil_id_estadocivil_seq TO sistemas;


--
-- TOC entry 1939 (class 0 OID 0)
-- Dependencies: 175
-- Name: tbl_frequencia_id_frequencia_seq; Type: ACL; Schema: public; Owner: sistemas
--

REVOKE ALL ON SEQUENCE tbl_frequencia_id_frequencia_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_frequencia_id_frequencia_seq FROM sistemas;
GRANT ALL ON SEQUENCE tbl_frequencia_id_frequencia_seq TO sistemas;


--
-- TOC entry 1940 (class 0 OID 0)
-- Dependencies: 176
-- Name: tbl_frequencia; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_frequencia FROM PUBLIC;
REVOKE ALL ON TABLE tbl_frequencia FROM postgres;
GRANT ALL ON TABLE tbl_frequencia TO postgres;
GRANT ALL ON TABLE tbl_frequencia TO assisti;
GRANT ALL ON TABLE tbl_frequencia TO sistemas;


--
-- TOC entry 1941 (class 0 OID 0)
-- Dependencies: 136
-- Name: tbl_grau_parentesco; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_grau_parentesco FROM PUBLIC;
REVOKE ALL ON TABLE tbl_grau_parentesco FROM postgres;
GRANT ALL ON TABLE tbl_grau_parentesco TO postgres;
GRANT ALL ON TABLE tbl_grau_parentesco TO assisti;
GRANT ALL ON TABLE tbl_grau_parentesco TO sistemas;


--
-- TOC entry 1943 (class 0 OID 0)
-- Dependencies: 137
-- Name: tbl_grau_parentesco_id_grauparentesco_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_grau_parentesco_id_grauparentesco_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_grau_parentesco_id_grauparentesco_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_grau_parentesco_id_grauparentesco_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_grau_parentesco_id_grauparentesco_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_grau_parentesco_id_grauparentesco_seq TO sistemas;


--
-- TOC entry 1945 (class 0 OID 0)
-- Dependencies: 138
-- Name: tbl_imovel; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_imovel FROM PUBLIC;
REVOKE ALL ON TABLE tbl_imovel FROM postgres;
GRANT ALL ON TABLE tbl_imovel TO postgres;
GRANT ALL ON TABLE tbl_imovel TO assisti;
GRANT ALL ON TABLE tbl_imovel TO sistemas;


--
-- TOC entry 1947 (class 0 OID 0)
-- Dependencies: 139
-- Name: tbl_imovel_id_imovel_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_imovel_id_imovel_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_imovel_id_imovel_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_imovel_id_imovel_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_imovel_id_imovel_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_imovel_id_imovel_seq TO sistemas;


--
-- TOC entry 1948 (class 0 OID 0)
-- Dependencies: 186
-- Name: tbl_pontuacao; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_pontuacao FROM PUBLIC;
REVOKE ALL ON TABLE tbl_pontuacao FROM postgres;
GRANT ALL ON TABLE tbl_pontuacao TO postgres;
GRANT ALL ON TABLE tbl_pontuacao TO assisti;
GRANT ALL ON TABLE tbl_pontuacao TO sistemas;


--
-- TOC entry 1949 (class 0 OID 0)
-- Dependencies: 187
-- Name: tbl_pontuacao_beneficio; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_pontuacao_beneficio FROM PUBLIC;
REVOKE ALL ON TABLE tbl_pontuacao_beneficio FROM postgres;
GRANT ALL ON TABLE tbl_pontuacao_beneficio TO postgres;
GRANT ALL ON TABLE tbl_pontuacao_beneficio TO assisti;
GRANT ALL ON TABLE tbl_pontuacao_beneficio TO sistemas;


--
-- TOC entry 1951 (class 0 OID 0)
-- Dependencies: 188
-- Name: tbl_pontuacao_beneficio_id_pontuacao_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_pontuacao_beneficio_id_pontuacao_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_pontuacao_beneficio_id_pontuacao_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_pontuacao_beneficio_id_pontuacao_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_pontuacao_beneficio_id_pontuacao_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_pontuacao_beneficio_id_pontuacao_seq TO sistemas;


--
-- TOC entry 1953 (class 0 OID 0)
-- Dependencies: 185
-- Name: tbl_pontuacao_id_pontuacao_seq1; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_pontuacao_id_pontuacao_seq1 FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_pontuacao_id_pontuacao_seq1 FROM postgres;
GRANT ALL ON SEQUENCE tbl_pontuacao_id_pontuacao_seq1 TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_pontuacao_id_pontuacao_seq1 TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_pontuacao_id_pontuacao_seq1 TO sistemas;


--
-- TOC entry 1954 (class 0 OID 0)
-- Dependencies: 140
-- Name: tbl_questionario; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_questionario FROM PUBLIC;
REVOKE ALL ON TABLE tbl_questionario FROM postgres;
GRANT ALL ON TABLE tbl_questionario TO postgres;
GRANT ALL ON TABLE tbl_questionario TO assisti;
GRANT ALL ON TABLE tbl_questionario TO sistemas;


--
-- TOC entry 1955 (class 0 OID 0)
-- Dependencies: 141
-- Name: tbl_questionario_beneficio; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_questionario_beneficio FROM PUBLIC;
REVOKE ALL ON TABLE tbl_questionario_beneficio FROM postgres;
GRANT ALL ON TABLE tbl_questionario_beneficio TO postgres;
GRANT ALL ON TABLE tbl_questionario_beneficio TO assisti;
GRANT ALL ON TABLE tbl_questionario_beneficio TO sistemas;


--
-- TOC entry 1957 (class 0 OID 0)
-- Dependencies: 142
-- Name: tbl_questionario_beneficio_id_questionario_beneficio_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_questionario_beneficio_id_questionario_beneficio_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_questionario_beneficio_id_questionario_beneficio_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_questionario_beneficio_id_questionario_beneficio_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_questionario_beneficio_id_questionario_beneficio_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_questionario_beneficio_id_questionario_beneficio_seq TO sistemas;


--
-- TOC entry 1959 (class 0 OID 0)
-- Dependencies: 143
-- Name: tbl_questionario_id_questionario_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_questionario_id_questionario_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_questionario_id_questionario_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_questionario_id_questionario_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_questionario_id_questionario_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_questionario_id_questionario_seq TO sistemas;


--
-- TOC entry 1960 (class 0 OID 0)
-- Dependencies: 144
-- Name: tbl_questionario_periodo; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_questionario_periodo FROM PUBLIC;
REVOKE ALL ON TABLE tbl_questionario_periodo FROM postgres;
GRANT ALL ON TABLE tbl_questionario_periodo TO postgres;
GRANT ALL ON TABLE tbl_questionario_periodo TO assisti;
GRANT ALL ON TABLE tbl_questionario_periodo TO sistemas;


--
-- TOC entry 1962 (class 0 OID 0)
-- Dependencies: 145
-- Name: tbl_questionario_periodo_id_questionarioperiodo_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_questionario_periodo_id_questionarioperiodo_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_questionario_periodo_id_questionarioperiodo_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_questionario_periodo_id_questionarioperiodo_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_questionario_periodo_id_questionarioperiodo_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_questionario_periodo_id_questionarioperiodo_seq TO sistemas;


--
-- TOC entry 1963 (class 0 OID 0)
-- Dependencies: 146
-- Name: tbl_questionario_resposta; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON TABLE tbl_questionario_resposta FROM PUBLIC;
REVOKE ALL ON TABLE tbl_questionario_resposta FROM assisti;
GRANT ALL ON TABLE tbl_questionario_resposta TO assisti;
GRANT ALL ON TABLE tbl_questionario_resposta TO PUBLIC;


--
-- TOC entry 1964 (class 0 OID 0)
-- Dependencies: 147
-- Name: tbl_questionario_resposta_beneficio; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON TABLE tbl_questionario_resposta_beneficio FROM PUBLIC;
REVOKE ALL ON TABLE tbl_questionario_resposta_beneficio FROM assisti;
GRANT ALL ON TABLE tbl_questionario_resposta_beneficio TO assisti;
GRANT ALL ON TABLE tbl_questionario_resposta_beneficio TO sistemas;


--
-- TOC entry 1967 (class 0 OID 0)
-- Dependencies: 149
-- Name: tbl_questionario_resposta_id_questionarioresposta_seq; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON SEQUENCE tbl_questionario_resposta_id_questionarioresposta_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_questionario_resposta_id_questionarioresposta_seq FROM assisti;
GRANT ALL ON SEQUENCE tbl_questionario_resposta_id_questionarioresposta_seq TO assisti;


--
-- TOC entry 1968 (class 0 OID 0)
-- Dependencies: 150
-- Name: tbl_situacao_imovel; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_situacao_imovel FROM PUBLIC;
REVOKE ALL ON TABLE tbl_situacao_imovel FROM postgres;
GRANT ALL ON TABLE tbl_situacao_imovel TO postgres;
GRANT ALL ON TABLE tbl_situacao_imovel TO assisti;
GRANT ALL ON TABLE tbl_situacao_imovel TO sistemas;


--
-- TOC entry 1970 (class 0 OID 0)
-- Dependencies: 151
-- Name: tbl_situacao_imovel_id_situacaoimovel_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_situacao_imovel_id_situacaoimovel_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_situacao_imovel_id_situacaoimovel_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_situacao_imovel_id_situacaoimovel_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_situacao_imovel_id_situacaoimovel_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_situacao_imovel_id_situacaoimovel_seq TO sistemas;


--
-- TOC entry 1971 (class 0 OID 0)
-- Dependencies: 152
-- Name: tbl_situacao_trabalho; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_situacao_trabalho FROM PUBLIC;
REVOKE ALL ON TABLE tbl_situacao_trabalho FROM postgres;
GRANT ALL ON TABLE tbl_situacao_trabalho TO postgres;
GRANT ALL ON TABLE tbl_situacao_trabalho TO assisti;
GRANT ALL ON TABLE tbl_situacao_trabalho TO sistemas;


--
-- TOC entry 1973 (class 0 OID 0)
-- Dependencies: 153
-- Name: tbl_situacao_trabalho_id_situacaotrabalho_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_situacao_trabalho_id_situacaotrabalho_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_situacao_trabalho_id_situacaotrabalho_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_situacao_trabalho_id_situacaotrabalho_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_situacao_trabalho_id_situacaotrabalho_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_situacao_trabalho_id_situacaotrabalho_seq TO sistemas;


--
-- TOC entry 1974 (class 0 OID 0)
-- Dependencies: 154
-- Name: tbl_situacao_trabalho_pai; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_situacao_trabalho_pai FROM PUBLIC;
REVOKE ALL ON TABLE tbl_situacao_trabalho_pai FROM postgres;
GRANT ALL ON TABLE tbl_situacao_trabalho_pai TO postgres;
GRANT ALL ON TABLE tbl_situacao_trabalho_pai TO assisti;
GRANT ALL ON TABLE tbl_situacao_trabalho_pai TO sistemas;


--
-- TOC entry 1976 (class 0 OID 0)
-- Dependencies: 155
-- Name: tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1 FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1 FROM postgres;
GRANT ALL ON SEQUENCE tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1 TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1 TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_situacao_trabalho_pai_id_situacaotrabalhopai_seq_1 TO sistemas;


--
-- TOC entry 1977 (class 0 OID 0)
-- Dependencies: 177
-- Name: tbl_status; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_status FROM PUBLIC;
REVOKE ALL ON TABLE tbl_status FROM postgres;
GRANT ALL ON TABLE tbl_status TO postgres;
GRANT ALL ON TABLE tbl_status TO assisti;
GRANT ALL ON TABLE tbl_status TO sistemas;


--
-- TOC entry 1978 (class 0 OID 0)
-- Dependencies: 190
-- Name: tbl_teste; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_teste FROM PUBLIC;
REVOKE ALL ON TABLE tbl_teste FROM postgres;
GRANT ALL ON TABLE tbl_teste TO postgres;
GRANT ALL ON TABLE tbl_teste TO assisti;
GRANT ALL ON TABLE tbl_teste TO sistemas;


--
-- TOC entry 1980 (class 0 OID 0)
-- Dependencies: 189
-- Name: tbl_teste_id_teste_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_teste_id_teste_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_teste_id_teste_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_teste_id_teste_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_teste_id_teste_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_teste_id_teste_seq TO sistemas;


--
-- TOC entry 1981 (class 0 OID 0)
-- Dependencies: 156
-- Name: tbl_tipo_escola; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_tipo_escola FROM PUBLIC;
REVOKE ALL ON TABLE tbl_tipo_escola FROM postgres;
GRANT ALL ON TABLE tbl_tipo_escola TO postgres;
GRANT ALL ON TABLE tbl_tipo_escola TO assisti;
GRANT ALL ON TABLE tbl_tipo_escola TO sistemas;


--
-- TOC entry 1983 (class 0 OID 0)
-- Dependencies: 157
-- Name: tbl_tipo_escola_id_tipoescola_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_tipo_escola_id_tipoescola_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_tipo_escola_id_tipoescola_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_tipo_escola_id_tipoescola_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_tipo_escola_id_tipoescola_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_tipo_escola_id_tipoescola_seq TO sistemas;


--
-- TOC entry 1984 (class 0 OID 0)
-- Dependencies: 158
-- Name: tbl_tipo_imovel; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_tipo_imovel FROM PUBLIC;
REVOKE ALL ON TABLE tbl_tipo_imovel FROM postgres;
GRANT ALL ON TABLE tbl_tipo_imovel TO postgres;
GRANT ALL ON TABLE tbl_tipo_imovel TO assisti;
GRANT ALL ON TABLE tbl_tipo_imovel TO sistemas;


--
-- TOC entry 1986 (class 0 OID 0)
-- Dependencies: 159
-- Name: tbl_tipo_imovel_id_tipoimovel_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_tipo_imovel_id_tipoimovel_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_tipo_imovel_id_tipoimovel_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_tipo_imovel_id_tipoimovel_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_tipo_imovel_id_tipoimovel_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_tipo_imovel_id_tipoimovel_seq TO sistemas;


--
-- TOC entry 1987 (class 0 OID 0)
-- Dependencies: 183
-- Name: tbl_tipo_veiculo; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_tipo_veiculo FROM PUBLIC;
REVOKE ALL ON TABLE tbl_tipo_veiculo FROM postgres;
GRANT ALL ON TABLE tbl_tipo_veiculo TO postgres;
GRANT ALL ON TABLE tbl_tipo_veiculo TO assisti;
GRANT ALL ON TABLE tbl_tipo_veiculo TO sistemas;


--
-- TOC entry 1988 (class 0 OID 0)
-- Dependencies: 160
-- Name: tbl_tipousuario; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_tipousuario FROM PUBLIC;
REVOKE ALL ON TABLE tbl_tipousuario FROM postgres;
GRANT ALL ON TABLE tbl_tipousuario TO postgres;
GRANT ALL ON TABLE tbl_tipousuario TO assisti;
GRANT ALL ON TABLE tbl_tipousuario TO sistemas;


--
-- TOC entry 1990 (class 0 OID 0)
-- Dependencies: 161
-- Name: tbl_tipousuario_id_tipousuario_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_tipousuario_id_tipousuario_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_tipousuario_id_tipousuario_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_tipousuario_id_tipousuario_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_tipousuario_id_tipousuario_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_tipousuario_id_tipousuario_seq TO sistemas;


--
-- TOC entry 1991 (class 0 OID 0)
-- Dependencies: 162
-- Name: tbl_turno; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_turno FROM PUBLIC;
REVOKE ALL ON TABLE tbl_turno FROM postgres;
GRANT ALL ON TABLE tbl_turno TO postgres;
GRANT ALL ON TABLE tbl_turno TO assisti;
GRANT ALL ON TABLE tbl_turno TO sistemas;


--
-- TOC entry 1993 (class 0 OID 0)
-- Dependencies: 163
-- Name: tbl_turno_id_turno_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_turno_id_turno_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_turno_id_turno_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_turno_id_turno_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_turno_id_turno_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_turno_id_turno_seq TO sistemas;


--
-- TOC entry 1994 (class 0 OID 0)
-- Dependencies: 164
-- Name: tbl_uf; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_uf FROM PUBLIC;
REVOKE ALL ON TABLE tbl_uf FROM postgres;
GRANT ALL ON TABLE tbl_uf TO postgres;
GRANT ALL ON TABLE tbl_uf TO assisti;
GRANT ALL ON TABLE tbl_uf TO sistemas;


--
-- TOC entry 1996 (class 0 OID 0)
-- Dependencies: 165
-- Name: tbl_uf_id_uf_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_uf_id_uf_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_uf_id_uf_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_uf_id_uf_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_uf_id_uf_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_uf_id_uf_seq TO sistemas;


--
-- TOC entry 1997 (class 0 OID 0)
-- Dependencies: 166
-- Name: tbl_usuario; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_usuario FROM PUBLIC;
REVOKE ALL ON TABLE tbl_usuario FROM postgres;
GRANT ALL ON TABLE tbl_usuario TO postgres;
GRANT ALL ON TABLE tbl_usuario TO PUBLIC;
GRANT ALL ON TABLE tbl_usuario TO assisti;
GRANT ALL ON TABLE tbl_usuario TO sistemas;


--
-- TOC entry 1999 (class 0 OID 0)
-- Dependencies: 167
-- Name: tbl_usuario_id_usuario_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_usuario_id_usuario_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_usuario_id_usuario_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_usuario_id_usuario_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_usuario_id_usuario_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_usuario_id_usuario_seq TO sistemas;


--
-- TOC entry 2000 (class 0 OID 0)
-- Dependencies: 168
-- Name: tbl_veiculo; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tbl_veiculo FROM PUBLIC;
REVOKE ALL ON TABLE tbl_veiculo FROM postgres;
GRANT ALL ON TABLE tbl_veiculo TO postgres;
GRANT ALL ON TABLE tbl_veiculo TO assisti;
GRANT ALL ON TABLE tbl_veiculo TO sistemas;


--
-- TOC entry 2002 (class 0 OID 0)
-- Dependencies: 169
-- Name: tbl_veiculo_id_veiculo_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE tbl_veiculo_id_veiculo_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE tbl_veiculo_id_veiculo_seq FROM postgres;
GRANT ALL ON SEQUENCE tbl_veiculo_id_veiculo_seq TO postgres;
GRANT SELECT,UPDATE ON SEQUENCE tbl_veiculo_id_veiculo_seq TO assisti;
GRANT SELECT,UPDATE ON SEQUENCE tbl_veiculo_id_veiculo_seq TO sistemas;


--
-- TOC entry 2003 (class 0 OID 0)
-- Dependencies: 172
-- Name: visao_chaves_das_tabelas; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON TABLE visao_chaves_das_tabelas FROM PUBLIC;
REVOKE ALL ON TABLE visao_chaves_das_tabelas FROM assisti;
GRANT ALL ON TABLE visao_chaves_das_tabelas TO assisti;
GRANT ALL ON TABLE visao_chaves_das_tabelas TO sistemas;


--
-- TOC entry 2004 (class 0 OID 0)
-- Dependencies: 174
-- Name: visao_descricao_tabelas; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON TABLE visao_descricao_tabelas FROM PUBLIC;
REVOKE ALL ON TABLE visao_descricao_tabelas FROM assisti;
GRANT ALL ON TABLE visao_descricao_tabelas TO assisti;
GRANT ALL ON TABLE visao_descricao_tabelas TO sistemas;


--
-- TOC entry 2005 (class 0 OID 0)
-- Dependencies: 170
-- Name: visao_sequencias_e_registros_das_tabelas; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON TABLE visao_sequencias_e_registros_das_tabelas FROM PUBLIC;
REVOKE ALL ON TABLE visao_sequencias_e_registros_das_tabelas FROM assisti;
GRANT ALL ON TABLE visao_sequencias_e_registros_das_tabelas TO assisti;
GRANT ALL ON TABLE visao_sequencias_e_registros_das_tabelas TO sistemas;


--
-- TOC entry 2006 (class 0 OID 0)
-- Dependencies: 173
-- Name: visao_tabelas_chaves_sequencias_registros; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON TABLE visao_tabelas_chaves_sequencias_registros FROM PUBLIC;
REVOKE ALL ON TABLE visao_tabelas_chaves_sequencias_registros FROM assisti;
GRANT ALL ON TABLE visao_tabelas_chaves_sequencias_registros TO assisti;
GRANT ALL ON TABLE visao_tabelas_chaves_sequencias_registros TO sistemas;


--
-- TOC entry 2007 (class 0 OID 0)
-- Dependencies: 171
-- Name: visao_tabelas_e_visoes; Type: ACL; Schema: public; Owner: assisti
--

REVOKE ALL ON TABLE visao_tabelas_e_visoes FROM PUBLIC;
REVOKE ALL ON TABLE visao_tabelas_e_visoes FROM assisti;
GRANT ALL ON TABLE visao_tabelas_e_visoes TO assisti;
GRANT ALL ON TABLE visao_tabelas_e_visoes TO sistemas;


-- Completed on 2013-11-08 09:53:17

--
-- PostgreSQL database dump complete
--

