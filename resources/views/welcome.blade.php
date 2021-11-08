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

                    <img src="{{ asset('img/koestraat.png') }}" alt="plattegrond">
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
