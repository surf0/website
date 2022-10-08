<?php

function nav_active($nav_name) {
    global $page_name;
    if($nav_name == $page_name)
        return 'active';
}

function toCommunityID($id) {
    if (preg_match('/^STEAM_/', $id)) {
        $parts = explode(':', $id);
        return bcadd(bcadd(bcmul($parts[2], '2'), '76561197960265728'), $parts[1]);
    } elseif (is_numeric($id) && strlen($id) < 16) {
        return bcadd($id, '76561197960265728');
    } else {
        return $id;
    }
};

function toSteamID64($id) {
    if (preg_match('/^STEAM_/', $id)) {
        $parts = explode(':', $id);
        return  intval($parts[2]) * 2 +  76561197960265728 + intval($parts[1]);
    } else {
        return 0;
    }
};

function toSteamID($id) {
    if (is_numeric($id) && strlen($id) >= 16) {
        $z = bcdiv(bcsub($id, '76561197960265728'), '2');
    } elseif (is_numeric($id)) {
        $z = bcdiv($id, '2'); // Actually new User ID format
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
    $y = bcmod($id, '2');
    return 'STEAM_1:' . $y . ':' . floor($z);
};

function toSteamID_NULL($id) {
    if (is_numeric($id) && strlen($id) >= 16) {
        $z = bcdiv(bcsub($id, '76561197960265728'), '2');
    } elseif (is_numeric($id)) {
        $z = bcdiv($id, '2'); // Actually new User ID format
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
    $y = bcmod($id, '2');
    return 'STEAM_0:' . $y . ':' . floor($z);
};

function toUserID($id) {
    if (preg_match('/^STEAM_/', $id)) {
        $split = explode(':', $id);
        return $split[2] * 2 + $split[1];
    } elseif (preg_match('/^765/', $id) && strlen($id) > 15) {
        return bcsub($id, '76561197960265728');
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
};

function toSteamID_NO_STEAM($id) {
    if (is_numeric($id) && strlen($id) >= 16) {
        $z = bcdiv(bcsub($id, '76561197960265728'), '2');
    } elseif (is_numeric($id)) {
        $z = bcdiv($id, '2'); // Actually new User ID format
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
    $y = bcmod($id, '2');
    return '' . $y . ':' . floor($z);
};

function CountryFlag($country, $country_flag, $continent_flag) {
    if(!empty($country_flag))
        return '<img class="bg-transparent border" title="'.$country.'" height="16" src="./images/flags/'.strtolower($country_flag).'.svg"/>';
    elseif(!empty($continent_flag))
        return '<img class="bg-transparent border" title="'.$country.'" height="16" src="./images/flags/continents/'.strtolower($continent_flag).'.svg"/>';
    else
        return '<img class="bg-transparent border" title="'.$country.'" height="16" src="./images/flags/unknown.svg"/>';
}

function CountryFlagProfile($countryCode, $continentCode) {
    if(!empty($countryCode))
        return '<img class="rounded border bg-transparent shadow-sm mb-1" height="20" src="./images/flags/'.strtolower($countryCode).'.svg"/>';
    elseif(!empty($continent_flag))
        return '<img class="rounded border bg-transparent shadow-sm mb-1" height="20" src="./images/flags/continents/'.strtolower($continentCode).'.svg"/>';
    else
        return '<img class="rounded border bg-transparent shadow-sm mb-1" height="20" src="./images/flags/unknown.svg"/>';
}


function LinkColor(){
    global $settings_link_color;
    if($settings_link_color==='')
        return 'link-secondary';
    else
        return $settings_link_color;
}

$LinkColor = LinkColor();

function PlayerUsernameProfile($player_steamid64, $player_name, $steam_only = false) {
    global $settings_player_profile_icon, $LinkColor;

    if($player_name=='          ' || $player_name==''){
        $player_name = '<span class="text-muted">(Unknown)</span>';
        $player_name_title = '(Unknown)'; 
    } else 
        $player_name_title = $player_name;
    if ($steam_only)
        return $player_name.' <a href="https://steamcommunity.com/profiles/'.$player_steamid64.'" target="_blank" title="'.$player_name_title.' - Steam Profile" class="link-secondary text-decoration-none"><i class="fab fa-steam"></i></a>';
    else if($settings_player_profile_icon)
        return $player_name.' <a href="dashboard-player.php?id='.$player_steamid64.'" target="" title="'.$player_name_title.' - Surf Profile" class="link-secondary text-decoration-none"><i class="fas fa-user-circle"></i></a> <a href="https://steamcommunity.com/profiles/'.$player_steamid64.'" target="_blank" title="'.$player_name_title.' - Steam Profile" class="link-secondary text-decoration-none"><i class="fab fa-steam"></i></a>';
    else
        return  '<a href="dashboard-player.php?id='.$player_steamid64.'" title="'.$player_name_title.' - Surf Profile" class="'.$LinkColor.' text-decoration-none">'.$player_name.'</a>';
}

function MapPageLink($map_name){
    global $settings_map_link_icon, $LinkColor;
    if($settings_map_link_icon)
            return  $map_name.' <a href="dashboard-maps.php?map='.$map_name.'" title="'.$map_name.' - Map Page" class="link-secondary text-decoration-none"><i class="fas fa-link"></i></a>';
            
        else
            return '<a href="dashboard-maps.php?map='.$map_name.'" title="'.$map_name.' - Map Page" class="'.$LinkColor.' text-decoration-none">'.$map_name.'</a>';
}

function BackgroundImage() {
    global $settings_background_image;

    if($settings_background_image=='')
        return 'surf-images/'.date('N', strtotime(date('l'))).'.jpg';
    else 
        return $settings_background_image;
}

if($settings_language_enable):
    function LanguageActive($language) {
        if($_SESSION['language'] == $language)
            return 'active';
    };

    function LanguageFlag(){
        if($_SESSION['language'] == 'Czech')
            return 'cz';
        elseif($_SESSION['language'] == 'English')
            return 'gb';
        elseif($_SESSION['language'] == 'German')
            return 'de';
        elseif($_SESSION['language'] == 'Slovak')
            return 'sk';
        elseif($_SESSION['language'] == 'Portuguese')
            return 'pt';
        elseif($_SESSION['language'] == 'French')
            return 'fr';
        elseif($_SESSION['language'] == 'Turkish')
            return 'tr';
        elseif($_SESSION['language'] == 'Danish')
            return 'dk';
    };

    function LanguageURL($language){
        if(isset($_GET['map'])||isset($_GET['id']))
            return $_SERVER['REQUEST_URI'].'&language='.$language;
        else
            return '?language='.$language;
    };
endif;

function MapDownload($map_name)
    {
        global $settings_maps_download_url;
        if($settings_maps_download_url!==''):
            $url = $settings_maps_download_url.$map_name.'.bsp.bz2';
        
            $file_headers = @get_headers($url);
            if(strpos($file_headers[0],'200')!==false){
                return ' <a href="'.$url.'" class="link-secondary text-decoration-none" title="Download map: '.$map_name.'"><i class="fa-solid fa-download"></i></a>';
            } else {
                $url = $settings_maps_download_url.$map_name.'.bsp';
                $file_headers = @get_headers($url);
                if(strpos($file_headers[0],'200')!==false) 
                    return ' <a href="'.$url.'" class="link-secondary text-decoration-none" title="Download map: '.$map_name.'"><i class="fa-solid fa-download"></i></a>';
            }
        endif;
    }
