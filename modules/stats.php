<?php
function secondsStr($sec) {
	$days = floor($sec/(3600*24));
	$rest = $sec%(3600*24);
	$hours = floor($rest/3600);
	$rest = $rest%3600;
	$minutes = floor($rest/60);
	$rest = $rest%60;
	$seconds = $rest;
	
	return $days.'d'.$hours.'h'.$minutes.'m'.$seconds.'s';
}

function percent($subtotal, $total) {
	return ($subtotal/$total*100).'%';
}

$numberOfBundles = $db->result('SELECT count(*) as result FROM bundles');
$bundlesDelivered = $db->result('SELECT count(*) as result FROM bundles WHERE delivered!=0');
$bundlesUndelivered = $db->result('SELECT count(*) as result FROM bundles WHERE delivered=0');
$averageDelay = $db->result('SELECT AVG(delivered-creationTimestampTime) as result FROM bundles WHERE delivered!=0');
$averageDelay = secondsStr($averageDelay);
$sources = array();
$q = $db->query('SELECT source, count(*) as occs FROM bundles GROUP BY source ORDER BY occs DESC');
#$q = $db->query('SELECT * from bundles');
for($i=0; ($c=mysql_fetch_assoc($q)) && $i<5; $i++)
	$sources[] = array($c['source'], $c['occs']);
?>
				<div class="grid_5">
					<div class="box">
						<h2>Overall</h2>
						<table>
							<tbody>
								<tr>
									<td>Number of Bundles</td>
									<td><?php echo $numberOfBundles; ?></td>
								</tr>
								<tr>
									<td>Bundles Delivered</td>
									<td><?php echo $bundlesDelivered.' ('.percent($bundlesDelivered, $numberOfBundles).')'; ?></td>
								</tr>
								<tr>
									<td>Bundles Undelivered</td>
									<td><?php echo $bundlesUndelivered.' ('.percent($bundlesUndelivered, $numberOfBundles).')'; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="box">
						<h2>Delay</h2>
						<table>
							<tbody>
								<tr>
									<td>Average delay</td>
									<td><?php echo $averageDelay; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="box">
						<h2>Sources</h2>
						<table>
							<?php foreach($sources as $k=>$v) {?>
							<tbody>
								<tr>
									<td><?php echo $v[0]; ?></td>
									<td><?php echo $v[1]; ?></td>
								</tr>
							</tbody>
							<?php } ?>
						</table>
					</div>
				</div>