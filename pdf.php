
<?php
include "db.php";
require "vendor/autoload.php";
$result = $conn->query("select * from products1");
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('times','I', 12);

$html = '<table border="1" cellspacing="0" cellpadding="5">
<tr>
<td>P_ID</td>
<td>P_Name</td>
<td>P_Category</td>
<td>P_Price</td>
<td>P_Quantity</td>
<td>Description</td>
</tr>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
    <td>'.$row['p_id'].'</td>
    <td>'.$row['p_name'].'</td>
    <td>'.$row['category'].'</td>
     <td>'.$row['price'].'</td>
    <td>'.$row['quantity'].'</td>
    <td>'.$row['description'].'</td>
    </tr>';
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Products1.pdf', 'D');
?>