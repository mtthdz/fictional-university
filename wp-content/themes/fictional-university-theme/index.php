<?php

function greet($name, $colour) {
  echo "<p>Hi, my name is $name and my favourite colour is $colour.</p>";

}

greet("John", "blue");
greet("Jane", "green");

?>
<!-- bloginfo is a built in wordpress fn -->
<h1><?php bloginfo('name'); ?></h1>
<p><?php bloginfo('description'); ?></p>