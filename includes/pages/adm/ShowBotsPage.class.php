<?php

/**
 *
 */
class ShowBotsPage extends AbstractAdminPage
{
  protected $allNames = array();

  protected $title = ['Marshal', 'Czar', 'Governor', 'Technocrat', 'Geologist', 'Commander',
      'Lord', 'Commodore', 'Chancellor', 'Emperor', 'Mogul', 'Sovereign', 'Proconsul',
      'Stadtholder', 'Renegade', 'Lieutenant', 'Admiral', 'Vice', 'Consul', 'Chief',
      'President', 'Procurator', 'Engineer', 'Constable', 'Bandit', 'Senator', 'Viceregent',
      'Captain', 'Director', 'Kualla', 'Padme'];

  protected $name = ['Yakini', 'Astra', 'Cosmos', 'Skat', 'Nemesis', 'Mars', 'Icarus', 'Helix', 'Cetus',
      'Hydra', 'Genesis', 'Octans', 'Remus', 'Sigma', 'Pavo', 'Navi', 'Rocket', 'Erdemas',
      'Europa', 'Ceres', 'Ferret', 'Cupid', 'Sirius', 'Antimatter', 'Centauri', 'Midas',
      'Quantum', 'Dorado', 'Deimos', 'Keid', 'Andromeda', 'Apollo',
      'Saturn', 'Spica', 'Majoris', 'Vega', 'Pathfinder', 'Kuma', 'Cosmo',
      'Gravity', 'Uranus', 'Ares', 'Janus', 'Transit', 'Uriel',
      'Scorpius', 'Omicron', 'Sol', 'Mimas', 'Euler', 'Castor',
      'Probe', 'Neso', 'Retina', 'Io', 'Leda', 'Ceti', 'Moon', 'Herschel',
      'Varilla', 'Tarvos', 'Pollux', 'Sunspot', 'Mariner', 'Zuben', 'Nestor',
      'Grus', 'Themis', 'Klio', 'Puck', 'Japetus', 'Scout', 'Solar', 'Kale', 'Lambda',
      'Leto', 'Amidala', 'Zagadra', 'Seti', 'Tycho', 'Sputnik', 'Navi', 'Starburst',
      'Comet', 'Sagan', 'Atik', 'Gamma', 'Dorado', 'Jones', 'Lepus', 'Taurus', 'Owl',
      'Zenith', 'Auriga', 'Jericho', 'Mimas', 'Voyager', 'Spirit', 'Explorer', 'Palma',
      'Gliese', 'Cassini', 'Pan', 'Neptune', 'Discory', 'Polaris', 'Barym', 'Spacewalk',
      'Ganimed', 'Forma', 'Pulsar', 'Holmes', 'Rhea', 'Deneb',
      'Nova', 'Omega', 'Zagadra', 'Hunter', 'Ranger', 'Zibal', 'Asteroid'];

    protected $titleCount;
    protected $nameCount;

  function __construct()
  {
    parent::__construct();
  }

  function show(){

    $this->display('page.bots.default.tpl');
  }

  function create(){

    $this->display('page.bots.create.tpl');
  }

  function generateName(){

      $randomName = $this->title[rand(0,($this->titleCount - 1))] . ' ' . $this->name[rand(0,($this->nameCount - 1))];

      $i = 0;
  		foreach ($this->allNames as $userName) {
  			if (strpos($userName,$randomName) !== false) {
  				$i++;
  			}
  		}

  		if ($i > 0) {
  			$randomName = $randomName . ' (' . ($i + 1) . ')';
  		}


    return $randomName;

  }

  function getAllNames(){

    $db = Database::get();

    $sql = "SELECT username FROM %%USERS%%";

    $userNames = $db->select($sql);

    foreach ($userNames as $currentName) {
      $this->allNames[] = $currentName['username'];
    }

  }

