var g_starindex=0;
var g_clicked = 0;

function starover(curStar)
{
    var curStarIndex = curStar.id.substring(4);

    var defaultSrc;
    if (g_clicked)
	    defaultSrc = "star_reg.gif";
    else
	    defaultSrc = "star_off.gif";

    if (g_starindex == curStarIndex)
	    return;
    else if (g_starindex > curStarIndex)
    {
	  for (var j=parseInt(curStarIndex)+1;j<=g_starindex;j++)
  	        document.getElementById("star" + j).src = defaultSrc;
    }
    else
    {
	    for (var j=parseInt(g_starindex)+1;j<=curStarIndex;j++)
  	        document.getElementById("star" + j).src = "star_hover.gif";
    }

    g_starindex = curStarIndex;
}


function starsout()
{
    for (var j=1;j<=g_starindex;j++)
    {
 	if (g_clicked && j<=g_clicked)
  		document.getElementById("star" + j).src = "star_reg.gif";
  	else
  		document.getElementById("star" + j).src = "star_off.gif";
    }

    g_starindex = 0;
}

function starclick(curStar)
{
    var curStarIndex = curStar.id.substring(4);
    for (var j=1;j<=curStarIndex;j++)
        document.getElementById("star" + j).src = "star_reg.gif";

    if (g_clicked && g_clicked > curStarIndex)
    {
    	for (var j=parseInt(curStarIndex)+1;j<=g_clicked;j++)
            document.getElementById("star" + j).src = "star_off.gif";
    }
   
    g_clicked = curStarIndex;
    g_starindex = 0;

    rate();
}
	
