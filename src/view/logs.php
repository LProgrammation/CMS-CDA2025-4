<h1>Logs Historique</h1>

<table id="datatable-logs" class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>ID Log</th>
            <th>ID User</th>
            <th>Log Date</th>
            <th>Log Message</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $compteur=1;
        foreach ($tab_logs as $log) {
            ?>
            <tr>
                <td><?php echo $compteur; ?></td>
                <td><?php echo $log['id_log']; ?></td>
                <td><?php echo $log['id_user']; ?></td>
                <td><?php echo $log['date_log']; ?></td>
                <td><?php echo $log['action_log']; ?></td>
            </tr>
            <?php
            $compteur++;
        }
        ?>
</table>