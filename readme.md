// 2015-07-17
! when retriving data, use CRUD, as REST is not stable 
* curl_manipulation.php has get functions --- ok
* four total numbers with href were built on the mainpage  --- ok 

// 2015-07-20
* write a curl get function, returning all Json[][] info  --- ok
* alarm table with raw data has been built   --- ok
* date time of alarm listview  --- ok  
* table advanced table function   --- ok

// 2015-07-21
* change alarm listview navigation bar   --- ok
* outage table with raw data has been built   --- ok 
* date time of outage listview  --- ok   
* table advanced table function   --- ok 
* ? function on page title of outage and alarm --- ok
* outstanding notice page raw data  --- ok
* outstanding notice page advanced table function   --- ok

// 2015-07-22
* acknowledged notice page raw data   --- ok
* acknowledged notice page advanced table function  --- ok
* Device log history navigation bar  --- ok
* Device log history navigation form --- ok
* Device log history raw data --- ok
* Device log form input ip hint ajax --- ok

// 2015-07-23
* Device log table ajax --- ok
* Beautify the drop menu of ajax suggestion  --- ok
* create blank network mapping page with navigation bar  --- ok

// 2015-07-25
* acknowledge action on alarm page  --- ok   
* acknowledge action on outstanding notice page  --- ok 
* refresh button for all currently existed pages  --- ok 

// 2015-07-27
* alarm acknowledge by php curl  --- ok 
* notice acknowledge by php curl  --- ok 
* acknowledge function validation  --- ok 
* minimize the confirmation page  --- ok   
* top navagation alert bar  --- ok   
* account management black page  --- ok 
* contact admin black page  --- ok    
* inventory assest database  

// 2015-08-05
* finish a lot for demo
!!! still leave a lot back-end real functions  


// 2015-08-17
* user management with json file    --- ok


// 2015-08-20
* acknowledgement functions have been validated   --- ok
* auto-refresh function was added, but not validated yet  --- ok


// 2015-08-24
* auto-refresh function has been validated, and set 180 s interval  --- ok
* topology is functionally done  --- ok

// 2015-09-30
* all optical device oid snmpget is done, in the folder of php_script/oid

// 2015-10-01: start to polish the software 
* index page --- ok
* need to add logo and version number, optical theme   --- ok
* fix inventory table  --- ok
* fix action subpage --- ok

// 2015-10-02
* fix alarm    --- ok
* fix outage  --- ok
* display server ip   --- ok

// 2015-10-05
* fix account management   --- ok
* fix device history   --- ok 
* fix notice    --- ok  // the database doesnt have any record now, need to check Opennms configuration 
* network mapping  --- ok
* discovery UI -- ok
* polling UI  remove  --- ok 
* add a new device UI   --- ok 
* database/opennms link   --- ok

// 2015-10-06
* tree   --- ok
* main    --- ok
* alarm email test   --- ok   // manually

// 2015-10-07
* change text   --- ok
* email address    --- ok
* toggle the ip   --- ok
* email contend   --- ok

// 2015-10-08

* fix buton top  --- ok
* fix right top corner  --- ok
* change tree   // toublesome 
* change elink oid    --- ok
* extend the white space on the main page 


// 2015-10-21   --- curl, build db, see how to daemon, page should havea button to manuelly refresh data 
* change the export location to php_script/DataFolder, plus not hard code the path    --- ok
* open the php debug mode  (add php_flag display_errors 1 in .htaccess)
* alarm curl (curl_acknowledgeAlarm.php)     ---- ok
* notifi curl (curl_acknowledgeAlarm.php)   ---- ok

// 2015-10-22
* change the alarmlist term to network failure  --- ok 
* change the vanguard name and path  --- ok 
* delete node via curl   --- ok 

// 2015-10-23
* discovery configuration via XML --- ok 
* add new devices function    --- toublesome 


// 2015-10-25
* finish node provisioning   --- ok 
* build new database "vanguardhe" and "user" table by script  --- ok 
* create database auto check function with user login   --- ok 

// 2015-10-26
* build the daemon GUI and main entracne skeleton  --- ok 

// 2015-10-27
* fix the bug of user account   --- ok
* put all snmp asset value of 1550 in db    --- ok 
* let main entrace auto detect 1550, if multiple     --- ok 
* debug ok, use "require_once()"   --- ok


!!! NOTE 
<!-- require() includes and evaluates a specific file, while require_once() does that only if it has not been included before (on the same page).

So, require_once() is recommended to use when you want to include a file where you have a lot of functions for example. This way you make sure you don't include the file more times and you will not get the "function re-declared" error. -->

!!! NOTE 
<!-- remove the ; before the php.ini to enable snmp and socket  -->


// 2015-10-28
* add a function that doulbe check this device is there    --- ok
* $sysid = snmpget($ip, 'public', '.1.3.6.1.2.1.1.4.0', 300);   --- ok

// 2015-10-29
* put all snmp asset value of headend in db    --- ok
* smart detector on elink    --- ok 
* auto detect the subdevice of headend device elink    --- ok 
* let main entrace auto detect elink, if multiple     --- ok 

// 2015-10-30
* put all snmp asset value of egfa in db    --- ok
* let main entrace auto detect egfa, if multiple     --- ok 
* unit test of elink_check    --- ok
* unit test of device array    --- ok
* unit test of scan time    --- ok
* unit test of 1550    --- ok
* unit test of egfa    --- ok
* unit test of elink     --- ok
* ensemble test of main      --- ok

// 2015-11-03
* check alarm info function on main     --- ok

// 2015-11-04
* debug the "snmp not found"   --- ok
* create alarm info logger helper function   --- ok 
* add alarm threshold function of 1550   --- ok 
* add alarm threshold function of egfa    --- ok
* make the frame of compare 1550, link to main   --- ok 
* make the frame of compare egfa, link to main    --- ok

// 2015--11-06




* re-organize the snmp info page of 1550
* re-organize the snmp info page of elink
* re-organize the snmp info page of egfa

* debug the egfa 
* change alarm thres supplementation 
* add alarm threshold function of elink  

* make the frame of compare elink, link to mainpage


* alarm threshold model functon into db 1550
* alarm threshold model functon into db elink
* alarm threshold model functon into db egfa
