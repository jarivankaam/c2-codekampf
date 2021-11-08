@extends('layouts.app')

@section('content')
        <div class="wrapper">
            <div class="title">
                <h1>CodeCamp</h1>
            </div>
            <div class="gridwrapper">
                <div class="contact">
                    <h3>Contact Us</h3>
                    <p>Telefoonnummer: 076-80934847</p>
                    <p>Addres: Koestraat 1 Den Bosch</p>

                    <div id="map" style="width:75%;height:400px;"></div>
                    <script>
                        mapboxgl.accessToken = 'pk.eyJ1IjoiZmFhYjAwN25sIiwiYSI6ImNrMDFkMHh3ejF0dGQzbXBreWQ2d2hkeG0ifQ.F2URKD0piukSb90e47KQVw';
                        let map = new mapboxgl.Map({
                            container: 'map',
                            style: 'mapbox://styles/mapbox/streets-v11',
                            center: [5.293600, 51.697400],
                            zoom: 18,
                        });
                        map.addControl(new mapboxgl.NavigationControl());
                        map.addControl(new mapboxgl.GeolocateControl({
                            positionOptions: {
                                enableHighAccuracy: true
                            },
                            trackUserLocation: true,
                            showUserHeading: true
                        }));
                        let marker = new mapboxgl.Marker()
                            .setLngLat([5.293600, 51.697400])
                            .addTo(map);
                    </script>
                </div>
                <div class="about">
                    <h3>About us</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur assumenda debitis, delectus esse facere fugit impedit mollitia quibusdam ullam veritatis. Ad consequatur cum expedita facilis magnam maxime pariatur reiciendis sapiente.</p>

                </div>
                <div class="time">
                    <h3>Datum en tijd:</h3>
                    <p id="time-el"></p>

                </div>
            </div>
        </div>
@endsection
