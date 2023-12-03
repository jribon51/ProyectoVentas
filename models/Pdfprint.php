<?php
    require_once '../include/vendor/autoload.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;

    require_once("../config/conexion.php");
    require_once("../models/Venta.php");

    class Pdfprint extends Conectar{

        public function generar_pdf_venta($vent_id){

            $options = New Options();

            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);

            $css = file_get_contents('../assets/css/stylepdf.css');

            $venta = new Venta();
            /* Obteniendo el detalle de cabezera */
            $cabezera = $venta->get_venta($vent_id);
            foreach ($cabezera as $rowc){
                $documento = $rowc["DOC_NOM"];

                $empresa = $rowc["EMP_NOM"];
                $empresaruc = $rowc["EMP_RUC"];
                $empresacorreo = $rowc["EMP_CORREO"];
                $empresatelf = $rowc["EMP_TELF"];

                $clinom = $rowc["CLI_NOM"];
                $cliruc = $rowc["CLI_RUC"];
                $clidirecc = $rowc["CLI_DIRECC"];
                $clicorreo = $rowc["CLI_CORREO"];
                $fechcrea = $rowc["FECH_CREA"];
                $pago = $rowc["PAG_NOM"];

                $subtotal = $rowc["VENT_SUBTOTAL"];
                $igv = $rowc["VENT_IGV"];
                $total = $rowc["VENT_TOTAL"];
            }

            /* TODO: Obteniendo el detalle */
            $detalle = $venta->get_venta_detalle($vent_id);
            $tbody="";
            foreach($detalle as $row){
                $tbody.='
                    <tr>
                        <td class="service">'.$row["CAT_NOM"].'</td>
                        <td class="desc">'.$row["PROD_NOM"].'</td>
                        <td class="service">'.$row["UND_NOM"].'</td>
                        <td class="unit">'.$row["PROD_PVENTA"].'</td>
                        <td class="qty">'.$row["DETV_CANT"].'</td>
                        <td class="total">'.$row["DETV_TOTAL"].'</td>
                    </tr>
                ';
            }

            $html ='
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <title>v-' . $vent_id . '</title>
                    <style>' . $css . '</style>
                </head>
                <body>
                    <header class="clearfix">
                    <div id="logo">
                        <img src="http://localhost:90/PERSONAL_CompraVenta/assets/images/logopdf.png">
                    </div>
                    <h1>' . $documento . ' ' . $vent_id . '</h1>
                    <div id="company" class="clearfix">
                        <div>' . $empresa . '</div>
                        <div>' . $empresaruc . '</div>
                        <div>' . $empresatelf . '</div>
                        <div>' . $empresacorreo . '</div>
                    </div>
                    <div id="project">
                        <div><span>Nombre</span> ' . $clinom . '</div>
                        <div><span>RUC</span> ' . $cliruc . '</div>
                        <div><span>Dirección</span> ' . $clidirecc . '</div>
                        <div><span>Correo</span> <a href="' . $clicorreo . '">' . $clicorreo . '</a></div>
                        <div><span>Fecha</span> ' . $fechcrea . '</div>
                        <div><span>Pago</span> ' . $pago . '</div>
                    </div>
                    </header>
                    <main>
                    <table>
                        <thead>
                        <tr>
                            <th class="service">Categoria</th>
                            <th class="desc">Producto</th>
                            <th>Und</th>
                            <th>P.Venta</th>
                            <th>Cant</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        '.$tbody.'
                        <tr>
                            <td colspan="5">SubTotal</td>
                            <td class="total">' . $subtotal . '</td>
                        </tr>
                        <tr>
                            <td colspan="5">IGV (18%)</td>
                            <td class="total">' . $igv . '</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="grand total">Total</td>
                            <td class="grand total">' . $total . '</td>
                        </tr>
                        </tbody>
                    </table>
                    <div id="notices">
                        <div>NOTICE:</div>
                        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    </div>
                    </main>
                    <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                    </footer>
                </body>
                </html>
            ';

            $dompdf->loadHtml($html);
            $dompdf->render();

            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=v-'.$vent_id.'.pdf');
            header('Cache-Control: public, must-revalidate, max-age=0');
            header('Pragma: public');

            $filelocation = "../assets/pdf/venta/v-".$vent_id.".pdf";
            $dompdf->output();
            file_put_contents($filelocation,$dompdf->output());

            exit();

        }

    }
?>