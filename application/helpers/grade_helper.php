<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('number_to_letter')) {
  function number_to_letter($ci, $score) {
    if ($score === null) return null;
    $rows = $ci->db->order_by('min_score','DESC')->get('grade_mapping')->result();
    foreach($rows as $r) {
      if ($score >= (float)$r->min_score && $score <= (float)$r->max_score) {
        return $r->letter;
      }
    }
    if ($score >= 90) return 'A';
    if ($score >= 80) return 'B';
    if ($score >= 70) return 'C';
    if ($score >= 60) return 'D';
    return 'E';
  }
}
