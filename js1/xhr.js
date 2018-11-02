function sendRequest(url, payload, categoryName, callback)
{
    var options = {method:"GET",
        payload:payload,
        onSuccess: callback,
        categoryName: categoryName
    };

    AjaxTCR.comm.sendRequest(url, options);
}


function handlePhotosResponse(response)
{
    var photos = AjaxTCR.data.decodeJSON(response.xhr.responseText);
    var fileList = document.getElementById("fileList");
    fileList.innerHTML = "";

    if (photos)
    {
        for (var i=0;i<photos.length;i++)
        {
            var a = document.createElement("a");
            a.href = "#";
            a.onclick = function(){ return showThumbnail(this.innerHTML, response.categoryName, true);}
            a.className = "photoLink";
            a.appendChild(document.createTextNode(photos[i]));
            fileList.appendChild(a);
            fileList.appendChild(document.createElement("br"));
        }
    }

}

function handleCategoriesResponse(response)
{
    var categories = AjaxTCR.data.decodeJSON(response.xhr.responseText);
    var categoryList = document.getElementById("categoryList");

    if (categories)
    {
        for (var i=0;i<categories.length;i++)
        {
            var a = document.createElement("a");
            a.href = "#";
            a.onclick = function(){return selectFiles(this.innerHTML, true);};
            a.className = "categoryLink";
            a.appendChild(document.createTextNode(categories[i]));
            categoryList.appendChild(a);
            categoryList.appendChild(document.createElement("br"));
        }
    }
}

function selectFiles(categoryName, addToHistory)
{
    removeThumbnail();
    var payload = "category=" + categoryName;
    var url = "http://ajaxref.com/ch8/photoviewer.php";

    sendRequest(url, payload, categoryName, handlePhotosResponse);

    return false;
}

function selectCategories()
{
    var url = "http://ajaxref.com/ch8/photoviewer.php";
    sendRequest(url, "", null, handleCategoriesResponse);

}