<?php


/*
 * @version $Id: profile.class.php 4258 2007-01-04 16:16:18Z moyo $
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2006 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Walid Nouh
// Purpose of file:
// ----------------------------------------------------------------------
if (!defined('GLPI_ROOT')) {
	die("Sorry. You can't access directly to this file");
}

function addNewAffectationRule($input) {
	//Add the rule
	$ruleDescription = new RuleDescription;
	$ruleid = $ruleDescription->add($input);
	
	if ($ruleid)
	{
		//Add an action associated to the rule
		$ruleAction = new RuleAction;
		//Action is : affect computer to this entity
		$ruleAction->addActionByAttributes("assign", $ruleid, "FK_entities", $input["affectentity"]);
	}
}

	/**
	 * Get the next ranking for a specified rule
	 */
	function getNextRanking($type)
	{
		global $DB;
		$sql = "SELECT max(ranking) as rank FROM glpi_rules_descriptions WHERE rule_type=".$type;
		$result = $DB->query($sql);
		if ($DB->numrows($result) > 0)
		{
			$datas = $DB->fetch_array($result);
			return $datas["rank"] + 1;
		}
		else
			return 0;
	}

?>
