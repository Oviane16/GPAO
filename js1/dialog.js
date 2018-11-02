function createDialog(href, photoname, categoryName, addToHistory)
{
    var parent = document.createElement("div");
    parent.style.display = "none";
    parent.id = "parent";

    var dialog = document.createElement("div");
    dialog.className = "center";

    // create link
    var closeLink = document.createElement("a");
    closeLink.href = '#';
    closeLink.onclick = function () {return removeDialog(photoname, categoryName, true);}
    closeLink.appendChild(document.createTextNode("X"));
    dialog.appendChild(closeLink);

    // create image
    var bigImage = document.createElement("img");
    bigImage.id = "lightboxImage";
    bigImage.onload = function(){resetPosition(this, dialog);};
    bigImage.src = href;
    dialog.appendChild(bigImage);

    parent.appendChild(dialog);

    var overlay = createOverlay();
    overlay.id = "overlay";
    parent.appendChild(overlay);

    document.body.appendChild(parent);
    parent.style.display = "block";

    return false;
}

function resetPosition(image, dialog)
{
    var margin = (image.width + 24) / -2;

    dialog.style.width = image.width + "px";
    dialog.style.marginLeft = margin + "px";
    dialog.style.display = "block";
    image.onload = null;
}

function removeDialog(photoname, categoryName, addToHistory)
{
    var parent = document.getElementById("parent");
    if (parent)
        document.body.removeChild(parent);

    return false;
}

function createOverlay()
{
    var div = document.createElement("div");
    div.className = "grayout";
    document.body.appendChild(div);
    return div;
}