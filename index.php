<?php 
session_start();
if ( !isset( $_SESSION['username'] ) ) { 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Desktops - Login</title>
<script language="javascript" type="text/javascript" src="js/md5.js">
/** 
 * http://pajhome.org.uk/crypt/md5/
 * 
 */
</script>

<script language="javascript" type="text/javascript">
function encrypt_pw() {
	var $new_pw;
	$new_pw = hex_md5( document.getElementById('password').value );
	document.getElementById('encrypted_pw').value = $new_pw;
	
	alert( "The hash of " + document.getElementById('password').value + " is: \n" + document.getElementById('encrypted_pw').value );
	document.getElementById('password').value = '';
	return $new_pw
}

function dologin() {
	var $error;
	$error = '';
	if ( document.getElementById('username').value == '' ) { 
		//alert("Username!");
		$error = $error + "You must enter a username!\n";
	}

	if ( document.getElementById('password').value == '' ) { 
		//alert("Password!");
		$error = $error + "You must enter a password!";
	}

	if ( $error == '' ) { 
		//alert( "No error");
		encrypt_pw();
		return true;
	} else { 
		alert( $error );
		return false;
	}
}

function showabout() {
	$aboutDiv = document.getElementById('about');
	$vis      = $aboutDiv.style.display;
	if ( $vis == 'block' ) {
		$aboutDiv.style.display = 'none';
	} else {
		$aboutDiv.style.display = 'block';
	}
}
</script>
<link rel="stylesheet" href="css/master.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/login.css" type="text/css" media="screen" />
</head>
<body>


    <form id="login" name="login" action="login.php" method="post">
      <h2>Login to View Desktops</h2>
<?php
if ( isset( $_GET['error'] ) ) {
	echo "      <p class=\"error\">";

	if ( $_GET['error'] == 'username' )
		echo "Invalid username!";
	elseif ( $_GET['error'] == 'data' )
		echo "Error retrieving data from MySQL!";
	elseif ( $_GET['error'] == 'password' )
		echo "Incorrect password!";

	echo "</p>\n";
}
?>
      <p><strong>Username:</strong> admin<br />
	  <strong>Password:</strong> demo</p>
      <p>You must be logged in to continue.</p>
      <p><a href="javascript:void(0)" onclick="javascript:showabout()">About This Page</a></p>
      <div id="about">
		<p><strong>Authentication</strong></p>
        <p>This site was created using JavaScript, PHP and MySQL.<br />
           MD5 hash JavaScript function provided by: <a href="http://pajhome.org.uk/crypt/md5/">http://pajhome.org.uk/crypt/md5/</a></p>
        <p>The password is first encrypted to a MD5 hash client side.  This hash is then sent
           to the web server for validation.  This is more secure as the plain text password is never
           visible over the Internet.</p>
        <p>On the server, the username and password hash are stored in a MySQL database. 
           This also adds security.  If someone gained access to the database, they wouldn't be able 
           to simply SELECT * and see all of our passwords.</p> 
		<p><strong>Navigation</strong></p>
        <p>This site was created using JavaScript, PHP and MySQL.<br />
           AJAX Slideshow provided by: <a href="http://www.couloir.org">http://www.couloir.org</a></p>
        <p>This area takes a directory of desktop images and displays a slideshow.  They are dynamically
           downloaded (with a progress image) as you navigate.  Navigation itself, is as easy as clicking
           the left or right side of the image.  If you click 'Random' when you login, these images will
           be presented in random order.</p>
        <p>It took some tweaking of the PHP code to get this to work properly, as it was only 
           setup for a static number of images.</p>
        <p><strong>Tying them together</strong></p>
        <p>A simple if test is done on the main page that checks if you have logged in.  If you have <strong>not</strong>
           you will see the login form.  If you have just clicked 'Submit', the page redirects to itself, acknowlegding that
           you've authenticated yourself, and presents the gallery. If something goes wrong with validation, the page will 
           refresh, showing you what the problem was.</p>
         <p><strong>Other JavaScript Functions</strong></p>
         <p>The two authentication functions are encrypt_pw() and dologin().  encrypt_pw() uses the MD5 function to create
            a hash of the password the user submits.  It also clears the actual password's value (so it can't be intercepted).
            dologin() simply checks that the user has entered both a username and password, if they have encrypt_pw() is ran.
            If they haven't, an error message is displayed.</p>
      </div>
      <p>
        <label for="username" class="bg">Username</label>
        <input type="text" id="username" name="username" />
      </p>
      <p>
        <label for="password" class="bg">Password</label><br />
        <input type="password" id="password" name="password" />
      </p>
	  <p>
		<label for="random">Randomize Images?</label><br />
		<input type="checkbox" id="random" name="random" value="Y" />
      <p>
        <input type="submit" name="submit" id="submit" value="Login" onclick="return dologin()" />
		<input type="hidden" name="encrypted_pw" id="encrypted_pw" value="" />
      </p>
    </form>
