/**
 * @filename mobile.js
 * @fileoverview Prepares page for STP and supports various Mobile site-wide
 *    JavaScript functions.
 */

function loadJsApi(){
  includeScript("http://www.google.com/jsapi");
}

/**
 * includeScript
 * Includes JavaScript files by writing them to the page
 */

function includeScript(jsFile) {
  document.write('<script charset="utf-8" type="text/javascript" src="'
      + jsFile + '"></scr' + 'ipt>');
}

/**
 * searchFor -- used on demo pages
 */

function searchFor(searchTerm) {
  document.getElementById("demoframe").src = document.getElementById("searchUrl").value +
    encodeURIComponent(searchTerm);
  document.demo.searchTerm.value = searchTerm;
  return false;
}

var doneyet = false;
function restoreFocusToBody() {
  if(!doneyet) {
    window.focus();
    scroll(0,0);
    doneyet = true;
  }
}

/**
 * startList()
 * Provides a fix for IE6 on the hover navigation menu.
 */

function startList() {
  if (document.all&&document.getElementById) {
    if (navRoot = document.getElementById("top-nav")){
      for (i=0; i<navRoot.childNodes.length; i++) {
	node = navRoot.childNodes[i];
	if (node.nodeName=="LI") {
	  node.onmouseover=function() { this.className+=" over"; }
	  node.onmouseout=function() { this.className=this.className.replace("over", ""); }
	}
      }
    }
  }
}

function getUtmSourceFromCookie() {
  var search = document.cookie;
  var regex = new RegExp('utm_source=([^;]*)');
  var results = regex.exec(search);
  if (results != null) {
    return results[1];
  } else {
    return null;
  }
}

function rememberSource() {
  var utmSource;
  var hash = document.location.hash;
  if (hash.length) {
    var regex = new RegExp('utm_source=([^&]*)');
    var results = regex.exec(hash);
    if (results != null) {
      utmSource = results[1];
      var expiry = new Date();
      expiry.setTime(expiry.getTime() + (24*60*60*1000));
      document.cookie = 'utm_source=' + utmSource + ';expires=' + expiry.toGMTString() + ';';
    } else {
      return;
    }
  } else {
    return;
  }
}

/**
 * draw()
 * Draws feed entries from Blogspot
 */

function draw(root, printDate, IDName, numfeeds) {
  var feed = root.feed;
  if ((feed.num) && (feed.num.$t != "")) {numfeeds = feed.num.$t}
  var entries = feed.entry || [];
  var html = [''];
  for (var i = 0; i < numfeeds; ++i) {
    var entry = feed.entry[i];
    if (entry != null){
      var title = entry.title.$t;
      var href = entry.link[4].href;
      if (printDate) {
	var date = entry.published.$t;
	year = date.substring(0,4);
	month = date.substring(5,7);
	day = date.substring(8,10);
	html.push('<li>', month, '/', day, '/', year, ' - <a href="', href, '" onclick="javascript:mgcTrack._trackPageview(outgoing/blog-entry', i+1, ');">', title, '</a></li>');
      } else {
	html.push('<li><a href="', href, '">', title, '</a></li>');
      }
    }
  }
  document.getElementById(IDName).innerHTML = html.join("");
}

/**
 * drawHC()
 * Draws Help Center feed using draw()
 */

function drawHC(root) {
  draw(root, 0, "help-center", 3);
}

/**
 * drawBlogLinks()
 * Draws links to Mobile blog in a list with a specified ID
 */

function drawBlogLinks(idToFill){
  var handleError = function(error) { return; };
  var handleInitError = function(error) { return; };
  google.gdata.client.init(handleInitError);
  var bloggerService = new google.gdata.blogger.
    BloggerService('GoogleInc-jsguide-1.0');
  var feedUri = 'http://www.blogger.com/feeds/' +
    '1737808092791042537/posts/default?max-results=3';
  var handleBlogPostFeed = function(postsFeedRoot) {
    var posts = postsFeedRoot.feed.getEntries();
    var output = '';
    for (var i = 0, post; post = posts[i]; i++) {
      var postTitle = post.getTitle().getText();
      var postURL = post.getHtmlLink().getHref();
      var postDate = new Date(post.getPublished().getValue().date);
      postDate = postDate.getMonth()+1 + '/' + 
	postDate.getDate() + '/' + 
	postDate.getFullYear();
      output += '<li>'+postDate+' - <a href="'+ postURL +
	'">'+ postTitle + '</a></li>';
    }
    document.getElementById(idToFill).innerHTML = output;
  };
  bloggerService.getBlogPostFeed(feedUri, handleBlogPostFeed, handleError);

}

/**
 * changePreview()
 * Supports hover preview switching for Mobile site index page
 */

// Legacy
function changePreview(num) {
  var count = 10;
  for (i = 1; i <= count; i++) {
    document.getElementById('p-' + i).style.display = 'none';
  }
  document.getElementById('p-' + num).style.display = 'block';
}

var oldPhone = 'none';
function phoneHover(phoneToShow) {
  document.getElementById('p-' + oldPhone).style.display = 'none';
  document.getElementById('p-' + phoneToShow).style.display = 'block';
  oldPhone = phoneToShow;
}

/**
 * Mobile site-wide Analytics
 * @overview Auto-generates cookie path based on document pathname
 */

var mgcTrack; // Make GA available globally
function initAnalytics() {

  if (typeof(_gat) != 'undefined') {
    mgcTrack = _gat._getTracker('UA-18047-1');
    var path = document.location.pathname;
    var dynamicCp = path.match(/.+?mobile\//gi);
    if(!dynamicCp) {
      mgcTrack._setCookiePath('/mobile/');
    } else {
      mgcTrack._setCookiePath(dynamicCp);
    }
    mgcTrack._setAllowAnchor(true);
    mgcTrack._trackPageview();
    analyzeOutgoingLinks();
  }

}

/**
 * Automatically adds event tracking to outgoing links that dont start with "http://"
 */

function analyzeOutgoingLinks(){
  var allLinks = document.links;
  for (var i=0; i<allLinks.length; i++) {
    var curLink = allLinks[i].getAttribute('href');
    if (curLink.indexOf('http://') == 0) {
      var outgoingTag = curLink.toString();
      allLinks[i].setAttribute('onclick', "mgcTrack._trackEvent('Outgoing click', 'Auto-tagged', '" + outgoingTag + "');");
    }
  }
}

/**
 * Do these functions on page load
 */

initAnalytics(); // Hit analytics and tag outgoing links
startList(); // Make navigation IE6 compatible
