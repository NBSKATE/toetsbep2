<h3><?= $data['title']; ?></h3>
<h4><?= 'Naam instructeur: ' . $data['instructorName']; ?></h4>

<table border="1">
    <thead>
        <th>Datum</th>
        <th>Mankement</th>
        <th></th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>