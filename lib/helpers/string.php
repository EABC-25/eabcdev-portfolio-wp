<?php

if (!defined('ABSPATH')) {
    exit;
}

function eabcdev_portfolio_substr_trailing_dots($string, $start, $end) {
  return substr($string, $start, $end) . '...';
}