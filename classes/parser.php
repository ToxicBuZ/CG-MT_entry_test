<?php
use Carbon\Carbon;

//create parser class
class parser{

    public $type;
    public $raw_data;
    public $parsed_data;

    //constructor
    public function __construct($settings)
    {
        $this->type = $settings['type'];
        $this->filename = $settings['file'];
        $this->date_field = $settings['date_field'];
        $this->click_field = $settings['click_field'];
        $this->format = $settings['format'];
        $this->title = $settings['title'];
        $this->error = false;
        $this->read_file();
        $this->parse_data();
     
     
    }

    //function to read .json & .csv files (with error handling)
    public function read_file(){

        if($this->type == 'json')
        {
            $data = file_get_contents($this->filename);
            if($data) $this->raw_data = json_decode($data,1);
            else{
                $this->error = true;
                $this->message = "unable to load file ".$this->filename;
            } 
        }

        if($this->type == 'csv')
        {
            $file = fopen($this->filename, 'r');
            if($file){
                while (($line = fgetcsv($file)) !== FALSE) {
                    $data[] = $line;
                }
                fclose($file);

                $headers = $data[0];
                unset($data[0]);
                foreach($data as $line)
                {
                    $this->raw_data[]=[
                        $headers[0]=>$line[0],
                        $headers[1]=>$line[1],
                        $headers[2]=>$line[2]
                    ];
                }
            }
            else {
                $this->error = true;
                $this->message = "unable to load file ".$this->filename;
            }
        }
 
    }

    // function to parse data
    public function parse_data()
    {
        $date_field = $this->date_field;
        $click_field = $this->click_field;
        $format = $this->format;

        foreach ($this->raw_data as $entry)
        {
            $date = Carbon::createFromFormat($format, $entry[$date_field])->format('d/m/Y');
            $this->parsed_data[$date] = ['date'=>$date ,'clicks'=>$entry[$click_field]];
        }
    }
}