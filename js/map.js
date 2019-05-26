// fonction openStreetMap
if(document.getElementById('map')!=null){
    var mymap = L.map('map').setView([47.9003731, 1.9090707], 13);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiZW5naGF6YXIiLCJhIjoiY2pxaHJsNGJ3MDc2cjN4cG9jcWJ3aGF5dSJ9.Z8jjJfV6dkobuY-ZdbcaCg'
    }).addTo(mymap);

    var marker = L.marker([47.9003731, 1.9090707]).addTo(mymap);
    marker.bindPopup("<b>Närenj</b>").openPopup();
}