<html>
<head>
	<meta charset='utf-8'>
	<title>Crop Image</title>

	<!-- <script type="text/javascript" src="<?php echo base_url() . 'js/jquery/jquery.js'  ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'js/jquery/jcrop/jquery.Jcrop.pack.js' ?>"></script>
	<link rel="stylesheet" href="<?php echo base_url() . 'js/jquery/jcrop/jquery.Jcrop.css' ?>" type="text/css" /> -->

	<link rel='stylesheet' type='text/css' href='<?php echo base_url('assets/jquery_crop/css/jquery.Jcrop.css')?>' />
	<script type="text/javascript" src="<?php echo base_url('assets/jquery_crop/js/jquery.Jcrop.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jquery_crop/js/jqueryJcrop.min.js')?>"></script>

	<script language="Javascript">

		$(function(){
			var jcrop_api;

			$('#cropbox').Jcrop({
				aspectRatio: 1,
				onSelect: updateCoords,
				setSelect: [ 0, 0, 15, 15 ]
			},function(){
				jcrop_api = this;
			});

			jcrop_api.setOptions({
				bgFade: true,
				bgOpacity: 0.4
			});
		});

		function updateCoords(c)
		{
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#w').val(c.w);
			$('#h').val(c.h);
		};

		function checkCoords()
		{
			if (parseInt($('#w').val())) return true;
			alert('Please select a crop region then press submit.');
			return false;
		};

	</script>

</head>

<body>

	<div id="outer">
		<div class="jcExample">
			<div class="article">

				<h1>Jcrop - Crop Behavior</h1>

				<!-- This is the image we're attaching Jcrop to -->
				<img src="<?php echo base_url(); ?>assets/upload/alumni/noval.jpg" id="cropbox" />

				<!-- This is the form that our event handler fills -->
				<form action="<?php echo base_url(); ?>upload/do_crop" method="post" onsubmit="return checkCoords();">
					<input type="" id="x" name="x" />
					<input type="" id="y" name="y" />
					<input type="" id="w" name="w" />
					<input type="" id="h" name="h" />
					<input type="submit" value="Crop Image" />
				</form>

				<p>
					<b>An example server-side crop script.</b> Hidden form values
					are set when a selection is made. If you press the <i>Crop Image</i>
					button, the form will be submitted and a 150x150 thumbnail will be
					dumped to the browser. Try it!
				</p>

				<!-- <div id="dl_links">
					<a href="http://deepliquid.com/content/Jcrop.html">Jcrop Home</a> |
					<a href="http://deepliquid.com/content/Jcrop_Manual.html">Manual (Docs)</a>
				</div> -->
			</div>
		</div>
	</div>
</body>

</html>