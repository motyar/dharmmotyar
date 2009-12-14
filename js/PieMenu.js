/*
 * Copyright (c) 2007 Markus Fisch <mf@markusfisch.de>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. Neither the name of Markus Fisch nor the names of its contributors
 *    may be used to endorse or promote products derived from this software
 *    without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED.  IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * Menu icon
 *
 * @param url - url to icon image
 * @param callback - function to call (optional)
 */
function PieMenuIcon( url, callback )
{
	/**
	 * X position of icon
	 *
	 * @access public
	 */
	this.x = 0;

	/**
	 * Y position of icon
	 *
	 * @access public
	 */
	this.y = 0;

	/**
	 * Weight
	 *
	 * @access public
	 */
	this.weight = 0;

	/**
	 * Length of a side in pixels
	 *
	 * @access public
	 */
	this.size = 0;

	/**
	 * Cell size in pixels
	 *
	 * @access public
	 */
	this.cellSize = 0;

	/**
	 * Callback function
	 *
	 * @access private
	 */
	this.callback = callback;

	/**
	 * Image element
	 *
	 * @access private
	 */
	this.image = null;

	/**
	 * Document division
	 *
	 * @access private
	 */
	this.div = null;

	// initialize
	{
		var nextFreeId = document.getElementsByTagName( "div" ).length;
		document.write(
			'<div id="PieMenuIconObject'+nextFreeId+
				'" style="visibility: hidden;">'+
				'<img id="PieMenuIconImage'+nextFreeId+'" src="'+url+
				'" alt="Icon Image"/></div>' );

		this.div = document.getElementById(
			"PieMenuIconObject"+nextFreeId ).style;
		this.image = document.getElementById(
			"PieMenuIconImage"+nextFreeId ).style;

		this.div.position = 'absolute';
	}
}

/**
 * Execute icon
 *
 * @access public
 */
PieMenuIcon.prototype.execute = function()
{
	if( !this.callback )
	{
		return;
	}

	this.callback();
}

/**
 * Hide icon
 *
 * @access public
 * @param x - x position
 * @param y - y position
 * @param w - width of icon
 * @param h - height of icon
 */
PieMenuIcon.prototype.draw = function()
{
	var size = Math.round( this.size )>>1<<1;
	var x = this.x-(size>>1);
	var y = this.y-(size>>1);

	this.image.width = size+"px";
	this.image.height = size+"px";

	this.div.left = Math.round( x )+"px";
	this.div.top = Math.round( y )+"px";
	this.div.width = size+"px";
	this.div.height = size+"px";
	this.div.visibility = 'visible';
}

/**
 * Hide icon
 *
 * @access public
 */
PieMenuIcon.prototype.hide = function()
{
	this.div.visibility = 'hidden';
}

/**
 * Pie menu
 */
