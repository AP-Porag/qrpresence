@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Update Profile</h4>

                    <div class="row">
                        <div class="col-md-4">
                            <form id="adminAvatarUpdateForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' name="avatar" id="adminImageUpload" accept=".png, .jpg, .jpeg" />
                                        <label for="adminImageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('{{ $user->avatar_url }}');">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form action="{{ route('admin.profile.update', $user->id) }}" method="POST" id="form">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-2">
                                    <label for="first_name">
                                        First Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="first_name" name="first_name" class="form-control"
                                           autocomplete="off" value="{{ $user->first_name }}"
                                           placeholder="Enter your first name" required>
                                    @error('first_name')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label for="middle_name">
                                        Middle Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="middle_name" name="middle_name" class="form-control"
                                           autocomplete="off" value="{{ $user->middle_name }}"
                                           placeholder="Enter your middle name">
                                    @error('email')
                                    <p class="middle_name">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label for="last_name">
                                        Last Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="last_name" name="last_name" class="form-control"
                                           autocomplete="off" value="{{ $user->last_name }}" placeholder="Enter your last name"
                                           required>
                                    @error('last_name')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

{{--                                <div class="form-group mb-2">--}}
{{--                                    <label for="department">--}}
{{--                                        Department--}}
{{--                                    </label>--}}
{{--                                    <input type="text" id="department" name="department" class="form-control"--}}
{{--                                           autocomplete="off" value="{{ $user->department }}" placeholder="Enter your department"--}}
{{--                                           >--}}
{{--                                    @error('department')--}}
{{--                                    <p class="error">{{ $message }}</p>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <div class="form-group mb-2">--}}
{{--                                    <label for="department">--}}
{{--                                        Title--}}
{{--                                    </label>--}}
{{--                                    <input type="text" id="title" name="title" class="form-control"--}}
{{--                                           autocomplete="off" value="{{ $user->title }}" placeholder="Enter your title"--}}
{{--                                    >--}}
{{--                                    @error('title')--}}
{{--                                    <p class="error">{{ $message }}</p>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <div class="mb-2">--}}
{{--                                    <label class="form-label">Date of Hire <span class="error">*</span></label>--}}
{{--                                    <input type="date" name="date_of_hire" class="form-control" required=""--}}
{{--                                           placeholder="Enter date of birth" value="{{ $user->date_of_hire }}">--}}
{{--                                    @error('date_of_hire')--}}
{{--                                    <p class="error">{{ $message }}</p>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

                                <div class="form-group mb-2">
                                    <label for="phone">
                                        Phone Number <span class="text-danger">*</span>
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="phone" autocomplete="off"
                                           value="{{ $user->phone }}" required>
                                    @error('phone')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label">Email <span class="error">*</span></label>
                                    <input type="email" name="email" class="form-control" required="" placeholder="Email"
                                           value="{{ $user->email }}">
                                    @error('email')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

{{--                                <div class="mb-3">--}}
{{--                                    <label class="form-label mb-2 w-100">Gender <span class="error">*</span></label>--}}
{{--                                    <div class="form-check form-check-inline">--}}
{{--                                        <input type="radio" id="male" value="male" name="gender" class="form-check-input" {{--}}
{{--                                        $user->gender == 'male' ?--}}
{{--                                    'checked' : '' }}>--}}
{{--                                        <label class="custom-control-label" for="male">Male</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-check form-check-inline">--}}
{{--                                        <input type="radio" id="female" value="female" name="gender"--}}
{{--                                               class="form-check-input" {{ $user->gender ==--}}
{{--                                    'female' ? 'checked' : '' }}>--}}
{{--                                        <label class="custom-control-label" for="female">Female</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-check form-check-inline">--}}
{{--                                        <input type="radio" id="other" value="other" name="gender" class="form-check-input"--}}
{{--                                            {{ $user->gender == 'other'--}}
{{--                                        ? 'checked' : '' }}>--}}
{{--                                        <label class="custom-control-label" for="other">Other</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Update Profile
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Update Password</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.update.password') }}" method="POST" id="form2">
                                @csrf

                                <div class="form-group mb-2">
                                    <label for="c_password">Current Password<span class="text-danger">*</span></label>
                                    <input id="c_password" type="password" class="form-control" name="current_password"
                                           autocomplete="current-password" placeholder="Enter current password" required>
                                    @error('current_password')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="new_password">New Password <span class="text-danger">*</span></label>
                                    <input id="new_password" type="password" class="form-control" name="new_password"
                                           placeholder="Enter new password" autocomplete="current-password" required>
                                    @error('new_password')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="new_confirm_password">Confirm New Password <span
                                            class="text-danger">*</span></label>
                                    <input id="new_confirm_password" type="password" class="form-control"
                                           name="new_password_confirmation" placeholder="Confirm new password"
                                           autocomplete="current-password" required>

                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Update Password
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('style')
    <!-- profile font -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endpush

@push('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#adminImageUpload").on("change",function() {
            readURL(this);
            uploadUserProfileImage();
        });

        function uploadUserProfileImage() {
            let myForm = document.getElementById('adminAvatarUpdateForm');
            let formData = new FormData(myForm);
            $.ajax({
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                url: "{{ route('admin.avatar.update') }}",
                success: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: result.success
                    })
                }.bind($(this))
            });
        }
    </script>
@endpush
