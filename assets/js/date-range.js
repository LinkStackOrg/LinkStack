/* ====== Index ======

1. RECNT ORDERS
2. USER ACTIVITY
3. ANALYTICS COUNTRY
4. PAGE VIEWS
5. ACTIVITY USER

====== End ======*/
$(function() {
  "use strict";
  
  /*======== 1. RECNT ORDERS ========*/
  if ($("#recent-orders")) {
    var start = moment().subtract(29, "days");
    var end = moment();
    var cb = function(start, end) {
      $("#recent-orders .date-range-report span").html(
        start.format("ll") + " - " + end.format("ll")
      );
    };

    $("#recent-orders .date-range-report").daterangepicker(
      {
        startDate: start,
        endDate: end,
        opens: 'left',
        ranges: {
          Today: [moment(), moment()],
          Yesterday: [
            moment().subtract(1, "days"),
            moment().subtract(1, "days")
          ],
          "Last 7 Days": [moment().subtract(6, "days"), moment()],
          "Last 30 Days": [moment().subtract(29, "days"), moment()],
          "This Month": [moment().startOf("month"), moment().endOf("month")],
          "Last Month": [
            moment()
              .subtract(1, "month")
              .startOf("month"),
            moment()
              .subtract(1, "month")
              .endOf("month")
          ]
        }
      },
      cb
    );
    cb(start, end);
  }

  /*======== 2. USER ACTIVITY ========*/
  if ($("#user-activity")) {
    var start = moment().subtract(1, "days");
    var end = moment().subtract(1, "days");
    var cb = function(start, end) {
      $("#user-activity .date-range-report span").html(
        start.format("ll") + " - " + end.format("ll")
      );
    };

    $("#user-activity .date-range-report").daterangepicker(
      {
        startDate: start,
        endDate: end,
        opens: 'left',
        ranges: {
          Today: [moment(), moment()],
          Yesterday: [
            moment().subtract(1, "days"),
            moment().subtract(1, "days")
          ],
          "Last 7 Days": [moment().subtract(6, "days"), moment()],
          "Last 30 Days": [moment().subtract(29, "days"), moment()],
          "This Month": [moment().startOf("month"), moment().endOf("month")],
          "Last Month": [
            moment()
              .subtract(1, "month")
              .startOf("month"),
            moment()
              .subtract(1, "month")
              .endOf("month")
          ]
        }
      },
      cb
    );
    cb(start, end);
  }

  /*======== 3. ANALYTICS COUNTRY ========*/
  if ($("#analytics-country")) {
    var start = moment();
    var end = moment();
    var cb = function(start, end) {
      $("#analytics-country .date-range-report span").html(
        start.format("ll") + " - " + end.format("ll")
      );
    };

    $("#analytics-country .date-range-report").daterangepicker(
      {
        startDate: start,
        endDate: end,
        opens: 'left',
        ranges: {
          Today: [moment(), moment()],
          Yesterday: [
            moment().subtract(1, "days"),
            moment().subtract(1, "days")
          ],
          "Last 7 Days": [moment().subtract(6, "days"), moment()],
          "Last 30 Days": [moment().subtract(29, "days"), moment()],
          "This Month": [moment().startOf("month"), moment().endOf("month")],
          "Last Month": [
            moment()
              .subtract(1, "month")
              .startOf("month"),
            moment()
              .subtract(1, "month")
              .endOf("month")
          ]
        }
      },
      cb
    );
    cb(start, end);
  }

  /*======== 4. PAGE VIEWS ========*/
  if ($("#page-views")) {
    var start = moment();
    var end = moment();
    var cb = function(start, end) {
      $("#page-views .date-range-report span").html(
        start.format("ll") + " - " + end.format("ll")
      );
    };

    $("#page-views .date-range-report").daterangepicker(
      {
        startDate: start,
        endDate: end,
        opens: 'left',
        ranges: {
          Today: [moment(), moment()],
          Yesterday: [
            moment().subtract(1, "days"),
            moment().subtract(1, "days")
          ],
          "Last 7 Days": [moment().subtract(6, "days"), moment()],
          "Last 30 Days": [moment().subtract(29, "days"), moment()],
          "This Month": [moment().startOf("month"), moment().endOf("month")],
          "Last Month": [
            moment()
              .subtract(1, "month")
              .startOf("month"),
            moment()
              .subtract(1, "month")
              .endOf("month")
          ]
        }
      },
      cb
    );
    cb(start, end);
  }
  /*======== 5. ACTIVITY USER ========*/
  if ($("#activity-user")) {
    var start = moment();
    var end = moment();
    var cb = function(start, end) {
      $("#activity-user .date-range-report span").html(
        start.format("ll") + " - " + end.format("ll")
      );
    };

    $("#activity-user .date-range-report").daterangepicker(
      {
        startDate: start,
        endDate: end,
        opens: 'left',
        ranges: {
          Today: [moment(), moment()],
          Yesterday: [
            moment().subtract(1, "days"),
            moment().subtract(1, "days")
          ],
          "Last 7 Days": [moment().subtract(6, "days"), moment()],
          "Last 30 Days": [moment().subtract(29, "days"), moment()],
          "This Month": [moment().startOf("month"), moment().endOf("month")],
          "Last Month": [
            moment()
              .subtract(1, "month")
              .startOf("month"),
            moment()
              .subtract(1, "month")
              .endOf("month")
          ]
        }
      },
      cb
    );
    cb(start, end);
  }
});
