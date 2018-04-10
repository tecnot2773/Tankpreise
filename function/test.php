<html><head>
<title>strange bar chart</title>
<link href="../css/generic/table.css" type="text/css" rel="stylesheet" />
</head>
<body>

<?php
include "dbConnect.php";
include_once "printStats.php";

$stats = getStatsSingle(date("d", strtotime("yesterday")), date("m", strtotime("yesterday")), 1);
echo '<table class="chart">';
echo generateBarChart($stats, 150);
echo '</table>';
var_dump($stats);

?>
</body>
</html>
