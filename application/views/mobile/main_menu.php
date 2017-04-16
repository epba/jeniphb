    <?php
    $uri= $this->uri->segment(2);
    if ($uri == 'bars') {
    	$a = 'ui-btn-active';
    	$b ='';
    	$c ='';
    } elseif ($uri == 'loker') {
    	$b = 'ui-btn-active';
    	$a ='';
    	$c ='';
    } elseif ($uri == null) {
    	$c = 'ui-btn-active';
    	$a ='';
    	$b ='';
    }
    

    ?>

<div data-role="header" data-theme="b">
    <div data-role="navbar" class="navbar" data-grid="c">
    	<ul>
    		<li><a data-theme="b" class="<?=$b?>" href="<?php echo base_url('mob_tampil/loker') ;?>">News</a></li>
    		<li><a data-theme="b" class="<?=$c?>" href="<?php echo base_url('mob_tampil') ;?>" >Feeds</a></li>
    		<li><a href="<?php echo base_url('mob_tampil/chat') ;?>" data-theme="b" data-ajax="false">Chat</a></li>
    		<li><a data-theme="b" class="<?=$a?>" href="<?php echo base_url('mob_tampil/bars') ;?>"><i class="fa fa-bars fa-1x"></i></a></li>
    	</ul>
    </div>
    </div>
    <div data-role="content" class="ui-content">
	<?php echo $this->session->flashdata("k");?>