var data = JSON.parse(document.getElementById('script-view-swf').innerHTML);
var file = data[0];
var width = data[1];
var height = data[2];
var id = data[3];
var el = document.getElementById(id);

var flash = '<object type="application/x-shockwave-flash" width="' + data[1] + '" height="' + data[2] + '" data="' + file+ '" ><param name="play" value="true" /><param name="movie" value="' + file+ '" /><param name="wmode" value="direct" /><param name="pluginspage" value="https://www.adobe.com/go/getflashplayer" /><embed type="application/x-shockwave-flash" src="' + file+ '" width="' + data[1] + '" height="' + data[2] + '" wmode="direct" play="true" pluginspage="https://www.adobe.com/go/getflashplayer" /></object>'
var $el = $(el)
el.innerHTML = flash

/*
if (swfobject.hasFlashPlayerVersion("10")) {
    swfobject.embedSWF(file, el, width, height, 10, null, null, {
        'scale': 'default',
        'wmode': 'gpu',
        'browserzoom': 'scale',
        'quality': 'best'
    });
}
else {
    el.style.display = 'block';
}
el.style.color = "white"
*/