<?php
include_once "function/dbConnect.php";
$month = date("m", strtotime("last Saturday"));
$year = date("Y", strtotime("last Saturday"));
$day = date("d", strtotime("last Saturday"));
echo "SELECT * FROM stats WHERE gasStationID = '1' AND MONTH(timestamp) = '$month' AND DAY(timestamp) = '$day' AND YEAR(timestamp) = '$year' ORDER BY timestamp ASC"

?>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#ff0000;}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 643px">
	<colgroup>
		<col style="width: 100px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
		<col style="width: 60px">
	</colgroup>
  <tr>
    <th class="tg-yw4l">\</th>
    <th class="tg-yw4l">1</th>
    <th class="tg-yw4l">2</th>
    <th class="tg-yw4l">3</th>
    <th class="tg-yw4l">4</th>
    <th class="tg-yw4l">5</th>
    <th class="tg-yw4l">6</th>
    <th class="tg-yw4l">7</th>
    <th class="tg-yw4l">8</th>
    <th class="tg-yw4l">9</th>
    <th class="tg-yw4l">10</th>
    <th class="tg-yw4l">11</th>
    <th class="tg-yw4l">12</th>
    <th class="tg-yw4l">13</th>
    <th class="tg-yw4l">14</th>
    <th class="tg-yw4l">15</th>
    <th class="tg-yw4l">16</th>
    <th class="tg-yw4l">17</th>
    <th class="tg-yw4l">18</th>
    <th class="tg-yw4l">19</th>
    <th class="tg-yw4l">20</th>
    <th class="tg-yw4l">21</th>
    <th class="tg-yw4l">22</th>
    <th class="tg-yw4l">23</th>
    <th class="tg-yw4l">24</th>
  </tr>
  <tr>
		<th class="tg-yw4l">Montag</th>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <th class="tg-yw4l">Dienstag</th>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <th class="tg-yw4l">Mittwoch</th>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <th class="tg-yw4l">Donnerstag</th>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <th class="tg-yw4l">Freitag</th>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
	<?php $saturdayData = mysqli_query($conn, "SELECT * FROM stats WHERE gasStationID = '1' AND MONTH(timestamp) = '$month' AND DAY(timestamp) = '$day' AND YEAR(timestamp) = '$year' ORDER BY timestamp ASC;"); ?>
  <tr>
    <th class="tg-yw4l">Samstag</th>
		<?php while($data = mysqli_fetch_array($saturdayData)){ ?>
			<td class="tg-yw4l"><?php echo $data['E5']; ?></td>
		<?php } ?>
  </tr>
  <tr>
    <th class="tg-yw4l">Sonntag</th>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
</table>
