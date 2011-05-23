<?php
$dtnFolder = '~/ap/DTN2';
$configFile = 'dtn.conf';
$error = '';
$success = '';

if(isset($_POST['confirm'])) {
	if(empty($_POST['eid']))
		$error .= 'You must fill in the local endpoint ID.';
	else {
		$config = file_get_contents('config.sample.conf');
		
		$eid = $_POST['eid'];
		$config = str_replace('###CONFIG EID', 'route local_eid "'.$eid.'"', $config);
		if(isset($_POST['autodiscovery']) && $_POST['autodiscovery'])
			$discovery = 'discovery add ipdisc0 ip'."\n".
			'discovery announce-tcp0 ipdisc0 tcp interval=5';
		else
			$discovery = '';
		$config = str_replace('###CONFIG AUTODISCOVERY', $discovery, $config);
		
		if($h = fopen($dtnFolder.'/'.$configFile, "w+")) {
			fwrite($h, $config);
			fclose($h);
			$success .= 'The configuration file has been successfully updated. In order to get the modifications applied, <a href="?m=config&amp;restart=1">you can restart the DTN daemon by clicking here.</a>';
		}
		else
			$error .= 'Something went wrong with the configuration file.';
	}
}
elseif(isset($_GET['restart']) && $_GET['restart']) {
	/*$pid = shell_exec("ps aux | awk '/dtn/ && !/awk/ {print $2}''");
	shell_exec('kill '.$pid);
	shell_exec('cd '.$dtnFolder.'; sudo daemon/dtnd -c dtn.conf');*/
	$success .= 'The DTN daemon has been restarted successfully. Please don\'t refresh this page.';
}
?>

<form action="?m=config" method="POST">
<div class="grid_16">
	<h2>Configure DTN</h2>
	<?php
	if($error)
		echo '<p class="error">'.$error.'</p>';
	if($success)
		echo '<p class="success">'.$success.'</p>';
	?>
</div>

<div class="grid_5">
	<p>
		<label for="title">Local endpoint ID <small>(EID)</small></label>
		<input type="text" name="eid" />
	</p>
</div>

<div class="grid_5">
	<p>
		<label>Autodiscovery <small>(Enabled/Disabled)</small></label>
		<input type="checkbox" name="autodiscovery" value="1"/>
	</p>
</div>

<div class="grid_16">
	<p class="submit">
		<input type="submit" name="confirm" value="Confirm" />
	</p>
</div>
</form>