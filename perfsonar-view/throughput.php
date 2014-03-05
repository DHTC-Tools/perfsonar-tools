<!DOCTYPE html>
<html>
<head>
  <title>Throughput - Perfsonar View</title>
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
      "1 month": "2592000",
      "3 months": "7776000"
    };
    var URLS = {
      "UC - IU (uct2-net2.mwt2.org <-> iut2-net2.iu.edu)": "http://iut2-net2.iu.edu/serviceTest/bandwidthGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=149.165.225.224&srcIP=192.170.227.162&dst=iut2-net2.iu.edu&src=uct2-net2.mwt2.org&type=TCP&length={0}",
      "IU - UIUC (iut2-net2.iu.edu <-> mwt2-ps02.campuscluster.illinois.edu)": "http://iut2-net2.iu.edu/serviceTest/bandwidthGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=72.36.96.9&srcIP=149.165.225.224&dst=mwt2-ps02.campuscluster.illinois.edu&src=iut2-net2.iu.edu&type=TCP&length={0}",
      //"IU - CERN (perfsonar-ps.cern.ch <-> iut2-net2.iu.edu)": "http://iut2-net2.iu.edu/serviceTest/bandwidthGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=149.165.225.224&srcIP=128.142.223.236&dst=iut2-net2.iu.edu&src=perfsonar-ps.cern.ch&type=TCP&length={0}",
      "UC - UIUC (uct2-net2.mwt2.org <-> mwt2-ps02.campuscluster.illinois.edu)": "http://mwt2-ps02.campuscluster.illinois.edu/serviceTest/bandwidthGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=72.36.96.9&srcIP=192.170.227.162&dst=mwt2-ps02.campuscluster.illinois.edu&src=uct2-net2.mwt2.org&type=TCP&length={0}",
      "IU - BNL (iut2-net2.iu.edu <-> lhcmon.bnl.gov)": "http://iut2-net2.iu.edu/serviceTest/bandwidthGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=192.12.15.23&srcIP=149.165.225.224&dst=lhcmon.bnl.gov&src=iut2-net2.iu.edu&type=TCP&length={0}",
      "UC - BNL (uct2-net2.mwt2.org <-> lhcmon.bnl.gov)": "http://uct2-net2.mwt2.org/serviceTest/bandwidthGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=192.12.15.23&srcIP=192.170.227.162&dst=lhcmon.bnl.gov&src=uct2-net2.mwt2.org&type=TCP&length={0}",
      //"UC - CERN (uct2-net2.mwt2.org <-> perfsonar-ps.cern.ch)": "http://uct2-net2.mwt2.org/serviceTest/bandwidthGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=128.142.223.236&srcIP=192.170.227.162&dst=perfsonar-ps.cern.ch&src=uct2-net2.mwt2.org&type=TCP&length={0}",
      //"UIUC - CERN (mwt2-ps02.campuscluster.illinois.edu <-> perfsonar-ps.cern.ch)": "http://mwt2-ps02.campuscluster.illinois.edu/serviceTest/bandwidthGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=128.142.223.236&srcIP=72.36.96.9&dst=perfsonar-ps.cern.ch&src=mwt2-ps02.campuscluster.illinois.edu&type=TCP&length={0}",
      "UIUC - BNL (mwt2-ps02.campuscluster.illinois.edu <-> lhcmon.bnl.gov)": "http://mwt2-ps02.campuscluster.illinois.edu/serviceTest/bandwidthGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&dstIP=192.12.15.23&srcIP=72.36.96.9&dst=lhcmon.bnl.gov&src=mwt2-ps02.campuscluster.illinois.edu&type=TCP&length={0}"
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
      width: 720px;
      height: 345px;
      margin: 25px 15px;
      display: inline-block;
      overflow: hidden;
      border: 1px dashed #aaa;
    }

    .gridFrame p { 
      position: relative;
      top: -150px;
    }

    .gridFrame iframe {
      /*width: 100%;
      height: 100%;*/
      width:  1000px;
      height: 432px;
      position: relative;
      left: -210px;
      top: -140px;
    }
  </style>
</head>
<body>
  <h1 style="margin-bottom:0px;">Throughput</h1>
  Time Period: <select id="lengthSelect" onchange="removeFrames();addFrames();">
    <option>1 month</option>
    <option>3 months</option>
  </select>
  <p><a href="./?type=latency">Switch to Latency</a></p>
  <!--<select id="pageSelector">
  </select>
  <button onClick="goButton()">Go</button>
  <iframe id="graphFrame" src=""></iframe>-->
  <br />
  <div id="frameContainer">
  <!--
  <div class="gridFrame">
  	<iframe scrolling="no" src="http://iut2-net2.iu.edu/serviceTest/delayGraph.cgi?url=http://localhost:8085/perfSONAR_PS/services/pSB&key=3eb0fe8c459271720cc0288f0c15f17c&keyR=b8faa2b1e9aa08d8564956914cf15194&dstIP=192.170.227.160&srcIP=149.165.225.223&dst=uct2-net1.mwt2.org&src=iut2-net2.iu.edu&type=TCP&length=14400&bucket_width=0.001s"></iframe>
  </div> -->
  </div>

  <script>
    addFrames()
  </script>
</body>
</html>