var PieMenu =
{
	/**
	 * Size of a side of the square of the pie menu
	 *
	 * @access public
	 */
	size : 320,

	/**
	 * Multiplier of start radius
	 *
	 * @access public
	 */
	startRadius : 0.9,

	/**
	 * True if this is Opera
	 *
	 * @access private
	 */
	isOpera : window.opera ? 1 : 0,

	/**
	 * True if this is Internet Explorer
	 *
	 * @access private
	 */
	isIE : document.all && !window.opera ? 1 : 0,

	/**
	 * True if this is Mozilla/Firefox
	 *
	 * @access private
	 */
	isMozilla : window.innerWidth &&
		!window.opera && !document.layers ? 1 : 0,

	/**
	 * True if this is Netscape 4
	 *
	 * @access private
	 */
	isNetscape : document.layers ? 1 : 0,

	/**
	 * Maximum radius
	 *
	 * @access private
	 */
	maxRadius : 0,

	/**
	 * Current radius of pie menu
	 *
	 * @access private
	 */
	radius : 0,

	/**
	 * Radial displacement for intro animation
	 *
	 * @access private
	 */
	twist : 0,

	/**
	 * Horizontal center of pie menu
	 *
	 * @access private
	 */
	centerX : 0,

	/**
	 * Vertical center of pie menu
	 *
	 * @access private
	 */
	centerY : 0,

	/**
	 * X coordinate of cursor position within pie menu
	 *
	 * @access private
	 */
	x : 0,

	/**
	 * Y coordinate of cursor position within pie menu
	 *
	 * @access private
	 */
	y : 0,

	/**
	 * Radians per circle
	 *
	 * @access private
	 */
	radiansPerCircle : Math.PI+Math.PI,

	/**
	 * Half PI
	 *
	 * @access private
	 */
	pi2 : Math.PI/2,

	/**
	 * Array of PieMenuIcon objects
	 *
	 * @access private
	 */
	icons : new Array(),

	/**
	 * Timer id
	 *
	 * @access private
	 */
	timerId : 0,

	/**
	 * Array index of currently selected icon
	 *
	 * @access private
	 */
	selectedIcon : -1,

	/**
	 * Initialize menu
	 *
	 * @access public
	 * @param icons - array of icons
	 */
	init : function( icons )
	{
		if( PieMenu.isMozilla )
			window.captureEvents( Event.MOUSEMOVE | Event.MOUSEUP )

		document.onmouseup = PieMenu.mouseUp;

		this.icons = icons;
	},

	/**
	 * Draw menu
	 *
	 * @access public
	 * @param e - event
	 */
	mouseUp : function( e )
	{
		var b = 0;

		if( PieMenu.isIE )
			b = event.button;
		else
			b = e.which;

		if( PieMenu.timerId )
		{
			if( PieMenu.selectedIcon > -1 &&
				PieMenu.selectedIcon < PieMenu.icons.length )
				PieMenu.icons[PieMenu.selectedIcon].execute();

			PieMenu.hide();

			return true;
		}
		else if( b == 1 )
		{
			PieMenu.setCursor( e );
			PieMenu.show();

			return true;
		}

		return false;
	},

	/**
	 * Handle mouse moves
	 *
	 * @access public
	 * @param e - event
	 */
	mouseMove : function( e )
	{
		PieMenu.setCursor( e );

		var x = PieMenu.x-PieMenu.centerX;
		var y = PieMenu.y-PieMenu.centerY;

		if( Math.sqrt( (x*x)+(y*y) ) > PieMenu.size>>1 )
			PieMenu.hide();
	},

	/**
	 * Show menu
	 *
	 * @access public
	 */
	show : function()
	{
		if( PieMenu.timerId )
			return;

		document.onmousemove = PieMenu.mouseMove;

		PieMenu.maxRadius = (PieMenu.size-(.3*PieMenu.size))>>1;
		PieMenu.radius = Math.round( PieMenu.startRadius*PieMenu.maxRadius );
		PieMenu.twist = .0;
		PieMenu.centerX = PieMenu.x;
		PieMenu.centerY = PieMenu.y;

		PieMenu.draw();
	},

	/**
	 * Hide menu
	 *
	 * @access public
	 */
	hide : function()
	{
		document.onmousemove = null;

		for( var n = 0; n < PieMenu.icons.length; n++ )
			PieMenu.icons[n].hide();

		clearTimeout( PieMenu.timerId );
		PieMenu.timerId = 0;
	},

	/**
	 * Set cursor position from event
	 *
	 * @access private
	 * @param e - some event
	 */
	setCursor : function( e )
	{
		var x = 0;
		var y = 0;

		if( PieMenu.isOpera )
		{
			x = e.clientX;
			y = e.clientY;
		}
		else if( PieMenu.isIE )
		{
			if( document.documentElement &&
				document.documentElement.scrollTop )
			{
				x = event.clientX+document.documentElement.scrollLeft;
				y = event.clientY+document.documentElement.scrollTop;
			}
			else
			{
				x = event.clientX+document.body.scrollLeft;
				y = event.clientY+document.body.scrollTop;
			}
		}
		else if( PieMenu.isMozilla )
		{
			x = e.pageX;
			y = e.pageY;
		}
		else
			return;

		PieMenu.x = x;
		PieMenu.y = y;
	},

	/**
	 * Draw menu
	 *
	 * @access private
	 */
	draw : function()
	{
		var numberOfIcons = PieMenu.icons.length;
		var closestIcon = 0;

		PieMenu.selectedIcon = -1;

		if( !numberOfIcons )
			return;

		// calculate positions and sizes
		{
			var circumference = Math.PI*(PieMenu.radius<<1);
			var pixelsPerRadian = PieMenu.radiansPerCircle/circumference;
			var centeredY = PieMenu.y-PieMenu.centerY;
			var centeredX = PieMenu.x-PieMenu.centerX;
			var cursorAngle = Math.atan2( centeredY, centeredX );
			var cellSize = PieMenu.radiansPerCircle/numberOfIcons;
			var closestAngle = 0;
			var weight = 0;
			var maxIconSize = .8*PieMenu.radius;
			var maxWeight;

			// calculate weight of each icon
			{
				var cursorRadius = Math.sqrt(
					(centeredY*centeredY)+
					(centeredX*centeredX) );
				var infieldRadius = PieMenu.radius>>1;
				var f = cursorRadius/infieldRadius;

				if( cursorRadius < infieldRadius )
				{
					var b = (circumference/numberOfIcons)*.75;

					if( b < maxIconSize )
						maxIconSize = b+(maxIconSize-b)*f;
				}

				// determine how close every icon is to the cursor
				{
					var closestDistance = PieMenu.radiansPerCircle;
					var a = PieMenu.twist;
					var m = (maxIconSize*pixelsPerRadian)/cellSize;

					maxWeight = PieMenu.pi2+Math.pow( Math.PI, m );

					for( var n = 0; n < numberOfIcons; n++ )
					{
						var d = Math.abs(
							PieMenu.getAngleDifference( a, cursorAngle ) );

						if( d < closestDistance )
						{
							closestDistance = d;
							closestIcon = n;
							closestAngle = a;
						}

						if( cursorRadius < infieldRadius )
							d *= f;

						PieMenu.icons[n].weight =
							PieMenu.pi2+Math.pow( Math.PI-d, m );
						weight += PieMenu.icons[n].weight;

						if( (a += cellSize) > Math.PI )
							a -= PieMenu.radiansPerCircle;
					}

					PieMenu.selectedIcon = closestIcon;
				}
			}

			// calculate size of icons
			{
				var sizeUnit = circumference/weight;

				for( var n = numberOfIcons; n--; )
					PieMenu.icons[n].size =
						PieMenu.icons[n].cellSize =
							sizeUnit*PieMenu.icons[n].weight;

				// scale icons within cell
				{
					var maxSize = sizeUnit*maxWeight;

					if( maxSize > maxIconSize )
					{
						var f = maxIconSize/maxSize;

						for( var n = numberOfIcons; n--; )
							PieMenu.icons[n].size *= f;
					}
				}
			}

			// calculate icon positions
			{
				var difference = PieMenu.getAngleDifference(
					cursorAngle, closestAngle );
				var angle = PieMenu.getValidAngle(
					cursorAngle-
						(pixelsPerRadian*
							PieMenu.icons[closestIcon].cellSize)/cellSize*
						difference );

				// active icon
				PieMenu.icons[closestIcon].x =
					PieMenu.centerX+
					Math.round(
						PieMenu.radius*
						Math.cos( angle ) );
				PieMenu.icons[closestIcon].y =
					PieMenu.centerY+
					Math.round(
						PieMenu.radius*
						Math.sin( angle ) );

				// calculate positions of all other icons
				{
					var leftAngle = angle;
					var rightAngle = angle;
					var left = closestIcon;
					var right = closestIcon;
					var previousRight = closestIcon;
					var previousLeft = closestIcon;

					for( var n = 0; ; n++ )
					{
						if( (--left) < 0 )
							left = numberOfIcons-1;

						// break here when number of icons is odd
						if( right == left )
							break;

						if( (++right) >= numberOfIcons )
							right = 0;

						leftAngle = PieMenu.getValidAngle(
							leftAngle-
								(
									(.5*PieMenu.icons[previousLeft].cellSize)+
									(.5*PieMenu.icons[left].cellSize)
								)*pixelsPerRadian );

						PieMenu.icons[left].x =
							PieMenu.centerX+
							Math.round(
								PieMenu.radius*
								Math.cos( leftAngle ) );
						PieMenu.icons[left].y =
							PieMenu.centerY+
							Math.round(
								PieMenu.radius*
								Math.sin( leftAngle ) );

						// break here when number of icons is even
						if( left == right )
							break;

						rightAngle = PieMenu.getValidAngle(
							rightAngle+
								(
									(.5*PieMenu.icons[previousRight].cellSize)+
									(.5*PieMenu.icons[right].cellSize)
								)*pixelsPerRadian );

						PieMenu.icons[right].x =
							PieMenu.centerX+
							Math.round(
								PieMenu.radius*
								Math.cos( rightAngle ) );
						PieMenu.icons[right].y =
							PieMenu.centerY+
							Math.round(
								PieMenu.radius*
								Math.sin( rightAngle ) );

						previousRight = right;
						previousLeft = left;
					}
				}
			}
		}

		// draw icons
		for( var n = 0; n < numberOfIcons; n++ )
			PieMenu.icons[n].draw();

		// zoom and rotate into appearance
		if( PieMenu.radius < PieMenu.maxRadius )
		{
			if( (PieMenu.radius += 2) > PieMenu.maxRadius )
				PieMenu.radius = PieMenu.maxRadius;

			if( (PieMenu.twist += .05) > PieMenu.radiansPerCircle )
				PieMenu.twist -= PieMenu.radiansPerCircle;
		}

		PieMenu.timerId = setTimeout( "PieMenu.draw()", 50 );
	},

	/**
	 * Return the difference of two angles in radians
	 *
	 * @access private
	 * @param a - angle in radians
	 * @param b - angle in radians
	 * @return difference of two angles in radians
	 */
	getAngleDifference : function( a, b )
	{
		var c = a-b;
		var d;

		if( a > b )
			d = a-(b+PieMenu.radiansPerCircle);
		else
			d = a-(b-PieMenu.radiansPerCircle);

		if( Math.abs( c ) < Math.abs( d ) )
			return c;

		return d;
	},

	/**
	 * Recalculate angle to be within a valid range
	 *
	 * @access private
	 * @param a - angle in radians
	 * @return valid angle
	 */
	getValidAngle : function( a )
	{
		if( a < -Math.PI )
			a += PieMenu.radiansPerCircle;
		else if( a > Math.PI )
			a -= PieMenu.radiansPerCircle;

		return a;
	}
};
