@extends('layouts.main')
@section('content')
    @if (count($bookings) === 0)
        <div class="container mt-5" style="height: 250px">
            <div class="alert alert-info" role="alert">
                You don't have any booking yet. <a href="{{ route('restaurants.index') }}" class="alert-link">Click Here</a>
                to
                create new booking.
            </div>
        </div>
    @else
        @foreach ($bookings as $booking)
            <div class="mt-5 " style="margin: 0 64px;">
                <div class="row gap-4">
                    <div class="col-12">
                        <div class="position-relative card p-4 border">
                            <form action="{{ route('booking.delete', ['id' => $booking->id]) }}" method="post"
                                id="delete_booking">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-outline-danger position-absolute top-0 end-0"
                                    data-toggle="tooltip" title="X" onclick="confirmDeleteBooking(this)">X</button>
                            </form>
                            <div class="d-flex flex-wrap gap-4">
                                @if ($booking->restaurant->image)
                                    <img src="{{ asset($booking->restaurant->image) }}" alt="Restaurant Image"
                                        class="img-fluid rounded-3" style="width: 200px; height: 200px;">
                                @else
                                    <img class="rounded-3" src="{{ asset('img/image-skeleton.png') }}" alt=""
                                        style="width: 200px">
                                @endif

                                <div class="flex-fill flex-shrink">
                                    <div class="d-inline-flex flex-column justify-content-between h-100">
                                        <div>
                                            @foreach ($restaurant as $resto)
                                                @if ($resto->id == $booking->restaurant->id)
                                                    <h5 class="fw-bold">{{ $resto->name }}</h5>
                                                @endif
                                            @endforeach
                                            <div class="d-flex align-items-center gap-2 mb-3">
                                                <div class="card px-2 py-1 text-center">{{ $booking->day }}</div>
                                                <div class="card px-2 py-1 text-center">{{ $booking->time }}</div>
                                                @if ($booking->seat == 'family_seat')
                                                    <div class="card px-2 py-1 text-center">Family Seat</div>
                                                @else
                                                    <div class="card px-2 py-1 text-center">2 Seat</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            @if ($booking->status == 'pending')
                                                <form action="{{ route('booking.update', ['id' => $booking->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="canceled" />
                                                    <button type="submit" class="btn btn-outline-secondary">Cancel
                                                        Booking</button>
                                                </form>
                                                <form action="{{ route('booking.update', ['id' => $booking->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="confirmed" />
                                                    <button type="submit" class="btn btn-success">Confirm RSVP</button>
                                                </form>
                                            @elseif($booking->status == 'confirmed')
                                                <button type="button" class="btn btn-success" disabled>Confirmed</button>
                                            @else
                                                <button type="button" class="btn btn-outline-secondary"
                                                    disabled>Canceled</button>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <span class="position-absolute" style="opacity: 0.5; bottom: 12px; right: 12px;">
                                Seat Number: {{ $booking->seat_number }}
                            </span>
                            <span class="position-absolute" style="opacity: 0.5; bottom: 12px; right: 160px;">
                                Username : {{ Auth::user()->username }}
                            </span>
                            <span class="position-absolute" style="opacity: 0.5; bottom: 12px; right: 320px;">
                                Order date : {{ $booking->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
@push('script')
    <script>
        function confirmDeleteBooking(button) {
            var form = $(button).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
@endpush
