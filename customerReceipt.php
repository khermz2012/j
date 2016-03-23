<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/22/2016
 * Time: 11:42 PM
 */
require('fpdf.php');

session_start();

$total = 0;
$date = date("d/m/Y");
$address = isset($_SESSION['address']) ? $_SESSION['address'] : '';
$mail = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$pdf = new    FPDF();
$pdf->AddPage();
$pdf->SetFont('Courier', 'b', 30);
$pdf->SetTextColor(254, 152, 15);
//can	put	empty	quotes,	bold,	underline,	italics,
$pdf->Image('./images/home/logo.png', 90, 5, 30);
$pdf->Ln();
$pdf->Cell(80, 20, 'RECEIPT');
$pdf->Ln();

$pdf->SetFontSize(14);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(80, 20, 'Trendy-Gear');
$pdf->Ln();

$pdf->SetTextColor(254, 152, 15);
$pdf->Cell(80, 20, 'BILL TO');
$pdf->Cell(100, 20, 'RECEIPT DATE');
$pdf->Ln();

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFontSize(12);
$pdf->Cell(80, 1, $mail);
$pdf->Ln();
$pdf->Cell(80, 10, $address);
$pdf->Cell(100, 1, $date);

$pdf->Ln(10);

$pdf->Cell(80, 5, 'Item', 1, 0, 'C', 0);
$pdf->Cell(20, 5, 'Price', 1, 0, 'C', 0);
$pdf->Cell(20, 5, 'Qty', 1, 0, 'C', 0);
$pdf->Cell(40, 5, 'Brand', 1, 0, 'C', 0);
$pdf->Cell(30, 5, 'Sub Total', 1, 0, 'C', 0);

$pdf->Ln(5);

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $skirt_id => $details) {
        $pdf->Cell(80, 5, $_SESSION['cart'][$skirt_id]['skirt_name'], 1, 0, 'C', 0);
        $pdf->Cell(20, 5, '$' . $_SESSION['cart'][$skirt_id]['price'], 1, 0, 'C', 0);
        $pdf->Cell(20, 5, $_SESSION['cart'][$skirt_id]['quantity'], 1, 0, 'C', 0);
        $pdf->Cell(40, 5, $_SESSION['cart'][$skirt_id]['brand_name'], 1, 0, 'C', 0);
        $pdf->Cell(30, 5, '$' . $_SESSION['cart'][$skirt_id]['total'], 1, 0, 'C', 0);
        $pdf->Ln(5);

    }

    foreach ($_SESSION['cart'] as $skirt_id => $details) {
        $total += $_SESSION['cart'][$skirt_id]['total'];
    }

    $pdf->SetFontSize(20);
    $pdf->SetTextColor(254, 152, 15);
    $pdf->Cell(80, 20, 'TOTAL: ', 0, 0, 'R');
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(80, 20, '$' . $total, 0, 0);

    $pdf->SetTextColor(254, 152, 15);
    $pdf->Ln(20);
    $pdf->SetFontSize(20);
    $pdf->SetFont('Courier', 'bu', 14);

    $pdf->Cell(80, 20, 'Terms and Conditions');
    $pdf->Ln(8);

    $pdf->SetFontSize(14);
    $pdf->SetFont('Courier', 'b', 14);

    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(80, 20, 'Payment is due on delivery.');
    $pdf->Ln(7);
    $pdf->Cell(80, 20, 'Free Shipping.');
}

$pdf->Output();
