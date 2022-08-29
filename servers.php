<?php
    $url = "https://api.steampowered.com/IGameServersService/GetServerList/v1/?key=***REMOVED***&filter=addr\\62.171.171.235";
    $json = file_get_contents($url);
    $table2 = json_decode($json, true);
    $servers = $table2["response"]["servers"];
?>


<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Map name</th>
            <th>Players</th>
            <th></th>
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

<?php
function server($name,$id, $servers) {
    $server_key = array_search($id, array_column($servers, 'steamid'));
    $server = $servers[$server_key];
    ?>
    <tr>
        <td><?php echo $name?></td>
        <td><?php echo $server["map"] ?></td>
        <td>
            <?php echo $server['players']?>/<?php echo $server['max_players']?> (<?php echo $server['bots']?> bots)
        </td>
        <td>
            <a href="steam://connect/<?php echo $server['addr'] ?>">
                Connect
            </a>
        </td>
    </tr>
    <?php
}
?>