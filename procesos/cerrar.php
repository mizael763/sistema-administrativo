<?php
session_start();
session_unset();
session_destroy();
header("Location: ../"); // Redirige al usuario a la página de inicio después de cerrar sesión
exit();
