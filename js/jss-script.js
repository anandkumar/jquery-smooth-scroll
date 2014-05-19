jQuery.noConflict();
jQuery(function($) {
 

// Customize Settings: For more information visit www.blogsynthesis.com/plugins/jquery-smooth-scroll/
 
	// When to show the scroll link
	// higher number = scroll link appears further down the page	
	var upperLimit = 100; 
		
	// Our scroll link element
	var scrollElem = $('a#scroll-to-top');
	
	// Scroll Speed. Change the number to change the speed
	var scrollSpeed = 600;
	
	// Choose your easing effect http://jqueryui.com/resources/demos/effect/easing.html
	var scrollStyle = 'swing';
	
/****************************************************
 *													*
 *		JUMP TO ANCHOR LINK SCRIPT START			*
 *													*
 ****************************************************/
	
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
		$('html, body').animate({scrollTop:0}, scrollSpeed, scrollStyle ); return false; 
	});

/****************************************************
 *													*
 *		JUMP TO ANCHOR LINK SCRIPT START			*
 *													*
 ****************************************************/
 
  $('a[href*=#]:not([href=#])').click(function() 
  {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
        || location.hostname == this.hostname) 
    {
      
      var target = $(this.hash),
      headerHeight = $(".primary-header").height() + 5; // Get fixed header height
            
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              
      if (target.length) 
      {
        $('html,body').animate({ scrollTop: target.offset().top }, scrollSpeed, scrollStyle );
        return false;
      }
    }
  });
  

/****************************************************
 *													*
 *	 FOLLOW BLOGSYNTHESIS.COM FOR WORDPRESS TIPS	*
 *													*
 ****************************************************/
 
});


/****************************************************
 *													*
 *	 			  SCRIPTS ENDS HERE					*
 *													*
 ****************************************************/
 

/* DEPRECITED SCRIPT - WILL BE REMOVED IN NEXT UPDATE */
 
/* Smooth Scroll Anchor Links */
/*
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
            e.preventDefault();
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

*/