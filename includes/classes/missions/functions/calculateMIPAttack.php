<?php

/**
*  ultimateXnova
*  based on 2moons by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package ultimateXnova
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2022 Koray Karakuş <koraykarakus@yahoo.com>
 * @copyright 2024 Pfahli (https://github.com/Pfahli)
 * @licence MIT
 * @version 1.8.x Koray Karakuş <koraykarakus@yahoo.com>
 * @link https://github.com/ultimateXnova/ultimateXnova
 */

function calculateMIPAttack($TargetDefTech, $OwnerAttTech, $missiles, $targetDefensive, $firstTarget, $defenseMissles)
{
	global $pricelist, $CombatCaps;

	$destroyShips		= array();
	$countMissles 		= $missiles - $defenseMissles;

	if($countMissles == 0)
	{
		return $destroyShips;
	}

	$totalAttack 		= $countMissles * $CombatCaps[503]['attack'] * (1 +  0.1 * $OwnerAttTech);

	// Select primary target, if exists
	if(isset($targetDefensive[$firstTarget]))
	{
		$firstTargetData	= array($firstTarget => $targetDefensive[$firstTarget]);
		unset($targetDefensive[$firstTarget]);
		$targetDefensive	= $firstTargetData + $targetDefensive;
	}

	foreach($targetDefensive as $element => $count)
	{
		if($element == 0)
		{
			throw new Exception("Unknown error. Please report this error on tracker.2moons.cc. Debuginforations:<br><br>".serialize(array($TargetDefTech, $OwnerAttTech, $missiles, $targetDefensive, $firstTarget, $defenseMissles)));
		}
		$elementStructurePoints = ($pricelist[$element]['cost'][901] + $pricelist[$element]['cost'][902]) * (1 + 0.1 * $TargetDefTech) / 10;
		$destroyCount           = floor($totalAttack / $elementStructurePoints);
		$destroyCount           = min($destroyCount, $count);
		$totalAttack  	       -= $destroyCount * $elementStructurePoints;

		$destroyShips[$element]	= $destroyCount;
		if($totalAttack <= 0)
		{
			return $destroyShips;
		}
	}

	return $destroyShips;
}
