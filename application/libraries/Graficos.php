<?php 
class Graficos {
	var $highcharts	= '<script src="http://localhost/Durox/libraries/highcharts-4.1.9/js/highcharts.js"></script>';
	var $exporting	= '<script src="http://localhost/Durox/libraries/highcharts-4.1.9/js/modules/exporting.js"></script>';
	var $tresD		= '<script src="http://localhost/Durox/libraries/highcharts-4.1.9/js/highcharts-3d.js"></script>';
	var $carga; 
		
	function __construct(){
		$this->carga = 0;
	}
	
	function torta($opciones, $datos){
		if(!isset($opciones['type']) || (
			$opciones['type'] != 'legend' && 
			$opciones['type'] != 'chart' &&
			$opciones['type'] != '3d' &&
			$opciones['type'] != 'donut' )){
			$opciones['type'] = 'legend';
		}
		
		$return = '';	
		
		if($this->carga == 0){
			$this->highcharts = str_replace("http://localhost/Durox/", base_url(), $this->highcharts);
			$this->exporting = str_replace("http://localhost/Durox/", base_url(), $this->exporting);
			$this->tresD = str_replace("http://localhost/Durox/", base_url(), $this->tresD);
			
			$return .= $this->highcharts;
			$return .= $this->exporting;
			$return .= $this->tresD;
			$this->carga = 1;
		}
		
		$return .= '<script>';
		$return .= '$(function () {';
    	$return .= '$(document).ready(function () {';
        $return .= "$('#".$opciones['id']."').highcharts({";
        $return .= " chart: {
		                plotBackgroundColor: null,
		                plotBorderWidth: null,
		                plotShadow: false,
		                type: 'pie'";
		if($opciones['type'] == '3d' || $opciones['type'] == 'donut'){
			 $return .= ", options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }";
		}				
        $return .= " },";
        if(isset($opciones['title'])){
        	$return .= "title: {
                			text: '".$opciones['title']."'
            			},";
        }
		$return .= "tooltip: {
                		pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            		},";
					
		$return .= "plotOptions: {";			
		if($opciones['type'] == 'legend'){
			$return .=" pie: {
		                   allowPointSelect: true,
		                   cursor: 'pointer',
		                   dataLabels: {
		                       enabled: false
		                   },
		                   showInLegend: true
		               }";
            		
		}else if($opciones['type'] == 'chart'){
			$return .=" pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
                }";
		}else if($opciones['type'] == '3d'){
			$return .=" pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }";
		}else if($opciones['type'] == 'donut'){
			$return .=" pie: {
				innerSize: 100,
                depth: 45
            }";
		}
		
		$return .= " },";		
		
		$return .= " series: [{
		                name: 'Brands',
		                colorByPoint: true,
		                data: [";
                 
		foreach ($datos as $key => $value) {
			$return .= "{
				name: '".$key." ".$value."',
				y:".$value."
			}, ";	
		}
		$return = substr($return, 0, -1);
		$return .="	]
            		}]
        			});
    				});
					});";
					
		$return .= '</script>';	
		
		return $return;		
	}



	function barra($opciones, $datos){
		if(!isset($opciones['type']) ||(
			$opciones['type'] != 'line' && 
			$opciones['type'] != 'column' &&
			$opciones['type'] != 'area' &&
			$opciones['type'] != '3d'
		)){
			$opciones['type'] = 'line';
		}
		
		$categories = array();
		foreach ($datos as $name => $valores) {
			foreach ($valores as $categoria => $value) {
				if(!in_array($categoria, $categories)){
					$categories[] = $categoria;	
				}	 
			}
		}	
		
		$return = '';	
		
		if($this->carga == 0){
			$this->highcharts = str_replace("http://localhost/Durox/", base_url(), $this->highcharts);
			$this->exporting = str_replace("http://localhost/Durox/", base_url(), $this->exporting);
			$this->tresD = str_replace("http://localhost/Durox/", base_url(), $this->tresD);
			
			$return .= $this->highcharts;
			$return .= $this->exporting;
			$return .= $this->tresD;
			$this->carga = 1;
		}
		
		$return .= '<script>';
		
		$return .= '$(function () {';
    	$return .= "$('#".$opciones['id']."').highcharts({";
		
		if($opciones['type'] != 'line'){
			if($opciones['type'] == '3d'){
				$return .= "chart: {
		           renderTo: 'container',
		            type: 'column',
		            margin: 75,
		            options3d: {
		                enabled: true,
		                alpha: 15,
		                beta: 15,
		                depth: 50,
		                viewDistance: 25
		            }
        		},";
			}else if($opciones['type'] == 'area'){
				$return .= " chart: {
	            	type: 'area'
	        	},";
			}else if($opciones['type'] == 'column'){
				$return .= " chart: {
	            	type: 'column'
	        	},";
			}
		}
		
    	if(isset($opciones['title'])){
        	$return .= "title: {
                			text: '".$opciones['title']."',
                			x: -20
            			},";
        }
        
        $return .=" xAxis: {
             			categories: [";
		
		$test = '';
		foreach ($categories as $categoria) {
			$test .="'".$categoria."',";	 
		}
		$return .= substr($test, 0, -1);
		$return .="] },";	
        $return .= "    
        yAxis: {
            title: {
                text: 'total'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '$'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
		series: [";
       		foreach ($datos as $key => $valores) {
				$return .= "{
		        			name: '".$key."',
		           			data: [";
					foreach ($categories as $categoria) {
						if(isset($valores[$categoria])){
							$return .=' '.$valores[$categoria].',';		 
						}else{
							$return .=' 0,';		 
						}
						
					}   			
				$return = substr($return, 0, -1);
				$return.= ']} ,';
			}
		$return = substr($return, 0, -1);	
		$return .= "	
					]
			    });
			});
		</script>";
		
		return $return;
	}
}