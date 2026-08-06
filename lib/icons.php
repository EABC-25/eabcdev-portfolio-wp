<?php

if (!defined('ABSPATH')) {
    exit;
}

function eabcdev_portfolio_icon($name) {
    return match ($name) {
        'home'=> eabcdev_portfolio_icon_home(),
        'projects'=> eabcdev_portfolio_icon_projects(),
        default => '',
    };
}

function eabcdev_portfolio_icon_home(): string
{
    return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg"
width="24"
    height="24"
     viewBox="0 0 24 24"
     fill="none"
     stroke="currentColor"
     stroke-width="2"
     stroke-linecap="round"
     stroke-linejoin="round"
     aria-hidden="true">
    <path d="M3 10.5L12 3l9 7.5"/>
    <path d="M5 9.5V21h14V9.5"/>
    <path d="M9 21v-6h6v6"/>
</svg>
SVG;
}

function eabcdev_portfolio_icon_projects(): string
{
    return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg"
width="24"
    height="24"
     viewBox="0 0 24 24"
     fill="none"
     stroke="currentColor"
     stroke-width="2"
     stroke-linecap="round"
     stroke-linejoin="round"
     aria-hidden="true">
    <path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
</svg>
SVG;
}