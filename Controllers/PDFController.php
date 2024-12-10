<?php
    require_once __DIR__ . '/../vendor/tecnickcom/tcpdf/tcpdf.php';
    require_once __DIR__ . '/../Models/Compra.php';
    
    class PDFController {
        private $compra;

        public function __construct($conn) {
            $this->compra = new Compra($conn);
        }

        public function generarPDF($comp_id) {
            $compraDetalles = $this->compra->obtenerCompraPorId($comp_id);

            if (!$compraDetalles || !isset($compraDetalles['compra']) || !isset($compraDetalles['cliente'])) {
                echo "No se encontraron datos de la compra.";
                return;
            }

            $pdf = new TCPDF();
            $pdf->setAutoPageBreak(TRUE, 15);
            $pdf->AddPage();
        
            $pdf->setFont('helvetica', '', 12);
            $compra = $compraDetalles['compra'];
            $cliente = $compraDetalles['cliente'];

            $pdf->Cell(0,10, 'Id de la Compra: ' . $compra['comp_id'], 0, 1);
            $pdf->Cell(0,10, 'Estado de la Compra: ' . $compra['comp_status'], 0, 1);
            $pdf->Cell(0,10, 'Fecha del Pedido: ' . $compra['comp_fPedio'], 0, 1);
            $pdf->Cell(0, 10, 'Fecha Entrega: ' . ($compra['comp_fEntrega'] ?: 'Pendiente'), 0, 1);
            $pdf->Cell(0, 10, 'Total: $' . number_format((float)$compra['comp_total'], 2), 0, 1);
            $pdf->Cell(0, 10, 'Cliente: ' . $cliente['cli_nombre'] . ' ' . $cliente['cli_apellido'], 0, 1);
            $pdf->Cell(0, 10, 'Correo: ' . $cliente['cli_email'], 0, 1);
            $pdf->Cell(0, 10, 'RFC: ' . $cliente['cli_rfc'], 0, 1);

            $pdf->Ln(10);
            $pdf->setFont('helvetica', 'B', 12);
            $pdf->Cell(70, 10, 'Vinilo', 1, 0, 'C');
            $pdf->Cell(40,10, 'Precio', 1, 1, 'C');

            foreach ($compraDetalles['vinilos'] as $vinilo) {
                $pdf->setFont('helvetica', '', 12);
                $pdf->Cell(70, 10, $vinilo['vin_nombre'], 1, 0);
                $pdf->Cell(40, 10, '$' . number_format((float)$vinilo['precio'], 2), 1, 1, 'C');
            }

            $pdf->Output('Compra_' . $compra['comp_id'] . '.pdf', 'I');
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $pdfController = new PDFController($conn);
    
        if (isset($_GET['action']) && $_GET['action'] === 'generar_pdf' && isset($_GET['comp_id'])) {
            $comp_id = $_GET['comp_id'];
            $pdfController->generarPDF($comp_id);
            exit;
        }
    }
?>