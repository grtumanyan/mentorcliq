<?php


/**
 * File processing criteria.
 */
const CRITERIAS = ['Division', 'Age', 'Timezone', 'Name'];

/**
 * File processing criteria.
 */
const PERCENTAGE = ['Division' => 30, 'Age' => 30, 'Timezone' => 40];


/**
 * Lists all the prices for the mobile app.
 * @param $firstAge
 * @param $secondAge
 * @return bool
 */
function checkAge($firstAge, $secondAge)
{
    if (abs($firstAge - $secondAge) <= 5) {
        return true;
    }
    return false;
}
