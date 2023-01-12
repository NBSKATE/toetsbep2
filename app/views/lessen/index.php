<h3><?= $data['title']; ?></h3>
<h4><?= 'Naam instructeur: ' . $data['instructorName']; ?></h4>
<h4><?= 'Email instructeur: ' . $data['Email']; ?></h4>
<h4><?= 'Kenteken Auto: ' . $data['kenteken']; ?></h4>


<table border="1">
    <thead>
        <th>Datum</th>
        <th>Mankement</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>
<button type="button">toevoegen mankement</button>