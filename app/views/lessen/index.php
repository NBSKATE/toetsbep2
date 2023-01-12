<h3><?= $data['title']; ?></h3>
<h4><? echo 'Naam instructeur: ' . $data['instructorName']; ?></h4>

<table border="1">
    <thead>
        <th>Datum</th>
        <th>Mankement</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>