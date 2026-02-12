<?php
// Retorna dados do tipo JSON
header('Content-Type: application/json');

//string JSON
$lista = file_get_contents("contato.json");
 
//faz o parsing da string JSON, criando um objeto
$jsonObj = json_decode($lista);

//recupera quantos objetos deverão ser retornados
$total_contatos = count($jsonObj);
$quantidade = isset($_GET['limite']) ? $_GET['limite'] : $total_contatos;
if(!is_numeric($quantidade) || $quantidade > $total_contatos){
	$quantidade = $total_contatos;
}

//recupera o código do contato que deverá ser retornado
$contato = isset($_GET['contato']) ? $_GET['contato'] : null;
if(!is_numeric($contato) || $contato >= $total_contatos){
	$contato = null;
}

if($contato != null){
	// Recupera as informações do contato
	$newObj = $jsonObj[$contato];
}else{
	// Cria um novo objeto genérico
	$newObj = new stdClass();

	//navega pelos elementos do array
	for($i=0; $i<$quantidade; $i++){
		$newObj->{"contato{$i}"} = $jsonObj[$i];
	}
}

// Imprime o resultado da consulta em formato JSON
echo json_encode($newObj);

?>