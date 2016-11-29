<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	//Debug SQL
	$this->output->enable_profiler(TRUE);
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8">
    
	<base href="<?php echo site_url(); ?>" />
	<?php
	$siteSconfig = $this->config->item('site');
	foreach ($siteSconfig['stylesheets'] as $media => $files) {
		foreach ($files as $file)
		{
			$url = starts_with($file, 'http') ? $file : base_url($file);
			echo "<link href='$url' rel='stylesheet' media='$media'>".PHP_EOL;	
		}
	}
	if($siteSconfig['scripts']['foot']){
		foreach ($siteSconfig['scripts']['head'] as $file)
		{
			$url = starts_with($file, 'http') ? $file : base_url($file);
			echo "<script src='$url'></script>".PHP_EOL;
		}
				
	}
	?>
	<title><?php echo $siteSconfig['title']; ?></title>
	<script type="text/javascript">
        var LT_ROOT_URL = '//chivi.vn';
        var MODULE_ROOT_URL = '//chivi.vn';
    </script>
  </head>
  <body class="skin-red">
    <div class="wrapper">
      