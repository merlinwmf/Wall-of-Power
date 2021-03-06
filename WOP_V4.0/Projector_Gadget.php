<!DOCTYPE>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Wall Of Power</title>

<script src="resources/js/raphael.2.1.0.min.js"></script>
<script src="resources/js/justgage.1.0.1.min.js"></script>
<script src="resources/js/dygraph-combined.js"></script>
<script src="js/jquery-1.8.2.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<script type="text/javascript">
<script language="javascript" type="text/javascript" src="js/jquery-1.4.2.min.js"></script> 
<script language="javascript" type="text/javascript" src="js/jgauge-0.3.0.a3.js"></script> 
<script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="js/jQueryRotate.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.flot.stack.js"></script>
		
<style type="text/css">
<!--
body {
	background-image: url(black.jpg);
	text-align: center;
}
#g1,#g2,#g3,#g4,#g5,#g6 {
        width:150px; height:120px;
        display: inline-block;
        margin: 1em;
      }

/* #Layer1 {
	position:absolute;
	width:200px;
	height:50px;
	z-index:5;
	left: 1214px;
	top: 115px;
}
#Layer2 {
	position:absolute;
	width:516px;
	height:266px;
	z-index:2;
	left: 1100px;
	top: 420px;
}
#Layer3 {
	position:absolute;
	width:400px;
	height:115px;
	z-index:3;
	left: 942px;
	top: 15px;
} */
#Layer4 {
	position:absolute;
	width:214px;
	height:389px;
	z-index:1;
	left: 1100px;
	top: 200px;
}
#Layer5 {
	position:absolute;
	width:50px;
	height:50px;
	z-index:0;
	left: 575px;
	top: 510px;
}

#Layer6 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:7;
	left: 670px;
	top: 150px;
}
#Layer7 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:7;
	left: 1317px;
	top: 31px;
	color:#F7FE2E;
	font-size:80px;
}

-->
</style>

<script>

// Layer4 is TV, Layer5 is Lamp, Layer6 is Speaker
//change the background automatically

/* function ghtp() {
    document.getElementById("xxx").style.backgroundImage="url("+i+".jpg)";
    i++;
    if (i>2) i=0;
}
var i=0;
setInterval("ghtp()",30000); //30s
*/
</script> 


<script>



