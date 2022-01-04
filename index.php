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
<div class="container">
<h1>Text Tokenizer (Word counter)</h1>
<a href="https://github.com/writecrow/tokenizer">Source code</a>
<hr />
</div>
<div class="container">
  <form action="//' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '" method="POST">
    <div class="row">
      <div class="six columns">
        <label for="text">Tagged text to be tokenized</label>
        <em>Paste your text below.</em>
        <textarea class="u-full-width textbox" placeholder="Place tagged text here..." name="text">' . $file . '</textarea>
      </div>
      <div class="six columns">
      <input type="submit" value="Tokenize (count words)" />
      </div>
    </div>
  </form>';
if (isset($_POST['text'])) {
  $tokens = Tokenizer::tokenize($_POST['text']);
  echo '<strong>Word count:</strong> ' . count($tokens);
  echo '<div><pre><code>';
  print_r($tokens);
  echo '</code></pre></div>';
}

echo '
</div>
</body>
</html>';
