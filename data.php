<?php


include('animais.php');

$animal = array_by_id($animal, 'codAnimal');
$tbldestinacaoanimal = array_by_id($tbldestinacaoanimal, 'codDestinacaoAnimal');
$tblgrupotaxonom = array_by_id($tblgrupotaxonom, 'codGrupoTax');
$tblmunicipio = array_by_id($tblmunicipio, 'codMunicipio');
$tblsexo = array_by_id($tblsexo, 'codSexo');
$tblsituacaoanimal = array_by_id($tblsituacaoanimal, 'codSituacaoAnimal');
$tbltipochuva = array_by_id($tbltipochuva, 'codTipoChuva');
$tbltipodivisaopistas = array_by_id($tbltipodivisaopistas, 'codTipoDivisao');
$tbltipolocal = array_by_id($tbltipolocal, 'codTipoLocal');
$tbltipopavimento = array_by_id($tbltipopavimento, 'codTipoPavimento');
$tbltiporegistro = array_by_id($tbltiporegistro, 'codTipoRegistro');
$tblvalorbiologico = array_by_id($tblvalorbiologico, 'codValorBiologico');

// funcao para hash das arrays
function array_by_id($data, $cell)
{
	$temp = array();
	foreach($data as $item){
		$temp[$item[$cell]] = $item;
	}
	return $temp;
}

function to_boolean($data)
{
	if($data == 1)
		return 'sim';
	else if($data == 0)
		return 'nao';
	else {
		return '?';
	}
}

function to_numeric($data)
{
	$data = floatval(str_replace(',', '.', str_replace('.', '', $data)));
	if($data == '') return '?';
	else return $data;
}

function validate($data)
{
	if($data == '') return '?';
	else return $data;
}

function validate_by_array($data, $array)
{
	foreach($array as $item)
	{
		if($data == $item)
			return $data;
	}
	return '?';
}

function relation($name)
{
	return "@RELATION ".$name."\n";
}

function numeric_attribute($name)
{
	return "@ATTRIBUTE ".$name." NUMERIC\n";
}

function month_attribute($name)
{
	$temp = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
	return "@ATTRIBUTE ".$name." {".implode(',', $temp)."}\n";
}

function day_attribute($name)
{
	$temp = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
	return "@ATTRIBUTE ".$name." {".implode(',', $temp)."}\n";
}

function boolean_attribute($name)
{
	$temp = array('sim', 'nao');
	return "@ATTRIBUTE ".$name." {".implode(',', $temp)."}\n";
}


function nominal_attribute($name, $table, $column)
{
	$temp = array();
	foreach($table as $item)
	{
		array_push($temp, to_nominal($item[$column]));
	}
	return "@ATTRIBUTE ".$name." {".implode(',', $temp)."}\n";
}

function nominal_attribute_array($name, $array)
{
	return "@ATTRIBUTE ".$name." {".implode(',', $array)."}\n";
}

function print_data($data)
{
	$str = "@DATA\n";
	foreach($data as $item)
	{
		$str .= implode(',', $item)."\n";
	}
	return $str;
}

function to_nominal($str) {
		$str = removeAccents($str);
		if(substr_count($str, ' '))
		{
			return '"'.$str.'"';
		}else{
			return $str;
		}
}

