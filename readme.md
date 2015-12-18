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

// 2015--11-10
* debug the egfa   --- ok
* fix alarm database with two step alarm functions    --- ok (new: severity column)
* change to generic snmp php function (snmpget)    --- ok, but trouble w/ elink, so use previous 
* change alarm thres egfa with deadbandth    --- ok 
* change alarm thres elink with deadbandth   --- ok  
* change alarm thres eg1550 with deadbandth    --- ok  
* add alarm threshold function of elink    --- ok  
* make the frame of compare elink, link to mainpage   --- ok 

// 2015--11-11
* finish checkAlarmUpdatedIfYesTakeAction(use timestamp as the key)   --- ok 

// 2015--11-16
* alarm threshold model functon into db 1550  build   --- ok (LIMIT 1 SQL)
* alarm threshold model functon into db elink build   --- ok (LIMIT 1 SQL)
* alarm threshold model functon into db egfa  build   --- ok (LIMIT 1 SQL)

// 2015--11-17
* fix the inventory list (status, value, setup)   --- ok
* filter the unrelated devices out on inventort listview   --- ok
* re-organize the snmp info page of elink    --- ok 
* re-organize the snmp info page of egfa    --- ok 
* re-organize the snmp info page of 1550    --- ok 
* alarm setup page of elink   --- ok
* alarm setup page of egfa   --- ok
* alarm setup page of 1550   --- ok
* change sql column type, to make ip ok for search    --- ok

// 2015--11-18 
* unit-test: checkAlarmInfoDb.php   --- ok
* unit-test: daemon_alarmT1550.php  --- ok
* unit-test: daemon_alarmTegfa.php   --- ok
* unit-test: daemon_alarmTelink.php --- ok
* unit-test: daemon_checkElink.php   --- ok
* unit-test: daemon_db_init.php    --- ok
* unit-test: daemon_findTargetDeviceToArray.php   --- ok
* unit-test: daemon_scanTime.php   --- ok
* unit-test: daemon_snmp_1550.php   --- ok
* unit-test: daemon_snmp_egfa.php   --- ok
* unit-test: daemon_snmp_elink.php   --- ok
* unit-test: display_value_1550.php    --- ok
* unit-test: display_value_egfa.php   --- ok
* unit-test: display_value_elink.php  --- ok
* unit-test: setup_alarmT_1550.php   --- ok
* unit-test: setup_alarmT_egfa.php   --- ok
* unit-test: setup_alarmT_elink.php  --- ok
* unit-test: alarm_logger.php    --- ok
* unit-test: daemon_checkAlarmInfoDb.php  --- ok
* unit-test: daemon_compare_1550.php   --- ok 
* unit-test: daemon_compare_egfa.php  --- ok 

// 2015--11-19
* unit-test: daemon_compare_elink.php   --- ok 
* unit-test: daemon_main.php    --- ok

// 2015--11-20
* snmpget funciton proves good  --- ok
* build auto discovery funciton  --- ok 

// 2015--11-29
* change the database to localhost:5432 
* build auto discovery range functiion   --- ok 
* test why raw snmpget function is troublesome    --- ok
can still use shell_exeu to call snmpget on linux, but need to give the permission on Linux

// 2015-11-30
* change the daemon_main ip feeder   --- ok 
* build auto discoverty range input handler  --- ok 
* build ip single add handler   -- ok 
* build ip single spot functions    -- ok 
* map info feeder    -- ok 
* alarm status    -- ok 

// 2015-12-01
* test discoverty   -- ok (max_execution_time = 500 in php.ini)
& test integration with alarm thread   --- ok 
* test add device   -- ok
* need provision method   -- ok
* fix the back process with auto-cremental id    -- ok
* inventory table ALL     -- ok

// 2015-12-02 
* fix mapping table       --- ok 
* alarm table      --- ok 
* alarm history    --- ok 
* check alarm info background   --- could be neglected at this moment 
* fix alarm esp of elink   --- ok 
* delete other unused page    --- ok   
* organize all pages    --- ok 
* fix the mainpage   --- ok 

// 2015-12-03
* js tree stucture on the mainpage    --- ok 

// 2015-12-04
* plot chart along the time (google chart raw code proved)   -----ok 

// 2015-12-08
* reorganize 1550 value  --- ok 
* graph 1550 data    --- ok 
* reorganize egfa value  --- ok 
* graph egfa data    --- ok 
* reorganize elink value     --- ok 
 
// 2015-12-09
* change the graphe name and path to avoid permission issue     --- ok 
* graph elink data     --- ok 
* beautify table    --- ok 
* beautify graph    --- ok 
* polish details   --- ok  
* format email   --- ok  
* table header color     --- ok  

// 2015-12-10/11
* fix alarm table  --- ok  
* combine two alarm table together   --- ok  
* test the column   --- ok  
* read jquery document to get fimiliar with jstree change   --- ok  
* try to change jstree, but sti problmeatic   --- ok  

// 2015-12-17
* user password  --- ok  
* alarm page    --- ok  
* js tree   --- ok  
* color graph   ---- some graph do not have distinguishable axis label 
* return button    --- ok  
* test email with other source     --- ok  
* error page   --- ok  
 


