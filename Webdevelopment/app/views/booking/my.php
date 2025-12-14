<!doctype html>
<html lang="en"><meta charset="utf-8"><title>My Bookings</title>
<h1>My Bookings</h1>
<ul id="myBookings">
  <?php foreach ($bookings as $b): ?>
    <li>
      <?= htmlspecialchars($b['start_at']) ?> – <?= htmlspecialchars($b['end_at']) ?> :
      <?= htmlspecialchars($b['class_name']) ?>
    </li>
  <?php endforeach; ?>
</ul>

<p><a href="/classes">Back to booking</a></p>
</html>
