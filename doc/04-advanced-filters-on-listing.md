# Advanced Filters on Listing

> ⚠ All filter prefixed methods returns ```self class```

## The Display filters
> Methods: ```->filterAddDisplay($field)```, ```->filterRemoveDisplay($field)```

When the ```->list()``` method is called for an Entity object, only the id information of the records belonging to that object is returned if the display ```filter``` is not used.<br /><br />
You can define which fields to show in the list by calling the ```->filterAddDisplay($field)``` on the object before calling the list method.<br /><br />
If the ```full``` parameter is sent as the ```$field``` parameter, all fields belonging to the object are shown in the list.<br /><br />
You can define multiple fields to be displayed in the list by calling the ```->filterAddDisplay($field)``` method one after the other.<br /><br />
You can remove a display field attached to the filter using the ```->filterRemoveDisplay($field)``` method.

## The Sort Filters
> Methods: ```->filterAddSort($field, $way = 'ASC')```, ```->filterRemoveSort($field)```

The sort filter works just like the ```ORDER BY``` command in ```MySQL```. Lets you define how the listing should be sorted.<br /><br />
You can define multiple fields to be sorting in the list by calling the ```->filterAddSort($field, $way = 'ASC')``` method one after the other.<br /><br />
You can remove a sort field attached to the filter using the ```->filterRemoveSort($field)``` method.
The ```$way``` parameter can only take ```ASC``` and ```DESC``` values.

## The Limit Filters
> Methods: ```->filterSetLimit(int $limit = 100, int $offset = 0)```, ```->filterUnsetLimit()```

The limit filter works just like the ```LIMIT``` command in ```MySQL```. Lets you define how the listing should be paginated.<br /><br />


## The Language Filters
> Methods: ```->filterAddLanguage(int $id_lang)```, ```->filterRemoveLanguage(int $id_lang)```

The language filters allows you to define in which languages the values of the language-enabled fields are returned in the listing.<br /><br />
You can define multiple language to be listing in the list by calling the ```->filterAddLanguage(int $id_lang)``` method one after the other.<br /><br />
You can remove a language attached to the filter using the ```->filterRemoveLanguage(int $id_lang)``` method.


## The Where Equal Filters
> Methods: ```->filterAddEqual($field, $value)```, ```->filterRemoveEqual($field, $value)```

The Where Equal filter works like the ```WHERE field = 'value'``` command in MySQL.<br /><br />
Executing ```->filterAddEqual($field, $value)``` multiple times with different values for the same field will work like the MySQL command ```WHERE field IN ('value1', 'value2', 'value3')``` in MySQL.<br /><br />
You can remove a where equal filter attached to the filter using the ```->filterRemoveEqual($field, $value)``` method.


## The Where Not Equal Filters
> Methods: ```->filterAddNot($field, $value)```, ```->filterRemoveNot($field, $value)```

The Where Not Equal filter works like the ```WHERE field != 'value'``` command in MySQL.<br /><br />
Executing ```->filterAddNot($field, $value)``` multiple times with different values for the same field will work like the MySQL command ```WHERE field NOT IN ('value1', 'value2', 'value3')``` in MySQL.<br /><br />
You can remove a where equal filter attached to the filter using the ```->filterRemoveNot($field, $value)``` method.

## The Where Like Filters
> Methods: ```->filterAddBegin($field, $value)```, ```->filterRemoveBegin($field)```, ```->filterAddEnd($field, $value)```, ```->filterRemoveEnd($field)```, ```->filterAddContain($field, $value)```, ```->filterRemoveContain($field)```

## The Numeric Comparison Filters
> Methods: ```->filterAddGreater($field, $value)```, ```->filterRemoveGreater($field)```, ```->filterAddLower($field, $value)```, ```->filterRemoveLower($field)```, ```->filterAddBetween($field, $start, $end)```, ```->filterRemoveBetween($field)```


## The Reset &amp; Unset Filters
> Methods: ```->filterUnsetField($field)```, ```->resetFilters()```

&larr; [List Method](03-list-method.md) | [Add Method](05-add-method.md) &rarr;
