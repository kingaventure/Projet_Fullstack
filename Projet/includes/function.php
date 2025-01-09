<?php

function cleanString(string $string): string
{
    return trim(htmlspecialchars($string, ENT_QUOTES));
}