  function createSend(){
    global $LNG;

    $config = Config::get(Universe::getEmulated());
    $db = Database::get();

    $target_galaxy = HTTP::_GP('target_galaxy',1);

    $bots_number = HTTP::_GP('bots_number',0);

    $bot_name_type = HTTP::_GP('bot_name_type', 0);

    $bots_dm = HTTP::_GP('bots_dm', 0);

    $bots_password = HTTP::_GP('bots_password', '', true);

    $planetMetal = HTTP::_GP('planet_metal', 0);
    $planetCrystal = HTTP::_GP('planet_crystal', 0);
    $planetDeuterium = HTTP::_GP('planet_deuterium', 0);
    $planetFieldMax = HTTP::_GP('planet_field_max', 163);

    if ($bots_number == 0) {
      $this->printMessage('Enter bots number to be created !');
    }

    if (empty($bots_password)) {
      $this->printMessage('Enter a password for bots !');
    }

    if ($target_galaxy > $config->max_galaxy || $target_galaxy < 1) {
      $this->printMessage('Wrong galaxy !');
    }

    if ($bot_name_type == 0) {
      $this->getAllNames();
      $this->nameCount = count($this->name);
      $this->titleCount = count($this->title);
    }


    $numberOfPossiblePlanets = $config->max_system * $config->max_planets;

    $sql = "SELECT COUNT(*) as planet_number FROM %%PLANETS%% WHERE galaxy = :target_galaxy AND universe = :universe;";

    $usedPlanetSlots = $db->selectSingle($sql,array(
      ':target_galaxy' => $target_galaxy,
      ':universe' => Universe::getEmulated()
    ),'planet_number');

    $numberOfPossiblePlanets -= $usedPlanetSlots;



    if ($bots_number > $numberOfPossiblePlanets) {
      $this->printMessage('universe do not have enough space for bots !');
    }


    $sql = "SELECT galaxy,`system`,planet FROM %%PLANETS%% WHERE universe = :universe AND galaxy = :target_galaxy";

    $currentPlanets = $db->select($sql,array(
      ':universe' => Universe::getEmulated(),
      ':target_galaxy' => $target_galaxy
    ));

    $coordinatesNotAvailable = array();
    foreach ($currentPlanets as $cPlanet) {
      $coordinatesNotAvailable[] = $cPlanet['galaxy'] . ":" . $cPlanet['system'] . ":" . $cPlanet['planet'];
    }

    $allCoordinates = array();

    for ($i=1; $i <= $config->max_system; $i++) {

      for ($j=1; $j <= $config->max_planets ; $j++) {
        $allCoordinates[] = $target_galaxy . ":" . $i . ":" . $j;
      }

    }

    $possibleCoordinates = array_diff($allCoordinates,$coordinatesNotAvailable);


    $botInfo = array();
    $universeCurrent = Universe::getEmulated();

    $sql = "SELECT COUNT(*) as count FROM %%USERS%% WHERE is_bot = 1;";
    $numberOfBots = $db->selectSingle($sql,array(),'count');


    //generate main planet coordinates for bots
    for ($i=1; $i <= $bots_number; $i++) {

      $randomNumber = mt_rand(0, count($possibleCoordinates) - 1);
      $coordinate = explode(':',$possibleCoordinates[$randomNumber]);

      $botInfo[] = array(
        'galaxy' => $coordinate[0],
        'system' => $coordinate[1],
        'planet' => $coordinate[2],
        'username' => ($bot_name_type == 1) ? 'bot ' . $i : $this->generateName(),
        'email' => 'bot' . $i + $numberOfBots . '@2moons.de',
        'lang' => 'tr',
        'darkmatter' => $bots_dm
      );

      unset($possibleCoordinates[$randomNumber]);
      $possibleCoordinates = array_values($possibleCoordinates);
    }



    $sql_user = $save_sql_user = "INSERT INTO %%USERS%% (username, `password`, email, email_2, lang, universe, galaxy, `system`, planet, darkmatter,register_time,onlinetime, is_bot) VALUES ";

    $bots_password = PlayerUtil::cryptPassword($bots_password);

    $i = 0;
    foreach ($botInfo as $currentBotInfo) {
      $sql_user .= "('" . $currentBotInfo['username'] . "', '" . $bots_password . "', '"
      . $currentBotInfo['email'] . "', '" . $currentBotInfo['email'] . "', '" . $currentBotInfo['lang'] . "', "
      . $universeCurrent . ", " . $currentBotInfo['galaxy'] . ", " . $currentBotInfo['system'] . ", "
      . $currentBotInfo['planet'] . ", " . $currentBotInfo['darkmatter'] . ", " . TIMESTAMP . ", " . TIMESTAMP . ", " . "1" . "), ";

      $i++;

      if ($i == 50) {
        $i = 0;

        $sql_user = substr($sql_user,0,-2) . ";" ;
        $db->insert($sql_user);
        $sql_user = $save_sql_user;
      }

    }

    if ($sql_user != $save_sql_user) {
      $sql_user = substr($sql_user,0,-2) . ";" ;
      $db->insert($sql_user);
      $sql_user = $save_sql_user;
    }

    $sql_planets = $save_sql_planets = "INSERT INTO %%PLANETS%% (`name`, universe, galaxy, `system`, planet, last_update, planet_type, `image`, field_max, temp_min, temp_max, metal, crystal, deuterium, is_bot) VALUES ";

    $planetData	= array();
    require 'includes/PlanetData.php';
    $diameter			= (int) floor(1000 * sqrt($planetFieldMax));

    $i = 0;
    foreach ($botInfo as $currentBotInfo) {

      $dataIndex		= (int) ceil($currentBotInfo['planet'] / ($config->max_planets / count($planetData)));
      $planetTempMax	= $planetData[$dataIndex]['temp'];
      $planetTempMin	= $planetTempMax - 40;


      $imageNames			= array_keys($planetData[$dataIndex]['image']);
      $imageNameType		= $imageNames[array_rand($imageNames)];
      $imageName			= $imageNameType;
      $imageName			.= 'planet';
      $imageName			.= $planetData[$dataIndex]['image'][$imageNameType] < 10 ? '0' : '';
      $imageName			.= $planetData[$dataIndex]['image'][$imageNameType];

      $sql_planets .= "('" . $LNG['fcm_mainplanet'] . "', " . $universeCurrent . ", " . $currentBotInfo['galaxy'] . ", "
      . $currentBotInfo['system'] . ", " . $currentBotInfo['planet'] . ", " . TIMESTAMP . ", " . "1" . ", '"
      . $imageName . "', " . $planetFieldMax . ", " . $planetTempMin . ", " . $planetTempMax . ", "
      . $planetMetal . ", " . $planetCrystal . ", " . $planetDeuterium . ", " . "1" . "), ";

      $i++;

      if ($i == 50) {
        $i = 0;

        $sql_planets = substr($sql_planets,0,-2) . ";" ;
        $db->insert($sql_planets);
        $sql_planets = $save_sql_planets;
      }

    }

    if ($sql_planets != $save_sql_planets) {
      $sql_planets = substr($sql_planets,0,-2) . ";" ;
      $db->insert($sql_planets);
      $sql_planets = $save_sql_planets;
    }

    $sql = "SELECT id,galaxy,`system`,planet FROM %%USERS%% WHERE is_bot = 1 AND id_planet = 0 AND universe = :universe ORDER BY id ASC;";
    $newBots = $db->select($sql,array(
      ':universe' => Universe::getEmulated()
    ));

    $sql = "SELECT id,galaxy,`system`,planet FROM %%PLANETS%% WHERE is_bot = 1 AND id_owner IS NULL AND universe = :universe ORDER BY id ASC;";

    $newBotPlanets = $db->select($sql,array(
      ':universe' => Universe::getEmulated()
    ));

    //refresh bot users

    $sql_refresh_bot_users = $save_sql_refresh_bot_users = "INSERT INTO %%USERS%% (id,universe,id_planet) VALUES ";

    $i = 0;
    foreach ($newBots as $currentNewBot) {

      foreach ($newBotPlanets as $currentNewBotPlanet) {

        if ($currentNewBot['galaxy'] == $currentNewBotPlanet['galaxy'] &&
            $currentNewBot['system'] == $currentNewBotPlanet['system'] &&
            $currentNewBot['planet'] == $currentNewBotPlanet['planet']
          ) {
          $i++;
          $sql_refresh_bot_users .= "(" . $currentNewBot['id'] . ", " . $universeCurrent . ", " . $currentNewBotPlanet['id'] . "), ";

          if ($i == 50) {
            $sql_refresh_bot_users = substr($sql_refresh_bot_users,0,-2) . " ON DUPLICATE KEY UPDATE
            id = VALUES(id),
            universe = VALUES(universe),
            id_planet = VALUES(id_planet);";

            $i = 0;

            $db->insert($sql_refresh_bot_users);

            $sql_refresh_bot_users = $save_sql_refresh_bot_users;

          }

          break;
        }

      }

    }

    if ($sql_refresh_bot_users != $save_sql_refresh_bot_users) {
      $sql_refresh_bot_users = substr($sql_refresh_bot_users,0,-2) . " ON DUPLICATE KEY UPDATE
      id = VALUES(id),
      universe = VALUES(universe),
      id_planet = VALUES(id_planet);";
      $db->insert($sql_refresh_bot_users);
    }


    //refresh planets

    $sql_refresh_bot_planets = $save_sql_refresh_bot_planets = "INSERT INTO %%PLANETS%% (id,universe,id_owner) VALUES ";

    $i = 0;
    foreach ($newBots as $currentNewBot) {

      foreach ($newBotPlanets as $currentNewBotPlanet) {

        if ($currentNewBot['galaxy'] == $currentNewBotPlanet['galaxy'] &&
            $currentNewBot['system'] == $currentNewBotPlanet['system'] &&
            $currentNewBot['planet'] == $currentNewBotPlanet['planet']
          ) {
          $i++;
          $sql_refresh_bot_planets .= "(" . $currentNewBotPlanet['id'] . ", " . $universeCurrent . ", " . $currentNewBot['id']  . "), ";

          if ($i == 50) {
            $sql_refresh_bot_planets = substr($sql_refresh_bot_planets,0,-2) . " ON DUPLICATE KEY UPDATE
            id = VALUES(id),
            universe = VALUES(universe),
            id_owner = VALUES(id_owner);";

            $i = 0;

            $db->insert($sql_refresh_bot_planets);

            $sql_refresh_bot_planets = $save_sql_refresh_bot_planets;
          }

          break;
        }

      }

    }

    if ($sql_refresh_bot_planets != $save_sql_refresh_bot_planets) {
      $sql_refresh_bot_planets = substr($sql_refresh_bot_planets,0,-2) . " ON DUPLICATE KEY UPDATE
      id = VALUES(id),
      universe = VALUES(universe),
      id_owner = VALUES(id_owner);";
      $db->insert($sql_refresh_bot_planets);
    }



    $this->printMessage('Bots created successfully');

  }

}










 ?>
