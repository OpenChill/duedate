<?php

// Return a the HTML for all the assigments

$current_time = time();
$assigments = json_decode(file_get_contents('http://duedate.gear.host/api/assigments.php'), true);

function parseAssigments($assigments) {
  // Sort assigments based on due date
  usort($assigments, function($a, $b) {

       if (strtotime($a['due']) == strtotime($b['due'])) {
          return 0;
      }
      return (strtotime($a['due']) < strtotime($b['due'])) ? -1 : 1;
  });

  foreach ($assigments as $assigment) {
    if ($assigment["due"] <= $current_time) {
      $assigment["overude"] = 1;
    }
  }

  return $assigments;

}


function renderAssigments($assigments) {

  ?>

  <ul>

  <?php

  foreach ($assigments as $assigment) {
    ?>
    <li class="">
      <table>
        <tr>
          <th>Subject</th>
          <td><?php echo $assigment['name']; ?></td>
        </tr>
        <tr>
          <th>Due Date</th>
          <td><?php echo $assigment['due']; ?></td>
        </tr>
        <tr>
          <th>Details</th>
          <td><?php echo $assigment['info']; ?></td>
        </tr>
        <tr>
          <th>Overude</th>
          <td><?php echo $assigment['overdue'] == 1 ? "Yes": "No"; ?></td>
        </tr>
      </table>
    </li>
    <?php
  } ?>

  </ul>

<?php  }

renderAssigments(parseAssigments($assigments));
