UPDATE calendar
SET year = YEAR(calendar_date),
	month = MONTH(calendar_date),
    week = WEEK(calendar_date),
	day = dayofmonth(calendar_date),
	day_of_week = dayofweek(calendar_date),
	month_name = monthname(calendar_date),
	day_name = dayname(calendar_date)
