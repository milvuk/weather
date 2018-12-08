$(document).ready(function () {
    $('#check').on('click', checkWeather);

    $('input[type=radio][name=dep-address-or-latlon]').change(function () {
        let depCoordinateInputs = $('#dep-lat, #dep-lon');
        let depAddressInput = $('#dep-address');

        if (this.value === 'address') {
            depCoordinateInputs.val('');
            depCoordinateInputs.prop('disabled', true);
            depAddressInput.prop('disabled', false);
        }
        else if (this.value === 'latlon') {
            depAddressInput.val('');
            depAddressInput.prop('disabled', true);
            depCoordinateInputs.prop('disabled', false);
        }
    });

    $('input[type=radio][name=dest-address-or-latlon]').change(function () {
        let destCoordinateInputs = $('#dest-lat, #dest-lon');
        let destAddressInput = $('#dest-address');

        if (this.value === 'address') {
            destCoordinateInputs.val('');
            destCoordinateInputs.prop('disabled', true);
            destAddressInput.prop('disabled', false);
        }
        else if (this.value === 'latlon') {
            destAddressInput.val('');
            destAddressInput.prop('disabled', true);
            destCoordinateInputs.prop('disabled', false);
        }
    });

});

function checkWeather() {
    let dep_address = '';
    let dep_lat = '';
    let dep_lon = '';
    let dest_address = '';
    let dest_lat = '';
    let dest_lon = '';

    let dep_method = $('input[name=dep-address-or-latlon]:checked').val();
    let dest_method = $('input[name=dest-address-or-latlon]:checked').val();

    if (dep_method === 'address') {
        dep_address = $('#dep-address').val().trim();
    } else if (dep_method === 'latlon') {
        dep_lat = $('#dep-lat').val().trim();
        dep_lon = $('#dep-lon').val().trim();
    }

    if (dest_method === 'address') {
        dest_address = $('#dest-address').val().trim();
    } else if (dest_method === 'latlon') {
        dest_lat = $('#dest-lat').val().trim();
        dest_lon = $('#dest-lon').val().trim();
    }

    let checkButton = $('#check');
    let resultsContainer = $('#results-container');

    checkButton.prop('disabled', true);
    checkButton.text('Checking...');
    resultsContainer.fadeOut();

    $.ajax({
        url: GLOBAL_URL_BASE + 'ajax/check_weather',
        method: 'GET',
        dataType: 'JSON',
        data: {
            dep_address: dep_address,
            dep_lat: dep_lat,
            dep_lon: dep_lon,
            dep_method: dep_method,
            dest_address: dest_address,
            dest_lat: dest_lat,
            dest_lon: dest_lon,
            dest_method: dest_method
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
                resultsContainer.fadeIn();
            } else if (data.status === 'error') {
                alert(data.message);
            }
            checkButton.text('Check weather');
            checkButton.prop('disabled', false);
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

    drawClouds(meteoData, location);
    drawWeatherSymbol(meteoData, location);
}

function drawClouds(meteoData, location) {
    let lowCloudPerc = Math.round(meteoData.low_clouds);
    let mediumCloudPerc = Math.round(meteoData.medium_clouds);
    let highCloudPerc = Math.round(meteoData.high_clouds);

    let lowCloudSelector = $('#' + location + '-low-cloud-img');
    let mediumCloudSelector = $('#' + location + '-medium-cloud-img');
    let highCloudSelector = $('#' + location + '-high-cloud-img');

    changeCloudOpacity(lowCloudSelector, lowCloudPerc);
    changeCloudOpacity(mediumCloudSelector, mediumCloudPerc);
    changeCloudOpacity(highCloudSelector, highCloudPerc);
}

function changeCloudOpacity(selector, cloudPercentage) {
    if (cloudPercentage >= 20 && cloudPercentage < 50) {
        selector.attr('style', 'opacity: 0.5');
    } else if (cloudPercentage >= 50) {
        selector.attr('style', 'opacity: 1');
    } else {
        selector.attr('style', 'opacity: 0');
    }
}

function drawWeatherSymbol(meteoData, location) {
    let selector = $('#' + location + '-symbol');
    let image = '';

    switch (meteoData.symbol) {
        case 'Sun':
            image = 'sun.png';
            break;
        case 'Cloud':
            image = 'cloud.png';
            break;
        case 'Rain':
        case 'HeavyRain':
            image = 'rain.png';
            break;
        case 'Snow':
        case 'HeavySnow':
            image = 'snow.png';
            break;
        case 'LightRain':
        case 'RainSun':
        case 'LightRainSun':
            image = 'light_rain.png';
            break;
        case 'LightSnow':
        case 'SnowSun':
        case 'LightSnowSun':
            image = 'light_snow.png';
            break;
        case 'Fog':
            image = 'fog.png';
            break;
        case 'Drizzle':
            image = 'drizzle.png';
            break;
        case 'PartlyCloud':
        case 'LightCloud':
            image = 'partly_cloud.png';
            break;
        default:
            image = 'sun.png';
            break;
    }

    selector.attr('src', GLOBAL_URL_BASE + 'images/' + image);
}

