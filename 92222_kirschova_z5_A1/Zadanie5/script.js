//podla webtech1 - zadanie 6

var sinCoords = {
    x: [],
    y: [],
    mode: 'lines',
    line:{
        color:'rgb(135,27,184)'
    },
    name: 'Sin'
};
var cosCoords = {
    x: [],
    y: [],
    mode: 'lines',
    line:{
        color:'rgb(54,118,255)'
    },
    name: 'Cos'
};
var sinCosCoords = {
    x: [],
    y: [],
    mode: 'lines',
    line:{
        color:'rgb(25,145,36)'
    },
    name: 'Sin*Cos'
};
var src;
var isStopped = false;

function plotGraph() {
    var selectedSin = document.getElementById('sin').checked;
    var selectedCos = document.getElementById('cos').checked;
    var selectedSinCos = document.getElementById('sincos').checked;

    var layout = {
        title: 'Goniometrické funkcie'
    };

    var data = [];

    if (selectedSin || selectedCos || selectedSinCos) {
        if (selectedSin) {
            data.push(sinCoords);
        }
        if (selectedCos) {
            data.push(cosCoords);
        }
        if (selectedSinCos) {
            data.push(sinCosCoords);
        }
    } else {
        data = {x: [], y: []};
    }

    Plotly.newPlot('graph', data, layout);

}


function getCoords(){
    if(typeof(EventSource) == "undefined"){
        document.getElementById("graph").innerHTML = "Not supported";
    }
    else{
        src = new EventSource("generator.php");
        src.addEventListener("message", function(event){
            var receivedData = JSON.parse(event.data);

            sinCoords.x.push(receivedData.x);
            cosCoords.x.push(receivedData.x);
            sinCosCoords.x.push(receivedData.x);
            sinCoords.y.push(receivedData.y1);
            cosCoords.y.push(receivedData.y2);
            sinCosCoords.y.push(receivedData.y3);

            if (!isStopped){
                plotGraph();
            }
        });
    }
}

function stop(){
    isStopped = true;
}

function submitParameter() {
    //podla: w3schools.com/pHP/php_ajax_database.asp
    var a = document.getElementById("parameter").value;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.open("GET","index.php?a="+a,true);
    xmlhttp.send();
}