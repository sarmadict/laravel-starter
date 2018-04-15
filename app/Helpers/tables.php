<?php


if (!function_exists('table_sort_class')) {
    function table_sort_class($field)
    {
        $order = request(['order_by', 'order_direction']);

        if (array_get($order, 'order_by', null) == $field) {
            return array_get($order, 'order_direction', null) == 'asc' ? 'sorting_asc' : 'sorting_desc';
        }

        return 'sorting';
    }
}


if (!function_exists('table_sort_link')) {
    function table_sort_link($field)
    {
        $query = request()->all();

        $currentOrder = array_get($query, 'order_by', null);

        if ($currentOrder == $field) {
            $query['order_direction'] = array_get($query, 'order_direction', null) == 'asc' ? 'desc' : 'asc';
        } else {
            $query['order_by'] = $field;
            $query['order_direction'] = 'asc';
        }

        return '?' . http_build_query($query);
    }
}