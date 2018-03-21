<?php
            /*CONST DE LA TABLA*/
            class PDF extends FPDF{
            /*HEADER UNIVERSAL*/    
            function Header()
            {
                $this->SetFont('Arial','B',16);
                $this->SetLineWidth(0.1);
                $this->line(9.5,15,203,15);
                $this->SetLineWidth(0.5);
                $this->SetDrawColor(21,46,105);
                $this->SetFillColor(41,57,179);
                $this->Rect(177,10,26,5,'FD');
                $this->SetFont('Courier','B',10);
                $this->SetXY(30,11);
                $this->Cell(10,4,'TRANSPORT AND SERVICES MARINE, C.A.');
                $this->SetFont('Arial','B',8);
                $this->SetTextColor(255,255,255);
                $this->SetXY(179,11);
                $this->Cell(10,3,date('M. jS, Y'));
            }
            /*FOOTER UNIVERSAL*/
            function Footer()
            {
                $this->SetXY(-30,270);
                $this->SetFont('Arial','I',8);
                $this->Cell(25,4,'Pag '.$this->PageNo().'/{nb}',0,0,'C');
            }

            // Una tabla más completa
            function ImprovedTable($header, $data, $dctos)
            {
                // Anchuras de las columnas
                $w = array(30, 40, 30, 35, 40);
                // Cabeceras
                $this->SetFont('Courier','B',8);
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C');
                $this->Ln();
                $this->SetFont('Courier','',8);
                foreach($data as $row)
                {
                    $this->Cell($w[0],5,$row['fecha'],'LRB',0,'C');
                    $this->Cell($w[1],5,$row['nombre'],'LRB',0,'C');
                    $this->Cell($w[2],5,$row['codigo'],'LRB',0,'C');
                    $this->Cell($w[3],5,$row['nombrec'],'LRB',0,'C');
                    $this->Cell($w[4],5,number_format($row['montop'],2,',','.'),'LRB',0,'R');
                    // $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
                    // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
                    $totalp = $row['montop'] += $row['montop'];
                    $totalret = $row['montoret'] += $row['montoret'];
                    $this->Ln();
                }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
                $this->Ln();
                // Llamo descuentos
                foreach($dctos as $row)
                {
                    $this->Cell(100,5,'',0,0,'C');
                    $this->Cell($w[3],5,$row['nombre'],1,0,'L');
                    $this->Cell($w[4],5,number_format($row['montodesc'],2,',','.'),'LRB',0,'R');
                    $this->Ln();
                }

                //CELDA EN BLANCO PARA EMPUJAR
                    $this->SetFont('Courier','B',8);
                    $this->Cell(100,5,'',0,0,'C');
                    $this->Cell($w[3],5,'SUBTOTAL BS:',1,0,'L');
                    $this->Cell($w[4],5,number_format($totalp,2,',','.'),1,0,'R');
                    $this->Ln();
                    $this->Cell(100,5,'',0,0,'C');
                    $this->Cell($w[3],5,'DSCTO ISLR:',1,0,'L');
                    $this->Cell($w[4],5,number_format($totalret,2,',','.'),1,0,'R');
            }
        }

?>