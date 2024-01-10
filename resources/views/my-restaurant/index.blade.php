@extends('layouts.main')
@section('content')
    <div class="col container mt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <p class="text-center fw-bold" style="font-size: 30px;">My Restaurant</p>
            @if ($restaurants->count() == 0)
                <hr class="mt-3" style="width: 99%">

                <div class="" style="margin-top: 200px">
                    <p class="text-center fw-bold" style="font-size: 30px; color: #ADADAD;"> YOU DONT HAVE ANY RESTAURANT</p>

                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ route('my-restaurant.create') }}" style="text-decoration: none;">
                            <input class="btn btn-success " style="" value="Add Restaurant">
                            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                            </input>
                        </a>
                    </div>
                </div>

                <div class="bottom" style="margin-top: 200px">
                    <footer>
                        <hr class="mt-3" style="width: 99%;">
                    </footer>
                </div>
            @else
                <div class="d-flex justify-content-center align-items-center">
                    <a href="{{ route('my-restaurant.create') }}" style="text-decoration: none;">
                        <input class="btn btn-success " style="" value="Add Restaurant">
                        <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                        </input>
                    </a>
                </div>
                <div class="container mt-3">
                    <div class="row">
                        @foreach ($restaurants as $restaurant)
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <a href="{{ route('my-restaurant.show', ['id' => $restaurant->id]) }}"
                                        class="text-decoration-none text-dark position-relative d-inline-block">
                                        @if ($restaurant->image == null)
                                            <img src="{{ asset('img/image-skeleton.png') }}" class="card-img-top"
                                                alt="restaurant-image" style="z-index: 1">
                                        @else
                                            <img src="{{ $restaurant->image }}" class="card-img-top" alt="..."
                                                style="z-index: 1">
                                        @endif
                                        <div class="position-absolute top-0 end-0 p-2">
                                            <a href="#" role="button" id="dropdownAction" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ asset('img/three-dots-vertical.svg') }}" alt="dots"
                                                    style="width: 20px; z-index: 2; filter: drop-shadow(0 0 0.75rem crimson)">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('my-restaurant.edit', ['id' => $restaurant->id]) }}">Edit</a>
                                                <form action="{{ route('my-restaurant.delete', $restaurant->id) }}"
                                                    method="post" id="delete_form">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="button" class="dropdown-item confirm_delete"
                                                        data-toggle="tooltip" title="Delete" onclick="confirmDelete(this)">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $restaurant->name }}</h5>
                                            <p class="card-text">{{ $restaurant->address }}</p>
                                            <p class="card-text">{{ $restaurant->contact }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('script')
    <script>
        function confirmDelete(button) {
            var form = $(button).closest("form");
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
