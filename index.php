<?php 
require 'vendor/autoload.php';
require 'classes/parser.php';
use Carbon\Carbon;
use Carbon\CarbonPeriod;
error_reporting(0);


//Setup parsers
$settings = [
    'type'=>'json',
    'file'=>'./data/daily.json',
    'format'=>'d/m/Y',
    'date_field'=>'date',
    'click_field'=>'hits',
    'title'=>'Google Analytics'
];

$parsers[] = new parser($settings);

$settings = [
    'type'=>'csv',
    'file'=>'./data/daily.csv',
    'format'=>'d/m/Y',
    'date_field'=>'day',
    'click_field'=>'views',
    'title'=>'Positive Guys'
];

$parsers[] = new parser($settings);


//Setup lookup period to aggregate results
$start = Carbon::createFromFormat('d/m/Y',$_GET['start']);
$end = Carbon::createFromFormat('d/m/Y',$_GET['end']);
$period = new CarbonPeriod($start,$end);


//Lookup every day in periods and sum the parsers results
$aggregated = [];

foreach($parsers as $p)
{
    if(!$p->error){
        $result['error'] = $p->error;
        $result['message'] = $p->message;
        foreach($period as $day)
        {
            $day_text = $day->format('d/m/Y');
            
            if(!array_key_exists($p->title,$aggregated)) $aggregated[$p->title]=0;
            
            if(array_key_exists($day_text,$p->parsed_data))
            {
                $aggregated[$p->title] += $p->parsed_data[$day_text]['clicks'];
            }

        }
    }
    else
    {
        $result['error'] = $p->error;
        $result['message'] = $p->message;
    }
}


//echo result
$result['data']=$aggregated;
echo json_encode($result,JSON_UNESCAPED_SLASHES);


// test echo

//echo '<pre>';
//print_r($result);
//echo '</pre>';
