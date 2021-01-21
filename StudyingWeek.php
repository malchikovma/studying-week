<?php
/**
 * Source: https://github.com/minus20/studying-week
 */
 
namespace StudyingWeek;

class StudyingWeek
{
	private $date;
	
	/**
	 * @param $date number Время в формате Unix-epoch
	 */
	public function __construct($date = null)
	{
		if ($date === null) {
			$date = time();
		}
		
		$this->date = $date;
	}

	/**
	 * @param int|number|null $date Время в формате Unix-epoch
	 */
	public function setDate(?int $date): void
	{
		$this->date = $date;
	}

	/**
	 * @return string|bool|null
	 */
	public function getDate(): ?string
	{
		return date('d-m-Y', $this->date);
	}

    /**
     * Является ли первая учебная неделя нечетной неделей года
     * 1 неделя это начало учебного года т.е. 1 сентября, за исключением случая, когда это воскресенье
     *
     * @param $year
     * @return bool
     */
    private function isFirstWeekTheOdd($year)
    {
        // находим день недели 1 сентября текущего года
        $firstSeptember = strtotime('1 september ' . $year);
        $firstSeptemberDayOfWeek = (integer) date('N', $firstSeptember);
        $firstSeptemberNumberOfWeek = (integer) date('W', $firstSeptember);
        // если день недели - воскресенье, то следующая неделя будет первой, иначе текущая
        if ($firstSeptemberDayOfWeek === 7) {
            $firstWeek = $firstSeptemberNumberOfWeek + 1;
        } else {
            $firstWeek = $firstSeptemberNumberOfWeek;
        }
        // проверить четность первой недели
        return $firstWeek % 2 !== 0;
    }

    /**
     * Определить является ли неделя в первом семестре нечетной
     *
     * @param number $date
     * @return bool
     */
    private function isFirstSemesterWeekTheOdd($date)
    {
        // если первый семестр, то считаем от текущего года
        // проверить четность первой недели
        $currentYear = (integer) date('Y', $date);
        $isFirstWeekTheOdd = $this->isFirstWeekTheOdd($currentYear);
        // каждая неделя с такой же четностью будет первой (нечетной) учебной
        $currentWeek = (integer) date('W', $date);
        $isCurrentWeekTheOdd = $currentWeek % 2 !== 0;

        return $isCurrentWeekTheOdd === $isFirstWeekTheOdd;
    }

    /**
     * Является неделя второго семестра нечетной
     *
     * @param number $date
     * @return bool
     */
    private function isSecondSemesterWeekTheOdd($date)
    {
        // если второй семестр, то считаем от предыдущего года
        // первая неделя года не учебная, но входит в счет
        // в примере 1 января - воскресенье, но входит в след неделю
        // судя по производственному календарю если 1 января попадает на сб или вс, то вся след неделя - каникулы

        // находим является ли последняя неделя нечетной
        $lastDayOfTheYear = ((integer) date('Y', $date) - 1) . '-12-31';
        $lastWeekOfTheYearIsOdd = $this->isFirstSemesterWeekTheOdd(strtotime($lastDayOfTheYear));
        // если 1 янв === (сб или вс), то 1 и 2 неделя года - одна учебная неделя
        $firstJanuaryDayNumber = (integer) date('N',
            strtotime(
                date('Y', $date) . '-01-01'
            )
        );
        if ($firstJanuaryDayNumber === 6 || $firstJanuaryDayNumber === 7) {
            // !(четность последней недели) распространяется на вторую неделю, т.е. четные недели являются нечетными учебными неделями
            $evenWeeksTheOdd  = !$lastWeekOfTheYearIsOdd;
        } else {
            $evenWeeksTheOdd = $lastWeekOfTheYearIsOdd;
        }

        $isCurrentWeekTheOdd = (integer) date('N', $date) % 2 !== 0;

        return $isCurrentWeekTheOdd == $evenWeeksTheOdd;
    }
	
	/**
	 * Является ли учебная неделя нечетной
     *
     * @return bool
	 */
	public function isOdd()
	{

        $currentMonth = (integer) date('n', $this->date);

        if ( $currentMonth > 8 && $currentMonth < 13) {
            return $this->isFirstSemesterWeekTheOdd($this->date);
        } else {
            return $this->isSecondSemesterWeekTheOdd($this->date);
        }
	}

    /**
     * Является ли учебная неделя четной
     *
     * @return bool
     */
    public function isEven()
    {
        return !$this->isOdd();
    }
}
