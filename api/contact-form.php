<?php

use PHPMailer\PHPMailer\PHPMailer;


$connect = mysqli_connect('localhost', 'root', '', 'sandbox');

$email = isset($_POST['email']) ? $_POST['email'] : '';
$clientName = isset($_POST['clientName']) ? $_POST['clientName'] : '';
$departament = isset($_POST['departament']) ? $_POST['departament'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

$email_error = '';
$clientName_error = '';
$departament_error = '';
$message_error = '';


if (count($_POST)) {
    $errors = 0;

    if ($_POST['email'] == '') {
        $email_error = 'Please enter an email address';
        $errors++;
    }

    if ($_POST['clientName'] == '') {
        $clientName_error = 'Please enter an client name';
        $errors++;
    }

    if ($_POST['departament'] == '') {
        $departament_error = 'Please enter an departament';
        $errors++;
    }

    if ($_POST['message'] == '') {
        $message_error = 'Please enter a message';
        $errors++;
    }


    if ($errors == 0) {
        $departament_employees = array(
            "atencion cliente" => array("Mario Sanchez", "Carlos Suarez", "Lina Trujillo", "Carolina Ruiz"),
            "soporte tecnico" => array("Roberto Gomez", "Juan Agudelo", "José Parra", "Amanda Perez"),
            "facturacion" => array("Gabriela Linares", "David Lopez", "Wendy Joya", "Steven Diaz")
        );

        $client = $_POST['clientName'];
        $departament = $_POST['departament'];

        if ($departament == "atencion cliente") {
            $employeeName = $departament_employees["atencion cliente"][array_rand($departament_employees["atencion cliente"], 1)];
        } elseif ($departament == "soporte tecnico") {
            $employeeName = $departament_employees["soporte tecnico"][array_rand($departament_employees["soporte tecnico"], 1)];
        } elseif ($departament == "facturacion") {
            $employeeName = $departament_employees["facturacion"][array_rand($departament_employees["facturacion"], 1)];
        }

        $query = 'INSERT INTO contact (
                email,
                clientName,
                departament,
                client,
                employeeName,
                message
            ) VALUES (
                "' . addslashes($_POST['email']) . '",
                "' . addslashes($_POST['clientName']) . '",
                "' . addslashes($_POST['departament']) . '",
                "' . addslashes($client) . '",
                "' . addslashes($employeeName) . '",
                "' . addslashes($_POST['message']) . '"
            )';
        mysqli_query($connect, $query);

        $message = 'You have received a contact form submission:
            
Email: ' . $_POST['email'] . '
ClientName: ' . $_POST['clientName'] . '
Departament: ' . $_POST['departament'] . '
Client: ' . $client . '
EmployeeName: ' . $employeeName . '
Message: ' . $_POST['message'];

        mail(
            'darodriguezg3@academia.usbbog.edu.co',
            'Contact Form Cubmission',
            $message
        );

        $lastInsertedID = mysqli_insert_id($connect);

        // Redirecciona a thankyou.php pasando los parámetros en la URL
        header("Location: thankyou.php?id=$lastInsertedID&clientName=$clientName&department=$departament&employeeName=$employeeName");
        die();

    }
}

?>
<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="./styles/contact-form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@100;300&family=Open+Sans:wght@600&display=swap"
        rel="stylesheet">
    <title>PHP Contact Form</title>
</head>

<body>
    <div class='contact-title'>
        <h1>☎️</h1>
    </div>

    <form method="post" action="">

        <label>Correo electrónico:</label>
        <br>
        <input type="text" name="email" value="<?php echo $email; ?>" placeholder="carlosperez@correo.com">
        <br>
        <?php echo $email_error; ?>

        <br><br>

        <label>Nombre del cliente:</label>
        <br>
        <input type="text" name="clientName" value="<?php echo $clientName; ?>" placeholder="Carlos Perez">
        <br>
        <?php echo $clientName_error; ?>

        <br><br>

        <label for="lang">Departamento:</label>
        <br>
        <select name="departament" id="dep" placeholder="Selecciona una opción">
            <option value="atencion cliente">Atención Cliente</option>
            <option value="soporte tecnico">Soporte Técnico</option>
            <option value="facturacion">Facturación</option>
        </select>
        <?php echo $departament_error; ?>
        <br><br>

        <label>
            Mensaje:
        </label>
        <br>
        <textarea name="message" placeholder="Mensaje..."><?php echo $message; ?></textarea>
        <br>
        <?php echo $message_error; ?>

        <br><br>

        <input type="submit" value="Submit">

    </form>

</body>

</html>