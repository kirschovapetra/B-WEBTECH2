function loadModal(show,id) {
    if (show) {
        $(id).modal('show');
    }
    else {
        $(id).modal('hide');
    }
}

var customMap;
function addMarker(city,state,lat,lon) {
    L.marker([lat,lon]).addTo(customMap)
        .bindPopup("<b>"+city+" ("+state+")</b>");
}

function createMap(cities){
    var token = 'pk.eyJ1IjoicGV0cmFraXJzY2hvdmEiLCJhIjoiY2s5ZGFoZ3kwMDFjaDNobGd0ejR4OGlnbiJ9.inrfUO-BY3x8B-ZHMuCfFw';
    customMap = L.map('mapid').setView([48.14816, 17.10674], 3);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token='+token, {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(customMap);

    for (var i in cities) {
        addMarker(cities[i].city,cities[i].code,parseFloat(cities[i].lat),parseFloat(cities[i].lon));
    }


}
