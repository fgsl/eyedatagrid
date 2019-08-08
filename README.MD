
# EyeDataGrid 

_Based on version 1.0 of class created by Mike Frank <mike@eyesis.ca> http://www.eyesis.ca_
Former source code: https://www.phpclasses.org/package/4951-PHP-Display-data-from-a-database-in-a-sortable-table.html

This component was built because former EyeDataGrid has not update since 2008 and presents fatal errors in current PHP environments. 

## About

This class can be used to display data from an SQL database in a sortable HTML table.
It can execute a given SQL query and generate HTML and Javascript to display the data in an HTML table.
The table listing can be sorted by clicking on the column header titles.
Data grid tables can also be displayed using Ajax.
Its creator, Mike, was not satisfied with available PHP data grid controls.
He uses data grids on every web site that he developes.
According him, they're great for displaying all kinds of data.
He argues that developed his datagrid to suit all his needs and more.


## Features

* Filtering and searching capabilities
* Ability to change column headers
* Capable of displaying images
* Automatic row paging
* Row selection
* Supports MySQL database
* Hide columns
* Sort columns
* Customizable look and feel through CSS
* Can handle large data sets
* Ability to add controls
* Checkbox support
* Specify column format types (such as percent, dollars, etc)
* Much more...


## Files

**Eyedatagrid.php**

The main datagrid class

**EyeMySQLAdap..php**

Mysql wrapper class created by Mike in former project - an improvement is replacing it with another one

**ex*.php**
    -Example datagrid

Create a file local.php in config folder from local.inc.php template and fill with database access parameters.

**ex*.png**

Image of the example

**sample data.sql**

Sample data for playing around with (from examples).
    
Create a database from this script for running samples.
    
**table.css**

    -The style layout for the datagrid table


## Placeholder Variables

What is a placeholder in the datagrid control? 
* A placeholder is a just the same as a variable. It is a name and references a column in a particular row.
* For exampe; lets say you had a Pets table with PetName, PetAge and PetComment columns.
* You can reference other columns in the PetComment by placing percent symbols (%) around the column name you are specifying.
* If the primary key is set during the setQuery method, you can use %_P% as a placeholder for the table's primary key.
Where can I use this?
* This can be on the database or scripted.
* This can be used in column types criteria and criteria_2 param. Look below on TYPE_IMAGE and TYPE_CUSTOM for more examples.


## Column Types and Usage

A quick overview of the available column types. 

**TYPE_ONCLICK**

Sets a "onclick" call on a cell value.

e.g: 

`$db->setColumnType('FirstName', EyeDataGrid::TYPE_ONCLICK, "alert('Hello?')");`

**TYPE_HREF**

Sets a href link on a cell value.

e.g: 

`$db->setColumnType('FirstName', EyeDataGrid::TYPE_HREF, "http://www.google.com");`

**TYPE_DATE**

Format a date.

e.g:

```php
$db->setColumnType('Birthday', EyeDataGrid::TYPE_DATE, "M d, Y", true); // Converts to a timestamp and then to the formatted date
$db->setColumnType('Birthday', EyeDataGrid::TYPE_DATE, "M d, Y"); // Converts formatted date from a timestamp
```

**TYPE_IMAGE**

Changes a column's values to a image.

e.g: 

```php
$db->setColumnType('Photo', EyeDataGrid::TYPE_IMAGE, "/images/photos/%LastName%.png");
```

**TYPE_ARRAY**

Maps a value to a key in an array

```php
$db->setColumnType('Gender', EyeDataGrid::TYPE_ARRAY, array('f' => 'Female', 'm' => 'Male'));
```

**TYPE_CHECK**

Converts a cell to a checkmark when the value is "1", "true", "yes" or value matches 3rd passed value.

e.g:

```php
$db->setColumnType('Single?', EyeDataGrid::TYPE_CHECK);
$db->setColumnType('Single?', EyeDataGrid::TYPE_CHECK, 'legs');
```

**TYPE_PERCENT**

Converts a value to a percent as a whole number.

e.g:

```php
$db->setColumnType('Score', EyeDataGrid::TYPE_PERCENT); // Value is already in percent
$db->setColumnType('Score', EyeDataGrid::TYPE_PERCENT, true); // Value is converted from decimal format when 3rd param is true
$db->setColumnType('Score', EyeDataGrid::TYPE_PERCENT, true, array('Back' => 'red', 'Fore' => 'black')); // Adds bars whose width represents the percent, colors are specified as 'Back' and 'Fore'
```

**TYPE_DOLLAR**

Converts a value to the a currency. Always rounded to 2 decimal places.

e.g: 

```php
$db->setColumnType('Price', EyeDataGrid::TYPE_DOLLAR);`
```

**TYPE_CUSTOM**

Convert value to a custom value.

e.g:

```php
$db->setColumnType('School', EyeDataGrid::TYPE_CUSTOM, 'I go to %CollegeName% in %City%, %Province%'); // Converts a cell to "I go to..". Placeholders are replaced with the value in that row's column
```

**TYPE_FUNCTION**

Sends a value (or values) to a user specified function.

e.g:

```php
$db->setColumnType('Password', EyeDataGrid::TYPE_FUNCTION, 'md5', '%Password%'); // Value is sent to the md5 function and return is printed in the cell
$db->setColumnType('Password', EyeDataGrid::TYPE_FUNCTION, 'make_hash', '%Password%'); // Value is sent to the make_hash user function and return is printed in the cell
$db->setColumnType('Password', EyeDataGrid::TYPE_FUNCTION, 'generate_key', array('%Username%', '%Password%')); // To pass multiple params to the user function use an array
```
