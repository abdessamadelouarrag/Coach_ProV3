<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes disponibilités</title>
</head>
<body>

<h2>Mes disponibilités</h2>

<p><a href="/coach">⬅ Back</a></p>

<?php if (!empty($_SESSION['flash_error'])): ?>
  <p style="color:red;"><?php echo $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></p>
<?php endif; ?>

<?php if (!empty($_SESSION['flash_success'])): ?>
  <p style="color:green;"><?php echo $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?></p>
<?php endif; ?>

<form method="POST" action="/coach/disponibilite/add">
  <div>
    <label>Date:</label>
    <input type="date" name="date_dispo" required>
  </div>

  <div>
    <label>Start:</label>
    <input type="time" name="start_time" required>
  </div>

  <div>
    <label>End:</label>
    <input type="time" name="end_time" required>
  </div>

  <button type="submit">Ajouter</button>
</form>

<hr>

<h3>Liste</h3>

<?php if (empty($dispos)): ?>
  <p>Aucune disponibilité.</p>
<?php else: ?>
  <table border="1" cellpadding="8">
    <thead>
      <tr>
        <th>Date</th>
        <th>Start</th>
        <th>End</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dispos as $d): ?>
        <tr>
          <td><?php echo htmlspecialchars($d['date_dispo']); ?></td>
          <td><?php echo htmlspecialchars(substr($d['start_time'], 0, 5)); ?></td>
          <td><?php echo htmlspecialchars(substr($d['end_time'], 0, 5)); ?></td>
          <td>
            <a href="/coach/disponibilite/delete?id=<?php echo (int)$d['id']; ?>"
               onclick="return confirm('Supprimer?')">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

</body>
</html>
