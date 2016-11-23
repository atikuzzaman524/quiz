<?php

/**
 * Class FillInProcessor
 * Processes and generates HTML report for 'fill-in' interaction type.
 */
class LongChoiceProcessor extends TypeProcessor {

  /**
   * Determines options for interaction and generates a human readable HTML
   * report.
   *
   * @param string $description Description of interaction task
   * @param array $crp Correct responses pattern
   * @param string $response User response
   * @param stdClass $extras Optional xAPI properties like choice descriptions
   * @return string HTML for report
   */
  public function generateHTML($description, $crp, $response, $extras = NULL) {
    static $css_added;
    if (!$css_added) {
      drupal_add_css(drupal_get_path('module', 'h5preport') . '/styles/long-choice.css');
      $css_added = true;
    }

    $correctAnswers = explode('[,]', $crp[0]);
    $responses = explode('[,]', $response);

    $descriptionHTML = $this->generateDescription($description);
    $bodyHTML = $this->generateBody($extras, $correctAnswers, $responses);
    $footer = $this->generateFooter();

    return
      '<div class="h5p-long-choice-container">' .
        $descriptionHTML . $bodyHTML . $footer .
      '</div>';
  }

  private function generateDescription($description) {
    return'<p class="h5p-long-choice-task-description">' . $description . '</p>';
  }

  private function generateBody($extras, $correctAnswers, $responses) {

    $choices = $extras->choices;

    $choicesHTML = '';
    foreach($choices as $choice) {
      $choiceID = $choice->id;
      $isCRP = in_array($choiceID, $correctAnswers);
      $isAnswered = in_array($choiceID, $responses);

      $classes = 'h5p-long-choice-word';
      if ($isAnswered) {
        $classes .= ' h5p-long-choice-answered';
      }
      if ($isCRP) {
        $classes .= ' h5p-long-choice-correct';
      }

      $choicesHTML .=
        '<span class="' . $classes . '">' .
          $choice->description->{'en-US'} .
        '</span>';
    }

    return '<div class="h5p-long-choice-words">' . $choicesHTML . '</div>';

  }


  /**
   * Generate footer
   *
   * @return string
   */
  private function generateFooter() {
    return
      '<div class="h5p-long-choice-footer">' .
        '<span class="h5p-long-choice-word h5p-long-choice-correct">Correct Answer</span>' .
        '<span class="h5p-long-choice-word h5p-long-choice-answered h5p-long-choice-correct">' .
          'Your correct answer' .
        '</span>' .
        '<span class="h5p-long-choice-word h5p-long-choice-answered">' .
          'Your incorrect answer' .
        '</span>' .
      '</div>';
  }
}
