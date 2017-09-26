var data = JSON.parse(document.getElementById('script-view-swf').innerHTML);
var file = data[0];
var width = data[1];
var height = data[2];
var id = data[3];
var el = document.getElementById(id);
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


