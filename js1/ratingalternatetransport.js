if (!AjaxTCR.widget)
{
    AjaxTCR.widget = {};
}

AjaxTCR.widget.ratingWidget = {

    /* defaults */
    defaults : {
        choiceOff: "images/star_off.gif",
        choiceOn: "images/star_hover.gif",
        choiceSelected: "images/star_reg.gif"
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

        if (!ratingOptions.form)
            return;

        /* read rating form for default config  */
        ratingOptions.url = ratingOptions.form.action;
        ratingOptions.argument = $selector("#" + ratingOptions.form.id + " input")[0].name;
        ratingOptions.method = ratingOptions.form.method;


        /* get the old style rating indicators so we transform one form to another */
        var ratingChoices = $selector("#" + ratingOptions.ratingContainer.id + " input");

        /* calculate number of ratings */
        ratingOptions.choices = ratingChoices.length;

        /* save out the old values */
        var choiceValues = [];
        for (var i = 0; i < ratingOptions.choices; i++)
        {
            choiceValues[i] = ratingChoices[i].value;
        }

        /* visually modify the ratings mechanism */
        ratingOptions.ratingContainer.style.visibility = "hidden";

        /* delete the radios */
        ratingOptions.ratingContainer.innerHTML = "";

        ratingOptions.prefixID = AjaxTCR.util.misc.generateUID("AjaxTCRRatingChoice");
        /* add the images setting the alt to the rating value */
        for (i = 0 ; i < ratingOptions.choices; i++)
        {
            var ratingImage = document.createElement("img");
            ratingImage.id = ratingOptions.prefixID + (i+1);
            ratingImage.alt = choiceValues[i];
            ratingImage.onclick = function (){AjaxTCR.widget.ratingWidget._rateClick(this,ratingOptions);};
            ratingImage.onmouseover = function (){AjaxTCR.widget.ratingWidget._rateOver(this, ratingOptions);};
            ratingImage.src = ratingOptions.choiceOff;

            ratingOptions.ratingContainer.appendChild(ratingImage);
        }

        /* set event to turn off images */
        ratingOptions.ratingContainer.onmouseout = function (){AjaxTCR.widget.ratingWidget._rateOut(ratingOptions);};

        /* show the new ratings presentation */
        ratingOptions.ratingContainer.style.visibility = "visible";

    },

    _sendRating : function(rating, ratingOptions) {

        var url = ratingOptions.url;
        var transport = ratingOptions.transportObject.options[ratingOptions.transportObject.selectedIndex].text;
        var options = { method: ratingOptions.method,
            outputTarget : ratingOptions.outputTarget,
            payload : ratingOptions.argument+"=" + rating,
            transport: transport,
            ratingOptions: ratingOptions
        };

        switch (transport)
        {
            case "image" : options.outputTarget = undefined;
                options.onSuccess = AjaxTCR.widget.ratingWidget._handleCookie;
                break;
            case "script" :
                options.outputTarget = undefined;
                options.payload += "&callbackfunction=AjaxTCR.widget.ratingWidget._displayScriptResults&outputTarget=" + ratingOptions.outputTarget;
                break;
        }


        AjaxTCR.comm.sendRequest(url,options);
    },

    _handleCookie: function(response) {
        var responseOutput = $id(response.ratingOptions.outputTarget);
        var results = AjaxTCR.comm.cookie.get("PollResults");
        var tokens = results.split("_");
        if (tokens.length == 3)
            responseOutput.innerHTML = "Thank you for voting.  You rated this a <strong>" + tokens[0] + "</strong>.  There are <strong>" + tokens[1] + "</strong> total votes.  The average is <strong>" + tokens[2] + "</strong>.  You can see the ratings in the <a href='ratings.txt' target='_blank'>ratings file</a></span>";
    },


    _displayScriptResults : function (rating, votes, average, outputTarget) {
        var responseOutput = $id(outputTarget);
        responseOutput.innerHTML = "Thank you for voting.  You rated this a <strong>" + rating + "</strong>.  There are <strong>" + votes + "</strong> total votes.  The average is <strong>" + average + "</strong>.  You can see the ratings in the <a href='ratings.txt' target='_blank'>ratings file</a></span>";
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
            $id(ratingOptions.prefixID + j).src = ratingOptions.choiceOff;
        }
    },

    _rateClick : function (choice,ratingOptions) {
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

        ratingOptions.ratingContainer.onmouseout = function (){};
        AjaxTCR.widget.ratingWidget._sendRating(choice.alt, ratingOptions);
    }
}; /* ratingWidget */

/* enable the rating widget */
AjaxTCR.util.event.addWindowLoadEvent(function () {
    var options = {
        outputTarget: "ratingResult",
        form: $id("ratingForm"),
        ratingContainer : $id("ratings"),
        transportObject: $id('transport')
    };
    AjaxTCR.widget.ratingWidget.init(options);

    var options2 = {
        outputTarget: "uiRatingResult",
        form: $id("uiRatingForm"),
        ratingContainer : $id("uiratings"),
        transportObject: $id('uitransport')
    };
    AjaxTCR.widget.ratingWidget.init(options2);

});