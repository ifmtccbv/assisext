<?php 
class SGetter 
{
	protected $table;
	protected $banco;
	
	/**
	 * Função setData: Executa operações no banco
	 * @param dados: Campos com os valores que serão inseridos(no caso de DELETE no banco, essa variavel nao é utilizada). Pode ser um vetor com varios campos ou uma string(Comando SQL Completo). <br />
	 * o vetor é estruturado da seguinte maneira: $dados[$i]['campos'] = 'valor';
	 * @param criterios: Criterios para a inserção no banco(nao é utilizado no caso de INSERT). vetor estruturado da seguinte maneira: $criterios[$i]['campo']['op'], $criterios[$i]['campo']['valor']<br />
	 * @return boolea
	 * @example <code>
	 * 
	 * INSERT: <br />
	 * $dados[0]['nome'] = 'Diego';
	 * $dados[0]['email'] = 'Diego';
	 * $dados[0]['senha'] = 'Diego';
	 * 
	 * $dados[1]['nome'] = 'Rafael';
	 * $dados[1]['email'] = 'Rafael';
	 * $dados[1]['senha'] = 'Rafael';
	 * 
	 * setData($dados); <br /> <br /> 
	 * 
	 * UPDATE: <br />
	 * $dados[0]['nome'] = 'Diego  Cardim'; <br />
	 * 
	 * $criterios[0]['nome']['op'] = '='; <br />
	 * $criterios[0]['nome']['valor'] = 'Diego'; <br />
	 * 
	 * $dados[1]['nome'] = 'Rafael Silverio'; <br />
	 * 
	 * $criterios[1]['nome']['op'] = '='; <br />
	 * $criterios[1]['nome']['valor'] = 'Rafael'; <br />
	 * 
	 * setData($dados,$criterios);<br /> <br />
	 * 
	 * DELETE: <br />
	 * 
	 * $criterios[0]['nome']['op'] = '='; <br />
	 * $criterios[0]['nome']['valor'] = 'Diego'; <br />
	 * $criterios[1]['nome']['op'] = '='; <br />
	 * $criterios[1]['nome']['valor'] = 'Rafael'; <br />
	 * setData(0,$criterios);
	 * </code>
	*/
	public function setData($dados=0, $criterios=0, $insertId=false)
	{
		if( is_array($dados))
		{
			 if (is_array($criterios)) //Comandos de UPDATE
			 {
			 	$retorno = true;
			 	for ($i=0;$i<sizeof($dados);$i++)
			 	{
					$this->banco->query = 'UPDATE '.$this->table.' SET ';
					
					$arrayDados = array();
					
					foreach ($dados[$i] as $campo=>$valor)
					{
						$valor = strtoupper($valor) == 'NULL' ? $valor : "'".$valor."'";
						 array_push($arrayDados, $campo." = ".$valor);
					} //fim foreach
					
					$this->banco->query.= implode(', ', $arrayDados)." WHERE ";
					
					$arrayCriterios = array();
					
					foreach ($criterios[$i] as $chave => $value)
					{
						$value['valor'] = strtoupper($value['valor']) == 'NULL' ? $value['valor'] : "'".$value['valor']."'";
						array_push($arrayCriterios, $chave." ".$value['op']." ".$value['valor']);	
					}//fim foreach
					$this->banco->query .= implode(' AND ', $arrayCriterios)." ; ";	
					$retorno = $retorno && $this->banco->executarSQL($this->banco->query);					
						
			 	}//fim do for
			 	
				return $retorno;
				
			 } // fim if
			 else  // comando de INSERT
			 {
			 	$this->banco->query = "INSERT INTO ".$this->table." (".implode(',',array_keys($dados[0])).") VALUES ";
			 	
			 	$arrayDados = array();
			 	
				for ($i=0;$i<sizeof($dados);$i++)
				{
					$campos = array();		// array de valores dos campos
					
					foreach ($dados[$i] as $valor)
					{
						$valor = strtoupper($valor) == 'NULL' ? $valor : "'".$valor."'";
						
						array_push($campos, $valor);
					} // fim foreach
					
			 		array_push($arrayDados, '('.implode(', ', $campos).')');		// empilhar comando insert
				} // fim for
				
				$this->banco->query .= implode(', ', $arrayDados);
				
				if ($this->banco->executarSQL($this->banco->query))
				{
					return $insertId ? mysql_insert_id() : true;		// caso parametro de retorno de id esteja ativado retornar id de inserção
				} // fim if
				else 
				{
					return false;
				} // fim else
			 } // fim else
		} // fim if
		else 
		{
			if (is_array($criterios))// comando de DELETE
			{
				$this->banco->query = '';
				
				for ($i = 0;$i<sizeof($criterios);$i++)
				{
					$this->banco->query .= 'DELETE FROM '.$this->table.' WHERE ';
					$arrayCriterios = array();
					
					foreach ($criterios[$i] as $chave => $value)
					{
						$value['valor'] = strtoupper($value['valor']) == 'NULL' ? $value['valor'] : "'".$value['valor']."'";
						array_push($arrayCriterios, $chave.' '.$value['op'].' '.$value['valor']);
					}//fim foreach
					$this->banco->query .= implode(' AND ',$arrayCriterios).';';
				} //fim do for
				
				return $this->banco->executarSQL($this->banco->query);
			} // fim if
			else // executar SQL (SQL setado na mao) 
			{
				return $this->banco->executarSQL($dados);
			} // fim else
		} // fim else
	}//fim setData

