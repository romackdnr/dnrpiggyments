var theImages = new Array() 
var theValue = new Array() 

theImages[0] = '_assets/captcha/captcha1.gif'
theImages[1] = '_assets/captcha/captcha2.gif'
theImages[2] = '_assets/captcha/captcha3.gif'
theImages[3] = '_assets/captcha/captcha4.gif'
theImages[4] = '_assets/captcha/captcha5.gif'
theImages[5] = '_assets/captcha/captcha6.gif'
theImages[6] = '_assets/captcha/captcha7.gif'
theImages[7] = '_assets/captcha/captcha8.gif'
theImages[8] = '_assets/captcha/captcha9.gif'

theValue[0] = 'dog';
theValue[1] = 'and';
theValue[2] = 'rooster';
theValue[3] = 'company';
theValue[4] = 'web';
theValue[5] = 'dev';
theValue[6] = 'services';
theValue[7] = 'seo';
theValue[8] = 'marketing';

var j = 0
var p = theImages.length;
var preBuffer = new Array()
for (i = 0; i < p; i++){
	preBuffer[i] = new Image()
	preBuffer[i].src = theImages[i]
}
var whichImage = Math.round(Math.random()*(p-1));
function showImage(){
	document.write('<img src="'+theImages[whichImage]+'">');
	document.getElementById('security').value= theValue[whichImage];
}
