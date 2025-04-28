@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{get_page_meta('title', true)}}</h4>

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">First Name <span class="error">*</span></label>
                                <input type="text" name="first_name" class="form-control" required="" placeholder="First Name"
                                       value="{{ $user->first_name }}">
                                @error('first_name')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Last Name <span class="error">*</span></label>
                                <input type="text" name="last_name" class="form-control" required="" placeholder="Last Name"
                                       value="{{ $user->last_name }}">
                                @error('last_name')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email <span class="error">*</span></label>
                                <input type="email" name="email" class="form-control" required="" placeholder="Email"
                                       value="{{ $user->email }}">
                                @error('email')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone <span class="error">*</span></label>
                                <input type="tel" name="phone" class="form-control" required="" placeholder="Phone"
                                       value="{{ $user->phone }}">
                                @error('phone')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Date of hire <span class="error">*</span></label>
                                <input type="date" name="date_of_hire" class="form-control" required="" placeholder="Date of hire"
                                       value="{{ $user->date_of_hire }}">
                                @error('date_of_hire')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Title </label>
                                <input type="text" name="title" class="form-control" placeholder="Title"
                                       value="{{ $user->title }}">
                                @error('title')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">User Type <span class="error">*</span></label>
                                <select class="form-control text-capitalize" name="user_type" id="user_type">
                                    <option class="text-capitalize" @if($user->user_type == \App\Models\User::USER_TYPE_ADMIN) selected @endif value="{{\App\Models\User::USER_TYPE_ADMIN}}">{{\App\Models\User::USER_TYPE_ADMIN}}</option>
                                    <option class="text-capitalize" @if($user->user_type == \App\Models\User::USER_TYPE_MANAGER) selected @endif value="{{\App\Models\User::USER_TYPE_MANAGER}}">{{\App\Models\User::USER_TYPE_MANAGER}}</option>
                                    <option class="text-capitalize" @if($user->user_type == \App\Models\User::USER_TYPE_HR) selected @endif value="{{\App\Models\User::USER_TYPE_HR}}">{{\App\Models\User::USER_TYPE_HR}}</option>
                                    <option class="text-capitalize" @if($user->user_type == \App\Models\User::USER_TYPE_EMPLOYEE) selected @endif value="{{\App\Models\User::USER_TYPE_EMPLOYEE}}">{{\App\Models\User::USER_TYPE_EMPLOYEE}}</option>
                                </select>
                                @error('user_type')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Department @if($errors->has('department')) <span class="error">*</span> @endif</label>
                                <input type="text" name="department" class="form-control" placeholder="Department"
                                       value="{{ $user->department }}">
                                @error('department')
                                <p class="error">{{ $message }}</p>
                                @enderror
                                <span id="StrengthDisp" class="input_bellow_text text-warning">
                                Must fill this if user type is employee.
                            </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Password <span class="error">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                                       value="">
                                @error('password')
                                <p class="error">{{ $message }}</p>
                                @enderror
                                <span id="StrengthDisp" class="input_bellow_text">
                            Should contains Letters(uppercase & lowercase), Number and Special
                            Characters.
                        </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Confirm Password <span class="error">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder="Confirm Password" value="">
                                @error('password_confirmation')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            {{--                        <div class="mb-3">--}}
                            {{--                            <label class="form-label">Select Role <span class="error">*</span></label>--}}
                            {{--                            <select class="form-control select2" name="role" required>--}}
                            {{--                                @forelse ($roles as $role)--}}
                            {{--                                    <option value="{{ $role->id }}" {{ $user->getRoleNames()->contains($role->name) ? 'selected'--}}
                            {{--                                : '' }}>{{--}}
                            {{--                                $role->name }}</option>--}}
                            {{--                                @empty--}}
                            {{--                                    <option value="">Nothing in the list</option>--}}
                            {{--                                @endforelse--}}
                            {{--                            </select>--}}
                            {{--                            @error('role')--}}
                            {{--                            <p class="error">{{ $message }}</p>--}}
                            {{--                            @enderror--}}
                            {{--                        </div>--}}

                            {{--                        <div class="mb-3">--}}
                            {{--                            <label class="form-label mb-2 w-100">Gender <span class="error">*</span></label>--}}
                            {{--                            <div class="form-check form-check-inline">--}}
                            {{--                                <input type="radio" id="male" value="male" name="gender" class="form-check-input" {{--}}
                            {{--                                $user->gender == 'male' ? 'checked' : '' }}>--}}
                            {{--                                <label class="custom-control-label" for="male">Male</label>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-check form-check-inline">--}}
                            {{--                                <input type="radio" id="female" value="female" name="gender" class="form-check-input" {{--}}
                            {{--                                $user->gender == 'female' ? 'checked' : '' }}>--}}
                            {{--                                <label class="custom-control-label" for="female">Female</label>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-check form-check-inline">--}}
                            {{--                                <input type="radio" id="other" value="other" name="gender" class="form-check-input" {{--}}
                            {{--                                $user->gender == 'other' ? 'checked' : '' }}>--}}
                            {{--                                <label class="custom-control-label" for="other">Other</label>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            <div class="mb-3 col-md-6">
                                <label class="form-label mb-2 w-100">Status <span class="error">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="status_yes" name="status" class="form-check-input"
                                           value="{{ \App\Utils\GlobalConstant::STATUS_ACTIVE }}" name="status"
                                           class="custom-control-input" @if(
                                \App\Utils\GlobalConstant::STATUS_ACTIVE==$user->status) checked @endif>
                                    <label class="custom-control-label" for="status_yes">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="status_no" name="status" class="form-check-input"
                                           value="{{ \App\Utils\GlobalConstant::STATUS_INACTIVE }}" name="status"
                                           class="custom-control-input" @if(
                                \App\Utils\GlobalConstant::STATUS_INACTIVE==$user->status) checked @endif>
                                    <label class="custom-control-label" for="status_no">Inactive</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 offset-md-6 col-md-6">
                                <div class="text-end">
                                    <button class="btn btn-primary waves-effect waves-lightml-2 me-2" type="submit">
                                        <i class="fa fa-save"></i> Save
                                    </button>

                                    <a class="btn btn-secondary waves-effect" href="{{ route('admin.users.index') }}">
                                            <i class="fa fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script src="{{ asset('/admin/js/passwordCheck.js') }}"></script>
@endpush

