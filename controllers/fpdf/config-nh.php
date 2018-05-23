<?php
            /*CONST DE LA TABLA*/
            class PDF extends FPDF{
            /*HEADER UNIVERSAL*/    
            function Header()
            {

            }
            /*FOOTER UNIVERSAL*/
            function Footer()
            {
                $this->SetXY(-30,270);
                $this->SetFont('Arial','I',8);
                $this->Cell(25,4,'Pag '.$this->PageNo().'/{nb}',0,0,'C');
            }

            function obFecha($fecha)
            {
                function conocerDiaSemanaFecha($fecha) 
                {
                    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
                    $dia = $dias[date('w', strtotime($fecha))];
                    return $dia;
                }
                $dia= conocerDiaSemanaFecha($fecha);
                $num = date("j", strtotime($fecha));
                $anno = date("Y", strtotime($fecha));
                $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                $mes = $mes[(date('m', strtotime($fecha))*1)-1];
                return $dia.', '.$num.' de '.$mes.' del '.$anno;
            }

        }

        // Una tabla detalle ticket
        function tablaChoferes($header, $choferes)
        {
            // Anchuras de las columnas
            $w = array(30, 25, 35, 30, 30, 30);
            // Cabeceras
            $this->SetFont('Courier','B',8);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->Ln();
            $this->SetFont('Courier','',8);
            foreach($data as $row)
            {
                $this->Cell($w[0],5,$row['fecha'],'LRB',0,'C');
                $this->Cell($w[1],5,$row['chofer'],'LRB',0,'C');
                $this->Cell($w[2],5,$row['centro'],'LRB',0,'C');
                $this->Cell($w[3],5,$row['descripcion'],'LRB',0,'C');
                $this->Cell($w[4],5,$row['cliente'],'LRB',0,'C');
                $this->Cell($w[5],5,number_format($row['montop'],2,',','.'),'LRB',0,'R');
                $this->Cell($w[6],5,$row['estado'],'LRB',0,'C');
                $this->Ln();
            }
            // Línea de cierre
            $this->Cell(array_sum($w),0,'','T');
            $this->Ln();
        }



?>