<?php
     session_start();
     if (isset($_SESSION['login'])) {
          unset($_SESSION['login']);
          echo "
               <script>
                    window.location.href='/login.php';
                    alert('Logout Successfull');
               </script>
          ";
     }
?>
