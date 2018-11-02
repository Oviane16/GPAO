function showThumbnail(photoName, categoryName, addToHistory)
{
    //var photoName = photo;
    var thumbnail = document.getElementById("thumbnail");
    thumbnail.innerHTML = "";

    var fullhref = "Pix/" + categoryName + "/" + photoName;
    var a = document.createElement("a");
    a.href="#";
    a.onclick = function(){return createDialog("/ch8/" + fullhref, photoName, categoryName, true);};
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

function updateState(thumbnail, category)
{
    if (!thumbnail || !category)
    {
        removeThumbnail();
        removeFiles();
    }
    else
    {
        selectFiles(category, false);
        showThumbnail(thumbnail,category, false);
    }
}