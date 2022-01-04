<?php

/**
 * @file
 * Demonstration file of using TagConverter library.
 */

require 'vendor/autoload.php';

use writecrow\Tokenizer\Tokenizer;

$file = file_get_contents('demo_text.txt', FILE_USE_INCLUDE_PATH);
if (isset($_POST['text'])) {
  $file = $_POST['text'];
}

include 'head.html';

echo '
<form action="//' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '" method="POST">
  <label for="text"><strong>Text to be tokenized</strong></label><br />
  <em>(Paste your text below)</em><br />
  <textarea class="u-full-width textbox" placeholder="Place your text here..." name="text">' . $file . '</textarea><br />
  <input class="btn" type="submit" value="Tokenize (& count words)" />';
if (isset($_POST['text'])) {
  $tokens = Tokenizer::tokenize($_POST['text']);
  echo '<h3>Word count: ' . count($tokens) . '</h3>';
  echo '<div><pre><code>';
  print_r($tokens);
  echo '</code></pre></div>';
}

echo '
</form>
</body>
</html>';
