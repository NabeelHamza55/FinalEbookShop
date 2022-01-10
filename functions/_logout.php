<?php
     session_start();
     if (isset($_SESSION['login'])) {
          session_destroy();
          echo "
               <script>
                    window.location.href='/login.php';
                    alert('Logout Successfull');
               </script>
          ";
     }
?>
