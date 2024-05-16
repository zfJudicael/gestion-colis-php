<?php
require "fpdf.php";

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','B',15);
        $this->Cell(135);
        $this->Cell(52,10,'Colis Express Mada', 1,0, 'C');
        $this->Ln(30);
    }
}

$pdf = new PDF();
$pdf->AddPage();

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=gestion_colis", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
}

$envoi = $_GET["idenvoi"];

$sql1 = $conn->prepare("SELECT * FROM envoyer WHERE idenvoi = :idenvoi");
$sql1->bindParam(':idenvoi', $envoi);
$sql1->execute();
while($row1 = $sql1->fetch()){
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(68);
    $pdf->Cell(30,10,utf8_decode('Réçu N° : '),'B',0,'C');
    $pdf->Cell(10,10, $row1['idenvoi'], 0,0, 'C');
    $pdf->ln(20);

    $pdf->SetFont('Times','B',12);
    $pdf->Cell(15);
    $pdf->write(10, 'Date d\'envoi : ');
    $pdf->SetFont('Times','',12);
    $pdf->Cell(40,10, $row1['date_envoi'], 0,0, 'L');
    $pdf->ln(10);
    $pdf->Cell(15);
    $pdf->SetFont('Times','B',12);
    $pdf->write(10, utf8_decode('Numéro du colis envoyé : '));
    $pdf->SetFont('Times','',12);
    $pdf->Cell(10,10, $row1['idcolis'], 0,0, 'C');
    $pdf->ln(10);
    $pdf->Cell(15);
    $pdf->SetFont('Times','B',12);

    $pdf->write(10, 'Colis : ');
    $sql2=$conn->prepare("SELECT designColis FROM colis WHERE idcolis = :idcolis");
    $sql2->bindParam(':idcolis', $row1['idcolis']);
    $sql2->execute();
    $pdf->SetFont('Times','',12);
    while($row2 = $sql2->fetch()){
        $pdf->Cell(40,10, $row2['designColis'], 0,0, 'L');
    }
    $pdf->ln(10);

    $pdf->Cell(15);
    $pdf->SetFont('Times','B',12);
    $pdf->write(10, 'Nom de l\'Envoyeur : ');
    $pdf->SetFont('Times','',12);
    $pdf->Cell(10,10, $row1['nomEnvoyeur'], 0,0, 'C');
    $pdf->ln(10);
    $pdf->Cell(15);
    $pdf->SetFont('Times','B',12);
    $pdf->write(10, 'Email de l\'Envoyeur : ');
    $pdf->SetFont('Times','',12);
    $pdf->Cell(35,10, $row1['emailEnvoyeur'], 0,0, 'L');
    $pdf->ln(10);
    $pdf->Cell(15);
    $pdf->SetFont('Times','B',12);
    $pdf->write(10, utf8_decode('Numéro d\'Immatriculation de la voiture : '));
    $pdf->SetFont('Times','',12);
    $pdf->Cell(15,10, $row1['idvoit'], 0,0, 'L');
    $pdf->ln(10);
    $pdf->Cell(15);
    $pdf->SetFont('Times','B',12);


    $pdf->write(10, 'Destination : ');
    $pdf->SetFont('Times','',12);
    $sql3 = $conn->prepare("SELECT villedep, villearr FROM itineraire WHERE codeit = (SELECT codeit FROM desservir WHERE idvoit = :idvoit)");
    $sql3->bindParam(':idvoit', $row1['idvoit']);
    $sql3->execute();
    while($row3 = $sql3->fetch()){
        $pdf->Cell(70,10, $row3['villedep'].' - '.$row3['villearr'], 0,0, 'L');
    }
    $pdf->ln(10);


    $pdf->Cell(15);
    $pdf->SetFont('Times','B',12);
    $pdf->write(10, 'Frais : ');
    $pdf->SetFont('Times','',12);
    $pdf->Cell(30,10, $row1['frais'], 0,0, 'R');
    $pdf->Cell(10,10, 'Ariary', 0,0, 'L');
    $pdf->ln(10);
    $pdf->Cell(15);
    $pdf->SetFont('Times','B',12);
    $pdf->write(10, utf8_decode('Nom du Récepteur : '));
    $pdf->SetFont('Times','',12);
    $pdf->Cell(60,10, $row1['nomRecepteur'], 0,0, 'L');
    $pdf->ln(10);
    $pdf->Cell(15);
    $pdf->SetFont('Times','B',12);
    $pdf->write(10, utf8_decode('Contact du  Récepteur : '));
    $pdf->SetFont('Times','',12);
    $pdf->Cell(50,10, $row1['contactRecepteur'], 0,0, 'L');
    $pdf->ln(10);
    $pdf->Cell(15);
}

$pdf->Output('D', utf8_decode('récu_N°'.$envoi.'.pdf'));

?>