var TotalPower = 0;
var TvPower = 0;
var LampPower = 0;
var SpeakerPower = 0;
var VD1 = 0;
var VD2 = 0;
var VD3 = 0;
var all = 0;
var RestPower = 0;
var money = 0;
var time = 0;
      window.onload = function(){
/*         var g1 = new JustGage({
          id: "g1", 
          value: getRandomInt(0, 100), 
          min: 0,
          max: 100,
          title: "Virtual TV",
          titleFontColor: "#000000",
		  showMinMax: false,   
          shadowOpacity: 1,
          shadowSize: 0,
          shadowVerticalOffset: 5,   
		});
	    
		var g2 = new JustGage({
          id: "g2", 
          value: getRandomInt(0, 100), 
          min: 0,
          max: 100,
          title: "Virtual STB",
            shadowOpacity: 1,
          shadowSize: 0,
          shadowVerticalOffset: 5,
		  showMinMax: false,  
        });
        
        var g3 = new JustGage({
          id: "g3", 
          value: getRandomInt(0, 100), 
          min: 0,
          max: 100,
          title: "Virtual PC",
          showMinMax: false, 
          shadowOpacity: 1,
          shadowSize: 0,
          shadowVerticalOffset: 5,		  
        });  */
		    var g4 = new JustGage({
          id: "g4", 
          value: getRandomInt(0, 100), 
          min: 0,
          max: 100,
		  valueFontColor: "#FFFFFF",
          title: "TV",
          titleFontColor: "#FFFFFF",
		  titleFontColor: "#FFFFFF",
		  label: "Watts",
		  labelFontColor: "#FFFFFF",
          showMinMax: false, 
		  shadowOpacity: 1,
          shadowSize: 0,
          shadowVerticalOffset: 5,     
        });
		    var g5 = new JustGage({
          id: "g5", 
          value: getRandomInt(0, 100), 
          min: 0,
          max: 100,
		  valueFontColor: "#FFFFFF",
          title: "Lamp",
		  titleFontColor: "#FFFFFF",
		  label: "Watts",
		  labelFontColor: "#FFFFFF",
          showMinMax: false,  
		  shadowOpacity: 1,
          shadowSize: 0,
          shadowVerticalOffset: 5,   
        });
		    var g6 = new JustGage({
          id: "g6", 
          value: getRandomInt(0, 100), 
          min: 0,
          max: 100,
		  valueFontColor: "#FFFFFF",
          title: "Speaker",
		  titleFontColor: "#FFFFFF",
		  label: "Watts",
		  labelFontColor: "#FFFFFF",
          showMinMax: false,        
          shadowOpacity: 1,
          shadowSize: 0,
          shadowVerticalOffset: 5,
		}); 
		  setInterval(function() {
/* 			GetVD1Power();
		  GetVD2Power();
		  GetVD3Power(); */
		  GetTvPower();
		  GetLampPower();
		  GetSpeakerPower();
		  GetRestPower();
		  GetTotalPower();

/* 		  g1.refresh(VD1);
		g2.refresh(VD2);
		  g3.refresh(VD3); */
		  g4.refresh(TvPower);
		  g5.refresh(LampPower);
		  g6.refresh(SpeakerPower);
		  GetTime();
        }, 2500); //2.5 sec
		
      };
///////////////////
//flow

$(function () {

    var data = [], totalPoints = 300;
    var data2 = [];
		var y = 0;

		var tmin, tmax;

	
    function getData() {
		if (data.length > 0)
            data = data.slice(1);
			
        // do a random walk

				PD_all=y;
       
        while (data.length < totalPoints) {
			data.push(all);
        }
		
        // zip the generated y values with the x values
        var res = [];
    for(var m = 0; m <= data.length; m++)
        data2 [m] = data[data.length-m-1];
		for (var i = 0; i <= data.length; ++i)		
        res.push([i, data2[i]]);
		return res;
    }

    // setup control widget
    var updateInterval = 50;//millisecond
    
    // setup plot
    var options = {
		series: { label: "Total Power (W)", shadowSize: 0, color: '#3ADF00', lines: { show: true, fill: true }},
        yaxis: { min: 0, max: 300 },
        xaxis: { show: false},

    };
    var plot = $.plot($("#placeholder_4"), [ getData() ], options);

    function update() {
        plot.setData([ getData() ]);
        // since the axes don't change, we don't need to call plot.setupGrid()
        plot.draw();
        
        setTimeout(update, updateInterval);
		
    }
	update();
	
});
///////////////////////
//total
function GetTime(){

		today = new Date();
		time = today.getHours();
		//alert(time);
		
		if(time>=10 && time<=18)
		{
			document.getElementById('Layer7').innerHTML="PEAK";
			document.getElementById('Layer7').style.color = "#0C4685";
			document.getElementById('Layer7').style.fontSize="40px";
		  document.getElementById('Layer7').style.fontFamily= "Arial";
		  document.getElementById('MoneyPosition').innerHTML=money;
		}
		else
		{	
			document.getElementById('Layer7').innerHTML="OFF-PEAK";
			document.getElementById('Layer7').style.color = "#000000";
		  document.getElementById('Layer7').style.fontSize="40px";
		  document.getElementById('Layer7').style.fontFamily= "Arial";	
		  document.getElementById('MoneyPosition').innerHTML=money;	
		}
}
function GetTotalPower(){

	var xmlhttp;
	var str = 1;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			TotalPower = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","power.php?q="+str,true);
		xmlhttp.send();

}

