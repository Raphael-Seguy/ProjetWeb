<?php
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="bootstrap-css/bootstrap.min.css"><!--classe déjà faite-->
	<link rel="stylesheet" type="text/css" href="bootstrap-css/Home.css">
	<title>Home</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.0.1/css/ol.css" type="text/css">
	<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.0.1/build/ol.js"></script>
</head>
<body>
	<style type="text/css">
	body{
		width: 100%;
	}
	.Zemap{
		height: 500px;
		top:-44px;
	}
	.Zemap canvas{
		left: 0px;
     }
    #myBtn{
    	position: sticky;
    	left:150%;
    	top:50%;
    	margin:0;
    	transform: rotate(-90deg)translateY(65px);
    	transform-origin: left top 0;
    	padding: 0px;
    }
    #myBtn:hover{
    	-webkit-animation: fadeInOut 1s linear forwards infinite;
    	animation-name: fadeInOut 1s linear forwards infinite;
    }
	#myModal{
		top:10%;
		height: 75%;
	}
	/* Modal Header */
	.modal-header {
		padding: 2px 16px;
		background-color: #5cb85c;
		color: white;
	}

	/* Modal Body */
	.modal-body {padding: 2px 16px;}

	/* Modal Footer */
	.modal-footer {
		padding: 2px 16px;
		background-color: #5cb85c;
		color: white;
	}
	.close{
		padding:0px;
		width:28px;
		margin: 8px 0px 8px 95%;
		border: solid;
	}
	/* Modal Content */
	.modal-content {
		height: 100%;
		position: relative;
		background-color: #fefefe;
		margin: auto;
		padding: 0;
		border: 1px solid #888;
		width: 65%;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
		animation-name: modalentry;
		animation-duration: 1s
	}

	/* Add Animation */
	@keyframes modalentry {
		from {right: -1000px; opacity: 0}
		to {right: 0px; opacity: 1}
	}
	@-webkit-keyframes fadeinout {
	  0%,100% { opacity: 0; }
	  50% { opacity: 1; }
	}
	@keyframes fadeInOut {
   		0%,100% { opacity: 1; }
        50% { opacity: 0; }
	}
	</style>
	<div class="text-center">
		<div class="container square" style="width: 33%">
		
		</div>
		<button id="myBtn">Open Modal</button>
	</div>
	<!-- Trigger/Open The Modal -->

	<!-- The Modal -->
	<div id="myModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
	    <p class="close rounded-circle">&times;</p>
	    <div id="Zemap" class="Zemap"></div>
	  </div>

	</div>
	<script type="text/javascript">
	var map = new ol.Map({
        target: 'Zemap',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          })
        ],
        view: new ol.View({
          center: ol.proj.fromLonLat([2.28512942790985, 48.8795093545962]),
          zoom: 9
        })

	});
	const sleep = (milliseconds) => {
  		return new Promise(resolve => setTimeout(resolve, milliseconds))
	}

	// Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal
	btn.onclick = function() {
	  modal.style.display = "block";
	  layer.redraw({ force: true });
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	  btn.style.opacity = 1;
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	    btn.style.display = "block";
	  }
	}
	
	</script>
</body>

</html>
