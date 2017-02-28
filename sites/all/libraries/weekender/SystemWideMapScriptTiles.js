var mapWidth = 3410;
var mapHeight = 3410;
var selectedStationIDs = '';
var selectedLeftDiv = 'weekenderleftPanel';
var ZoomMapName = 'SubwayMap';
var systemMapLoaded = false;
var selectedStation = ""
/* Route Array */
var routes = new Array()
routes[0] = "1"
routes[1] = "2"
routes[2] = "3"
routes[3] = "4"
routes[4] = "5"
routes[5] = "6"
routes[6] = "7"
routes[7] = "8"
routes[8] = "9"
routes[9] = "A"
routes[10] = "B"
routes[11] = "C"
routes[12] = "D"
routes[13] = "E"
routes[14] = "F"
routes[15] = "G"
routes[16] = "J"
routes[17] = "L"
routes[18] = "M"
routes[19] = "N"
routes[20] = "Q"
routes[21] = "R"
routes[22] = "S"
routes[23] = "V"
routes[24] = "W"
routes[24] = "Z"

function closeStatusDetailDiv()
{
    document.getElementById("weekenderleftStatus").style.display = "none"
}
//function to read QueryString
function querySt(ji) {
    hu = window.location.search.substring(1);
    gy = hu.split("&");
    for (i = 0; i < gy.length; i++) {
        ft = gy[i].split("=");
        if (ft[0] == ji) {
            return ft[1];
        }
    }
}

function setCenterByQuerystring() {
    var t = querySt("top")
    var l = querySt("left")
    var id = querySt("id")
    if (t != undefined) {
        setCenter(t, l);
        onStationClick(id);       
    }
}
function setCenter(t, l) {
    var imgTop = 280 - t - 5
    var imgLeft = 480 - l - 5 + 150
    document.getElementById('mapDivInner').style.top = imgTop + "px";
    document.getElementById('mapDivInner').style.left = imgLeft + "px";
}

//weekendstatus
var ZoomInImg = false;
function onImgStationClick(e) {        
	onStationClick(e.id.split("_")[0]);
}
function clearChildren(obj) {
    try {
        if (obj.hasChildNodes() && obj.childNodes) {
            while (obj.firstChild) {
                obj.removeChild(obj.firstChild);
            }
        }        
    }
    catch (e) { }
}

function getServiceStatusByStationID(stationID) 
{    
	var divID = 1000;
	var sCount = 0;
	var statusMsg = '';
	var statusID = '';
	
    for (i = 0; i < weekendstatus.length; i++) {
        if (weekendstatus[i].split(",")[2] == stationID) {
            if (statusID != weekendstatus[i].split(",")[0]) {
                statusID = weekendstatus[i].split(",")[0];
                //align all route images to center
                var title = GetStatusTitle(statustext[statusID]);
                title = title.replace(/<br>/g, "")
                title = title.replace(/<img/g, "<img")
                divID = divID + i;
                title = title + '... more <br>';
                title = title.replace(/<b>/g, "")
                var detail = GetStatusDetailText(statustext[statusID]);
                detail = detail.replace(/<img/g, "<img style='position:relative; top:2px;' ")
                sCount++;
                statusMsg += '<div class="statusHeaderText" onmouseover="AllStationMouseOver(this);" onmouseout="AllStationMouseOut(this);" onclick="ShowHide(' + divID + ');">' + title + '</div><br>';
                //statusMsg += '<div id=' + divID + ' style=display:none;top:5px;>' + detail + '</div>';
		  statusMsg += '<div id=' + divID + ' style=display:none;top:5px;>' + detail ;
		  statusMsg += '<a href="http://tripplanner.mta.info/MyTrip/ui_web/customplanner/tripplanner.aspx" border=0 target=_blank><img border=0 src=images/TPLink.jpg></a>' + '</div>';
            }
        }        
    }    
	document.getElementById('statusCaptionSpan').style.display ='inline';
	if(sCount > 1)		
		document.getElementById('statusCaptionSpan').innerText = 'Select one for details';			
	else		
		document.getElementById('statusCaptionSpan').innerText = 'Click for details';
		
	if(statusMsg != undefined && statusMsg != 'undefined' && statusMsg != '')
    {		
        document.getElementById('spanStatusByStation').innerHTML = statusMsg.replace(/travel.mtanyct/g,"tripplanner.mta");
    }
    else
    {
		document.getElementById('statusCaptionSpan').style.display ='none';
        document.getElementById('spanStatusByStation').innerHTML = '<span style="font-weight:normal;">No scheduled work affecting service at this station.</span>';
    }     
	
}

