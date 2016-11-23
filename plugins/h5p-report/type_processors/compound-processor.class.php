<?php

/**
 * Class FillInProcessor
 * Processes and generates HTML report for 'fill-in' interaction type.
 */
class CompoundProcessor extends TypeProcessor {

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
    $H5PReport = H5PReport::getInstance();

    $reports = '';
    if (isset($extras->children)) {
      foreach ($extras->children as $childData) {
        $reports .= $H5PReport->generateReport($childData);
      }
    }

    return $reports;
  }
}
