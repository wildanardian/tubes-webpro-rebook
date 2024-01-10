@extends('layouts.main')
@section('content')
    <div class="mt-5" style="margin: 0 64px">
        <div class="row gap-4 gap-lg-0">
            <div class="col-12 col-lg-4">
                @if ($restaurant->image)
                    <img src="{{ asset($restaurant->image) }}" alt="Restaurant Image" class="img-fluid rounded-3">
                @else
                    <img src="{{ asset('img/real.jpg') }}" alt="Restaurant Image" class="img-fluid rounded-3">
                @endif
            </div>
            <div class="col-12 col-lg-8 px-lg-5">
                <div>
                    <h4 class="fw-bold fs-2">{{ $restaurant->name }}</h4>
                    <p class="text-sm text-muted" style="text-align: justify;">
                        {{ $restaurant->description }}
                    </p>
                </div>

                <hr>

                <form action="{{ route('booking.store') }}" method="post">
                    @csrf
                    <div class="selection mb-4">
                        <h5 class="fw-bold mb-3">Schedule</h5>
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                        <div class="row mb-3">
                            @foreach ($days as $day)
                                <div class="col" style="width: 30px">
                                    <input type="checkbox" class="btn-check-day" id="btn-{{ $day }}"
                                        autocomplete="off" value="{{ $day }}" name="booking_day" hidden>
                                    <label class="btn btn-outline-secondary w-100 btn-day" for="btn-{{ $day }}">
                                        @if (count($days) <= 5)
                                            {{ $day }}
                                        @else
                                            {{ substr($day, 0, 3) }}
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="row mb-3">
                            @foreach ($time_category as $time)
                                <div class="col">
                                    <input type="checkbox" class="btn-check-time" id="btn-{{ $time }}"
                                        autocomplete="off" value="{{ $time }}" name="booking_time" hidden>
                                    <label class="btn btn-outline-secondary w-100 btn-time"
                                        for="btn-{{ $time }}">{{ $time }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input type="checkbox" class="btn-check" id="btn-check-2-seat" autocomplete="off"
                                    name="booking_seat" value="2_seat">
                                <label class="btn btn-outline-secondary w-100 btn-seat" for="btn-check-2-seat">2
                                    Seat</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" class="btn-check" id="btn-check-family-seat" autocomplete="off"
                                    name="booking_seat" value="family_seat">
                                <label class="btn btn-outline-secondary w-100 btn-seat" for="btn-check-family-seat">Family
                                    Seat</label>
                            </div>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary btn-lg w-100" value="Book Now"
                        {{ in_array($restaurant->id, $restaurant_user_id->toArray()) ? 'disabled' : '' }}>
                </form>

                <hr class="mt-5">

                <div class="mb-3">
                    <h5 class="fw-bold mb-3">Reviews</h5>

                    @if (count($reviews) == 0)
                        <div class="text-center">
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <img src="{{ asset('img/error-warning.png') }}" alt="error" aria-label="Error"
                                    style="width: 30px" class="me-2">
                                There are no reviews yet.
                            </div>
                        </div>
                    @else
                        @foreach ($reviews as $re)
                            <div class="card shadow p-4 mb-3">
                                <h5 class="fw-bold">{{ $name }}</h5>
                                <p class="text-muted mb-3">
                                    {{ $re->review }}
                                </p>
                                @php
                                    $rating = $re->rating;
                                @endphp

                                @for ($i = 1; $i <= $rating; $i++)
                                    @if ($i <= 5)
                                        ⭐️
                                    @endif
                                @endfor

                                ({{ $re->rating }})
                            </div>
                        @endforeach
                    @endif
                </div>

                @if (!in_array($restaurant->id, $restaurant_user_id->toArray()))
                    <div class="container bg-body-tertiary border border-dark-subtle rounded-3 mt-5 pt-3 pb-3">
                        <form action="{{ route('review.store') }}" method="POST">
                            @csrf
                            <h5 class="fw-bold mb-3">Add Your Review</h5>
                            <div class="rating d-flex justify-content-center gap-3 mb-3">
                                <span class="star fa-regular fa-star" data-value="1"></span>
                                <span class="star fa-regular fa-star" data-value="2"></span>
                                <span class="star fa-regular fa-star" data-value="3"></span>
                                <span class="star fa-regular fa-star" data-value="4"></span>
                                <span class="star fa-regular fa-star" data-value="5"></span>
                            </div>
                            <input type="hidden" name="rating_input" id="rating_input" value="">
                            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="review"
                                    style="height: 100px; resize: none;"></textarea>
                                <label for="floatingTextarea2">Describe your experience</label>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary btn-md mt-3" type="submit">Add Review</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
