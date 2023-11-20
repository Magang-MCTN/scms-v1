<script src="{{ asset('dashboard/template/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('dashboard/template/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dashboard/template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('dashboard/template/vendors/progressbar.js/progressbar.min.js') }}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('dashboard/template/js/off-canvas.js') }}"></script>
<script src="{{ asset('dashboard/template/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('dashboard/template/js/template.js') }}"></script>
<script src="{{ asset('dashboard/template/js/settings.js') }}"></script>
<script src="{{ asset('dashboard/template/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('dashboard/template/js/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboard/template/js/dashboard.js') }}"></script>
<script src="{{ asset('dashboard/template/js/Chart.roundedBarCharts.js') }}"></script>
<!-- End custom js for this page-->
<!-- Masukkan kode jQuery ke dalam halaman Anda (pastikan jQuery telah dimuat sebelumnya) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/decoupled-document/ckeditor.js"></script>

<!-- Kemudian tambahkan skrip berikut untuk menampilkan pesan kesalahan sebagai pop-up -->
<script>
    $(document).ready(function() {
        // Periksa apakah ada pesan kesalahan
        var errorMessage = "{{ session('error') }}";

        if (errorMessage !== '') {
            // Tampilkan pesan kesalahan sebagai pop-up
            alert(errorMessage);
        }
    });
</script>