function removeAccents($str)
{
    static $map = [
        // single letters
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'ą' => 'a',
        'å' => 'a',
        'ā' => 'a',
        'ă' => 'a',
        'ǎ' => 'a',
        'ǻ' => 'a',
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'A',
        'Ą' => 'A',
        'Å' => 'A',
        'Ā' => 'A',
        'Ă' => 'A',
        'Ǎ' => 'A',
        'Ǻ' => 'A',


        'ç' => 'c',
        'ć' => 'c',
        'ĉ' => 'c',
        'ċ' => 'c',
        'č' => 'c',
        'Ç' => 'C',
        'Ć' => 'C',
        'Ĉ' => 'C',
        'Ċ' => 'C',
        'Č' => 'C',

        'ď' => 'd',
        'đ' => 'd',
        'Ð' => 'D',
        'Ď' => 'D',
        'Đ' => 'D',


        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ę' => 'e',
        'ē' => 'e',
        'ĕ' => 'e',
        'ė' => 'e',
        'ě' => 'e',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ę' => 'E',
        'Ē' => 'E',
        'Ĕ' => 'E',
        'Ė' => 'E',
        'Ě' => 'E',

        'ƒ' => 'f',


        'ĝ' => 'g',
        'ğ' => 'g',
        'ġ' => 'g',
        'ģ' => 'g',
        'Ĝ' => 'G',
        'Ğ' => 'G',
        'Ġ' => 'G',
        'Ģ' => 'G',


        'ĥ' => 'h',
        'ħ' => 'h',
        'Ĥ' => 'H',
        'Ħ' => 'H',

        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ĩ' => 'i',
        'ī' => 'i',
        'ĭ' => 'i',
        'į' => 'i',
        'ſ' => 'i',
        'ǐ' => 'i',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ĩ' => 'I',
        'Ī' => 'I',
        'Ĭ' => 'I',
        'Į' => 'I',
        'İ' => 'I',
        'Ǐ' => 'I',

        'ĵ' => 'j',
        'Ĵ' => 'J',

        'ķ' => 'k',
        'Ķ' => 'K',


        'ł' => 'l',
        'ĺ' => 'l',
        'ļ' => 'l',
        'ľ' => 'l',
        'ŀ' => 'l',
        'Ł' => 'L',
        'Ĺ' => 'L',
        'Ļ' => 'L',
        'Ľ' => 'L',
        'Ŀ' => 'L',


        'ñ' => 'n',
        'ń' => 'n',
        'ņ' => 'n',
        'ň' => 'n',
        'ŉ' => 'n',
        'Ñ' => 'N',
        'Ń' => 'N',
        'Ņ' => 'N',
        'Ň' => 'N',

        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ð' => 'o',
        'ø' => 'o',
        'ō' => 'o',
        'ŏ' => 'o',
        'ő' => 'o',
        'ơ' => 'o',
        'ǒ' => 'o',
        'ǿ' => 'o',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'O',
        'Ø' => 'O',
        'Ō' => 'O',
        'Ŏ' => 'O',
        'Ő' => 'O',
        'Ơ' => 'O',
        'Ǒ' => 'O',
        'Ǿ' => 'O',


        'ŕ' => 'r',
        'ŗ' => 'r',
        'ř' => 'r',
        'Ŕ' => 'R',
        'Ŗ' => 'R',
        'Ř' => 'R',


        'ś' => 's',
        'š' => 's',
        'ŝ' => 's',
        'ş' => 's',
        'Ś' => 'S',
        'Š' => 'S',
        'Ŝ' => 'S',
        'Ş' => 'S',

        'ţ' => 't',
        'ť' => 't',
        'ŧ' => 't',
        'Ţ' => 'T',
        'Ť' => 'T',
        'Ŧ' => 'T',


        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ü' => 'u',
        'ũ' => 'u',
        'ū' => 'u',
        'ŭ' => 'u',
        'ů' => 'u',
        'ű' => 'u',
        'ų' => 'u',
        'ư' => 'u',
        'ǔ' => 'u',
        'ǖ' => 'u',
        'ǘ' => 'u',
        'ǚ' => 'u',
        'ǜ' => 'u',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ũ' => 'U',
        'Ū' => 'U',
        'Ŭ' => 'U',
        'Ů' => 'U',
        'Ű' => 'U',
        'Ų' => 'U',
        'Ư' => 'U',
        'Ǔ' => 'U',
        'Ǖ' => 'U',
        'Ǘ' => 'U',
        'Ǚ' => 'U',
        'Ǜ' => 'U',


        'ŵ' => 'w',
        'Ŵ' => 'W',

        'ý' => 'y',
        'ÿ' => 'y',
        'ŷ' => 'y',
        'Ý' => 'Y',
        'Ÿ' => 'Y',
        'Ŷ' => 'Y',

        'ż' => 'z',
        'ź' => 'z',
        'ž' => 'z',
        'Ż' => 'Z',
        'Ź' => 'Z',
        'Ž' => 'Z',


        // accentuated ligatures
        'Ǽ' => 'A',
        'ǽ' => 'a',
    ];
    return strtr($str, $map);
}

?>
