<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<!-- <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
</script> -->



<script>
    const $button  = document.querySelector('#sidebar-toggle');
    const $wrapper = document.querySelector('#wrapper');
    $button.addEventListener('click', (e) => {
    e.preventDefault();
    $wrapper.classList.toggle('toggled');
    });
</script>


<style type="text/css">
    .fa-spin {
         display: none;
    }
  </style>
  <script type="text/javascript">
      (function () {
          $('.form_prevent_multiple_submits').on('submit', function(){
            $('.button_prevent_multiple_submits').attr('disabled', 'true');
            $('.fa-spin').show();
          })
      })();
  </script>
<script>
  $(document).ready(function(){
    $('#sidebar-toggle').click(function(e) {  
      $.get("{{ URL('/admin/session') }}");
    });
  });
</script>
@section('footerSection')
@show