function DrawStationImage(stationID)
{	
	var imgElementID = '';
	var leftpx = '';
	var j=0;
	var k=0;
	clearChildren(document.getElementById('divDrawStationImage'));	
	for(i = 0; i < masterArray.length; i++)
	{
		sID = masterArray[i].split(":")[1];
		if(sID == stationID)
		{
			sName = masterArray[i].split(":")[0]
			sIcons = masterArray[i].split(":")[2]
			iconArray = sIcons.split(";")
			iconList = ""
			for(j=0; j < iconArray.length; j++)
			{
				iconList = iconList + '<img src="images/routes/14px/' + iconArray[j] + '.gif" class="imgMargin" alt="" />'
				var routeImg;			 
				 if(k==0)
				 { 				
					leftpx = 0;
					k++;
				 }
				 else
				 {			    
					leftpx = leftpx + 16;
					k++;
				 }					 
				 routeImg = document.createElement('img');
				 routeImg.setAttribute('style', 'position:absolute;width:14px;height:14px;left:' + eval(leftpx) +'px');
				 routeImg.setAttribute('src', 'images/routes/14px/' + iconArray[j]  + '.gif');			
				 routeImg.setAttribute('id', stationID+iconArray[j] +'l')
				 routeImg.style.position = "absolute";
				 routeImg.style.width  = "14px";
				 routeImg.style.height = "14px";
				 routeImg.style.left = eval(leftpx) +'px';
				 document.getElementById('divDrawStationImage').appendChild(routeImg);	
			}
			//document.getElementById('divDrawStationImage')
			document.getElementById("spanStationName").innerHTML = sName;
		}
	}
}

function ShowHide(div) {	
    selLines = div;
    var control = document.getElementById(div);
    if (control.style.display == "inline" || control.style.display == "" || control.style.display == "block")
        control.style.display = 'none';
    else
        control.style.display = 'inline';
}

/* Function to plot Weekend Status Icons */
var zooming = false;
/* Function to Show Status Message */
function ShowStatusMessage(e) {
    statusID = e.id.split("_")[1];

    //align all route images to center
    var title = GetStatusTitle(statustext[statusID]);
    title = title.replace(/<img/g, "<img style='position:relative; top:2px;' ")   

    var detail = GetStatusDetailText(statustext[statusID]);    
    detail = detail.replace(/<img/g, "<img style='position:relative; top:2px;' ")

    var statusMsg = '<span style="font-family:arial;font-size:12px;line-height:15px;font-weight:normal;">' + title + '</span><br>';
    statusMsg += detail;

    var closeelement = document.createElement('img');
    closeelement.setAttribute('style', 'position:absolute; top:5px;left:250px; cursor:pointer;');
    closeelement.setAttribute('onclick', 'CloseStatusMessage(this);');
    closeelement.setAttribute('src', 'Images/Close16.png');
    closeelement.setAttribute('alt', 'close window');
    closeelement.setAttribute('id', 'imgClose');
    closeelement.style.position = "absolute";

    closeelement.style.top = "5px";
    closeelement.style.left = "250px";    
    closeelement.style.cursor = "pointer";
    closeelement.src = "Images/Close16.png";
    closeelement.id = 'imgClose';
    closeelement.onclick = function() { CloseStatusMessage(this); }

    document.getElementById('weekenderleftDiv').innerHTML = '';
    document.getElementById('weekenderleftDiv').style.display = "block";
    document.getElementById('weekenderleftPanel').style.display = "block";
    
    document.getElementById('weekenderleftDiv').innerHTML = "<br>" + stripoutTags(statusMsg,'b');    
    /*document.getElementById('weekenderleftDiv').appendChild(closeelement);*/
}

