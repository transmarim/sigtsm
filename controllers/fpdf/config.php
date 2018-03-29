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
            function tablaTSMPP($header, $data, $dctos)
            {
                // Anchuras de las columnas
                $w = array(30, 40, 30, 35, 40);
                //Variable que indica si se aplico sustraendo o no
                $nombreISLR = '';
                $subtotal = 0;
                $totalret = 0;
                $verificar = false;
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
                    $subtotal = $subtotal + $row['montop'];
                    $totalret = $totalret + $row['montoret'];
                    $this->Ln();
                }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
                $this->Ln();
                // Llamo descuentos
                foreach($dctos as $row)
                {
                    if($row['iddescuento'] != 1){
                        $this->Cell(100,5,'',0,0,'C');
                        $this->Cell($w[3],5,$row['nombre'],1,0,'L');
                        $this->Cell($w[4],5,number_format($row['montodesc']*-1,2,',','.'),'LRB',0,'R');
                        $this->Ln();
                        $nombreISLR = 'RET. ISLR:';
                        $subtotal = $subtotal - $row['montodesc'];
                        $totalret = $totalret - (0.01*$row['montodesc']);
                        $verificar = true;
                    } else {
                        $totalret = $totalret - $row['montodesc'];
                        $nombreISLR = 'RET. ISLR (-ST):';
                        $verificar = true;
                    }
                }

                //CELDA EN BLANCO PARA EMPUJAR
                    $this->SetFont('Courier','B',8);
                    $this->Cell(100,5,'',0,0,'C');
                    $this->Cell($w[3],5,'SUBTOTAL BS:',1,0,'L');
                    $this->Cell($w[4],5,number_format($subtotal,2,',','.'),1,0,'R');
                    $this->Ln();
                    $this->Cell(100,5,'',0,0,'C');
                    if($verificar != false){
                        $this->Cell($w[3],5,$nombreISLR,1,0,'L'); 
                    }else{
                        $this->Cell($w[3],5,'RET. ISLR:',1,0,'L');
                    }
                    $this->Cell($w[4],5,number_format($totalret,2,',','.'),1,0,'R');
                    $this->Ln();
                    $this->Cell(100,5,'',0,0,'C');
                    $this->Cell($w[3],5,'TOTAL:',1,0,'L');
                    $this->Cell($w[4],5,number_format($subtotal - $totalret,2,',','.'),1,0,'R');
            }

            function tablaCBPP($header, $data)
            {
                // Anchuras de las columnas
                $w = array(30, 40, 30, 35, 40);
                //Variable que indica si se aplico sustraendo o no
                $nombreISLR = '';
                $subtotal = 0;
                $totalret = 0;
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
                    $subtotal = $subtotal + $row['montop'];
                    $this->Ln();
                }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
                $this->Ln();

                //CELDA EN BLANCO PARA EMPUJAR
                    $this->SetFont('Courier','B',8);
                    $this->Cell(100,5,'',0,0,'C');
                    $this->Cell($w[3],5,'SUBTOTAL BS:',1,0,'L');
                    $this->Cell($w[4],5,number_format($subtotal,2,',','.'),1,0,'R');
                    $this->Ln();
                    $this->Cell(100,5,'',0,0,'C');
                    $this->Cell($w[3],5,'TOTAL:',1,0,'L');
                    $this->Cell($w[4],5,number_format($subtotal - $totalret,2,',','.'),1,0,'R');
            }

            function tablaTSMRP($header, $data, $startDate, $endDate)
            {
                // Anchuras de las columnas
                $w = array(65, 65, 65, 65);
                $itemresumenp = new Imprimir();
                //Variable que indica si se aplico sustraendo o no
                $subtotal = 0;
                $totalret = 0;
                // Cabeceras
                $this->SetFont('Courier','B',8);
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C');
                $this->Ln();
                $this->SetFont('Courier','',8);

                foreach($data as $row)
                {
                    $rspta = $itemresumenp->resumenDctosPP($startDate,$endDate,$row['idchofer']);
                    //Pregunto si tiene descuentos
                    if($rspta['idchofer'] != null ){
                        $this->Cell($w[0],5,$row['nombre'],'LRB',0,'L');
                        //Verifico si tiene sustraendos
                        $rspta2 = $itemresumenp->mostrarSustraendo($startDate,$endDate,$row['idchofer']);
                        if($rspta2['iddescuento'] != null ){
                            //Calculamos el monto y el ISLR OJO restar Sust al descuento
                            $monto = ($row['monto']-$rspta['montodesc'])+$rspta2['montodesc'];
                            $islr = ($row['ret']-(0.01*($rspta['montodesc']-$rspta2['montodesc'])))-$rspta2['montodesc'];
                            $this->Cell($w[1],5,number_format($monto,2,',','.'),'LRB',0,'R');
                            $this->Cell($w[2],5,number_format($islr,2,',','.'),'LRB',0,'R');
                            $this->Cell($w[3],5,number_format($monto-$islr,2,',','.'),'LRB',0,'R');
                            $subtotal = $subtotal+$monto;
                            $totalret = $totalret+$islr;
                        }else{
                            $monto2 = $row['monto']-$rspta['montodesc'];
                            $islr2 = $row['ret']-(0.01*$rspta['montodesc']);
                            $this->Cell($w[1],5,number_format($monto2,2,',','.'),'LRB',0,'R');
                            $this->Cell($w[2],5,number_format($islr2,2,',','.'),'LRB',0,'R');
                            $this->Cell($w[3],5,number_format($monto2-$islr2,2,',','.'),'LRB',0,'R');
                            $subtotal = $subtotal+$monto2;
                            $totalret = $totalret+$islr2;
                        }
                        $this->Ln();
                    }else{
                        $this->Cell($w[0],5,$row['nombre'],'LRB',0,'L');
                        $this->Cell($w[1],5,number_format($row['monto'],2,',','.'),'LRB',0,'R');
                        $this->Cell($w[2],5,number_format($row['ret'],2,',','.'),'LRB',0,'R');
                        $this->Cell($w[3],5,number_format($row['monto']-$row['ret'],2,',','.'),'LRB',0,'R');
                        $subtotal = $subtotal+$row['monto'];
                        $totalret = $totalret + $row['ret'];
                        $this->Ln();
                    }
                }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
                $this->Ln();
                //CELDA FINALES
                $this->SetFont('Courier','B',8);
                $this->Cell($w[0],5,'TOTALES BS:','LRB',0,'L');
                $this->Cell($w[1],5,number_format($subtotal,2,',','.'),'LRB',0,'R');
                $this->Cell($w[2],5,number_format($totalret,2,',','.'),'LRB',0,'R');
                $this->Cell($w[3],5,number_format($subtotal-$totalret,2,',','.'),'LRB',0,'R');
            }

            function tablaCARIBRP($header, $data, $startDate, $endDate)
            {
                // Anchuras de las columnas
                $w = array(65, 65, 65, 65);
                $itemresumenp = new Imprimir();
                //Variable que indica si se aplico sustraendo o no
                $subtotal = 0;
                $totalret = 0;
                // Cabeceras
                $this->SetFont('Courier','B',8);
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C');
                $this->Ln();
                $this->SetFont('Courier','',8);

                foreach($data as $row)
                    {
                        $this->Cell($w[0],5,$row['nombre'],'LRB',0,'L');
                        $monto = $row['monto'];
                        $this->Cell($w[1],5,number_format($monto,2,',','.'),'LRB',0,'R');
                        $this->Cell($w[2],5,number_format('0.00',2,',','.'),'LRB',0,'R');
                        $this->Cell($w[3],5,number_format($monto,2,',','.'),'LRB',0,'R');
                        $subtotal = $subtotal+$monto;
                        $this->Ln();  
                    }
                // Línea de cierre
                $this->Cell(array_sum($w),0,'','T');
                $this->Ln();
                //CELDA FINALES
                $this->SetFont('Courier','B',8);
                $this->Cell($w[0],5,'TOTALES BS:','LRB',0,'L');
                $this->Cell($w[1],5,number_format($subtotal,2,',','.'),'LRB',0,'R');
                $this->Cell($w[2],5,number_format('0.00',2,',','.'),'LRB',0,'R');
                $this->Cell($w[3],5,number_format($subtotal,2,',','.'),'LRB',0,'R');
                }   
            }

?>