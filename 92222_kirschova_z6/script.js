var nameEndpoint = "http://147.175.121.210:8056/zad6/rest/api/names";
var dateEndpoint = "http://147.175.121.210:8056/zad6/rest/api/dates";
var otherEndpoint = "http://147.175.121.210:8056/zad6/rest/api/other";
var insertEndpoint = "http://147.175.121.210:8056/zad6/rest/api/insert";

//hladanie mena podla datumu
function getName() {

    var stateSelect = document.getElementById("stateSelect");
    var stateInput = stateSelect.options[stateSelect.selectedIndex].value;
    var dateInput=formatDate(document.getElementById("dateInput").value);

    //ked nie su vyplnene parametre, nacitaju sa vsetky data
    if (dateInput==="" && stateInput==="") {
        getAll("name");
        return;
    }

    var url = nameEndpoint+"?dateInput="+dateInput+"&stateInput="+stateInput;
    var xmlhttp = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

    xmlhttp.onreadystatechange = function(){

        document.getElementById("name-output").innerHTML = "";
        var elements = [];

        if (xmlhttp.responseText!=="" && isValidJSONString(xmlhttp.responseText)) {
            var jsonData = JSON.parse(xmlhttp.responseText);

            //uklada sa datum, stat, meno
            for (var i in jsonData) {
                elements.push([splitDate(jsonData[i].date),jsonData[i].state,jsonData[i].name]);
            }

            //vypis
            for (var i in elements) {
                if (elements[i][2] != null) {
                    document.getElementById("name-output").innerHTML += "<b>"+elements[i][2] + "</b> (" +elements[i][0]  + " " + elements[i][1] + ")<br>";

                }
            }
        }
    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//hladanie datumu podla mena
function getDate() {
    var nameInput = document.getElementById("nameInput").value;
    var stateSelect = document.getElementById("stateSelect");
    var stateInput = stateSelect.options[stateSelect.selectedIndex].value;

    //ked nie su vyplnene parametre, nacitaju sa vsetky data
    if (nameInput==="" && stateInput==="") {
        getAll("date");
        return;
    }

    var url = dateEndpoint+"?nameInput="+nameInput+"&stateInput="+stateInput;
    var xmlhttp = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

    xmlhttp.onreadystatechange = function(){

        document.getElementById("date-output").innerHTML = "";
        var elements = [];

        if (xmlhttp.responseText!=="" && isValidJSONString(xmlhttp.responseText)) {
            var jsonData = JSON.parse(xmlhttp.responseText);

            //uklada sa datum, stat a meno
            for (var i in jsonData) {
                elements.push([splitDate(jsonData[i].date),jsonData[i].state, jsonData[i].name]);
            }

            //vypis
            for (var i in elements) {
                if (elements[i][2] != null) {
                    document.getElementById("date-output").innerHTML += "<b>"+elements[i][0] + "</b> (" +elements[i][1]  + " " + elements[i][2] + ")<br>";

                }
            }
        }
    };

    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//ziskanie sviatkov / pamatnych dni
function getOther(parameter,tagName, id){
    var url = otherEndpoint+"?"+parameter;
    var elements = [];

    var xmlhttp = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

    xmlhttp.onreadystatechange = function(){
        document.getElementById(id).innerHTML = "";

        if (xmlhttp.responseText!=="") {
            var jsonData = JSON.parse(xmlhttp.responseText);
            for (var i in jsonData) {
                var data;
                switch (tagName) { //podla tagu sa urci, ktore data sa budu citat
                    case "SKsviatky":
                        data = jsonData[i].SKsviatky;
                        break;
                    case "CZsviatky":
                        data = jsonData[i].CZsviatky;
                        break;
                    case "SKdni":
                        data = jsonData[i].SKdni;
                        break;
                }

                elements[splitDate(jsonData[i].date)] = data;
            }
            //vypis
            for (var i in elements) {
                document.getElementById(id).innerHTML += i + " <b>" + elements[i] + "</b><br>";
            }
        }
    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();

}

//nacitanie vsetkych dat - ak neboli vyplnene ziadne parametre
function getAll(type) {

    var url = (type==="name")? nameEndpoint : dateEndpoint;
    var elements = [];
    var xmlhttp = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

    xmlhttp.onreadystatechange = function(){
        document.getElementById(type+"-output").innerHTML = "";

        if (xmlhttp.responseText!=="" && isValidJSONString(xmlhttp.responseText)) {

            var jsonData = JSON.parse(xmlhttp.responseText);
            for (var i in jsonData) {
                elements[splitDate(jsonData[i].date)] = jsonData[i].currentNames; //ku kazdemu datumu priradene pole mien a statov
            }

            for (var date in elements) {
                //vypis datumu
                document.getElementById(type+"-output").innerHTML += "<b>"+date+"</b><br>";

                for (var i in elements[date]) {
                    if (elements[date][i].name !== null)
                        //vypis statu a mena
                        document.getElementById(type+"-output").innerHTML += elements[date][i].state +": " + elements[date][i].name+"<br>";
                }

                document.getElementById(type+"-output").innerHTML += "<br>";
            }
        }
    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//vlozenie mena
function insertName() {

    var nameInput = document.getElementById("nameInput").value;
    var dateInput = formatDate(document.getElementById("dateInput").value);

    if (nameInput === "" || dateInput === "") {
        document.getElementById("insert-output").innerHTML = "Nie je vyplnené meno alebo dátum!";
        return;
    }
    var xmlhttp = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var msg;

    xmlhttp.onreadystatechange = function(){
        document.getElementById("insert-output").innerHTML = "";
        if (xmlhttp.responseText!=="") {
            var jsonData = JSON.parse(xmlhttp.responseText);
            msg = jsonData.message; //sprava o uspesnom/neuspesnom vlozeni mena
            document.getElementById("insert-output").innerHTML += msg;
        }
    };
    xmlhttp.open("POST",insertEndpoint,true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("dateInput="+dateInput+"&nameInput="+nameInput);
}


function formatDate(date) {
    var newDate = date.toString();

    newDate = newDate.substr(5,date.length);
    newDate = newDate.replace("-","");

    return newDate;
}

function splitDate(date) {
    var day = date.substr(2,date.length);
    var month = date.substr(0,2);
    return day+"."+month+".";
}

function isValidJSONString(str) {
    //https://codeblogmoney.com/validate-json-string-using-javascript/
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

