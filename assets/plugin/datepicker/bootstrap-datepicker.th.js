/**
 * Thai translation for bootstrap-datepicker
 * Suchau Jiraprapot <seroz24@gmail.com>
 */

;
(function ($) {
    // en-th - (rare use) english language with thai-year
    $.fn.datepicker.dates['en-th'] =
            // en-en.th - english language with smart thai-year input (2540-2569) conversion
            $.fn.datepicker.dates['en-en.th'] =
            $.fn.datepicker.dates['en'];

    // th-th - thai language with thai-year
    $.fn.datepicker.dates['th-th'] =
            $.fn.datepicker.dates['th'] = {
        format: 'dd/mm/yyyy',
        days: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิตย์"],
        daysShort: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส", "อา"],
        daysMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส", "อา"],
        months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
        monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
        today: "วันนี้"
    };
}(jQuery));