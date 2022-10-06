<?php 

require __DIR__ . '/SourceQuery/bootstrap.php';
use xPaw\SourceQuery\SourceQuery;

function getPlayers($ip) {
    global $RCON_PWS, $db_conn_surftimer, $exists_UsrTableCountryCodeAndContinentCodeCheck;

    $addr = explode(':',$ip);
    $Query = new SourceQuery( );
    $players = []; 
    $Info    = [];
    $Exception = null;
    $lines = [];

    try
    {
        $Query->Connect( $addr[0], $addr[1], 3, SourceQuery::SOURCE );
        $Query->SetRconPassword( $RCON_PWS[$ip] );
        $test = $Query->Rcon( 'status' );
        $lines = preg_split("/\r\n|\n|\r/", $test);
    }
    catch( Exception $e )
    {
        $Exception = $e;
    }
    finally
    {
        $Query->Disconnect( );
    }

   


    $steamids = [];
    $users = [];
    foreach ($lines as $line) {

        preg_match('/#\s+([0-9]+)\s+([0-9]+)\s+"(.*)"\s+(.*)\s+(([0-9]+:)?[0-9]{2}:[0-9]{2})\s+([0-9]+)\s+([0-9]+)\s+active\s+([0-9]+)\s+(.*)/', $line, $matches);

        if (!empty($matches)) {
            $steamids[] =  $matches[4];
            $users[$matches[4]] = [
                'name' => $matches[3],
                'time' =>$matches[5]
            ];
        }

    }
    // echo print_r($steamids);


    $Players = [];
    foreach ($steamids as $player_id) {
        
        $stmt_status = 0;
        $sql_select_user_profile = "SELECT * FROM `ck_playerrank` WHERE steamid=? AND style='0' LIMIT 1";   
        $stmt_profile = mysqli_stmt_init($db_conn_surftimer);
        
        

        if(mysqli_stmt_prepare($stmt_profile, $sql_select_user_profile)){
            $stmt_status = 1;
            mysqli_stmt_bind_param($stmt_profile,"s", $player_id);
            mysqli_stmt_execute($stmt_profile);
            $result_select_user_profile = mysqli_stmt_get_result($stmt_profile);

            $row_sup = $result_select_user_profile->fetch_assoc();


            if($result_select_user_profile->num_rows > 0){

                $sql_select_user_rank = "SELECT COUNT(steamid) as rank_position FROM ck_playerrank WHERE style = 0 AND points >= (SELECT points FROM ck_playerrank WHERE steamid = '$player_id' AND style = 0) ORDER BY points";
                $result_select_user_rank = $db_conn_surftimer->query($sql_select_user_rank);
                $row_sur = $result_select_user_rank->fetch_assoc();
                
                $countryCode = '';
                $continentCode = '';

                if($exists_UsrTableCountryCodeAndContinentCodeCheck){
                    $countryCode = $row_sup['countryCode'];
                    $continentCode = $row_sup['continentCode'];
                }
                $Players[] = [
                    'steamid64'=> $row_sup['steamid64'],
                    'ranked' => true,
                    'name'=> $row_sup['name'],
                    'country'=> $row_sup['country'],
                    'countryCode' => $countryCode,
                    'continentCode' => $continentCode,
                    'points' => $row_sup['points'],
                    'wrs' => $row_sup['wrs'],
                    'rank' => $row_sur['rank_position'],
                    'time' => $users[$player_id]['time']
                ];
            
            } else {
                $Players[] = [
                    'steamid64' => toSteamID64($player_id),
                    'ranked' => false,
                    'name' => $users[$player_id]['name'],
                    'time' => $users[$player_id]['time']
                ];
            }
        }

    }

    return $Players;
}

