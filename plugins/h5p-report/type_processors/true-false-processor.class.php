<?php

/**
 * Class FillInProcessor
 * Processes and generates HTML report for 'fill-in' interaction type.
 */
class TrueFalseProcessor extends TypeProcessor {

  /**
   * Determines options for interaction and generates a human readable HTML
   * report.
   *
   * @param string $description Description of interaction task
   * @param array $crp Correct responses pattern
   * @param string $response User response
   *
   * @return string HTML for report
   */
  public function generateHTML($description, $crp, $response, $extras) {
    // Add CSS
    static $css_added;
    if (!$css_added) {
      drupal_add_css(drupal_get_path('module', 'h5preport') . '/styles/true-false.css');
      $css_added = true;
    }


    return $this->getContent($description, $crp, $response) . $this->generateFooter();
  }

  private function getContent($description, $crp, $response) {
    $isCorrectClass = $response === $crp[0] ?
      'h5p-true-false-user-response-correct' :
      'h5p-true-false-user-response-wrong';

    return
      '<div class="h5p-true-false-container">' .
        '<p class="h5p-true-false-task-description">' . $description . '</p>' .
        '<p class="h5p-true-false-task">' .
          '<span class="h5p-true-false-correct-responses-pattern">' . $crp[0] . '</span>' .
          '<span class="' . $isCorrectClass . '">' . $response . '</span>' .
        '</p>' .
      '</div>';
  }

  /**
   * Generate footer,
   *
   * @return string
   */
  function generateFooter() {
    return
      '<div class="h5p-true-false-footer">' .
      '<span class="h5p-true-false-correct-responses-pattern">Correct Answer</span>' .
      '<span class="h5p-true-false-user-response-correct">Your correct answer</span>' .
      '<span class="h5p-true-false-user-response-wrong">Your incorrect answer</span>' .
      '</div>';
  }
}
