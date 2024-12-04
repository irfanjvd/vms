<video id="video" width="485" height="275" autoplay style=""></video>

<canvas id="canvas" width="485" height="275" style="display: none;"></canvas>
<button type="button" id="take_image"  name="take_image" > Take Photo </button>
<script>
//Put event listeners into place
$(document).ready(function() {

	/*var canvas = document.getElementById("canvas"),
		context = canvas.getContext("2d"),
		video = document.getElementById("video"),
		videoObj = { "video": true },
		errBack = function(error) {
			console.log("Video capture error: ", error.code); 
		};

	// Put video listeners into place
	if(navigator.getUserMedia) { // Standard
		navigator.getUserMedia(videoObj, function(stream) {
			video.src = stream;
			video.play();
		}, errBack);
	} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
		navigator.webkitGetUserMedia(videoObj, function(stream){
			video.src = window.webkitURL.createObjectURL(stream);
			video.play();
		}, errBack);
	}
	else if(navigator.mozGetUserMedia) { // Firefox-prefixed
		navigator.mozGetUserMedia(videoObj, function(stream){
			video.src = window.URL.createObjectURL(stream);
			video.play();
		}, errBack);
	}*/
	
	navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);

    navigator.getMedia(
        // constraints
        {video:true, audio:false},

        // success callback
        function (mediaStream) {
            var video = document.getElementsByTagName('video')[0];
            //video.src = window.URL.createObjectURL(mediaStream);
			video.srcObject=mediaStream;
            video.play();
        },   
        //handle error
        function (error) {
            console.log(error);
        })


  $('#take_image').click(function(){
      

	var canvas1 = document.getElementById('canvas');
	var context1 = canvas1.getContext("2d");
	context1.drawImage(video, 0, 0, 485, 275);
	var image = new Image();
	image.src = canvas1.toDataURL("image/png;base64");

	$('#img_visitor').attr('src',image.src);
	$('#visitor_picture').val(image.src);
        $.colorbox.close();
	
    })
});
</script>