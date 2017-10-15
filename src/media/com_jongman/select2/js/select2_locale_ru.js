/**
* @package     Joomla Extensions
* @subpackage  JONGman
*
* @copyright   Copyright (C) 2005 - 2017 Prasit Gebsaap, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Совпадений не найдено"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Пожалуйста, введите еще " + n + " символ" + (n == 1 ? "" : ((n > 1)&&(n < 5) ? "а" : "ов")); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Пожалуйста, введите на " + n + " символ" + (n == 1 ? "" : ((n > 1)&&(n < 5)? "а" : "ов")) + " меньше"; },
        formatSelectionTooBig: function (limit) { return "Вы можете выбрать не более " + limit + " элемент" + (limit == 1 ? "" : ((limit > 1)&&(limit < 5)? "а" : "ов")); },
        formatLoadMore: function (pageNumber) { return "Загрузка данных..."; },
        formatSearching: function () { return "Поиск..."; }
    });
})(jQuery);
