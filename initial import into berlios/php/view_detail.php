<?php
/***************************************************************************
    begin                : Sam Nov 25 18:08:45 CET 2000
    copyright            : (C) 2000 by Thomas Fromm
    email                : tf@tfromm.com
 ***************************************************************************/

/***************************************************************************
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 ***************************************************************************/
include("prepend.inc.php");

$Server=getData("Server", "integer");
$User=getData("User");
$Viewname=getData("Viewname");

$html= "<h1> Database ".$DB->Name($Server)." - View ".$Viewname."</h1>";
if($Viewname){
    $view=new View($Server);
    $view->setOwner($User);
    $view->setName($Viewname);
    $view->getData();
    $html .="<table border=0><tr><th>Tag</th><th>Value</th></tr>";
    $html.="<tr><td>Name</td><td>".$view->name."</td></tr>";
    $html.="<tr><td>Owner</td><td>".$view->owner."</td></tr>";
    $html.="<tr><td>Comment</td><td>".$view->comment."</td></tr>";
    $html .="</table>";
    
    $html .="<P><B>View body:</b><br>";
    $html .=nl2br($view->sql)."<br>";
    $html.="</P>";
}

$page=new Page("View Properties");
$page->setHead();
$page->setBody();
$page->setSQL();
$page->setBody($html);
$page->Display();
?>
