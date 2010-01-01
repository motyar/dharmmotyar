// Note --  add a div in your page with id="targetStart"
// <div id="targetStart"></div>
// <script src="webhp_files/FireWorks.js"></script>
//


window.motyar={
				time:function(){
				       return(new Date).getTime()
					   },};
motyar.firework ||
function () {
    function n() {
        var l = Math.floor((k.getTime() - (new Date).getTime()) / 1E3);
        if (l > 0) {
            h.innerHTML = l;
            window.setTimeout(n, 500);
            if (l < m && !motyar.firework.loading) {
                motyar.fireworkRequest("ifl");
                motyar.firework.loading = 1
            }
        } else {
            h.innerHTML = "";
            motyar.firework.go()
        }
    }
    motyar.firework = {
        go: function () {},
        loading: 0,
        loaded: 0
    };
    var k = new Date(2010, 0, 1),
        i = document.createElement("center");
    i.innerHTML = '<div style="font-size:500%;font-weight:bold;color:darkblue"></div>';
   
	
	var g = document.getElementById("targetStart");
    if (g) {
        g.parentNode.insertBefore(i, g);
        var h = i.firstChild,
            m = 3600 * (1 + Math.random());
        window.setTimeout(n, 0)
    }
} ();
motyar.firework.loaded ||
function () {
    function n(d, f, c, e) {
        function j() {
            for (var q = [], b; b = o.shift();) {
                if (b.y + b.vy + a.y + 40 < g && b.x + b.vx + a.x + 25 < h) {
                    b.x += b.vx;
                    b.vy += 0.25;
                    b.y += b.vy;
                    b.fragment.style.left = b.x + "px";
                    b.fragment.style.top = b.y + "px";
                    b.count += 1;
                    if (b.count < 100) {
                        q.push(b);
                        continue
                    }
                }
                a.removeChild(b.fragment)
            }
            o = q;
            if (o.length > 0 && motyar.firework) window.setTimeout(j, 20);
            else {
                document.body.removeChild(a);
                m--
            }
        }
        var a = document.createElement("DIV");
        a.style.color = e;
        a.style.position = "absolute";
        a.x = d - 22;
        a.style.left = a.x + "px";
        a.y = f - 8;
        a.style.top = a.y + "px";
        a.innerHTML = "<font size=+2><i><b>" + c + "</b></i></font>";
        var o = [];
        d = [1, 7.007, 10, 7.007, -1, -7.007, -10, -7.007];
        for (f = 0; f < d.length; ++f) {
            c = document.createElement("DIV");
            c.innerHTML = "*";
            c.style.fontSize = "200%";
            c.style.position = "absolute";
            e = d[f];
            var p = d[(f + 2) % d.length];
            c.style.left = e + 22 + "px";
            c.style.top = p + 8 + "px";
            o.push({
                fragment: c,
                x: e + 22,
                y: p + 8,
                vx: e,
                vy: p,
                count: 0
            });
            a.appendChild(c)
        }
        window.setTimeout(function () {
            if (motyar.firework) {
                m++;
                document.body.appendChild(a);
                window.setTimeout(j, 10)
            }
        },
        0)
    }
    function k(d, f, c, e) {
        return function () {
            n(d, f, c, e)
        }
    }
    function i() {
        if (motyar.firework) {
            if (m < 24) for (var d = 0, f = 0; d < 12; f++) {
                var c = (h - 300) * Math.random() + 50,
                    e = g / 3 * Math.random() + 150,
                    j = 500 * Math.random(),
                    a = l[f];
                
                c += (Math.random() - 0.5) * 25 + 75;
                e += (Math.random() - 0.5) * 20;
                window.setTimeout(k(c, e, "", a), j + 100 * d++);
   
            }
            window.setTimeout(i, 2000)
        }
    }
    var g, h;
    if (typeof window.innerWidth == "number") {
        g = window.innerHeight;
        h = window.innerWidth
    } else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
        g = document.documentElement.clientHeight;
        h = document.documentElement.clientWidth
    } else {
        g = document.body.clientHeight;
        h = document.body.clientWidth
    }
    var m = 0,
        l = ["green","red","orange","yellow"];
    motyar.firework.go = function () {
        i();
        var d = false;
        motyar.bind(document, "click", function () {
            if (!d) {
                delete motyar.firework;
                d = true
            }
        })
    };
    motyar.firework.loaded = 1
} ();