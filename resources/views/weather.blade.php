@extends( 'extend.base' )

@section( 'title', 'Weather' )

@section( 'body' )

    <div class="container">

        <div class="row">

            <div class="widget widget-form col-lg-12">

                <h2 class="mt-5">Weather</h2>

                <div class="float-left col-md-4 input-box">
                    <h4>Departure</h4>
                    <label><input type="radio" name="dep-address-or-latlon" value="address" checked> Address/City</label>
                    <input class="form-control" type="text" placeholder="Address/City" id="dep-address">
                    <br> <label><input type="radio" name="dep-address-or-latlon" value="latlon"> Geo coordinates</label> <br>
                    Latitude
                    <input class="form-control" type="text" placeholder="latitude" id="dep-lat" disabled>
                    Longitude
                    <input class="form-control" type="text" placeholder="longitude" id="dep-lon" disabled>
                </div>

                <div class="float-left col-md-4 input-box">
                    <h4>Destination</h4>
                    <label><input type="radio" name="dest-address-or-latlon" value="address" checked> Address/City</label>
                    <input class="form-control" type="text" placeholder="Address/City" id="dest-address">
                    <br> <label><input type="radio" name="dest-address-or-latlon" value="latlon"> Geo coordinates</label> <br>
                    Latitude
                    <input class="form-control" type="text" placeholder="latitude" id="dest-lat" disabled>
                    Longitude
                    <input class="form-control" type="text" placeholder="longitude" id="dest-lon" disabled>
                </div>

                <div>
                    <button class="btn btn-success" id="check">Check weather</button>
                </div>

            </div>

        </div>

        <br>

        <div id="results-container">

        <div class="float-left col-md-4" id="results-dep">
            <div class="result-box">
                Departure Weather
                <br><br>
                <b>Dew Point:</b> <span id="dep-result-dew"></span> <br>
                <b>Humidity:</b> <span id="dep-result-humidity"></span> <br>
                <b>Temperature:</b> <span id="dep-result-temperature"></span> <br>
            </div>

            <div class="display-box">
                <div class="display-box-top"><div class="top-box-result"><span id="dep-result-fog"></span>%</div>Fog</div>
                <div class="display-box-top"><div class="top-box-result"><span id="dep-result-low-clouds"></span>%</div>Low<br>Clouds</div>
                <div class="display-box-top"><div class="top-box-result"><span id="dep-result-medium-clouds"></span>%</div>Medium<br>Clouds</div>
                <div class="display-box-top"><div class="top-box-result"><span id="dep-result-high-clouds"></span>%</div>High<br>Clouds</div>
                <div class="clearfix"></div>
                <div class="display-box-bottom"><div class="weather-symbol"><img src="{!! url('images/sun.png') !!}" width="100%" id="dep-symbol"></div></div>
                <div class="display-box-bottom"><div class="low-cloud"><img src="{!! url('images/cloud.png') !!}" width="100%" id="dep-low-cloud-img"></div></div>
                <div class="display-box-bottom"><div class="medium-cloud"><img src="{!! url('images/cloud.png') !!}" width="100%" id="dep-medium-cloud-img"></div></div>
                <div class="display-box-bottom"><div class="high-cloud"><img src="{!! url('images/cloud.png') !!}" width="100%" id="dep-high-cloud-img"></div></div>
            </div>

        </div>

        <div class="float-left col-md-4" id="results-dest">
            <div class="result-box">
                Destination Weather
                <br><br>
                <b>Dew Point:</b> <span id="dest-result-dew"></span> <br>
                <b>Humidity:</b> <span id="dest-result-humidity"></span> <br>
                <b>Temperature:</b> <span id="dest-result-temperature"></span> <br>
            </div>

            <div class="display-box">
                <div class="display-box-top"><div class="top-box-result"><span id="dest-result-fog"></span>%</div>Fog</div>
                <div class="display-box-top"><div class="top-box-result"><span id="dest-result-low-clouds"></span>%</div>Low<br>Clouds</div>
                <div class="display-box-top"><div class="top-box-result"><span id="dest-result-medium-clouds"></span>%</div>Medium<br>Clouds</div>
                <div class="display-box-top"><div class="top-box-result"><span id="dest-result-high-clouds"></span>%</div>High<br>Clouds</div>
                <div class="clearfix"></div>
                <div class="display-box-bottom"><div class="weather-symbol"><img src="{!! url('images/sun.png') !!}" width="100%" id="dest-symbol"></div></div>
                <div class="display-box-bottom"><div class="low-cloud"><img src="{!! url('images/cloud.png') !!}" width="100%" id="dest-low-cloud-img"></div></div>
                <div class="display-box-bottom"><div class="medium-cloud"><img src="{!! url('images/cloud.png') !!}" width="100%" id="dest-medium-cloud-img"></div></div>
                <div class="display-box-bottom"><div class="high-cloud"><img src="{!! url('images/cloud.png') !!}" width="100%" id="dest-high-cloud-img"></div></div>
            </div>

        </div>

        </div>

    </div>


@endsection

@section('javascripts')
    <script src="{!! url('/js/weather.js') !!}"></script>
@endsection