<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets-back') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets-back') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets-back') }}/dist/js/adminlte.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    setTimeout(() => {
                            alert.style.transition = 'opacity 0.5s ease';
                            alert.style.opacity = 0;
                            setTimeout(() => alert.remove(), 500);
                        }
                    });
</script>
@stack('scripts')
</body>

</html>
