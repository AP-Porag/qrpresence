<script src="{{ asset('admin/js/admin-app.js') }}"></script>
<script src="{{ asset('admin/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
{{-- <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script> --}}

<script src="{{ asset('admin/libs/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('admin/js/script.js') }}"></script>

<!-- Parsley js -->
<script src="{{ asset('backend/js/parsley.min.js') }}"></script>

<script src="{{ asset('admin/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('admin/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('admin/js/custom-dev.js') }}"></script>


<script>
    toastr.options =
    {
        "closeButton": true,
        "progressBar": true,
        "timeOut": 2000
    }

    @if(Session::has('success'))
        toastr.success("{{ session('success') }}");
    @endif
    @if(Session::has('error'))
        toastr.error("{{ session('error') }}");
    @endif
    @if(Session::has('update'))
        toastr.info("{{ session('update') }}");
    @endif
    @if(Session::has('delete'))
    toastr.success("{{ session('delete') }}");
    @endif
    @if(Session::has('info'))
        toastr.info("{{ session('info') }}");
    @endif
    @if(Session::has('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

    // Toaster notify
    const notify = (type, msg) => {
        if (type == 'success') {
            toastr.success(msg);
        } else {
            toastr.warning(msg);
        }
    }

    function showValidationError(err) {
        let error_string = '<div class="error-sa-v text-left">';
        for (const [key, value] of Object.entries(
        err.response.data.errors
        )) {
            error_string = error_string + value[0] + "<br>";

            if (value[1] != "undefined" && value[1] != undefined) {
                error_string = error_string + value[1] + "<br>";
            }
        }
        error_string = error_string + "<div>";

        Swal.fire({
            icon: "error",
            html: error_string,
        });
    }

    function showSomethingWrong() {
        Swal.fire({
            icon: "error",
            html: "<span>Something is wrong!</span>" + "<br>",
            showConfirmButton: true,
        });
    }

    const uploadFileCustom = (selector, type = "image") => {
        const file = $(`.${selector}`).filemanager(`${type}`);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('script')
