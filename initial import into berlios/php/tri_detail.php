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
$Triggername=getData("Triggername");

$html= "<h1> Database  ".$DB->Name($Server)." - Trigger  ".$Triggername."</h1>";
if($Triggername){
    $tri=new Trigger($Server);
    $tri->setOwner($User);
    $tri->setName($Triggername);
    $tri->getData();
    $html .="<table border=0><tr><th>Tag</th><th>Value</th></tr>";
    $html.="<tr><td>Name</td><td>".$tri->name."</td></tr>";
    $html.="<tr><td>Owner</td><td>".$tri->owner."</td></tr>";
    $html.="<tr><td>Type</td><td>".$tri->trigger_type."</td></tr>";
    $html.="<tr><td>Triggering Event</td><td>".$tri->triggering_event."</td></tr>";
    $html.="<tr><td>On</td><td>".$tri->table_owner.".".$tri->table_name."</td></tr>";
    $html.="<tr><td>Referencing Names</td><td>".$tri->referencing_names."</td></tr>";
    $html.="<tr><td>When Clause</td><td>".$tri->when_clause."</td></tr>";
    $html.="<tr><td>Status</td><td>".$tri->status."</td></tr>";
    $html .="</table>";
    
    $html .="<P><B>Trigger body:</b><br>";
    $html .="CREATE OR REPLACE TRIGGER ".$tri->description."<br>".nl2br($tri->trigger_body);
    $html.="</P>";
}

$page=new Page("Table Properties");
$page->setHead();
$page->setBody();
$page->setSQL();
$page->setBody($html);
$page->Display();
?>
