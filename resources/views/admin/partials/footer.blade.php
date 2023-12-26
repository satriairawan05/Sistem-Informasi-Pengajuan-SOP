  <!-- General JS Scripts -->
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  @stack('js')

  <!-- SweetAlert -->
  <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
  @if (session('success'))
      <script type="text/javascript">
          let timerInterval;
          Swal.fire({
              title: "Success!",
              text: "{{ session('success') }}",
              timer: 5000,
              icon: 'success',
              timerProgressBar: true,
              confirmButtonText: 'Oke',
              didOpen: () => {
                  timerInterval = setInterval(() => {}, 100)
              },
              willClose: () => {

              }
          }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {

              }
          });
      </script>
  @endif
  @if (session('failed'))
      <script type="text/javascript">
          let timerInterval;
          Swal.fire({
              title: "Fail!",
              text: "{{ session('failed') }}",
              timer: 500000,
              icon: 'error',
              timerProgressBar: true,
              confirmButtonText: 'Oke',
              didOpen: () => {
                  timerInterval = setInterval(() => {}, 100)
              },
              willClose: () => {

              }
          }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {

              }
          });
      </script>
  @endif

  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/time.min.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  </body>

  </html>
