@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">Upload KML File</div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @if (session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif

                                <form action="{{ route('kmls.post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="kml">KML</label>
                                        <input class="form-control form-control-file @error('kml') is-invalid @enderror"
                                            type="file" name="kml" id="kml">
                                        @error('kml')
                                            <label class="invalid-feedback">{{ $message }}</label>
                                        @enderror
                                    </div>

                                    <div class="w-100 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="map" style="min-height: 300px"></div>
                <div id="capture" style="min-height: 300px"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASaYOTeTzqLgCjo8AV4h1djDyJWZGxnEw"></script>

    <script>
        // const url = "{{ Storage::url('kmls/cta.kml') }}";
        // console.log(url);

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 11,
                center: {
                    lat: 40.737613233694525,
                    lng: -73.9919798361891
                },
                // 40.737613233694525, -73.9919798361891
            });
            const ctaLayer = new google.maps.KmlLayer({
                // url: "https://googlearchive.github.io/js-v2-samples/ggeoxml/cta.kml",
                url: 'https://laraveltesttenancy.s3.eu-central-1.amazonaws.com/5GnLtRA7evmSoLMp.kml',
                map,
            });
        }

        // function initMap() {
            // const src = 'https://developers.google.com/maps/documentation/javascript/examples/kml/westcampus.kml';
            // const src = "{{ Storage::url('kmls/cta.kml') }}";
            // console.log(src);
            // const map = new google.maps.Map(document.getElementById('map'), {
            //     center: new google.maps.LatLng(-19.257753, 146.823688),
            //     zoom: 2,
            //     mapTypeId: 'terrain'
            // });

            // var kmlLayer = new google.maps.KmlLayer(src, {
            //     suppressInfoWindows: true,
            //     preserveViewport: false,
            //     map: map
            // });
            // kmlLayer.addListener('click', function(event) {
            //     var content = event.featureData.infoWindowHtml;
            //     var testimonial = document.getElementById('capture');
            //     testimonial.innerHTML = content;
            // });
        // }

        initMap();
    </script>
@endsection
