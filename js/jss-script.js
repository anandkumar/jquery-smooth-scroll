/* Smooth Back to Top, Get This functionality from: http://wordpress.org/extend/plugins/cudazi-scroll-to-top/ */

jQuery.noConflict();
jQuery(function($) {
	
	// When to show the scroll link
	// higher number = scroll link appears further down the page	
	var upperLimit = 100; 
		
	// Our scroll link element
	var scrollElem = $('a#scroll-to-top');
	
	// Scroll to top speed
	var scrollSpeed = 500;
	
	// Show and hide the scroll to top link based on scroll position	
	scrollElem.hide();
	$(window).scroll(function () { 			
		var scrollTop = $(document).scrollTop();		
		if ( scrollTop > upperLimit ) {
			$(scrollElem).stop().fadeTo(300, 1); // fade back in			
		}else{		
			$(scrollElem).stop().fadeTo(300, 0); // fade out
		}
	});

	// Scroll to top animation on click
	$(scrollElem).click(function(){ 
		$('html, body').animate({scrollTop:0}, scrollSpeed); return false; 
	});

}); 


/* Smooth Scroll Links, Get This functionality from: http://wordpress.org/extend/plugins/easy-smooth-scroll-links/ */
var ss = {
    fixAllLinks: function () {
        var allLinks = document.getElementsByTagName('a');
        for (var i = 0; i < allLinks.length; i++) {
            var lnk = allLinks[i];
            if ((lnk.href && lnk.href.indexOf('#') != -1) && ((lnk.pathname == location.pathname) || ('/' + lnk.pathname == location.pathname)) && (lnk.search == location.search)) {
                ss.addEvent(lnk, 'click', ss.smoothScroll);
            }
        }
    },
    smoothScroll: function (e) {
        if (window.event) {
            target = window.event.srcElement;
        } else if (e) {
            target = e.target;
        } else return;
        if (target.nodeName.toLowerCase() != 'a') {
            target = target.parentNode;
        }
        if (target.nodeName.toLowerCase() != 'a') return;
        anchor = target.hash.substr(1);
        var allLinks = document.getElementsByTagName('a');
        var destinationLink = null;
        for (var i = 0; i < allLinks.length; i++) {
            var lnk = allLinks[i];
            if (lnk.name && (lnk.name == anchor)) {
                destinationLink = lnk;
                break;
            }
        }
        if (!destinationLink) destinationLink = document.getElementById(anchor);
        if (!destinationLink) return true;
        var destx = destinationLink.offsetLeft;
        var desty = destinationLink.offsetTop;
        var thisNode = destinationLink;
        while (thisNode.offsetParent && (thisNode.offsetParent != document.body)) {
            thisNode = thisNode.offsetParent;
            destx += thisNode.offsetLeft;
            desty += thisNode.offsetTop;
        }
        clearInterval(ss.INTERVAL);
        cypos = ss.getCurrentYPos();
        ss_stepsize = parseInt((desty - cypos) / ss.STEPS);
        ss.INTERVAL = setInterval('ss.scrollWindow(' + ss_stepsize + ',' + desty + ',"' + anchor + '")', 10);
        if (window.event) {
            window.event.cancelBubble = true;
            window.event.returnValue = false;
        }
        if (e && e.preventDefault && e.stopPropagation) {
            e.preventDefault();
            e.stopPropagation();
        }
    },
    scrollWindow: function (scramount, dest, anchor) {
        wascypos = ss.getCurrentYPos();
        isAbove = (wascypos < dest);
        window.scrollTo(0, wascypos + scramount);
        iscypos = ss.getCurrentYPos();
        isAboveNow = (iscypos < dest);
        if ((isAbove != isAboveNow) || (wascypos == iscypos)) {
            window.scrollTo(0, dest);
            clearInterval(ss.INTERVAL);
            location.hash = anchor;
        }
    },
    getCurrentYPos: function () {
        if (document.body && document.body.scrollTop) return document.body.scrollTop;
        if (document.documentElement && document.documentElement.scrollTop) return document.documentElement.scrollTop;
        if (window.pageYOffset) return window.pageYOffset;
        return 0;
    },
    addEvent: function (elm, evType, fn, useCapture) {
        if (elm.addEventListener) {
            elm.addEventListener(evType, fn, useCapture);
            return true;
        } else if (elm.attachEvent) {
            var r = elm.attachEvent("on" + evType, fn);
            return r;
        } else {
            alert("Handler could not be removed");
        }
    }
}
ss.STEPS = 25;
ss.addEvent(window, "load", ss.fixAllLinks);