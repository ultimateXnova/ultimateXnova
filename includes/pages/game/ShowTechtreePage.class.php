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


class ShowTechtreePage extends AbstractGamePage
{
    public static $requireModule = MODULE_TECHTREE;

    function __construct()
    {
        parent::__construct();
    }

    function show()
    {
        global $resource, $requeriments, $reslist, $USER, $PLANET, $LNG;

        $elementIDs		= array_merge(
            array(0),
            $reslist['build'],
            array(100),
            $reslist['tech'],
            array(200),
            $reslist['fleet'],
            array(400),
            $reslist['defense'],
            array(500),
            $reslist['missile'],
            array(600),
            $reslist['officier']
        );

        $techTreeList = array();
        foreach($elementIDs as $elementId)
        {
            if(!isset($resource[$elementId]))
            {
                $techTreeList[$elementId]	= $elementId;
            }
            else
            {
                $requirementsList	= array();
                if(isset($requeriments[$elementId]))
                {
                    foreach($requeriments[$elementId] as $requireID => $RedCount)
                    {
                        $requirementsList[$requireID]	= array(
                            'count' => $RedCount,
                            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
                        );
                    }
                }

                $techTreeList[$elementId]	= $requirementsList;
            }
        }

        $this->assign(array(
            'TechTreeList'		=> $techTreeList,
        ));

        $this->display('page.techTree.default.tpl');
    }
}
