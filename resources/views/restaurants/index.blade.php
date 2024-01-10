@extends('layouts.main')
@section('content')
    <div>
        <div class="row gap-5 p-3 mb-5">
            <div class="col-md-1 ms-5">
                <form action="make_checkbox_select">
                    <select class="select1" name="Restaurant" id="restaurant">
                        <option value="">Restaurant</option>
                        <img src="{{ asset('img/restaurant.png') }}" alt="" srcset="" class="w-100"
                            style="max-width: 30px;">
                        <option value="McDonald"
                            style="background-image: url('restaurant.png'); background-size: 30px 30px;">
                            McDonald</option>
                        <option value="Subway">Subway</option>
                        <option value="Salsabila">Salsabila</option>
                        <option value="KFC">KFC</option>
                        <option value="Steak">HolyCow</option>
                    </select>
                </form>
            </div>
            <div class="col-md-1 ms-5">
                <form action="make_checkbox_select">
                    <select class="select2" name="Location" id="Location">
                        <option value="">Location</option>
                        <option value="bandung">Bandung</option>
                        <option value="jakarta">Jakarta</option>
                        <option value="bogor">Bogor</option>
                        <option value="depok">Depok</option>
                        <option value="bekasi">Bekasi</option>
                    </select>
                </form>
            </div>
            <div class="col-md-2 ms-5">
                <form action="make_checkbox_select">
                    <select class="select3" name="Search" id="Search">
                        <img src="restaurant.png" width="20">
                        <option value="">Search</option>
                        <option value="McDonald">McDonald</option>
                        <option value="Subway">Subway</option>
                        <option value="Salsabila">Salsabila</option>
                        <option value="KFC">KFC</option>
                        <option value="Steak">HolyCow</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col text-center">
            <h5 class="fw-bold">FOR YOU</h5>
            <hr>
            <br>
        </div>
        <div class="row align-items-center text-center justify-content-center">
            @foreach ($restaurants as $resto)
                <div class="card col-md-3 mb-4 text-center border-0 pe-auto" style="width: 17rem">
                    <a href="{{ route('restaurants.show', $resto->id) }}" class="text-decoration-none text-dark">
                        <div class="restaurant-items" data-toggle="card1">
                            @if ($resto->image == null)
                                <img src="{{ asset('img/image-skeleton.png') }}" alt="restaurant-image-default" class="card-img-top">
                            @else
                                <img src="{{ $resto->image }}" alt="restaurant-image" class="card-img-top"
                                    style="background-size: cover">
                            @endif
                            <div class="card-body mt-2">
                                <div class="details-sub">
                                    <h5 class="fw-bold">{{ $resto->name }}</h5>
                                </div>
                                <p>{{ $resto->description }}</p>
                                <div class="stars">
                                    <i class="fa-solid fa-star" style="color: #FEDE00;"></i>
                                    <i class="fa-solid fa-star" style="color: #FEDE00;"></i>
                                    <i class="fa-solid fa-star" style="color: #FEDE00;"></i>
                                    <i class="fa-solid fa-star" style="color: #FEDE00;"></i>
                                    <i class="fa-solid fa-star" style="color: #FEDE00;"></i>
                                    <span class="rating">(5)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection
