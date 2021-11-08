@extends('layouts.app')

@section('content')
        <div class="wrapper">
            <div class="title">
                <h1>C2-CodeCamp praktijk opdracht</h1>
            </div>
            <div class="gridwrapper">
                <div class="contact">
                    <h3>Contact Us</h3>
                    <p>Telefoonnummer: 076-80934847</p>
                    <p>Addres: Koestraat 1 Den Bosch</p>
                    
                    <div id="googleMap" style="width:75%;height:400px;"></div>  

                    <script>
                        function myMap() {
                        var mapProp= {
                        center:new google.maps.LatLng(51.6973624,5.2914112),
                        zoom:17,
                        };
                        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                        new google.maps.Marker({
                        position: {lat: 51.6973624, lng: 5.2914112},
                        map,
                        title: "Hello World!",
                        });
                        }


                    </script>
                    
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuUMx5QRvBmNC5Dv3o1Jqr0UlxRn8xyuw&callback=myMap"></script>
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
