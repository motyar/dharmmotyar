//<DIV style="cursor: move;position:absolute;"
//	onmousedown="startdrag(this, event);"
//><img src="http://mail.google.com/mail/images/2/5/logo1.png" ></DIV>
function startdrag(t, e) {
	if (e.preventDefault) e.preventDefault(); //line for IE compatibility
	e.cancelBubble = true;
	window.document.onmousemoveOld = window.document.onmousemove;
	window.document.onmouseupOld = window.document.onmouseup;
	window.document.onmousemove=dodrag;
	window.document.onmouseup=stopdrag;
	window.document.draged = t;
	t.dragX = e.clientX;
	t.dragY = e.clientY;
	return false;
}
//move the DIV
function dodrag(e) {
	
	if (!e) e = event; //line for IE compatibility
	t = window.document.draged;
	t.style.left = (t.offsetLeft + e.clientX - t.dragX)+"px";
	t.style.top = (t.offsetTop + e.clientY - t.dragY)+"px";
	t.dragX = e.clientX;
	t.dragY = e.clientY;
	return false;
}
//restore event-handlers
function stopdrag() {
   window.document.onmousemove=window.document.onmousemoveOld;
   window.document.onmouseup=window.document.onmouseupOld;
}
