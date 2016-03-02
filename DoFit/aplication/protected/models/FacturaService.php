<?php

class FacturaService
{

	public function GenerarFactura($actividad,$usuario,$anio,$mes){
        $list = Yii::app()->db->createCommand('select ficha_institucion.nombre nombregym,ficha_institucion.direccion direcciongym,ficha_institucion.telfijo,a.localidad localidadgym,b.provincia provinciagym,pago.id_actividad,pago.id_usuario,ficha_institucion.cuit,ficha_usuario.nombre nombrealu,ficha_usuario.apellido apellidoalu,ficha_usuario.direccion direccionalu,c.localidad localidadalu,d.provinciaalu provincialu,deporte.deporte,actividad.valor_actividad from  pago,actividad,ficha_usuario,ficha_institucion,deporte,localidad a,provincia b, localidad c, provincia d where pago.id_actividad = '.$actividad.' and pago.id_usuario = '.$usuario.' and pago.mes = '.$mes.' and pago.anio = '.$anio.' and ficha_usuario.id_usuario = pago.id_usuario and actividad.id_actividad = pago.id_actividad and actividad.id_institucion = ficha_institucion.id_institucion and actividad.id_deporte = deporte.id_deporte and ficha_institucion.id_localidad = a.id_localidad and a.id_provincia = b.id_provincia and ficha_usuario.id_localidad = c.id_localidad and c.id_provincia = d.id_provincia')->queryAll();

        foreach($list as $f){
            $nombreGimnasio = $f->nombregym;
            $direccionGimnasio = $f->direcciongym;
            $telefonoGimnasio = $f->telfijo;
            $localidadGimnasio = $f->localidadgym;
            $provinciaGimnasio = $f->provinciagym;
            $cuitGimnasio = $f->cuit;
            $nombreAlumno = $f->nombrealu;
            $apellidoAlumno = $f->apellidoalu;
            $direccionAlumno = $f->direccionalu;
            $localidadAlumno = $f->localidadalu;
            $provinciaAlumno = $f->provincialu;
            $deporte = $f->deporte;
            $precio = $f->valor_actividad;
        }

        $pdf = Yii::app()->ePdf->mpdf();
        $pdf->AddPage('P', 'A4','','titulo');
        $pdf->SetFont('Arial','',11);
        $pdf->Rect(10, 10, 95, 40);
        $pdf->Rect(10, 10, 190, 40);
        $pdf->Ln(8);
        $pdf->Cell(95,10,'UNIVERSIDAD NACIONAL DE LA MATANZA',0,1,'C');
        $pdf->Cell(95,5,'Florencio Varela 1903 - (1754) San Justo',0,1,'C');
        $pdf->Cell(95,5,'Prov. de Buenos Aires - Tel.: 4480-8900',0,1,'C');
        $pdf->Cell(95,5,'I.V.A. Exento',0,1,'C');
        $pdf->SetXY(110,10);
        $pdf->Cell(95,10,'VOLANTE DE PAGO',0,1,'L');
        $pdf->SetXY(110,15);
        $pdf->Cell(95,10,'Nº 25805',0,1,'L');
        $pdf->SetXY(115,25);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(95,5,'FECHA:',0,1,'L');
        $pdf->SetXY(160,25);
        $pdf->Cell(95,5,'01/03/2016',0,1,'L');
        $pdf->SetXY(115,30);
        $pdf->Cell(95,5,'C.U.I.T:',0,1,'L');
        $pdf->SetXY(160,30);
        $pdf->Cell(95,5,'30-65892485-5',0,1,'L');
        $pdf->SetXY(115,35);
        $pdf->Cell(95,5,'Ing. Brutos:',0,1,'L');
        $pdf->SetXY(160,35);
        $pdf->Cell(95,5,'No contribuyente',0,1,'L');
        $pdf->SetXY(115,40);
        $pdf->Cell(95,5,'Inicio Actividades:',0,1,'L');
        $pdf->SetXY(160,40);
        $pdf->Cell(95,5,'01/04/2016',0,1,'L');
        $pdf->Rect(10, 50, 190, 40);
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(17,50);
        $pdf->Cell(95,10,'Señores:',0,1,'L');
        $pdf->SetXY(40,50);
        $pdf->Cell(95,10,'CASTELLINI DAMIAN IGNACIO:',0,1,'L');
        $pdf->SetXY(17,60);
        $pdf->Cell(95,10,'Domicilio:',0,1,'L');
        $pdf->SetXY(40,60);
        $pdf->Cell(95,10,'-',0,1,'L');
        $pdf->SetXY(17,70);
        $pdf->Cell(95,10,'Localidad:',0,1,'L');
        $pdf->SetXY(40,70);
        $pdf->Cell(95,10,'-',0,1,'L');
        $pdf->SetXY(17,80);
        $pdf->Cell(95,10,'IVA:',0,1,'L');
        $pdf->SetXY(40,80);
        $pdf->Cell(95,10,'General',0,1,'L');
        $pdf->Ln(5);
        $w = array(30, 100, 30, 30);
        $pdf->Cell($w[0],10,'CANTIDAD',1,1,'C');
        $pdf->SetXY(40,95);
        $pdf->Cell($w[1],10,'DESCRIPCION',1,1,'C');
        $pdf->SetXY(140,95);
        $pdf->Cell($w[2],10,'P. UNITARIO',1,1,'C');
        $pdf->SetXY(170,95);
        $pdf->Cell($w[2],10,'TOTAL',1,1,'C');
        $pdf->SetXY(10,105);
        $pdf->Cell($w[0],10,'10',0,1,'C');
        $pdf->SetXY(40,105);
        $pdf->Cell($w[1],10,'Cambio de carrera - Cuota 1 de 1',0,1,'L');
        $pdf->SetXY(140,105);
        $pdf->Cell($w[2],10,'150.0',0,1,'C');
        $pdf->SetXY(170,105);
        $pdf->Cell($w[2],10,'150.0',0,1,'C');
        $pdf->Rect(10, 210, 190, 30);
        $pdf->Rect(10, 240, 120, 30);
        $pdf->Rect(130, 240, 35, 17);
        $pdf->Rect(165, 240, 35, 17);
        $pdf->Rect(130, 257, 35, 13);
        $pdf->Rect(165, 257, 35, 13);
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(50,213);
        $pdf->Cell(50,5,'Código de barras Pago Fácil',0,1,'C');
        $pdf->SetXY(15,243);
        $pdf->Cell(20,5,'Código Banelco:',0,1,'L');
        $pdf->SetXY(80,243);
        $pdf->Cell(30,5,'-',0,1,'L');
        $pdf->SetXY(15,248);
        $pdf->Cell(20,5,'Código de PagosLink:',0,1,'L');
        $pdf->SetXY(80,248);
        $pdf->Cell(30,5,'-',0,1,'L');
        $pdf->SetXY(15,253);
        $pdf->Cell(20,5,'Código de Tesorería:',0,1,'L');
        $pdf->SetXY(80,253);
        $pdf->Cell(30,5,'-',0,1,'L');
        $pdf->SetXY(131,243);
        $pdf->Cell(30,5,'TOTAL',0,1,'L');
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(131,253);
        $pdf->Cell(30,5,'Hasta:   29/02/2016',0,1,'L');
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(168,250);
        $pdf->Cell(30,5,'150.0',0,1,'C');
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(131,265);
        $pdf->Cell(30,5,'Hasta:   -',0,1,'L');
        $pdf->SetXY(168,265);
        $pdf->Cell(30,5,'-',0,1,'C');
        $pdf->Output();


	}



}
