
<?php $this->load->view('_base/head'); ?>
<?php //$this->load->view('_base/menu'); ?>
<?php $this->load->helper('buildMenu_helper');
	buildMenu();
?>
<!--<div id="content">
    <main class="main" role="main">
        <div class="row main-row">-->
			<?php $this->load->view(isset($template)?$template:NULL, isset($data)?$data:NULL);?>
		<!--</div>
	</main>
</div>-->
<?php $this->load->view('_base/footer'); ?>