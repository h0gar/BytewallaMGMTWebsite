<?php
$q = $db->query('SELECT * FROM bundles ORDER BY bundleID DESC');
if(mysql_num_rows($q)==0)
	echo 'No bundle.';
else {
	?><table>
		<thead>
			<tr>
				<th>Bundle ID</th>
				<th>Creation Timestamp</th>
				<th>Creation Seq.</th>
				<th>Source</th>
				<th>Payload</th>
				<th>Delivered</th>
			</tr>
		</thead>
		<tbody>
	<?php
	while($c = mysql_fetch_assoc($q)) {?>
		<tr>
			<td><?php echo $c['bundleID']; ?></td>
			<td><?php echo date('d/m/Y H:i:s', $c['creationTimestampTime']+946681200); ?></td>
			<td><?php echo $c['creationTimestampSeq']; ?></td>
			<td><?php echo $c['source']; ?></td>
			<td><?php echo substr($c['payload'], 0, 40); ?></td>
			<td><?php echo ($c['delivered']>0 ? date('d/m/Y H:i:s', $c['delivered']+946681200):'-'); ?></td>
		</tr>
		<?php
	}
	?>
	</tbody>
		</table>
	<?php
}