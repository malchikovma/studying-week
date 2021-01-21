<?php
require './StudyingWeek.php';

use StudyingWeek\StudyingWeek;

function fail($message) {
	echo $message . PHP_EOL;
	die(1);
}

$week = new StudyingWeek(strtotime('01-09-2020'));
if ($week->isEven()) {
	fail("Ошибка: {$week} четная неделя");
}
$week->setDate(strtotime('02-09-2020'));
if ($week->isEven()) {
	fail("Ошибка: {$week} четная неделя");
}
$week->setDate(strtotime('03-09-2020'));
if ($week->isEven()) {
	fail("Ошибка: {$week} четная неделя");
}
$week->setDate(strtotime('04-09-2020'));
if ($week->isEven()) {
	fail("Ошибка: {$week} четная неделя");
}
$week->setDate(strtotime('07-09-2020'));
if ($week->isOdd()) {
	fail("Ошибка: {$week} нечетная неделя");
}
$week->setDate(strtotime('08-09-2020'));
if ($week->isOdd()) {
	fail("Ошибка: {$week} нечетная неделя");
}
$week->setDate(strtotime('31-12-2020'));
if ($week->isOdd()) {
	fail("Ошибка: {$week} нечетная неделя");
}
$week->setDate(strtotime('11-01-2021'));
if ($week->isEven()) {
	fail("Ошибка: {$week} четная неделя");
}
$week->setDate(strtotime('12-01-2021'));
if ($week->isEven()) {
	fail("Ошибка: {$week} четная неделя");
}
$week->setDate(strtotime('13-01-2021'));
if ($week->isEven()) {
	fail("Ошибка: {$week} четная неделя");
}
$week->setDate(strtotime('18-01-2021'));
if ($week->isOdd()) {
	fail("Ошибка: {$week} нечетная неделя");
}
$week->setDate(strtotime('19-01-2021'));
if ($week->isOdd()) {
	fail("Ошибка: {$week} нечетная неделя");
}
$week->setDate(strtotime('20-01-2021'));
if ($week->isOdd()) {
	fail("Ошибка: {$week} нечетная неделя");
}
echo 'Тесты пройдены успешно' . PHP_EOL;