///////////////////////////////
function GetTvPower(){

	var xmlhttp;
	var str = 2;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			TvPower = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","power.php?q="+str,true);
		xmlhttp.send();
}
////////////////////////////////
function GetLampPower(){

	var xmlhttp;
	var str = 3;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			LampPower = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","power.php?q="+str,true);
		xmlhttp.send();
}
////////////////////////////////////

function GetSpeakerPower(){

	var xmlhttp;
	var str = 16;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			SpeakerPower = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","power.php?q="+str,true);
		xmlhttp.send();
}

//////////////////////////////////
function GetRestPower(){

	var xmlhttp;
	var str = 6;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			RestPower = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","power.php?q="+str,true);
		xmlhttp.send();
}
///////////////////////////////////
function GetVD1Power(){

	var xmlhttp;
	var str = 4;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			VD1 = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","power.php?q="+str,true);
		xmlhttp.send();
		

		
}
/////////////////////////////////////////////
function GetVD2Power(){

	var xmlhttp;
	var str = 5;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			VD2 = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","power.php?q="+str,true);
		xmlhttp.send();
		if(VD2==1)
			VD2 = 14;
		
}
//////////////////////////////////////////////
function GetVD3Power(){

	var xmlhttp;
	var str = 17;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			VD3 = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","power.php?q="+str,true);
		xmlhttp.send();
		
		all = (parseInt(TotalPower)+parseInt(VD1)+parseInt(VD2)+parseInt(VD3));
		//alert(RestPower);
		money = (parseInt(RestPower)/3600*0.18+parseInt(all)*30*(8*0.2+16*0.16)*0.25/1000).toFixed(2);
		//alert(money);
		//alert(all);
}
///////////////////////////////////////////
    </script>
	
	


	<script type="text/javascript">
var makeDrag_flag = false;
var makeDrop_objs = [];
function makeDrop(obj)
{
	makeDrop_objs.push(obj);	
}
function makeDrag(obj)
{
	obj.onmousedown = function (e)
	{
		if (!document.all) e.preventDefault();
		var oPos = getObjPos(obj);
		var cPos = getCurPos(e);
		makeDrag_flag = true;
		document.onmouseup = function (e){
			makeDrag_flag = false;
			document.onmousemove = null;
			document.onmouseup = null;			
			var nPos = getCurPos(e);			
			for(i = 0; i < makeDrop_objs.length; i++)
			{
				var tg = makeDrop_objs[i];
				var tPos = getObjPos(tg);
				var tg_w = tg.offsetWidth;
				var tg_h = tg.offsetHeight;
				if ((nPos.x > tPos.x) && (nPos.y > tPos.y) && (nPos.x < tPos.x + tg_w) && (nPos.y < tPos.y + tg_h))
				{
					tg.innerHTML += '<p>' + obj.innerHTML + '��?��?</p>'
					obj.style.display = 'none';
				}
			}
	    };
		document.onmousemove = function (e)
		{
			if (makeDrag_flag)
			{
				obj.style.position = 'absolute';
				var Pos = getCurPos(e);
				obj.style.left = Pos.x - cPos.x + oPos.x + 'px';
				obj.style.top = Pos.y - cPos.y + oPos.y + 'px';
			}
			return false;
		}
	}
}

function getObjPos(obj)
{
	var x = y = 0;
	if (obj.getBoundingClientRect)
	{
		var box = obj.getBoundingClientRect();
		var D = document.documentElement;
		x = box.left + Math.max(D.scrollLeft, document.body.scrollLeft) - D.clientLeft;
		y = box.top + Math.max(D.scrollTop, document.body.scrollTop) - D.clientTop;		
	}
	else
	{
		for(; obj != document.body; x += obj.offsetLeft, y += obj.offsetTop, obj = obj.offsetParent );
	}
	return {'x':x, 'y':y};
}

