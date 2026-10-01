function popupVideo(p){
	
	let video = document.getElementById('video');
	
	if(p>0){
		document.getElementById('malhaPopup').style.display='flex';
		document.getElementById('videoPopup').style.display='block';
	}
	else{
		document.getElementById('malhaPopup').style.display='none';
		document.getElementById('videoPopup').style.display='none';
		video.pause();
		video.currentTime = 0;
	}
	
}


