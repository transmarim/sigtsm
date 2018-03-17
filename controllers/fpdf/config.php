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
                $this->SetFont('Arial','B',10);
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
            function ImprovedTable($header, $data)
            {
                // Anchuras de las columnas
                $w = array(40, 35, 45, 40);
                // Cabeceras
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C');
                $this->Ln();
                // Datos
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row[0],'LR');
                    $this->Cell($w[1],6,$row[1],'LR');
                    $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
                    $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
                    $this->Ln();
                }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
            }
        }

?>