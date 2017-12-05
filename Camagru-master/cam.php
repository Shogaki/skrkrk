<?php 

require_once("config/isConnected.php");

?>

<html>
	<head>
		<title>Cam</title>
		<link rel="stylesheet" type="text/css" href="resources/css/nikleskeuf.css">
	</head>

	<body style="text-align:center;">

		<?php include('inc/header.php') ?>

		<?php if (isset($_GET['err'])) { ?>
		<div style="padding:5px;border:1px solid red;color: red !important;font-weight: bold;text-align:center;width:100%;margin:10px;background:white;">

			<?php if ($_GET['err'] == 1) { ?>
				Vous n'avez pas envoyer d'image.
			<?php } ?>

		</div>
		<?php } ?>

<form method="POST" action="make_img.php" enctype="multipart/form-data">
		<h2><strong>1ER ETAPE:</strong> Choisir un overlay:</h2>
		<div style="border:1px solid white;padding:10px;margin-left:10px;margin-right:10px;">
			<label for="overlay1">
				<img class="img-select-back" src="resources/img/coco.png" style="max-width: 10%;">
  				<input type="radio" name="overlay" value="coco.png" id="overlay1" style="display:none;" required>
			</label>
			<label for="overlay2">
				<img class="img-select-back" src="resources/img/0000.png" style="max-width: 10%;">
				<input type="radio" name="overlay" value="0000.png" id="overlay2" style="display:none;" required>
			</label>
			<label for="overlay3">
				<img class="img-select-back"  src="resources/img/antifa.png" style="max-width: 10%;">
				<input type="radio" name="overlay" value="antifa.png" id="overlay3" style="display:none;" required>
			</label>
			<label for="overlay4">
				<img class="img-select-back"  src="resources/img/stln.png" style="max-width: 10%;">
				<input type="radio" name="overlay" value="stln.png" id="overlay4" style="display:none;" required>
			</label>
			<label for="overlay5">
				<img class="img-select-back"  src="resources/img/moloo.png" style="max-width: 10%;">
				<input type="radio" name="overlay" value="moloo.png" id="overlay5" style="display:none;" required>
			</label>
		</div>

		<h2><strong>2ND ETAPE:</strong> Selectionnez une photo</h2>
		<div style="padding:0;">
			<div style="float:left;width:45%;min-height:100px;">
				<h3>UTILISEZ VOTRE WEBCAM</h3>
				<div style="border:1px solid white;margin:20px;padding:20px;">
					<div id="overlay" style="margin:0px;padding:0px;">
						<video id="video" style="width:100%;margin:0px;"></video>
						<canvas style="display:none" id="canvas"></canvas>
						<button id="startbutton" style="margin-top:10px;" disabled="true" type="button">Prendre une photo</button>
						<script src="resources/js/recupimg.js"></script>
						<img id="test" src="" style="z-index: 9999;float:left;position:relative;margin-top:-120px;margin-left:40;max-width:100px;">
					</div>
					<input type="hidden" value="" name="str" id="photo">
				</div>
			</div>
			<div style="float:left;width:10%;min-height:100px;">
				<h3>OU</h3>
			</div>
			<div style="float:right;width:45%;min-height:100px;">
				<h3>SELECTIONNEZ UNE PHOTO</h3>
				<input type="file" name="image" id="imgUpload" disabled>
				<div style="padding:30px;">
					<img id="imgUploaded" src="" style="max-width:100%;">
				</div>
				<hr>

			</div>
		</div>
		<button type="submit" style="padding:5px;font-size:14px;background:red;color:white;display:block;">
			Génerer votre image
		</button>
</form>



		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
		<script type="text/javascript">

			$('.img-select-back').click(function(e){
				$('.img-select-back.active').removeClass('active');
				$(this).addClass('active');
				$('#startbutton').attr('disabled', false);
				$('#imgUpload').attr('disabled', false);
			});


	        $("#imgUpload").change(function(){
	            readURL(this, $('#imgUploaded'));
	        });

		</script>
	</body>
</html>