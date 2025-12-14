<!doctype html>
<html lang="en"><meta charset="utf-8"><title>Book a Class</title>
<h1>Book a Class or Gym Session</h1>

<form method="post" action="/bookings" id="bookingForm">
  <label for="classSelect">Class</label>
  <select name="class_id" id="classSelect">
    <option value="">Independent gym session</option>
    <?php foreach ($list as $c): ?>
      <option value="<?= htmlspecialchars($c['id']) ?>"><?= htmlspecialchars($c['name']) ?></option>
    <?php endforeach; ?>
  </select>

  <label for="startAt">Start</label>
  <input type="datetime-local" id="startAt" name="start_at" required>

  <label for="endAt">End</label>
  <input type="datetime-local" id="endAt" name="end_at" required>

  <button type="submit">Book</button>
</form>

<p><a href="/bookings">My Bookings</a></p>

<script src="/assets/js/booking.js"></script>
</html>
