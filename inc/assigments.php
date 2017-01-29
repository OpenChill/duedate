<?php

$current_time = time();

function parseAssigments($assigments) {

  usort($assigments, function($a, $b) {

       if (strtotime($a->due) == strtotime($b->due)) {
          return 0;
      }
      return (strtotime($a->due) < strtotime($b->due)) ? -1 : 1;
  });

  foreach ($assigments as $assigment) {
    if ($assigment["due"] <= $current_time) {
      $assigment->overdue = 1;
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
      <p><?php echo $assigments->name; ?></p>
    </li>
  }

  </ul>

<?php  }

renderAssigments(parseAssigments(file_get_contents('../api/assigments.php')));
