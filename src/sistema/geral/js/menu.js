
var timeout	= 15000;
var closetimer	= 0;
var ddmenuitem	= 0;
var subsub	= 0;

// open hidden layer
function mopen(id)
{
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.display = 'none';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.display='block';
	//ddmenuitem.style.backgroundColor = "#7589B7";
	
}
function mopensub(id)
{
	// cancel close timer
	mcancelclosetime();
	if(subsub) subsub.style.display = 'none';
	// get new layer and show it
	subsub = document.getElementById(id);
	subsub.style.display='block';
	//subsub.style.left='300px';
	//ddmenuitem.style.backgroundColor = "#7589B7";
	
}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.display = 'none';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose;