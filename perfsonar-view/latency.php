<!DOCTYPE html>
<html>
<head>
  <title>Latency - Perfsonar View</title>
  <script>

    //String format function from: 
    //http://stackoverflow.com/questions/610406/javascript-equivalent-to-printf-string-format
    if (!String.prototype.format) {
      String.prototype.format = function() {
      var args = arguments;
      return this.replace(/{(\d+)}/g, function(match, number) { 
        return typeof args[number] != 'undefined'
          ? args[number]
          : match;
        });
      };
    }
    var lengths = {
      "4 hours": "14400",
      "12 hours": "43200",
      "1 day": "86400",
      "1 week": "604800"
    };
    var URLS = {
      "IU - UC (iut2-net1.iu.edu <-> uct2-net1.mwt2.org)": "http://iut2-net1.iu.edu/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=192.170.227.160&srcIP=149.165.225.223&dst=uct2-net1.mwt2.org&src=iut2-net1.iu.edu&type=TCP&length={0}&bucket_width=0.001s",
      "UIUC - IU (mwt2-ps01.campuscluster.illinois.edu <-> iut2-net1.iu.edu)": "http://iut2-net1.iu.edu/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=149.165.225.223&srcIP=72.36.96.4&dst=iut2-net1.iu.edu&src=mwt2-ps01.campuscluster.illinois.edu&type=TCP&length={0}&bucket_width=0.001",
      //"IU - CERN (perfsonar-ps2.cern.ch <-> iut2-net1.iu.edu2)": "http://iut2-net1.iu.edu/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=149.165.225.223&srcIP=128.142.223.237&dst=iut2-net1.iu.edu&src=perfsonar-ps2.cern.ch&type=TCP&length={0}&bucket_width=0.001",
      "UIUC - UC (mwt2-ps01.campuscluster.illinois.edu <-> uct2-net1.mwt2.org)": "http://uct2-net1.mwt2.org/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=192.170.227.160&srcIP=72.36.96.4&dst=uct2-net1.mwt2.org&src=mwt2-ps01.campuscluster.illinois.edu&type=TCP&length={0}&bucket_width=0.001",
      "IU - BNL (iut2-net1.iu.edu <-> lhcperfmon.bnl.gov)": "http://lhcperfmon.bnl.gov/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=192.12.15.26&srcIP=149.165.225.223&dst=lhcperfmon.bnl.gov&src=iut2-net1.iu.edu&type=TCP&length={0}&bucket_width=0.001",
      "UC - BNL (uct2-net1.mwt2.org <-> lhcperfmon.bnl.gov)": "http://lhcperfmon.bnl.gov/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=192.12.15.26&srcIP=192.170.227.160&dst=lhcperfmon.bnl.gov&src=uct2-net1.mwt2.org&type=TCP&length={0}&bucket_width=0.001",
      //"UC - CERN (perfsonar-ps2.cern.ch <-> uct2-net1.mwt2.org)": "http://uct2-net1.mwt2.org/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=192.170.227.160&srcIP=128.142.223.237&dst=uct2-net1.mwt2.org&src=perfsonar-ps2.cern.ch&type=TCP&length={0}&bucket_width=0.001",
      //"UIUC - CERN (perfsonar-ps2.cern.ch <-> mwt2-ps01.campuscluster.illinois.edu)": "http://mwt2-ps01.campuscluster.illinois.edu/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=72.36.96.4&srcIP=128.142.223.237&dst=mwt2-ps01.campuscluster.illinois.edu&src=perfsonar-ps2.cern.ch&type=TCP&length={0}&bucket_width=0.001",
      "UIUC - BNL (mwt2-ps01.campuscluster.illinois.edu <-> lhcperfmon.bnl.gov)": "http://mwt2-ps01.campuscluster.illinois.edu/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=192.12.15.26&srcIP=72.36.96.4&dst=lhcperfmon.bnl.gov&src=mwt2-ps01.campuscluster.illinois.edu&type=TCP&length={0}&bucket_width=0.001"
    };
    
    function addFrames() {
      // Add select box options
      var frameContainer = document.getElementById("frameContainer");
      var lengthSelect = document.getElementById("lengthSelect");
      var selectedLength = lengths[lengthSelect[lengthSelect.selectedIndex].text];
      for(var url in URLS) {
      	var ncont = document.createElement("div");
      	ncont.className = "gridFrame";
        var nlabel = document.createElement("p");
        nlabel.innerHTML = "<a href=\""+URLS[url].format(selectedLength)+"\"><b>" + url + "</b></a>";
      	var nel = document.createElement("iframe");
      	nel.src = URLS[url].format(selectedLength);
      	nel.scrolling = "no";

        ncont.appendChild(nel);
        ncont.appendChild(nlabel);
      	frameContainer.appendChild(ncont);
 	    }
    }

    function removeFrames() {
      document.getElementById("frameContainer").innerHTML = "";
    }
  </script>
  <style type="text/css">
    html, body {
      text-align: center;
      margin: auto;
      padding: 25px;
      width: 1800px;
    }/*
    iframe {
      width: 95%;
      height: 85%;
    }*/

    .gridFrame {
    	width: 743px;
    	height: 500px;
    	margin: 25px 15px;
    	display: inline-block;
      overflow: hidden;
      border: 1px dashed #aaa;
    }

    .gridFrame p { 
      position: relative;
      top: -100px;
    }

    .gridFrame iframe {
    	/*width: 100%;
    	height: 100%;*/
      width:  1000px;
      height: 545px;
    	position: relative;
    	left: -247px;
    	top: -80px;
    }
  </style>
</head>
<body>
  <h1 style="margin-bottom:0px;">Latency</h1>
  Time Period: <select id="lengthSelect" onchange="removeFrames();addFrames();">
    <option>4 hours</option>
    <option>12 hours</option>
    <option>1 day</option>
    <option>1 week</option>
  </select>
  <p><a href="./?type=throughput">Switch to Throughput</a></p>
  <br />
  <div id="frameContainer">
  <!--
  <div class="gridFrame">
  	<iframe scrolling="no" src="http://iut2-net1.iu.edu/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&key=3eb0fe8c459271720cc0288f0c15f17c&keyR=b8faa2b1e9aa08d8564956914cf15194&dstIP=192.170.227.160&srcIP=149.165.225.223&dst=uct2-net1.mwt2.org&src=iut2-net1.iu.edu&type=TCP&length=14400&bucket_width=0.001s"></iframe>
  </div> -->
  </div>

  <script>
    addFrames()
  </script>
</body>
</html>