function getCurPos(e)
{
	e = e || window.event;
	var D = document.documentElement;
	if (e.pageX) return {x: e.pageX, y: e.pageY};
	return {
		x: e.clientX + D.scrollLeft - D.clientLeft,
		y: e.clientY + D.scrollTop - D.clientTop	
	};
}
</script>
</head>
<body  onclick="SetPicture()" id="xxx">

<div id="Layer1"><td><div id='g1'></div></td></div>
<div id="Layer2"><td><div id='g2'></div></td></div>
<div id="Layer3"><td><div id='g3'></div></td></div>
<div id="Layer4"><td><div id='g4'></div></td></div>
<div id="Layer5"><td><div id='g5'></div></td></div>
<div id="Layer6"><td><div id='g6'></div></td></div>

<script type="text/javascript">
//register drag events
var Drag_Gage = document.getElementById('Layer1');
var Drag_Chart = document.getElementById('Layer2');
var Drag_Fee = document.getElementById('Layer3');
var Drag_Tree = document.getElementById('Layer4');
var Drag_Lamp = document.getElementById('Layer5');
var Drag_Couch1 = document.getElementById('Layer6');
var Drag_Peak = document.getElementById('Layer7');


makeDrag(Drag_Gage);
makeDrag(Drag_Chart);
makeDrag(Drag_Fee);
makeDrag(Drag_Tree);
makeDrag(Drag_Lamp);
makeDrag(Drag_Couch1);
makeDrag(Drag_Peak);

var dropItem = document.getElementById('drop');
makeDrop(dropItem);
</script>



</body>


<script type="text/javascript">
	
var y3 = 0;
var y1 = 0;
var y2 = 0;
var userWidth = window.screen.width;
var tv_x = 0;
var tv_y = 0;
var stb_x = 0;
var stb_y = 0;
var lt_x = 0;
var lt_y = 0;


function SetPicture(){
	var time1 = setInterval("movePicture1()",50);
	var time2 = setInterval("GetPoision1()",50);
	var time3 = setInterval("movePicture2()",50);
	var time4 = setInterval("GetPoision2()",50);
	var time5 = setInterval("movePicture3()",50);
	var time6 = setInterval("GetPoision3()",50);
}
////////////////////////////////////////////
//picture1
function GetPoision1(){

	var xmlhttp;
	var str = true;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			y3 = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","XY1.php?q="+str,true);
		xmlhttp.send();   
		var count1 = y3.indexOf("#");
		tv_x = parseInt(y3.substr(0,count1));
		tv_y = parseInt(y3.substr(count1+1));

}


///////////////////////////////////////////////////
//picture2
function GetPoision2(){

	var xmlhttp;
	var str = true;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			y1 = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","XY2.php?q="+str,true);
		xmlhttp.send();   
		var count1 = y1.indexOf("#");
		stb_x = parseInt(y1.substr(0,count1));
		stb_y = parseInt(y1.substr(count1+1));

}

function movePicture2() {
var pp = document.getElementById("soare2");
var lft = parseInt(pp.style.left);
lft = (stb_x+0)*16/9-190; 
to = (stb_y+0)*16/9-208;
pp.style.left = lft+"px";
pp.style.top = to+"px";
}
////////////////////////////////////////////
//picture3

function GetPoision3(){

	var xmlhttp;
	var str = true;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			y2 = xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","XY3.php?q="+str,true);
		xmlhttp.send();   
		var count1 = y2.indexOf("#");
		lt_x = parseInt(y2.substr(0,count1));
		lt_y = parseInt(y2.substr(count1+1));
}

function movePicture3() {
var pp = document.getElementById("soare3");
var lft = parseInt(pp.style.left);
lft = (lt_x+0)*16/9-160; 
to = (lt_y+0)*16/9-250;
pp.style.left = lft+"px";
pp.style.top = to+"px";
}
/////////////////////////////////////
</script>


</html>
