<footer class="mt-auto">
    <div class="footer-wrap pd-20 mb-5 card-box">
       Vehicle Management System <a href="https://www.ictchoice.com" target="_blank"><span>developed by </span>ICT Choice</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>
    <script>
   $(function() {
        let url = window.location.href;
        $('.menu-block .sidebar-menu ul li a').each(function() {
            if (this.href === url) {
            $(this).closest('li').addClass('active');
            }
        });
    });
    </script>
    <script>
        $('.close-icon').on('click',function() {
         $(this).closest('.card').fadeOut();
       })
         </script>
        <!-- js -->
      <script src="vendors/scripts/core.js"></script>
        <script src="vendors/scripts/script.min.js"></script>
        <script src="vendors/scripts/process.js"></script>
        <script src="vendors/scripts/layout-settings.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>    
@yield('scripts')