<?php
	function pr($d){echo '<pre>'.print_r($d,1).'</pre>';}
	function prd($d){die('<pre>'.print_r($d,1).'</pre>');}
	
	$sourceUrl = false;

	if(isset($_POST['submitted'])){
		
		$url = $_POST['url'];
		/*$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$output = curl_exec($ch);*/
		$output = get_headers($url);
		if(is_array($output)){
			// Get location header
			foreach($output as $k => $header){
				if(strpos($header,'Location: ') > -1){
					$location = 'Location: ';
					$sourceUrl = substr($header,strlen($location));
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8" />
	<title>Get source url</title>
	<link href='http://fonts.googleapis.com/css?family=Francois+One' rel='stylesheet' type='text/css'>
	<link type="text/css" href="styles.css" rel="stylesheet" />
</head>
<body>
	<header id="header">
		<h1>Urls Rancias</h1>
	</header>
	<div id="wrap">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<input name="url" id="url" placeholder="Coloca tu url rancia..." />
			<input type="submit" value="send>>" />
			<input type="hidden" name="submitted" value="1" />
		</form>
		<?php if($sourceUrl){ ?>
			<article id="response">
				<span><?php echo $sourceUrl; ?></span>
			</article>
		<?php } ?>	
	</div>
</body>
</html>