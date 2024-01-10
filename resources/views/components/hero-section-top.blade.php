<section class="hero position-relative mt-5">
    <img src="{{ asset('img/hero.png') }}" width="100%" alt="">

    <div class="position-absolute top-0 left-0 text-center text-white h-100">
        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
            <h1 class="fw-light">
                Booking your Seat Effortlessly with Ease
            </h1>

            <a href="{{ route('restaurants.index') }}">
                <button class="btn btn-light fw-light mt-2" style="color: #D17642">
                    See restaurant near me
                </button>
            </a>
        </div>
    </div>
</section>
