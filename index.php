<?php
    $page_name = 'Home - Dashboard';
    
    require_once('./inc/includes.php');
    require_once('./inc/pages/dashboard_home.php');

    require_once('header.php');
    require_once('navbar.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">

            <section class="my-4 pb-1">

                <div class="imageContainer">
                    <div class="blur container">
                        <img src="./images/logo.png" height="100">
                        <div class="row button-row">
                            <div class="col-sm">
                                <a class="btn btn-outline-primary" href="https://discord.gg/gNUsvEuZ3d" target="_blank" rel="noopener" role="button">Discord</a>
                            </div>
                            <div class="col-sm">
                                <a class="btn btn-outline-primary" href="https://steamcommunity.com/groups/surf0" target="_blank" rel="noopener" role="button">Steam</a>
                            </div>
                            <div class="col-sm">
                                <a class="btn btn-outline-primary" href="https://www.youtube.com/channel/UCwXXZtJLFx32fwrvU_M3JWQ" target="_blank" rel="noopener" role="button">YouTube</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-4"> <!-- Info Badges -->
                    <div class="row">
                        <div class="col-md col-12">
                            <div class="card card-body border-secondary bg-card-black text-center shadow-sm my-2">
                                <i class="fas fa-users fa-2x"></i>
                                <span class="  my-1"><?php echo HOME_TOTAL_PLAYERS;?></span>
                                <hr>
                                <?php echo number_format($total_players); ?>
                            </div>
                        </div>
                        <div class="col-md col-12">
                            <div class="card card-body border-secondary bg-card-black text-center shadow-sm my-2">
                                <i class="fas fa-map fa-2x"></i>
                                <span class="  my-1"><?php echo HOME_TOTAL_MAPS;?></span>
                                <hr>
                                <?php echo number_format($total_maps); ?>
                            </div>
                        </div>
                        <div class="col-md col-12">
                            <div class="card card-body border-secondary bg-card-black text-center shadow-sm my-2">
                                <i class="fas fa-bold fa-2x"></i>
                                <span class="  my-1"><?php echo HOME_TOTAL_BONUSES;?></span>
                                <hr>
                                <?php echo number_format($total_bonuses); ?>
                            </div>
                        </div>
                        <div class="col-md col-12">
                            <div class="card card-body border-secondary bg-card-black text-center shadow-sm my-2">
                                <i class="fas fa-user-clock fa-2x"></i>
                                <span class="  my-1"><?php echo HOME_TOTAL_COMPLETIONS;?></span>
                                <hr>
                                <?php echo number_format($count_player_times); ?>
                            </div>
                        </div>
                        <div class="col-md col-12">
                            <div class="card card-body border-secondary bg-card-black text-center shadow-sm my-2">
                                <i class="fas fa-clock fa-2x"></i>
                                <span class="  my-1"><?php echo HOME_HOURS_PLAYED;?></span>
                                <hr>
                                <?php echo number_format($hours_played); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    $url = "https://api.steampowered.com/IGameServersService/GetServerList/v1/?key=***REMOVED***&filter=addr\\62.171.171.235";
                    $json = file_get_contents($url);
                    $table2 = json_decode($json, true);
                    $servers = $table2["response"]["servers"];
                ?>

                <div class="row ">
                    <div class="col-12"> <!-- Server List-->
                        <div class="mb-3">
                            <div class="card card-body border-secondary bg-card-black shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-9">
                                            <span class="align-middle">Server List</span>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body border-secondary bg-card-black table-sm py-0 my-0">
                                        <thead>
                                        <tr>
                                            <th class="text-left px-3" scope="col">Name</th>
                                            <th class="text-center" scope="col">Map name</th>
                                            <th class="text-center" scope="col">Players</th>
                                            <th class="text-center" scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php server("Very Easy [Tier 1]","85568392925175846", $servers) ?>
                                        <?php server("Easy [Tier 1-2]","85568392925187498", $servers) ?>
                                        <?php server("Medium [Tier 2-3]","85568392925188366", $servers) ?>
                                        <?php server("Hard [Tier 3-8]","85568392925188368", $servers) ?>
                                        <?php server("All Maps [Tier 1-8]","85568392925188370", $servers) ?>
                                    </tbody>
                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php
                function server($name,$id, $servers) {
                    $server_key = array_search($id, array_column($servers, 'steamid'));
                    $server = $servers[$server_key];
                    ?>
                    <tr>
                        <td class="px-3 align-middle"><?php echo $name?></td>
                        <td class="text-center align-middle"><?php echo MapPageLink($server["map"]);?></td>
                        <td class="text-center align-middle">
                            <?php echo $server['players']?>/<?php echo $server['max_players']?> (<?php echo $server['bots']?> bots)
                        </td>
                        <td class="text-center align-middle">
                            <a class="btn btn-primary" href="steam://connect/<?php echo $server['addr'] ?>">
                                Connect
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                <div class="row">
                    <div class="col-12"> <!-- Recent Records -->
                        <div class="mt-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-9">
                                            <span class="align-middle"><?php echo HOME_RECENT;?></span>
                                        </div>
                                        <div class="col col-md-3 text-end">
                                            <a href="dashboard-recent.php" role="button" class="btn btn-outline-dark btn-sm py-1 px-2 my-0 shadow-sm border"><i class="fas fa-stopwatch"></i> <?php echo HOME_BUTTON_SHOW_MORE;?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body border-secondary bg-card-black table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-left px-3" scope="col"><?php echo TABLE_USERNAME;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_MAP;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_TIME;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_DATE;?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($r10rs as $r10r): ?>
                                                <?php
                                                    $runtime_r10rs_data = $r10r['runtime'];    
                                                    $runtime_r10rs_microtime = substr($runtime_r10rs_data, strpos($runtime_r10rs_data, ".") + 1);    
                                                    $runtime_r10rs_timeFormat = gmdate("H:i:s", $runtime_r10rs_data).'<span class=" ">.'.$runtime_r10rs_microtime.'</span>';
                                                    $dateFormat_r10rs = date('Y/m/d  (H:i)', strtotime($r10r['date']));
                                                ?>
                                                <tr>
                                                    <td class="px-3"><?php if($config_player_flags) echo CountryFlag($r10r['country'], $r10r['countryCode'], $r10r['continentCode']); ?> <?php echo PlayerUsernameProfile($r10r['steamid64'], $r10r['normal_name']); ?></td>
                                                    <td class="text-center"><?php echo MapPageLink($r10r['map']);?></td>
                                                    <td class="text-center"><?php echo $runtime_r10rs_timeFormat; ?></td>
                                                    <td class="text-center"><small><?php echo $dateFormat_r10rs; ?></small></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-12"> <!-- TOP players -->
                        <div class="my-3">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-9">
                                            <span class="align-middle"><?php echo HOME_TOP_PLAYERS;?></span>
                                        </div>
                                        <div class="col col-md-3 text-end">
                                            <a href="dashboard-players.php" role="button" class="btn btn-outline-dark btn-sm py-1 px-2 my-0 shadow-sm border"><i class="fas fa-users"></i> <?php echo HOME_BUTTON_SHOW_MORE;?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body border-secondary bg-card-black table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-left" scope="col"><?php echo TABLE_USERNAME;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_POINTS;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_MAPS;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_BONUSES;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_STAGES;?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t10p_row_number = '0'; foreach($t10ps as $t10p): ?>
                                                <?php
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo ++$t10p_row_number; ?>.</td>
                                                    <td class="text-left"><?php if($config_player_flags) echo CountryFlag($t10p['country'], $t10p['countryCode'], $t10p['continentCode']); ?> <?php echo PlayerUsernameProfile($t10p['steamid64'], $t10p['name']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10p['points']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10p['finishedmapspro']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10p['finishedbonuses']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10p['finishedstages']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12"> <!-- TOP WR holders -->
                        <div class="my-3">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-9">
                                            <span class="align-middle"><?php echo HOME_TOP_WR;?></span>
                                        </div>
                                        <div class="col col-md-3 text-end">
                                            <a href="dashboard-players.php" role="button" class="btn btn-outline-dark btn-sm py-1 px-2 my-0 shadow-sm border"><i class="fas fa-users"></i> <?php echo HOME_BUTTON_SHOW_MORE;?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body border-secondary bg-card-black table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-left" scope="col"><?php echo TABLE_USERNAME;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_WRS;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_FINISHED_MAPS;?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t10wrh_row_number = '0'; foreach($t10wrhs as $t10wrh): ?>
                                                <?php
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo ++$t10wrh_row_number; ?>.</td>
                                                    <td class="text-left"><?php if($config_player_flags) echo CountryFlag($t10wrh['country'], $t10wrh['countryCode'], $t10wrh['continentCode']); ?> <?php echo PlayerUsernameProfile($t10wrh['steamid64'], $t10wrh['name']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10wrh['wrs']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10wrh['finishedmapspro']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12"> <!-- TOP bonus WR holders -->
                        <div class="my-3">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-9">
                                            <span class="align-middle"><?php echo HOME_TOP_BONUS_WR;?></span>
                                        </div>
                                        <div class="col col-md-3 text-end">
                                            <a href="dashboard-players.php" role="button" class="btn btn-outline-dark btn-sm py-1 px-2 my-0 shadow-sm border"><i class="fas fa-users"></i> <?php echo HOME_BUTTON_SHOW_MORE;?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body border-secondary bg-card-black table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-left" scope="col"><?php echo TABLE_USERNAME;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_WRS;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_FINISHED_BONUSES;?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t10bwrh_row_number = '0'; foreach($t10bwrhs as $t10bwrh): ?>
                                                <?php
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo ++$t10bwrh_row_number; ?>.</td>
                                                    <td class="text-left"><?php if($config_player_flags) echo CountryFlag($t10bwrh['country'], $t10bwrh['countryCode'], $t10bwrh['continentCode']); ?> <?php echo PlayerUsernameProfile($t10bwrh['steamid64'], $t10bwrh['name']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10bwrh['wrbs']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10bwrh['finishedbonuses']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12"> <!-- TOP Stage WR holders -->
                        <div class="my-3">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-9">
                                            <span class="align-middle"><?php echo HOME_TOP_STAGE_WR;?></span>
                                        </div>
                                        <div class="col col-md-3 text-end">
                                            <a href="dashboard-players.php" role="button" class="btn btn-outline-dark btn-sm py-1 px-2 my-0 shadow-sm border"><i class="fas fa-users"></i> <?php echo HOME_BUTTON_SHOW_MORE;?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body border-secondary bg-card-black table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-left" scope="col"><?php echo TABLE_USERNAME;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_WRS;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_FINISHED_STAGES;?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t10swrh_row_number = '0'; foreach($t10swrhs as $t10swrh): ?>
                                                <?php
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo ++$t10swrh_row_number; ?>.</td>
                                                    <td class="text-left"><?php if($config_player_flags) echo CountryFlag($t10swrh['country'], $t10swrh['countryCode'], $t10swrh['continentCode']); ?> <?php echo PlayerUsernameProfile($t10swrh['steamid64'], $t10swrh['name']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10swrh['wrcps']); ?></td>
                                                    <td class="text-center"><?php echo number_format($t10swrh['finishedstages']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-12"> <!-- TOP Stage WR holders -->
                        <div class="my-3">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-9">
                                            <span class="align-middle"><?php echo HOME_RECENT_MAPS;?></span>
                                        </div>
                                        <div class="col col-md-3 text-end">
                                            <a href="dashboard-maps.php" role="button" class="btn btn-outline-dark btn-sm py-1 px-2 my-0 shadow-sm border"><i class="fas fa-map"></i> <?php echo HOME_BUTTON_SHOW_MORE;?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body border-secondary bg-card-black table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-left pl-3" scope="col"><?php echo TABLE_MAP;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_TIER;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_TYPE;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_BONUS;?></th>
                                                <th class="text-center" scope="col"><?php echo TABLE_ADDED;?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($rams as $ram): ?>
                                                <?php
                                                ?>
                                                <tr> 
                                                    <td class="text-left pl-3"><?php echo $ram[0]; ?></td>
                                                    <td class="text-center"><?php echo $ram[2]; ?></td>
                                                    <td class="text-center"><?php echo $ram[1]; ?></td>
                                                    <td class="text-center"><?php echo $ram[3]; ?></td>
                                                    <td class="text-center"><?php echo $ram[4]; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
<?php
    require_once('footer.php');
    $db_conn_surftimer->close();
?>
