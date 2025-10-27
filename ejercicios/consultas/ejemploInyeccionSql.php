<form action="" method="POST">
    usuario: <input type="text" name="usu"><br>
    password: <input type="text" name="pass"><br>
    <input type="submit" name="entrar" value="Entrar">
</form>
<?php
if (isset($_POST['entrar'])) {
    /* try { 
      $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
      $conex->set_charset("utf8mb4");
      $result = $conex->query("SELECT * FROM datos WHERE usuario= BINARY'$_POST[usu]' AND password= BINARY'$_POST[pass]'");
      if ($result->num_rows === 1) {
      echo "Has entrado";
      } else {
      echo 'CREDENCIALES INCORRECTAS';
      }
      } catch (mysqli_sql_exception $exc) {
      echo $exc->getTraceAsString();
      }
     * 
     */
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
        $conex->set_charset("utf8mb4");
        $stmt = $conex->prepare("SELECT * FROM datos WHERE usuario= BINARY ? AND password= BINARY ?");
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getTraceAsString();
    }
    $stmt->bind_param("ss", $_POST['usu'], $_POST['pass']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        echo "Has entrado";
    } else {
        echo 'CREDENCIALES INCORRECTAS';
    }
}
    