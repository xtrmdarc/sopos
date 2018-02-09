<?php
	/** Se agrega la libreria PHPExcel */
	require_once 'assets/lib/PHPExcel/PHPExcel.php';

	// Se crea el objeto PHPExcel
	$objPHPExcel = new PHPExcel();

	// Se asignan las propiedades del libro
	$objPHPExcel->getProperties()->setCreator("Tommy Leonard") //Autor
						 ->setLastModifiedBy("Tommy Leonard") //Ultimo usuario que lo modificó
						 ->setTitle("Reporte ventas")
						 ->setSubject("Reporte ventas")
						 ->setDescription("Reporte ventas")
						 ->setKeywords("Reporte ventas")
						 ->setCategory("Reporte ventas");

	$tituloReporte = "Reporte General de Ventas del día ".$_SESSION["min-1"]." al día ".$_SESSION["max-1"];
	$titulosColumnas = array('Fecha','Caja','Cliente','DNI/RUC','Tipo Doc.','Serie Doc.', 'Num Doc.','Total','Dscto','Tipo','Estado');
	
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:K2');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
  		    ->setCellValue('A5',$titulosColumnas[0])
          ->setCellValue('B5',$titulosColumnas[1])
  		    ->setCellValue('C5',$titulosColumnas[2])
  		    ->setCellValue('D5',$titulosColumnas[3])
  		    ->setCellValue('E5',$titulosColumnas[4])
  		    ->setCellValue('F5',$titulosColumnas[5])
  		    ->setCellValue('G5',$titulosColumnas[6])
  		    ->setCellValue('H5',$titulosColumnas[7])
  		    ->setCellValue('I5',$titulosColumnas[8])
  		    ->setCellValue('J5',$titulosColumnas[9])
  		    ->setCellValue('K5',$titulosColumnas[10]);
		
		//Se agregan los datos
		$i = 6;

		foreach($data as $r){

			$objPHPExcel->setActiveSheetIndex(0)
		  ->setCellValue('A'.$i, date('d-m-Y h:i A',strtotime($r->fec_ven)))
		  ->setCellValue('B'.$i, html_entity_decode($r->desc_caja, ENT_QUOTES, "UTF-8"))
		  ->setCellValue('C'.$i, html_entity_decode($r->Cliente->nombre, ENT_QUOTES, "UTF-8"))
		  ->setCellValue('D'.$i, html_entity_decode($r->Cliente->numero, ENT_QUOTES, "UTF-8"))
		  ->setCellValue('E'.$i, html_entity_decode($r->desc_td, ENT_QUOTES, "UTF-8"))
		  ->setCellValueExplicit('F'.$i, $r->ser_doc, PHPExcel_Cell_DataType::TYPE_STRING)
		  ->setCellValueExplicit('G'.$i, $r->nro_doc, PHPExcel_Cell_DataType::TYPE_STRING)
		  ->setCellValue('H'.$i, number_format($r->total, 2))
		  ->setCellValue('I'.$i, number_format($r->descu, 2))
		  ->setCellValue('J'.$i, 'Contado')
			->setCellValue('K'.$i, 'ACTIVO');

			$i++;
		}

		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Calibri',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>13.5,
	            	'color'     => array(
    	            	'rgb' => 'ffffff'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => '263847')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name' => 'Calibri', 
								'size' => 9, 
                'bold' => true,                          
                'color' => array(
                    'rgb' => '000000'
                )
            ),
            'fill' 	=> array(
						'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
						'rotation'   => 90,
		        		'startcolor' => array(
		            		'rgb' => 'FFFFFF'
		        		),
		        		'endcolor'   => array(
		            		'argb' => 'FFFFFF'
		        		)
					),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                	'color' => array(
    	            	'argb' => 'e5e5e4'
                   	)                  
               	)
            ), 
						'alignment' =>  array(
			        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			        			'wrap'          => TRUE
			    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Calibri', 
								'size' =>9,              
               	'color'     => array(
                   	'argb' => '000000'
               	)
           	),
           	'fill' 	=> array(
						'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
						'color'		=> array('argb' => 'FFFFFF')
					),
           	'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                	'color' => array(
    	            	'argb' => 'e5e5e4'
                   	)                  
               	)
            ), 
						'alignment' =>  array(
			        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			        			'wrap'          => TRUE
			    		)
        ));
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:K2')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A5:K5')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A6:K".($i-1));
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(A)->setWidth(25);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(B)->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(C)->setWidth(50);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(D)->setWidth(20);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(E)->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(F)->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(G)->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(H)->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(I)->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(J)->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(K)->setWidth(15);
				
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Reporte General');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ReporteGeneral.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
    $objWriter->save('php://output');

?>