function GetStatusTitle(text) {
    var startindex = 0
    var endindex = text.indexOf("$$", 0);
    var title = text.substring(startindex, endindex) 
    return title
}

/* Function to avoid duplicate heading */
function GetStatusDetailText(text) {
    var startindex = text.indexOf("$$", 0)    
    var detail = text.substring(startindex + 2)
    return detail
}

function stripoutTags(text, tag) {
    var re = new RegExp('<' + tag + '[^><]*>|<.' + tag + '[^><]*>', 'g');
    return text.replace(re, '');
}

function CloseStatusMessage(e) {
    document.getElementById('weekenderleftDiv').style.display = "none";
}

/* Function */
function showSystemMapImage() 
{
    document.getElementById("systemMapImg").style.visibility = "visible";
}

/* Function to ZoomIn|ZoomOut */
var divMenuLeftWidth = 200;
function reCenter(s) 
{
    if (!zooming) {return false;}
    var currentCenterX = -1 * (parseInt(document.getElementById("mapDivInner").style.left) - 300);
    var currentCenterY = -1 * (parseInt(document.getElementById("mapDivInner").style.top) - 200);
    var newCenterX = currentCenterX * s;
    var newCenterY = currentCenterY * s;
    document.getElementById("mapDivInner").style.left = (-1 * (newCenterX - 300)) + "px";
    document.getElementById("mapDivInner").style.top = (-1 * (newCenterY - 200)) + "px";
}

function EnableLegend()
{ 		
	if(document.getElementById("LegendDiv").style.display == "block")
	{
		document.getElementById("LegendDiv").style.display = 'none';
	}
	else
	{
		document.getElementById("LegendDiv").style.display = 'block';
		document.getElementById('legend').src = 'images/legend_over.png';
	}
}

function recenterSystemMap(staID) {
    if (systemMapLoaded) {
        //siva window.frames["systemMap"].zoom(-1);
        window.frames["systemMap"].centerOnStation(staID)        
    }
    else {
        window.frames["systemMap"].location.href = "tileMapSubway.html?staID=" + staID        
    }    
}


/* Function to ZoomIn */
function zoomIn() {    
        if (ZoomMapName == 'neighborhoodMap') {
            zoomNeighborhoodMap(1);
        }
		
        if (ZoomMapName == 'SubwayMap') {        
			if (parent.document.getElementById("zoom_in").src.indexOf("gray_zoom_in.png") <= 0) 
				{
					window.frames["systemMap"].zoom(1)
				}
				
        }
    
}

/* Function to ZoomOut */
function zoomOut() {

  
        
        if (ZoomMapName == 'neighborhoodMap') {
            zoomNeighborhoodMap(-1);
        }
        if (ZoomMapName == 'SubwayMap') {
			if (parent.document.getElementById("zoom_out").src.indexOf("gray_zoom_out.png") <= 0) {
				currentZoomLevel = -1;
				window.frames["systemMap"].zoom(-1);
			}
        }
        if (ZoomMapName == 'BingMap') {
            window.frames[1].zoomBingMap(-1);
        }

     
}

function onSystemDiagramClickXY(x, y) {
    window.frames["systemMap"].location.href = "tileMapSubway.html?staID=0&x=" + x + "&y=" + y;
    EnableZoomDrawerIconsInHeader();
}

