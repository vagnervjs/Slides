<?php
  $S1 = $_POST["str1"];
  $S2 = $_POST["str2"];
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
    <form action="lcs.php" method="POST">
      <p>Texto 1:</p>
      <textarea cols=200 rows=10 name="str1"><?php echo $S1; ?></textarea></br>
      <div id="txt2">
        <p>Texto 2:</p>
        <textarea cols=200 rows=10 name="str2"><?php echo $S2; ?></textarea></br>
      </div>
      <input type="submit" value="Calcular LCS" class="btn btn-primary"></br></br>
    </form>
  </div>
</body>
</html>

<?php
function string_lcs($S1, $S2) {
  $m = strlen($S1);
  $n = strlen($S2);

  $A = array();
  for ($i = $m-1; $i >= 0; $i--) {
    for ($j = $n-1; $j >= 0; $j--) {
      if ($S1[$i] == $S2[$j])
        $A[$i][$j] = $A[$i+1][$j+1] + 1;
      else 
        $A[$i][$j] = max($A[$i+1][$j], $A[$i][$j+1]);
    }
  }

  $i = 0;
  $j = 0;
  $LCS = "";
  while($i < $m && $j < $n) {
    if ($S1[$i] == $S2[$j]) {
      $LCS .= $S1[$i];
      $i++;
      $j++;
    } elseif ($A[$i+1][$j] >= $A[$i][$j+1]) 
      $i++;
    else                                 
      $j++;
  } 
  return $LCS;
}

  $subsequence = string_lcs($S1, $S2);

  if ($subsequence != "") {
    echo "<div id=result><hr>";
    echo "Subsequência encontrada: <span>" . $subsequence . "</span></br>";
    echo "Comprimento: <span>" . strlen($subsequence) . "</span>";
    echo "</div>";
  }
?>