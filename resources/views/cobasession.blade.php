<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Location in Session</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Get User Location</h1>
    <button id="get-location">Get Location</button>
    <p id="location-result"></p>
    @if(session('latitude') && session('longitude'))
    <p>Latitude: {{ session('latitude') }}</p>
    <p>Longitude: {{ session('longitude') }}</p>
    @endif


    <script>
        document.getElementById('get-location').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                document.getElementById('location-result').innerHTML = "Geolocation is not supported by this browser.";
            }
        });

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            document.getElementById('location-result').innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;

            // Kirim data ke server untuk disimpan dalam session
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
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    document.getElementById('location-result').innerHTML = "User denied the request for Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    document.getElementById('location-result').innerHTML = "Location information is unavailable.";
                    break;
                case error.TIMEOUT:
                    document.getElementById('location-result').innerHTML = "The request to get user location timed out.";
                    break;
                case error.UNKNOWN_ERROR:
                    document.getElementById('location-result').innerHTML = "An unknown error occurred.";
                    break;
            }
        }
    </script>
</body>
</html>