	/**
	 * Função getData: Executa uma pesquisa no banco
	 * @param campos: campos que se deseja mostrar no retorno. Pode ser um vetor com varios campos, ou simplesmente *. Ex: SELECT $campos FROM...
	 * @param criterios: vetor estruturado da seguinte maneira: $criterios['campos']['op'] , $criterios['campos']['valor']<br /> OBS: Para consultas complexas, passe todo o comando SQL como string na varialvel $criterios
	 * @param orderby: string que guarda por qual campo ordenar...
	 * @return Função da classe Banco, consultarSQL();
	 * @example 
	 * $criterios[0]['nome']['op']='='; <br />
	 * $criterios[0]['nome']['valor'] = 'Diego'; <br />
	 * $criterios[0]['estado']['op]='='; <br />
	 * $criterios[0]['estado']['valor'] = 'Diego'; <br />
	 * $campos[0] = '*'; <br />
	 * $orderby = 'nome'; <br />
	 * getData($criterios,$campos,$orderby);
	*/
	public function getData($criterios=0, $campos=0, $orderby=0, $limit=0)
	{
		if (is_string($criterios))
		{ //consulta complexa
			return $this->banco->consultarSQL($criterios);
		}//fim if
		
		$this->banco->query = 'SELECT ';
		
		$this->banco->query .= is_array($campos) ? implode(',',$campos) : '*';
		
		$this->banco->query .= ' FROM '.$this->table;
		
		if (is_array($criterios))
		{
			$this->banco->query.=' WHERE ';
			$arrayDados = array();
			
			foreach ($criterios as $vetor)
			{		
				foreach ($vetor as $chave => $value)	
				{
					$value['valor'] = strtoupper($value['valor']) == 'NULL' ? $value['valor'] : "'".$value['valor']."'";
					array_push($arrayDados, $chave.' '.$value['op'].' '.$value['valor']);
				} //fim foreach
			} //fim foreach
			
			$this->banco->query .= implode(' AND ',$arrayDados);
		} //fim da verificação dos criterios
		
		if(is_string($orderby))
		{
			$this->banco->query .= ' ORDER BY '.$orderby;
		}//fim if
		
		if(is_string($limit))
		{
			$this->banco->query .= ' LIMIT '.$limit;
		}//fim if
		
		return $this->banco->consultarSQL($this->banco->query);
	} // fim da getData
} // fim class SGetter
?>