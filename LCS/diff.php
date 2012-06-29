<?php

$principal = $_POST['file1'];
$secundario = $_POST['file2'];

/*
Algoritmo Simple Diff desenvolvido por Paul's Algorithm v 0.1 
adaptado em PHP.
*/

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/lcs.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="all">
		<form method="POST" action="diff.php">
			<p>Texto 1:</p>
			<textarea cols=200 rows=10 name="file1"><?php echo $principal; ?></textarea></br>
			<div id="txt2">
				<p>Texto 2:</p>
				<textarea cols=200 rows=10 name="file2"><?php echo $secundario; ?></textarea></br>
			</div>
			<input type="submit" class="btn btn-primary"  value="Executar Diff" ></br></br>
		</form>
	</div>
</body>
</html>

<?php 
function diff($old, $new){
	foreach($old as $oindex => $ovalue){
		$nkeys = array_keys($new, $ovalue);
		foreach($nkeys as $nindex){
			$matrix[$oindex][$nindex] = isset($matrix[$oindex - 1][$nindex - 1]) ?
			$matrix[$oindex - 1][$nindex - 1] + 1 : 1;
			if($matrix[$oindex][$nindex] > $maxlen){
				$maxlen = $matrix[$oindex][$nindex];
				$omax = $oindex + 1 - $maxlen;
				$nmax = $nindex + 1 - $maxlen;
			}
		}
	}
	if($maxlen == 0) return array(array('d'=>$old, 'i'=>$new));
		return array_merge(
						diff(array_slice($old, 0, $omax), array_slice($new, 0, $nmax)),
						array_slice($new, $nmax, $maxlen),
						diff(array_slice($old, $omax + $maxlen), array_slice($new, $nmax + $maxlen)));
}

function htmlDiff($old, $new){
	$diff = diff(explode(' ', $old), explode(' ', $new));
	foreach($diff as $k){
		if(is_array($k))
			$ret .= (!empty($k['d'])?"<del style='color: red; font-size: 22px;'>".implode(' ',$k['d'])."</del> ":'').
			(!empty($k['i'])?"<ins  style='color: green; font-size: 22px;'>".implode(' ',$k['i'])."</ins> ":'');
		else $ret .= $k . ' ';
	}
	return $ret;
}

$resposta = htmlDiff($principal , $secundario);

echo "<div id=result><hr>";
echo $resposta;
echo "<hr>";
echo "<span style='font-size: 13px; color: #696969;'>* itens em vermelho são a diferença entre as duas entradas. </span></div>"
?>
