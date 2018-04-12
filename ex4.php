<?php
use Fgsl\Eyedatagrid\EyeMySQLAdap;
use Fgsl\Eyedatagrid\EyeDataGrid;
require 'vendor/autoload.php';

$config = require 'config/local.php';

// Load the database adapter
$db = new EyeMySQLAdap($config['host'],$config['user'], $config['password'], $config['db']);

// Load the datagrid class
$x = new EyeDataGrid($db);

// Set the query
$x->setQuery("*", "people");

// Add a row selector
$x->addRowSelect("alert('You have selected id # %Id%')");

// Apply a function to a row
function returnSomething($lastname)
{
    return strrev($lastname);
}
$x->setColumnType('LastName', EyeDataGrid::TYPE_FUNCTION, 'returnSomething', '%LastName%');
?>
<html>
<head>
<title>EyeDataGrid Example 4</title>
<link href="table.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Row Selector</h1>
<ul>
	<li>Move your mouse over a row and click on it. You can use variables such as %FirstName% in the action commands to have it filled in with the value for that row.</li>
	<li>The last name is reversed. This is done by applying a column type of 'function' to the Last Name column. The last name is passed to a function which then returns the last name in reverse.</li>
</ul>
<?php
// Print the table
$x->printTable();
?>
</body>
</html>