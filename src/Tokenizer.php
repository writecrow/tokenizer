<?php

namespace writecrow\Tokenizer;

/**
 * Class Tokenizer.
 *
 * A helper class to split text on word boundaries.
 *
 * @author markfullmer <mfullmer@gmail.com>
 *
 * @link https://github.com/writecrow/tag-converter/
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class Tokenizer {

  /**
   * Tokenize.
   *
   * @param string $string
   *   The text.
   *
   * @return array
   *   A list of tokens.
   */
  public static function tokenize($string) {
    // Remove URLs.
    $regex = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@";
    $string = preg_replace($regex, ' ', $string);
    // This regex is similar to any non-word character (\W),
    // but retains the following symbols: @'#$%
    $tokens = preg_split("/\s|[,.!?:*&;\"()\[\]_+=”]/", $string);
    $result = [];
    $strip_chars = ":,.!&\?;-\”'()^*";
    foreach ($tokens as $token) {
      if (strlen($token) == 1) {
        if (!in_array($token, ["a", "i", "I", "A"])) {
          continue;
        }
      }
      $token = trim($token, $strip_chars);
      if ($token) {
        $result[] = $token;
      }
    }
    return $result;
  }

}
