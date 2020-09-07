<?php
if(isset($_POST['submit'])) 
{
	$paytril_coin_AUTH = trim($_POST['paytril_coin_AUTH']);
	$paytril_user_holder = trim($_POST['paytril_user_holder']);
	$paytril_recipient_holder = trim($_POST['paytril_recipient_holder']);
	$coin_name = trim($_POST['coin_name']);
	$pat_sending_amount = trim($_POST['pat_sending_amount']);
	$curr = trim($_POST['curr']);
	$transaction_token = trim($_POST['transaction_token']);
	$description = str_replace(" ","_", $_POST['description']);
	
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
	CURLOPT_URL => "https://paytrill.com/api/paymentapi.php?paytril_coin_AUTH=$paytril_coin_AUTH&paytril_user_holder=$paytril_user_holder&paytril_recipient_holder=$paytril_recipient_holder&coin_name=$coin_name&pat_sending_amount=$pat_sending_amount&currency=$curr&transaction_token=$transaction_token&description=$description",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
  
  echo '<br />';
  echo '<a href="">Continue</a>';
}
?>
<?php
if(!isset($_POST['submit']))
{
?>
  <form action="" method="POST" enctype="multipart/form-data">
          <label for="query">Send Coin:</label><br />
          <input type="hidden" name="paytril_coin_AUTH" value="Hash key of exchanger having base/block on PATHASH" />
		  <input type="text" style="width:300px; height:40px;" name="paytril_user_holder" placeholder="Sender Email Address" /><br />
		  <input type="text" style="width:300px; height:40px;" name="paytril_recipient_holder" placeholder="Recipient Wallet Address" /><br />
		  <select style="width:300px; height:40px;" name="coin_name">
		      <option value="paytrill">Paytrill</option>
		  </select><br />
		  
		  <select style="width:300px; height:40px;" name="curr">
		      <option value="USD">USD</option>
		      <option value="PAT">PAT</option>
		  </select><br />
		  
		  <input type="text" style="width:300px; height:40px;" name="pat_sending_amount" placeholder="Amount to Send in above currency" /><br />
		  
		  
		  <input type="text" style="width:300px; height:40px;" name="transaction_token" placeholder="Enter your transaction token" /><br />
		  <input type="text" style="width:300px; height:40px;" name="description" placeholder="<?php echo 'Paytrill transaction on '; echo date("D M Y"); echo ' at '; echo date("H:ia"); ?>" /><br />
		  <label>Note: Transaction sent are final and irreversible</label><br />
          <input type="submit" style="width:300px; height:40px;" name="submit" value="Make Payment" />
  </form>
<?php
}
?>
