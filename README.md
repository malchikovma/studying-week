# StudyingWeek class

## Description

Some education institutions use two week schedule system. This class calculates is given date the first or second studying week.

## Example

We pass time in Unix-epoch seconds in the constructor.

```php
use StudyingWeek\StudyingWeek;

$week = new StudyingWeek(strtotime('2020-07-11'));
$isEven = $week->isEven(); // or $week->isOdd();
```

## Notice

Calculation algorithm may vary depend on country/institution. Feel free to fork and modify it.