function onStationClick(stationID) {    
    var stationName = '';
    //AIRTrain check
    if (stationID.substring(0, 5) == '99999') {
        window.open('http://www.panynj.gov/airports/jfk-airtrain.html');
    }
    else {
        if (stationMapCoordinates[stationID]) {
            getServiceStatusByStationID(stationID);
            selectedStation = stationID;
            var lineData = stationMapCoordinates[stationID];
            stationName = lineData.split(",")[2];
        }
        document.getElementById("mapDivouter").style.display = "inline"        	
        document.getElementById("LegendDiv").style.display = "none";
        document.getElementById("weekenderleftStatus").style.display = "inline";
        document.getElementById("weekenderleftPanel").style.display = "block";        
        if (document.getElementById(stationID)) {
            document.getElementById("spanStationName").innerHTML = document.getElementById(stationID).childNodes[0].innerHTML; //+ "<span style='position:relative; top:3px; left:3px;'>" + document.getElementById(stationID).childNodes[1].innerHTML + "</span>";
        }
        else
        { document.getElementById("spanStationName").innerHTML = stationName; }
        selectedLeftDiv = 'weekenderleftStatus';
        recenterSystemMap(stationID)
        ZoomMapName = 'SubwayMap';
        DrawStationImage(stationID);
        EnableZoomDrawerIconsInHeader();
        if (document.getElementById("spanStationView")) {
            document.getElementById("spanStationView").style.color = "black";
        }
    }
}
function DisplayCompleteStatus(statusID) {
    if (detail_loaded) {
        var status = statustextraw[statusID]
        document.getElementById('mapDivouter').style.display = 'none';
        document.getElementById("moreStatusDiv").innerHTML = "<span class='detailcenterdiv'><span class='boldtext' style='width:615px;'>Details</span><span style='position:absolute;cursor:pointer;left:575px;' onclick='hideCompleteStatus()'><b>Close</b></span></span><br>";
        document.getElementById("moreStatusDiv_raw").innerHTML = status;
        document.getElementById("moreStatusDiv_raw").style.display = "inline";
        document.getElementById("moreStatusDiv").style.display = "inline";
        document.getElementById('drawer').style.display = 'none';
        document.getElementById("spanStationView").style.color = '#888888';
        document.getElementById("spanNeighborhoodView").style.color = '#888888';
        clearTimeout(timer_fun);
    }
    else {
        timer_fun = setTimeout(function() { DisplayCompleteStatus(statusID) }, 150);
    }
}
function hideCompleteStatus() {
    document.getElementById("moreStatusDiv_raw").style.display = "none";
    document.getElementById("moreStatusDiv").style.display = "none";
    document.getElementById('mapDivouter').style.display = 'block';
    document.getElementById('drawer').style.display = 'block';
    document.getElementById("spanStationView").style.color = 'black';
    document.getElementById("spanNeighborhoodView").style.color = '#888888';
}

function showAllStation() {
    document.getElementById("weekenderleftPanel").style.display = "block";
    document.getElementById("inputsearch").value = "Station name";
    $('#list tr').show(); //siva - to clears any search and show all stations
    document.getElementById("inputsearch").className = 'inputsearch';
    document.getElementById("weekenderleftStatus").style.display = "none";
    document.getElementById("mapDivouter").style.display = "inline";
    document.getElementById('diagram').src = 'images/diagram_over.png';
    selectedLeftDiv = 'weekenderleftPanel';
    window.frames["systemMap"].SelectedStationBackToNormalIcon();
    window.frames["systemMap"].selectedStation = '';
}

// Removes leading whitespaces
function LTrim(value) {
    var re = /\s*((\S+\s*)*)/;
    return value.replace(re, "$1");
}

// Removes ending whitespaces
function RTrim(value) {
    var re = /((\s*\S+)*)\s*/;
    return value.replace(re, "$1");
}

// Removes leading and ending whitespaces
function trim(value) {
    return LTrim(RTrim(value));
}

function stationSelect(id, x, y) {
    GetStatusInfoByStation(id);
    recenterMap(x, y);
}
/*function showHideNeighborhoodMap() {
if (document.getElementById("neighborhoodMapDiv").style.display == "inline") {
document.getElementById("neighborhoodMapDiv").style.display = "none"
document.getElementById("spanCityMapview").innerHTML = "City Map View"
}
else {
document.getElementById("neighborhoodMapDiv").style.display = "inline"
document.getElementById("spanCityMapview").innerHTML = "Subway System Diagram"
}
}
function hideNeighborhoodMap() {
document.getElementById("neighborhoodMapDiv").style.display = "none"
}*/