<br />
<br />
<br />
</body>
</html>

<?php } else { ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="en-us" />
		
		<title>Desktops - Logged in as: <?php echo $_SESSION['username']; ?></title>
		
		<meta name="ROBOTS" content="ALL" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta name="MSSmartTagsPreventParsing" content="true" />
		
		<!-- scriptaculous -->
		<script type="text/javascript" src="js/prototype.js"></script>
		<script type="text/javascript" src="js/scriptaculous.js"></script>
		<script type="text/javascript" src="js/behaviour.js"></script>
		<script type="text/javascript" src="js/soundmanager.js"></script>
		
		<script type="text/JavaScript" charset="utf-8">
		
// -----------------------------------------------------------------------------------
// 
// This page coded by Scott Upton
// http://www.uptonic.com | http://www.couloir.org
//
// This work is licensed under a Creative Commons License
// Attribution-ShareAlike 2.0
// http://creativecommons.org/licenses/by-sa/2.0/
//
// Associated APIs copyright their respective owners
//
// -----------------------------------------------------------------------------------
// --- version date: 11/28/05 --------------------------------------------------------


// get current photo id from URL
var thisURL = document.location.href;
var splitURL = thisURL.split("#");
var photoId = splitURL[1] - 1;

// if no photoId supplied then set default
var photoId = (!photoId)? 0 : photoId;

// CSS border size x 2
var borderSize = 10;

// Photo directory for this gallery
var photoDir = "images/thumbs/";

// Define each photo's name, height, width, and caption
var photoArray = new Array(<?

function dirList ($directory){
$results = array();
$handler = opendir($directory);
while ($file = readdir($handler)) {
if ($file != '.' && $file != '..')
$results[] = $file;
}
closedir($handler);
return $results;
}

$katalog = (dirList("./images/thumbs"));

if (isset($_GET['rand'])) shuffle($katalog);

$suma = count ($katalog);
for ($i=0;$i<$suma;$i++)
{
$count = $i+1;
$plik = $katalog[$i];
$size = getimagesize("images/thumbs/$plik");
$szerokosc = $size[0];
$wysokosc = $size[1];

$show_rand = rand(1, $suma);

if ($i==$suma-1) {print "new Array(\"$plik\", \"$szerokosc\", \"$wysokosc\", \"<a href=\\\"/images/$plik\\\">Download $plik</a>\")\n"; }else{
print "new Array(\"$plik\", \"$szerokosc\", \"$wysokosc\", \"<a href=\\\"/images/$plik\\\">Download $plik</a>\"),\n";}
}
?> );

// Number of photos in this gallery
var photoNum = photoArray.length;

/*--------------------------------------------------------------------------*/

// Additional methods for Element added by SU, Couloir
Object.extend(Element, {
	getWidth: function(element) {
   	element = $(element);
   	return element.offsetWidth; 
	},
	setWidth: function(element,w) {
   	element = $(element);
    	element.style.width = w +"px";
	},
	setHeight: function(element,h) {
   	element = $(element);
    	element.style.height = h +"px";
	},
	setSrc: function(element,src) {
    	element = $(element);
    	element.src = src; 
	},
	setHref: function(element,href) {
    	element = $(element);
    	element.href = href; 
	},
	setInnerHTML: function(element,content) {
		element = $(element);
		element.innerHTML = content;
	}
});

/*--------------------------------------------------------------------------*/

var Slideshow = Class.create();

Slideshow.prototype = {
	initialize: function(photoId) {
		this.photoId = photoId;
		this.photo = 'Photo';
		this.photoBox = 'Container';
		this.prevLink = 'PrevLink';
		this.nextLink = 'NextLink';
		this.captionBox = 'CaptionContainer';
		this.caption = 'Caption';
		this.counter = 'Counter';
		this.loader = 'Loading';
	},
	getCurrentSize: function() {
		// Get current height and width, subtracting CSS border size
		this.wCur = Element.getWidth(this.photoBox) - borderSize;
		this.hCur = Element.getHeight(this.photoBox) - borderSize;
	},
	getNewSize: function() {
		// Get current height and width
		this.wNew = photoArray[photoId][1];
		this.hNew = photoArray[photoId][2];
	},
	getScaleFactor: function() {
		this.getCurrentSize();
		this.getNewSize();
		// Scalars based on change from old to new
		this.xScale = (this.wNew / this.wCur) * 100;
		this.yScale = (this.hNew / this.hCur) * 100;
	},
	setNewPhotoParams: function() {
		// Set source of new image
		Element.setSrc(this.photo,photoDir + photoArray[photoId][0]);
		// Set anchor for bookmarking
		Element.setHref(this.prevLink, "#" + (photoId+1));
		Element.setHref(this.nextLink, "#" + (photoId+1));
	},
	setPhotoCaption: function() {
		// Add caption from gallery array
		Element.setInnerHTML(this.caption,photoArray[photoId][3]);
		Element.setInnerHTML(this.counter,((photoId+1)+'/'+photoNum));
	},
	resizePhotoBox: function() {
		this.getScaleFactor();
		new Effect.Scale(this.photoBox, this.yScale, {scaleX: false, duration: 0.3, queue: 'front'});
		new Effect.Scale(this.photoBox, this.xScale, {scaleY: false, delay: 0.5, duration: 0.3});
		// Dynamically resize caption box as well
		Element.setWidth(this.captionBox,this.wNew-(-borderSize));
	},
	showPhoto: function(){
		new Effect.Fade(this.loader, {delay: 0.5, duration: 0.3});
		// Workaround for problems calling object method "afterFinish"
		new Effect.Appear(this.photo, {duration: 0.5, queue: 'end', afterFinish: function(){Element.show('CaptionContainer');Element.show('PrevLink');Element.show('NextLink');}});
	},
	nextPhoto: function(){
		// Figure out which photo is next
		(photoId == (photoArray.length - 1)) ? photoId = 0 : photoId++;
		this.initSwap();
	},
	prevPhoto: function(){
		// Figure out which photo is previous
		(photoId == 0) ? photoId = photoArray.length - 1 : photoId--;
		this.initSwap();
	},
	initSwap: function() {
		// Begin by hiding main elements
		Element.show(this.loader);
		Element.hide(this.photo);
		Element.hide(this.captionBox);
		Element.hide(this.prevLink);
		Element.hide(this.nextLink);
		// Set new dimensions and source, then resize
		this.setNewPhotoParams();
		this.resizePhotoBox();
		this.setPhotoCaption();
	}
}

/*--------------------------------------------------------------------------*/

// Establish CSS-driven events via Behaviour script
var myrules = {
	'#Photo' : function(element){
		element.onload = function(){
			var myPhoto = new Slideshow(photoId);
			myPhoto.showPhoto();
		}
	},
	'#PrevLink' : function(element){
		element.onmouseover = function(){
			soundManager.play('beep');
		}
		element.onclick = function(){
			var myPhoto = new Slideshow(photoId);
			myPhoto.prevPhoto();
			soundManager.play('select');
		}
	},
	'#NextLink' : function(element){
		element.onmouseover = function(){
			soundManager.play('beep');
		}
		element.onclick = function(){
			var myPhoto = new Slideshow(photoId);
			myPhoto.nextPhoto();
			soundManager.play('select');
		}
	},
	a : function(element){
		element.onfocus = function(){
			this.blur();
		}
	}
};

// Add window.onload event to initialize
Behaviour.addLoadEvent(init);
Behaviour.apply();
function init() {
	var myPhoto = new Slideshow(photoId);
	myPhoto.initSwap();
	soundManagerInit();
}

		</script>
		
		<link rel="stylesheet" href="css/master.css" type="text/css" media="screen" />
	</head>
	
	<body>		
		<!-- slideshow -->
		<div id="Masthead">&nbsp;</div>
		<div id="OuterContainer">
			<div id="Container">
				<img id="Photo" src="img/c.gif" alt="Photo: Couloir" />
				<div id="LinkContainer">
				    <a href="#" id="PrevLink" title="Previous Photo"><span>Previous</span></a>
				    <a href="#" id="NextLink" title="Next Photo"><span>Next</span></a>
			    </div>
			    <div id="Loading"><img src="img/loading_animated2.gif" width="48" height="47" alt="Loading..." /></div>
			</div>
		</div>
		
		<div id="CaptionContainer">
		    <p><span id="Counter">&nbsp;</span> <span id="Caption">&nbsp;</span></p>
		</div>
		
		<script type="text/javascript">
 		// <![CDATA[
 		Behaviour.register(myrules);
 		// ]]>
 		</script>
	</body>
</html>
<?php } ?>
