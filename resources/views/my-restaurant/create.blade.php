@extends('layouts.main')
@section('content')
    <div class="container mt-5">
        <div class="shadow p-3 mb-5 bg-white rounded" style="height: 88%;">
            <p class="text-center fw-bold" style=" font-size: 30px;">My Restaurant</p>
            <hr class="mt-3" style="width: 99%">

            <form action="{{ route('my-restaurant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <label class="col align-content-center fw-bold">Restaurant Photo</label>
                            <div class="position-relative">
                                <div class="container border @error('image') is-invalid @enderror @if ($errors->has('image')) border-danger @else border-dark @endif d-flex align-items-center justify-content-center"
                                    id="container_photo"
                                    style="width: 100%px; height: 400px;  border-radius: 8px; overflow: hidden">
                                    <input type="file" id="select_image" name="image" accept="image/*" hidden>
                                    <label class="col align-self-center text-center" for="select_image" id="photo_label">
                                        <i class="fa-solid fa-square-plus fa-4x dark"></i>
                                    </label>
                                </div>
                                <img class="position-absolute top-0 start-0" id="preview"
                                    style="display: none; max-width: 100%; border-radius: 8px;" />
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="nameRestaurant" class="form-label fw-bold">Name Restaurant</label>
                            <input type="text"
                                class="@error('name') is-invalid @enderror
                            @if ($errors->has('name')) border-danger @else border-dark @endif form-control"
                                id="nameRestaurant" name="name" style="border-radius: 8px; height: 48px; width: 95%;"
                                placeholder="Restaurant Name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="fw-bold">Description Restaurant</label>
                            <textarea id="" cols="28" rows="5" name="description"
                                class="@error('description') is-invalid @enderror
                                @if ($errors->has('description')) border-danger @else border-dark @endif form-control"
                                style="resize: none; border-radius: 8px; width: 95%; height: 145px;" placeholder="Restaurant Description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="fw-bold">Address Restaurant</label>
                            <textarea id="" cols="28" rows="5" name="address"
                                class="@error('address') is-invalid @enderror
                                @if ($errors->has('address')) border-danger @else border-dark @endif form-control"
                                style="resize: none; width: 95%; height: 145px; border-radius: 8px;" placeholder="Restaurant Address">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="opening_day" class="fw-bold">Opening Day</label>
                            <br>
                            <div class="mb-2 d-flex">
                                <div class="flex-column">
                                    <select class="me-2 @error('opening_day_from') is-invalid @enderror" value=""
                                        name="opening_day_from" id="opening_day_from"
                                        style="width: 190px; height: 30px; border-radius: 8px;">
                                        <option value="">Select Day</option>
                                        @foreach ($restaurant_day as $day)
                                            <option value="{{ $day }}"
                                                {{ old('opening_day_from') == $day ? 'selected' : '' }}>{{ $day }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('opening_day_from')
                                        <div class="invalid-feedback text-wrap" style="width: 190px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label class="fw-bold">To</label>

                                <div class="flex-column">
                                    <select class="ms-2 @error('opening_day_to') is-invalid @enderror" name="opening_day_to"
                                        id="opening_day_to" style="width: 190px; height: 30px; border-radius: 8px;">
                                        <option value="">Select Day</option>
                                        @foreach ($restaurant_day as $day)
                                            <option value="{{ $day }}"
                                                {{ old('opening_day_to') == $day ? 'selected' : '' }}>{{ $day }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('opening_day_to')
                                        <div class="invalid-feedback text-wrap" style="width: 190px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="fw-bold">Opening Hour</label>
                            <br>
                            <div class="mb-2" style="display: inline-flex;">
                                <div class="flex-column">
                                    <select class="me-2 @error('opening_hour_from') is-invalid @enderror "
                                        name="opening_hour_from" id="opening_hour_from"
                                        style="width: 190px; height: 30px; border-radius: 8px;">
                                        <option value="">Select Hour</option>
                                        @foreach ($restaurant_hour as $hour)
                                            <option value="{{ $hour }}"
                                                {{ old('opening_hour_from') == $hour ? 'selected' : '' }}>
                                                {{ $hour }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('opening_hour_from')
                                        <div class="invalid-feedback text-wrap" style="width: 190px;">{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <label class="fw-bold">To</label>

                                <div class="flex-column">
                                    <select class="ms-2 @error('opening_hour_to') is-invalid @enderror"
                                        name="opening_hour_to" id="opening_hour_to"
                                        style="width: 190px; height: 30px; border-radius: 8px;">
                                        <option value="">Select Hour</option>
                                        @foreach ($restaurant_hour as $hour)
                                            <option value="{{ $hour }}"
                                                {{ old('opening_hour_to') == $hour ? 'selected' : '' }}>
                                                {{ $hour }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('opening_hour_to')
                                        <div class="invalid-feedback text-wrap" style="width: 190px">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label fw-bold">Contact Restaurant (Whatsapp)</label>
                            <input type="number"
                                class="@error('contact') is-invalid @enderror
                                @if ($errors->has('contact')) border-danger @else border-dark @endif form-control"
                                id="contact" name="contact" value="{{ old('contact') }}"
                                style="border-radius: 8px; height: 48px; width: 95%;" placeholder="Contact Whatsapp">
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="mt-3" style="width: 99%">
                    <div class="d-flex justify-content-center">
                        <input type="submit" class="btn btn-success " style="width: 15%;" value="Add Restaurant">
                        <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                        </input>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        select_image = document.getElementById('select_image')
        preview = document.getElementById('preview')
        photo_label = document.getElementById('photo_label')
        container_photo = document.getElementById('container_photo')

        select_image.onchange = evt => {
            const [file] = select_image.files
            if (file) {
                preview.src = URL.createObjectURL(file)
                preview.style.display = 'block'
                photo_label.style.display = 'none'
            }
        }
    </script>
@endpush
