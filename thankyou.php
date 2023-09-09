<?php
$clientName = $_GET['clientName'];
$id = $_GET['id'];
$department = $_GET['department'];
$employeeName = $_GET['employeeName'];
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="./styles/thankyou.css">
  <title>Thank You</title>
</head>

<body>
  <div class='contact-title'>
    <h1>📩</h1>
  </div>
  <div class="resp-cont">
    <p>
      Buenas tardes, señor
      <strong>
        <?php echo $clientName; ?>
      </strong>
    </p>
    <p>
      Gracias por confiar en <strong>CONSULTORA SAS.</strong> Su Solicitud ha sido recibida y se
      ha abierto un ticket con el id número
      <strong>
        <?php echo $id; ?>
      </strong>
      desde el departamento de
      <strong>
        <?php echo $department; ?>
      </strong>
      y será atendido por
      <strong>
        <?php echo $employeeName; ?>.
      </strong>
    </p>
  </div>
</body>

</html>