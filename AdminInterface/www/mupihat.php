<?php
	$change=0;
	$CHANGE_TXT="<div id='lbinfo'><ul id='lbinfo'>";
	include ('includes/header.php');
	
	if( $change == 1 )
		{
		$json_object = json_encode($data);
		$save_rc = file_put_contents('/tmp/.mupiboxconfig.json', $json_object);
		exec("sudo chmod 755 /etc/mupibox/mupiboxconfig.json");
		exec("sudo mv /tmp/.mupiboxconfig.json /etc/mupibox/mupiboxconfig.json");
		exec("sudo /usr/local/bin/mupibox/./setting_update.sh");
		exec("sudo -i -u dietpi /usr/local/bin/mupibox/./restart_kiosk.sh");
		}
	if( $change == 2 )
		{
		$json_object = json_encode($data);
		$save_rc = file_put_contents('/tmp/.mupiboxconfig.json', $json_object);
		exec("sudo mv /tmp/.mupiboxconfig.json /etc/mupibox/mupiboxconfig.json");
		exec("sudo /usr/local/bin/mupibox/./setting_update.sh");
		}
	if( $change == 3 )
		{
		$json_object = json_encode($data);
		$save_rc = file_put_contents('/tmp/.mupiboxconfig.json', $json_object);
		exec("sudo mv /tmp/.mupiboxconfig.json /etc/mupibox/mupiboxconfig.json");
		$command="sudo su dietpi -c 'pm2 restart spotify-control'";
		exec($command);
		}
	if( $change == 4 )
		{
		$json_object = json_encode($data);
		$save_rc = file_put_contents('/tmp/.mupiboxconfig.json', $json_object);
		exec("sudo mv /tmp/.mupiboxconfig.json /etc/mupibox/mupiboxconfig.json");
		}
	$CHANGE_TXT=$CHANGE_TXT."</ul></div>";
?>


<form class="appnitro" name="mupi" method="post" action="smart.php" id="form">
<div class="description">
<h2>MuPiHAT</h2>
<p>Make your MuPiBox smart...</p>
</div>




 <details>
  <summary><i class="fa-solid fa-circle-info"></i> Status</summary>
    <ul>
   <li id="li_1" >
		<h2>Battery Status</h2>
		<table class="version">
			<tr><td>Charger_Status:</td><td><?php print $mupihat_data["Charger_Status"] ?></td></tr>
			<tr><td>Vbat:</td><td><?php print $mupihat_data["Vbat"] ?></td></tr>
			<tr><td>Vbus:</td><td><?php print $mupihat_data["Vbus"] ?></td></tr>
			<tr><td>Ibat:</td><td><?php print $mupihat_data["Ibat"] ?></td></tr>
			<tr><td>IBus:</td><td><?php print $mupihat_data["IBus"] ?></td></tr>
			<tr><td>Temp:</td><td><?php print $mupihat_data["Temp"] ?></td></tr>
			<tr><td>REG14:</td><td><?php print $mupihat_data["REG14"] ?></td></tr>
			<tr><td>Bat_SOC:</td><td><?php print $mupihat_data["Bat_SOC"] ?></td></tr>
			<tr><td>Bat_Stat:</td><td><?php print $mupihat_data["Bat_Stat"] ?></td></tr>
			<tr><td>Bat_Type:</td><td><?php print $mupihat_data["Bat_Type"] ?></td></tr>
		</table>	
   </li>
  </ul>
 </details>
 <details>
  <summary><i class="fa-solid fa-battery-three-quarters"></i> Configuration</summary>
    <ul>
   <li id="li_1" >

                <h2>Battery selection</h2>
                <p>Choose your battery...</p>
				<div>
				<select id="battery" name="battery" class="element text medium">


				<?php
				$batterys = $data["mupihat"]["battery_types"];
				foreach($batterys as $battery) {
				if( $battery['name'] == $data["mupihat"]["selected_battery"] )
				{
				$selected = " selected=\"selected\"";
				}
				else
				{
				$selected = "";
				}
				print "<option value=\"". $battery['name'] . "\"" . $selected  . ">" . $battery['name'] . "</option>";
				}
				?>
				</select></div>

   </li>
  </ul>
 </details>
</form><p>

<?php
 include ('includes/footer.php');
?>
