<?php
require 'class.eyemysqladap.inc.php';
require 'class.eyedatagrid.inc.php';

// Load the database adapter
$db = new EyeMySQLAdap('localhost', 'root', '', 'codes');

// Load the datagrid class
$x = new EyeDataGrid($db);

// Set the query
$x->setQuery("*", "people", 'Id');

// Allows filters
$x->allowFilters();

// Change headers text
$x->setColumnHeader('FirstName', 'First Name');
$x->setColumnHeader('LastName', 'Last Name');

// Hide ID Column
$x->hideColumn('Id');

// Change column type
$x->setColumnType('FirstName', EyeDataGrid::TYPE_HREF, 'http://google.com/search?q=%FirstName%'); // Google Me!
$x->setColumnType('BirthDate', EyeDataGrid::TYPE_DATE, 'M d, Y', true); // Change the date format
$x->setColumnType('Gender', EyeDataGrid::TYPE_ARRAY, array('m' => 'Male', 'f' => 'Female')); // Convert db values to something better
$x->setColumnType('Done', EyeDataGrid::TYPE_PERCENT, false, array('Back' => '#c3daf9', 'Fore' => 'black'));

// Show reset grid control
$x->showReset();

// Add custom control, order does matter
$x->addCustomControl(EyeDataGrid::CUSCTRL_TEXT, "alert('%FirstName%\'s been promoted!')", EyeDataGrid::TYPE_ONCLICK, 'Promote Me');

// Add standard control
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "alert('Editing %LastName%, %FirstName% (ID: %_P%)')");
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "alert('Deleting %_P%')");


// Add create control
$x->showCreateButton("alert('Code for creating a new person')", EyeDataGrid::TYPE_ONCLICK, 'Add New Person');

// Show checkboxes
$x->showCheckboxes();

// Show row numbers
$x->showRowNumber();

// Apply a function to a row
function returnSomething($lastname)
{
	return strrev($lastname);
}
$x->setColumnType('LastName', EyeDataGrid::TYPE_FUNCTION, 'returnSomething', '%LastName%');

if (EyeDataGrid::isAjaxUsed())
{
	$x->printTable();
	exit;
}
?>
<html>
<head>
<title>EyeDataGrid Example 5</title>
<link href="table.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Everything</h1>
<ul>
	<li>Here we have a little of everything. Ajax, filters, ordering, custom and standard controls, pagination, column types of link, array mapping, date, function, etc.</li>
</ul>
<?php
// Print the table
EyeDataGrid::useAjaxTable();
?>
</body>
</html>