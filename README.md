## CG_entry_test

For a thorough briefing of the assignment please check api_task.txt <br/>

* The output of this file is in .json format. This program can only read .json or .csv files as input, but can easily be upgraded to read more types.
* Google Analytics counts the total clicks of the daily.json file for given dates.
* Positives Guys counts the total clicks of the daily.csv file for given dates.
<br/>
* Since the data are completely random, some entries exist more than once and with different number of clicks (for example: 24/2/2019 in daily.json file)
* For double entries, only the entry with the highest ID number will be counted. (for example: 24/2/2019 - only the entry with ID=997 will be counted, not the entries with ID=167 or ID=772 or ID=779)
* If the inputs are valid the user shall see "error":false, "message":"" on the output (for example: {"error":false,"message":"","data":{"Google Analytics":87,"Positive Guys":86}} ).
* If the inputs are invalid, the user shall see {"error":true,"message":"unable to load file (filename)"}
### Prerequisites

* PHP version 7+ ( to install LAMP version of PHP, please visit https://www.apachefriends.org/index.html)
* Carbon  ( for more info about the Carbon class, please visit https://carbon.nesbot.com/docs/ )

###  Data for input

* The daily.csv and daily.json files were created from Mockaroo ( for more information about Mockaroo and mock data please visit https://mockaroo.com/ )

### Installing

The project is plug & play. Open in a server and run the index.php file.

### Running the tests

To test the project please use the following extension in the searchbar.

* ?start=*date*&end=*date* (for example:  http://localhost/php-projects/CG_entry_test/?start=24/2/2019&end=25/2/2019)

### Built with

* PHP 7.4.1 (LAMPP)
* VS Code


### Author

* Emmanouil Chondrakis

