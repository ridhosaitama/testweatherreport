
const get = document.getElementById('get-location');
const result = document.getElementById('location-result');

get.addEventListener('click', function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        result.innerHTML = "Geolocation is not supported by this browser.";
    }
});

function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    result.innerHTML = "Latitude: " + latitude + "<br> Longitude: " + longitude;

    // Kirim data ke server
    fetch('/store-location', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ latitude: latitude, longitude: longitude })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => console.error('Error:', error));
    alert("Berhasil Mendapatkan Lokasi");
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            result.innerHTML = "User denied the request for Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
            result.innerHTML = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
            result.innerHTML = "The request to get user location timed out.";
            break;
        case error.UNKNOWN_ERROR:
            result.innerHTML = "An unknown error occurred.";
            break;
    }
}

function showWeather(){
    document.getElementById('show-weather').innerHTML = "Latitude: " + latitude + " & Longitude: " + longitude;

}
