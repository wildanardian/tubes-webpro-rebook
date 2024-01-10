@extends('layouts.main')
@section('content')
    <main>
        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            <div class="container rounded bg-white mt-5">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <a data-toggle="modal" data-target="#profileImageModal">
                                @if (Auth::user()->image == null)
                                    <img id="profileImage" class="rounded-circle mt-5" src="{{ asset('img/user.png') }}"
                                        width="90px">
                                @else
                                    <img id="profileImage" class="rounded-circle mt-5" src="{{ Auth::user()->image }}"
                                        width="90px">
                                @endif
                            </a>
                            <span class="font-weight-bold" id="nameLabel" data-content="Full Name"></span>
                            <span class="text-black-50" id="emailLabel" data-content="Email"></span>
                            <input type="file" id="fileInput" name="image" style="display: none;"
                                onchange="changeProfileImage(this)" accept="image/*">
                            <label for="fileInput" class="btn btn-link" style="color: black;">Change Photo</label>
                        </div>
                    </div>
                    <div class="col-md-8">

                        @csrf
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-right">Edit Profile</h6>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Full Name" name="full_name"
                                        value="{{ $user->full_name }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Username"
                                        value="{{ $user->username }}" name="username">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Email"
                                        value="{{ $user->email }}" name="email">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" placeholder="Phone number"
                                        name="phone_number" value="{{ $user->phone_number }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Address" name="address"
                                        value="{{ $user->address }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                            <div class="mt-5 text-right">
                                <input type="submit" class="btn btn-primary profile-button" value="Save Profile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="modal fade" id="profileImageModal" tabindex="-1" role="dialog"
            aria-labelledby="profileImageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modalProfileImage" class="img-fluid" alt="Profile Image">
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@push('script')
    <script>
        function changeProfileImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                    var profileImage = document.getElementById('profileImage');
                    profileImage.src = e.target.result;


                    var modalProfileImage = document.getElementById('modalProfileImage');
                    if (modalProfileImage) {
                        modalProfileImage.src = e.target.result;
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
