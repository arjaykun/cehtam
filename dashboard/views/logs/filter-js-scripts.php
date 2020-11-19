$("#today").click(function() {
      $("#to").val(moment().format('YYYY-MM-DD'));
      $("#from").val(moment().format('YYYY-MM-DD'));
      $("#filter-form").submit();
});

$("#this_week").click(function() {
      $("#from").val(moment().startOf("week").format('YYYY-MM-DD'));
      $("#to").val(moment().endOf("week").format('YYYY-MM-DD'));
      $("#filter-form").submit();     
});

$("#this_month").click(function() {
      $("#from").val(moment().startOf("month").format('YYYY-MM-DD'));
      $("#to").val(moment().endOf("month").format('YYYY-MM-DD'));
      $("#filter-form").submit();     
});

$("#this_year").click(function() {
      $("#from").val(moment().startOf("year").format('YYYY-MM-DD'));
      $("#to").val(moment().endOf("year").format('YYYY-MM-DD'));
      $("#filter-form").submit();
});

$("#last_7_days").click(function() {
      $("#from").val(moment().subtract(7, "d").format('YYYY-MM-DD'));
      $("#to").val(moment().format('YYYY-MM-DD'));
      $("#filter-form").submit();
});

$("#last_15_days").click(function() {
      $("#from").val(moment().subtract(15, "d").format('YYYY-MM-DD'));
      $("#to").val(moment().format('YYYY-MM-DD'));
      $("#filter-form").submit();
});

$("#last_30_days").click(function() {
      $("#from").val(moment().subtract(30, "d").format('YYYY-MM-DD'));
      $("#to").val(moment().format('YYYY-MM-DD'));
      $("#filter-form").submit();
});

$(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});

$("#filter").click(function() {
      $("#filter-modal").addClass("is-active")
})