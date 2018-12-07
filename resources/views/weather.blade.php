@extends( 'extend.base' )

@section( 'title', 'Weather' )

@section( 'body' )

    <div class="container">

        <div class="row">

            <div class="widget widget-form col-lg-12">

                <h2 class="mt-5">Weather</h2>

                <div class="float-left col-md-4">
                    <h4>Departure</h4>
                    Address/City
                    <input class="form-control" type="text" placeholder="Address/City" id="dep-address">
                    <br> <i>OR</i> <br>
                    Longitude
                    <input class="form-control" type="text" placeholder="longitude" id="dep-lon">
                    Latitude
                    <input class="form-control" type="text" placeholder="latitude" id="dep-lat">
                </div>

                <div class="float-left col-md-4">
                    <h4>Destination</h4>
                    Address/City
                    <input class="form-control" type="text" placeholder="Address/City" id="dest-address">
                    <br> <i>OR</i> <br>
                    Longitude
                    <input class="form-control" type="text" placeholder="longitude" id="dest-lon">
                    Latitude
                    <input class="form-control" type="text" placeholder="latitude" id="dest-lat">
                </div>

                <div>
                    <button class="btn btn-success" id="check">Check weather</button>
                </div>

            </div>

        </div>

        <br>

        <div class="float-left col-md-4" id="results-dep">
            <div class="result-box">
                Departure Weather
                <br><br>
                <b>Dew Point:</b> <span id="dep-result-dew"></span> <br>
                <b>Humidity:</b> <span id="dep-result-humidity"></span> <br>
                <b>Temperature:</b> <span id="dep-result-temperature"></span> <br>
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



        </div>

    </div>


@endsection

@section('javascripts')
    <script src="{!! url('/js/weather.js') !!}"></script>
@endsection