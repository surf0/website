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
        <?php foreach($servers as $server): ?>
        <tr>
            <td><?php echo $server['name']?></td>
            <td>
                <?php echo $server['players']?>/<?php echo $server['max_players']?> (<?php echo $server['bots']?> bots)
            </td>
            <td>
                <a href="steam://connect/<?php echo $server['addr'] ?>">
                    Connect
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>