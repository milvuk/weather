$(document).ready(function () {
    $('#check').on('click', checkWeather);

    $('#dep-address').on('keypress', function () {
        $('#dep-lat').val('');
        $('#dep-lon').val('');
    });

    $('#dest-address').on('keypress', function () {
        $('#dest-lat').val('');
        $('#dest-lon').val('');
    });

    $('#dep-lat, #dep-lon').on('keypress', function () {
        $('#dep-address').val('');
    });

    $('#dest-lat, #dest-lon').on('keypress', function () {
        $('#dest-address').val('');
    });

});

function checkWeather() {
    let dep_address = $('#dep-address').val().trim();
    let dep_lat = $('#dep-lat').val().trim();
    let dep_lon = $('#dep-lon').val().trim();
    let dest_address = $('#dest-address').val().trim();
    let dest_lat = $('#dest-lat').val().trim();
    let dest_lon = $('#dest-lon').val().trim();

    $('#check').prop('disabled', true);

    $.ajax({
        url: GLOBAL_URL_BASE + 'ajax/check_weather',
        method: 'GET',
        dataType: 'JSON',
        data: {
            dep_address: dep_address,
            dep_lat: dep_lat,
            dep_lon: dep_lon,
            dest_address: dest_address,
            dest_lat: dest_lat,
            dest_lon: dest_lon
        },
        success: function (data) {
            console.log(data);
            if (data.status === 'ok') {
                $('#dep-lat').val(data.departure.geo.latitude);
                $('#dep-lon').val(data.departure.geo.longitude);

                $('#dest-lat').val(data.destination.geo.latitude);
                $('#dest-lon').val(data.destination.geo.longitude);

                fillMeteoData(data.departure.meteo, 'dep');
                fillMeteoData(data.destination.meteo, 'dest');
            } else if (data.status === 'error') {
                alert(data.message);
            }
            $('#check').prop('disabled', false);
        }
    });
}

function fillMeteoData(meteoData, location) {
    $('#' + location + '-result-dew').text(Math.round(meteoData.dew_point) + '\u00B0');
    $('#' + location + '-result-humidity').text(Math.round(meteoData.humidity) + '%');
    $('#' + location + '-result-temperature').text(meteoData.temperature);
    $('#' + location + '-result-fog').text(Math.round(meteoData.fog));
    $('#' + location + '-result-low-clouds').text(Math.round(meteoData.low_clouds));
    $('#' + location + '-result-medium-clouds').text(Math.round(meteoData.medium_clouds));
    $('#' + location + '-result-high-clouds').text(Math.round(meteoData.high_clouds));
}

