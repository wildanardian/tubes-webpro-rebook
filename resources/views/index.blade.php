@extends('layouts.main')
@section('content')
    <main style="min-height: 50vh; margin: 64px; overflow: hidden; ">
        <div class=" d-flex  justify-content-between border-bottom" style="border-color: #D4D4D4;">
            <h5 class="fw-bold">For You</h5>
            <p class="text-end"><a href="{{ route('restaurants.index') }}">See all</a></p>
        </div>

        <div class="swiper mySwiper d-flex align-items-center justify-content-center mt-4"
            style="max-width: 100%; height: 400px;">
            <div class="slide-container swiper-wrapper">

                @foreach ($restaurants as $res)
                    <div class="card swiper-slide shadow"
                        style="flex: 0 0 auto; width: 230px; height: 330px; border-radius: 20px; cursor: pointer;">
                        <a href="{{ route('restaurants.show', ['id' => $res->id]) }}" class="text-decoration-none text-dark">
                            <div class="image-box position-relative w-100"
                                style="height: 200px; border-radius: 10px 10px 0px 0px; overflow: hidden;">
                                @if ($res->image)
                                    <img src="{{ asset($res->image) }}" alt="" style="background-size: cover">
                                @else
                                    <img src="{{ asset('img/detail.png') }}" alt="" class="w-100 h-100"
                                        style="background-size: cover">
                                @endif
                            </div>
                            <div class="card-details ps-3" style="height: 30%;">
                                <h5 class="fw-bold mt-2">{{ $res->name }}</h5>
                                <p class="fw-light mt-1" style="font-size: 13px; margin-bottom: 5px;">
                                    {{ $res->description }}</p>
                                @php
                                    $averageRating = $res->getReviewAverage();
                                    $rating = floor($averageRating);
                                @endphp
                                
                                <div class="mt-3" style="font-size: 15px;">
                                    @for ($i=1; $i<=5; $i++)
                                        @if($i <= $rating)
                                        <i class="fa-solid fa-star" style="color: #FEDE00;"></i>
                                        @else
                                        <i class="fa-regular fa-star"></i>
                                        @endif
                                    @endfor 
                                    ({{ $averageRating }})</div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </main>
@endsection
