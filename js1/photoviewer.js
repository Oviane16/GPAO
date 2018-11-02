function showThumbnail(photoname, categoryName, addToHistory)
{
    //var photoname = photo;
    var thumbnail = document.getElementById("thumbnail");
    thumbnail.innerHTML = "";

    var fullhref = "Pix/" + categoryName + "/" + photoname;
    var a = document.createElement("a");
    a.href="#";
    a.onclick = function(){return createDialog(fullhref, photoname, categoryName, true);};
    a.className = "thumbnailLink";

    var image = document.createElement("img");
    image.src = "http://ajaxref.com/ch8/thumbnail.php?file=" + fullhref;
    image.border = "0";
    image.className = "thumbnailImage";
    image.alt = "Turn on images to view Lightbox Example";
    image.title = "Click me to see Lightbox";

    a.appendChild(image);
    thumbnail.appendChild(a);

    return false;
}

function removeFiles()
{
    var fileList = document.getElementById("fileList");
    fileList.innerHTML = "";
}

function removeThumbnail()
{
    var thumbnail = document.getElementById("thumbnail");
    thumbnail.innerHTML = "";
}