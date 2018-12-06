@extends( 'extend.base' )

@section( 'title', 'Weather' )

@section( 'body' )

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <h1 class="mt-5">Weather</h1>

                <div>
                    Departure <input type="text" placeholder="Address/City" id="dep-address">
                    Longitude <input type="text" placeholder="longitude" id="dep-lon">
                    Latitude <input type="text" placeholder="latitude" id="dep-lat">
                </div>

                <br>

                <div>
                    Destination <input type="text" placeholder="Address/City" id="dest-address">
                    Longitude <input type="text" placeholder="longitude" id="dest-lon">
                    Latitude <input type="text" placeholder="latitude" id="dest-lat">
                </div>

                <button class="btn btn-success">Check weather</button>

            </div>

        </div>

        <div class="row" id="results">



        </div>

    </div>


@endsection