@extends('layouts.main')
@section('content')
    <div class="mt-5" style="margin: 0 64px">
        <div class="row gap-4 gap-lg-0">
            <div class="col-12 col-lg-5">
                @if($restaurant->image == null)
                    <img class="rounded-3" src="{{ asset('img/detail.png') }}" alt="restaurant-image" width="100%"> 
                @else
                    <img class="rounded-3" src="{{ asset($restaurant->image) }}" alt="restaurant-image" width="100%">
                @endif
            </div>
            <div class="col-12 col-lg-7 px-lg-5">
                <div>
                    <h4 class="fw-bold fs-2">{{ $restaurant->name }}</h4>
                    <p class="text-sm text-muted" style="text-align: justify;">
                        {{ $restaurant->description }}
                    </p>
                </div>

                <div class="mb-3">
                    <h5 class="fw-bold mb-3">Reviews</h5>
                    <div class="card shadow p-4">
                        <h5 class="fw-bold">Jane Doe</h5>
                        <p class="text-muted mb-3">
                            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum."
                        </p>
                        ⭐️⭐️⭐️⭐️⭐️ (5)
                    </div>
                </div>

                {{-- <div class="container bg-body-tertiary border border-dark-subtle rounded-3 mt-5 pt-3 pb-3">
                    <form>
                        <h5 class="fw-bold mb-3">Add Your Review</h5>
                        <div class="rating d-flex justify-content-center gap-3 mb-3">
                            <span class="star fa-regular fa-star" data-value="1"></span>
                            <span class="star fa-regular fa-star" data-value="2"></span>
                            <span class="star fa-regular fa-star" data-value="3"></span>
                            <span class="star fa-regular fa-star" data-value="4"></span>
                            <span class="star fa-regular fa-star" data-value="5"></span>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                style="height: 100px; resize: none;"></textarea>
                            <label for="floatingTextarea2">Describe your experience</label>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary btn-lg mt-3" type="submit">Add Review</button>
                            </div>
                        </div>
                    </form>
                </div> --}}
            </div>
        </div>
    @endsection
