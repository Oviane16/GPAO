if (!AjaxTCR.widget)
{
    AjaxTCR.widget = {};
}

AjaxTCR.widget.ratingWidget = {

    defaults : {
        minRating: "Hate it!!!!",
        maxRating: "Love it",
        choices: 5,
        choiceOff: "images/star_off.gif",
        choiceOn: "images/star_hover.gif",
        choiceSelected: "images/star_reg.gif",
        method: "POST"
    },

    init : function (options) {

        /* create ratingOptions Object */
        var ratingOptions = {};

        /* set defaults */
        for (var anOption in AjaxTCR.widget.ratingWidget.defaults)
            ratingOptions[anOption] = AjaxTCR.widget.ratingWidget.defaults[anOption];

        /* Set/Override Options */
        for (var anOption in options)
            ratingOptions[anOption] = options[anOption];

        var widget = $id(ratingOptions.id);

        /* set the question */
        var question = document.createElement("h3");
        question.innerHTML =  ratingOptions.question;
        widget.appendChild(question);

        /* set the min ranges */
        var minRating = document.createElement("em");
        minRating.innerHTML = ratingOptions.minRating;
        widget.appendChild(minRating);


        /* create the ratings container */
        var ratings = document.createElement("span");
        ratings.id = ratingOptions.id + "ratings";
        widget.appendChild(ratings);

        ratingOptions.prefixID = AjaxTCR.util.misc.generateUID("AjaxTCRRatingChoice");

        /* add the images to the rating container */
        for (var i = 0 ; i < ratingOptions.choices; i++)
        {
            var ratingImage = document.createElement("img");
            ratingImage.id = ratingOptions.prefixID + (i+1);
            ratingImage.onclick = function (){AjaxTCR.widget.ratingWidget._rateClick(this, ratingOptions);};
            ratingImage.onmouseover = function (){AjaxTCR.widget.ratingWidget._rateOver(this, ratingOptions);};
            ratingImage.src = ratingOptions.choiceOff;

            ratings.appendChild(ratingImage);
        }

        /* set event to turn off images */
        ratings.onmouseout = function (){AjaxTCR.widget.ratingWidget._rateOut(ratingOptions);};

        /* add max range */
        var maxRating = document.createElement("em");
        maxRating.innerHTML = ratingOptions.maxRating;
        widget.appendChild(maxRating);

        /* add some line breaks */
        var br1 = document.createElement("br");
        widget.appendChild(br1);

        var br2 = document.createElement("br");
        widget.appendChild(br2);

        /* create the output zone */
        var ratingResult = document.createElement("div");
        ratingResult.id = ratingOptions.id + "ratingResult";
        ratingOptions.outputTarget = ratingOptions.id + "ratingResult";
        widget.appendChild(ratingResult);

    },

    _sendRating : function(rating, ratingOptions) {
        var url = ratingOptions.url;

        var options = { method: ratingOptions.method,
            outputTarget : ratingOptions.outputTarget,
            payload : ratingOptions.payloadValue + "=" + rating };

        AjaxTCR.comm.sendRequest(url,options);
    },

    _rateOver : function (choice, ratingOptions) {
        var current = parseInt(choice.id.slice(-1),10);
        for (var j=1;j<=current;j++)
        {
            $id(ratingOptions.prefixID + j).src = ratingOptions.choiceOn;
        }
    },

    _rateOut : function (ratingOptions) {
        for (var j=1;j<=ratingOptions.choices;j++)
        {
            $id(ratingOptions.prefixID + j).src =ratingOptions.choiceOff;
        }
    },

    _rateClick : function (choice, ratingOptions) {
        var current = parseInt(choice.id.slice(-1),10);
        for (var j=1;j<=ratingOptions.choices;j++)
        {
            var selection = $id(ratingOptions.prefixID + j);

            if (j <= current)
            {
                selection.src = ratingOptions.choiceSelected;
            }

            selection.onmouseover = function (){};
            selection.onclick = function (){};
        }

        $id(ratingOptions.id + "ratings").onmouseout = function (){};
        AjaxTCR.widget.ratingWidget._sendRating(current, ratingOptions);  }

}; /* ratingWidget */



/* enable the rating widget */
AjaxTCR.util.event.addWindowLoadEvent(function () {
    var options = {
        id: 'ratingWidget1',
        question: "How do you feel about Ajax?",
        url: "http://ajaxref.com/ch9/rate.php",
        payloadValue : "rating"
    };

    AjaxTCR.widget.ratingWidget.init(options);

    var options2 = {
        id: 'ratingWidget2',
        question: "How do you feel about UI Widgets?",
        url: "http://ajaxref.com/ch9/rateui.php",
        payloadValue : "uirating"
    };
    AjaxTCR.widget.ratingWidget.init(options2);

});