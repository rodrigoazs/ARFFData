<?php
header("Content-Type: text/plain");

include('data.php');

$print_data = array();
foreach($tblocorrencia as $item) {
	$temp = array();
	$temp['mes'] = date('M', strtotime($item['DataColeta']));
	$temp['dia'] = date('D', strtotime($item['DataColeta']));
	$temp['km'] = to_numeric($item['Km']);
	$temp['sentido'] = validate_by_array($item['Sentido'], array('RJ', 'JF'));
	$temp['vegetacaobaixa'] = to_boolean($item['vegetacaoBaixa']);
	$temp['tax'] = to_nominal($tblgrupotaxonom[$animal[$item['codAnimal']]['codGrupoTax']]['nomeGrupoTax']);
	$temp['municipio'] = to_nominal($tblmunicipio[$item['codMunicipio']]['nomeMunicipio']);
	$temp['velocidade'] = to_numeric($item['Velocidade']);
	$temp['registro'] = to_nominal($tbltiporegistro[$item['codTipoRegistro']]['descTipoRegistro']);
	$temp['pavimento'] = to_nominal($tbltipopavimento[$item['codTipoPavimento']]['nomeTipoPavimento']);
	$temp['divisao'] = to_nominal($tbltipodivisaopistas[$item['codTipoDivisaoPistas']]['nomeTipoDivisao']);
	array_push($print_data, $temp);
}


echo relation('animais');
echo month_attribute('mes');
echo day_attribute('dia');
echo numeric_attribute('km');
echo nominal_attribute_array('sentido', array('RJ', 'JF'));
echo boolean_attribute('vegetacaobaixa');
echo nominal_attribute('tax', $tblgrupotaxonom, 'nomeGrupoTax');
echo nominal_attribute('municipio', $tblmunicipio, 'nomeMunicipio');
echo numeric_attribute('velocidade');
echo nominal_attribute('registro', $tbltiporegistro, 'descTipoRegistro');
echo nominal_attribute('pavimento', $tbltipopavimento, 'nomeTipoPavimento');
echo nominal_attribute('divisao', $tbltipodivisaopistas, 'nomeTipoDivisao');
echo print_data($print_data);

?>
