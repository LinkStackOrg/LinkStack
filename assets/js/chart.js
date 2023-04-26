/* ====== Index ======

1. DUAL LINE CHART
2. DUAL LINE CHART2
3. LINE CHART
4. LINE CHART1
5. LINE CHART2
6. AREA CHART
7. AREA CHART1
8. AREA CHART2
9. AREA CHART3
10. GRADIENT LINE CHART
11. DOUGHNUT CHART
12. POLAR CHART
13. RADAR CHART
14. CURRENT USER BAR CHART
15. ANALYTICS - USER ACQUISITION
16. ANALYTICS - ACTIVITY CHART
17. HORIZONTAL BAR CHART1
18. HORIZONTAL BAR CHART2
19. DEVICE - DOUGHNUT CHART
20. BAR CHART
21. BAR CHART1
22. BAR CHART2
23. BAR CHART3
24. GRADIENT LINE CHART1
25. GRADIENT LINE CHART2
26. GRADIENT LINE CHART3
27. ACQUISITION3
28. STATISTICS

====== End ======*/

$(document).ready(function() {
  "use strict";
  
  /*======== 1. DUAL LINE CHART ========*/
  var dual = document.getElementById("dual-line");
  if (dual !== null) {
    var urChart = new Chart(dual, {
      type: "line",
      data: {
        labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
        datasets: [
          {
            label: "Old",
            pointRadius: 4,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            fill: false,
            backgroundColor: "transparent",
            borderWidth: 2,
            borderColor: "#fdc506",
            data: [0, 4, 3, 5.5, 3, 4.7, 0]
          },
          {
            label: "New",
            fill: false,
            pointRadius: 4,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            backgroundColor: "transparent",
            borderWidth: 2,
            borderColor: "#4c84ff",
            data: [0, 2, 4.3, 3.8, 5.2, 1.8, 2.2]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
          padding: {
            right: 10
          }
        },

        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: false
              },
              ticks: {
                display: false, // hide main x-axis line
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true
              }
            }
          ]
        },
        tooltips: {
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 14,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2
        }
      }
    });
  }
  /*======== 1. DUAL LINE CHART2 ========*/
  var dual3 = document.getElementById("dual-line3");
  if (dual3 !== null) {
    var urdChart = new Chart(dual3, {
      type: "line",
      data: {
        labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
        datasets: [
          {
            label: "Old",
            pointRadius: 4,
            pointBackgroundColor: "#fec400",
            pointBorderWidth: 2,
            fill: false,
            backgroundColor: "transparent",
            borderWidth: 2,
            borderColor: "#fcdf80",
            data: [0, 4, 3, 5.5, 3, 4.7, 0]
          },
          {
            label: "New",
            fill: false,
            pointRadius: 4,
            pointBackgroundColor: "#fec400",
            pointBorderWidth: 2,
            backgroundColor: "transparent",
            borderWidth: 2,
            borderColor: "#ffffff",
            data: [0, 2, 4.3, 3.8, 5.2, 1.8, 2.2]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        layout: {
          padding: {
            right: 10
          }
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: false
              },
              ticks: {
                display: false, // hide main x-axis line
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true
              }
            }
          ]
        },
        tooltips: {
          enabled: true
        }
      }
    });
  }
  /*======== 3. LINE CHART ========*/
  var ctx = document.getElementById("linechart");
  if (ctx !== null) {
    var chart = new Chart(ctx, {
      // The type of chart we want to create
      type: "line",

      // The data for our dataset
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec"
        ],
        datasets: [
          {
            label: "",
            backgroundColor: "transparent",
            borderColor: "rgb(82, 136, 255)",
            data: [
              100,
              11000,
              10000,
              14000,
              11000,
              17000,
              14500,
              18000,
              5000,
              23000,
              14000,
              19000
            ],
            lineTension: 0.3,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointHoverBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            pointHoverRadius: 8,
            pointHoverBorderWidth: 1
          }
        ]
      },

      // Configuration options go here
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        layout: {
          padding: {
            right: 10
          }
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                display: false
              }
            }
          ],
          yAxes: [
            {
              gridLines: {
                display: true,
                color: "#eee",
                zeroLineColor: "#eee",
              },
              ticks: {
                callback: function(value) {
                  var ranges = [
                    { divider: 1e6, suffix: "M" },
                    { divider: 1e4, suffix: "k" }
                  ];
                  function formatNumber(n) {
                    for (var i = 0; i < ranges.length; i++) {
                      if (n >= ranges[i].divider) {
                        return (
                          (n / ranges[i].divider).toString() + ranges[i].suffix
                        );
                      }
                    }
                    return n;
                  }
                  return formatNumber(value);
                }
              }
            }
          ]
        },
        tooltips: {
          callbacks: {
            title: function(tooltipItem, data) {
              return data["labels"][tooltipItem[0]["index"]];
            },
            label: function(tooltipItem, data) {
              return "$" + data["datasets"][0]["data"][tooltipItem["index"]];
            }
          },
          responsive: true,
          intersect: false,
          enabled: true,
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 18,
          backgroundColor: "rgba(256,256,256,0.95)",
          xPadding: 20,
          yPadding: 10,
          displayColors: false,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 10,
          caretPadding: 15
        }
      }
    });
  }
  /*======== 4. LINE CHART1 ========*/
  var lchart1 = document.getElementById("linechart1");
  if (lchart1 !== null) {
    var urChart = new Chart(lchart1, {
      type: "line",
      data: {
        labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
        datasets: [
          {
            label: "Old",
            pointRadius: 0,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            fill: false,
            backgroundColor: "transparent",
            borderWidth: 2,
            borderColor: "#fcdf80",
            data: [0, 5, 2.5, 9.5, 3.3, 8, 0]
          },
          {
            label: "New",
            fill: false,
            pointRadius: 0,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            backgroundColor: "transparent",
            borderWidth: 2,
            borderColor: "#4c84ff",
            data: [0, 2, 6, 5, 8.5, 3, 3.8]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: false
              },
              ticks: {
                display: false, // hide main x-axis line
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true
              }
            }
          ]
        },
        tooltips: {
          enabled: false
        }
      }
    });
  }
  /*======== 5. LINE CHART2 ========*/
  var lchart2 = document.getElementById("linechart2");
  if (lchart2 !== null) {
    var urChart2 = new Chart(lchart2, {
      type: "line",
      data: {
        labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
        datasets: [
          {
            label: "Old",
            pointRadius: 0,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            fill: false,
            backgroundColor: "transparent",
            borderWidth: 2,
            borderColor: "#fcdf80",
            data: [0, 5, 2.5, 9.5, 3.3, 8, 0]
          },
          {
            label: "New",
            fill: false,
            pointRadius: 0,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            backgroundColor: "transparent",
            borderWidth: 2,
            borderColor: "#ffffff",
            data: [0, 2, 6, 5, 8.5, 3, 3.8]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: false
              },
              ticks: {
                display: false, // hide main x-axis line
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true
              }
            }
          ]
        },
        tooltips: {
          enabled: false
        }
      }
    });
  }
  /*======== 6. AREA CHART ========*/
  var area = document.getElementById("area-chart");
  if (area !== null) {
    var areaChart = new Chart(area, {
      type: "line",
      data: {
        labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
        datasets: [
          {
            label: "New",
            pointHitRadius: 10,
            pointRadius: 0,
            fill: true,
            backgroundColor: "rgba(76, 132, 255, 0.9)",
            borderColor: "rgba(76, 132, 255, 0.9)",
            data: [0, 4, 2, 6.5, 3, 4.7, 0]
          },
          {
            label: "Old",
            pointHitRadius: 10,
            pointRadius: 0,
            fill: true,
            backgroundColor: "rgba(253, 197, 6, 0.9)",
            borderColor: "rgba(253, 197, 6, 1)",
            data: [0, 2, 4.3, 3.8, 5.2, 1.8, 2.2]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        layout: {
          padding: {
            right: 10
          }
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: false
              },
              ticks: {
                display: false, // hide main x-axis line
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true
              }
            }
          ]
        },
        tooltips: {
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 14,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2
        }
      }
    });
  }
  /*======== 7. AREA CHART1 ========*/
  var area1 = document.getElementById("areaChart1");
  if (area1 !== null) {
    var areaChart = new Chart(area1, {
      type: "line",
      data: {
        labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
        datasets: [
          {
            label: "New",
            pointRadius: 0.1,
            fill: true,
            lineTension: 0.3,
            backgroundColor: "rgba(76, 132, 255, 0.9)",
            borderColor: "rgba(76, 132, 255, 0.9)",
            data: [0, 5, 2.5, 9, 3.5, 6.5, 0]
          },
          {
            label: "Old",
            pointRadius: 0.1,
            fill: true,
            lineTension: 0.3,
            backgroundColor: "rgba(253, 197, 6, 0.9)",
            borderColor: "rgba(253, 197, 6, 1)",
            data: [0, 2, 5.5, 2.6, 5.7, 4, 2.8]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: false
              },
              ticks: {
                display: false, // hide main x-axis line
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true
              }
            }
          ]
        },
        tooltips: {
          enabled: false
        }
      }
    });
  }

  /*======== 8. AREA CHART2 ========*/
  var area2 = document.getElementById("areaChart2");
  if (area2 !== null) {
    var areaChart = new Chart(area2, {
      type: "line",
      data: {
        labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
        datasets: [
          {
            label: "New",
            pointRadius: 0.1,
            fill: true,
            lineTension: 0.6,
            backgroundColor: "rgba(255, 255, 255, 0.4)",
            borderColor: "rgba(255, 255, 255,0)",
            data: [0, 5, 2.5, 9, 3.5, 6.5, 0]
          },
          {
            label: "Old",
            pointRadius: 0.1,
            fill: true,
            lineTension: 0.6,
            backgroundColor: "rgba(255, 255, 255, 0.8)",
            borderColor: "rgba(255, 255, 255, 0)",
            data: [0, 2, 5.5, 2.6, 5.7, 4, 2.8]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: false
              },
              ticks: {
                display: false, // hide main x-axis line
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true
              }
            }
          ]
        },
        tooltips: {
          enabled: false
        }
      }
    });
  }

  /*======== 9. AREA CHART3 ========*/
  var area3 = document.getElementById("area-chart3");
  if (area3 !== null) {
    var areaChart3 = new Chart(area3, {
      type: "line",
      data: {
        labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
        datasets: [
          {
            label: "New",
            pointHitRadius: 10,
            pointRadius: 0,
            fill: true,
            backgroundColor: "rgba(255, 255, 255, 0.4)",
            borderColor: "rgba(255, 255, 255,0)",
            data: [0, 4, 2, 6.5, 3, 4.7, 0]
          },
          {
            label: "Old",
            pointHitRadius: 10,
            pointRadius: 0,
            fill: true,
            backgroundColor: "rgba(255, 255, 255, 0.8)",
            borderColor: "rgba(255, 255, 255, 0)",
            data: [0, 2, 4.3, 3.8, 5.2, 1.8, 2.2]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        layout: {
          padding: {
            right: 10
          }
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: false
              },
              ticks: {
                display: false, // hide main x-axis line
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true
              }
            }
          ]
        },
        tooltips: {
          enabled: true
        }
      }
    });
  }
  /*======== 10. GRADIENT LINE CHART ========*/
  var line = document.getElementById("line");
  if (line !== null) {
    line = line.getContext("2d");
    var gradientFill = line.createLinearGradient(0, 120, 0, 0);
    gradientFill.addColorStop(0, "rgba(41,204,151,0.10196)");
    gradientFill.addColorStop(1, "rgba(41,204,151,0.30196)");

    var lChart = new Chart(line, {
      type: "line",
      data: {
        labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
        datasets: [
          {
            label: "Rev",
            lineTension: 0,
            pointRadius: 4,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            fill: true,
            backgroundColor: gradientFill,
            borderColor: "#29cc97",
            borderWidth: 2,
            data: [0, 4, 3, 5.5, 3, 4.7, 1]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        layout: {
          padding: {
            right: 10
          }
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: false
              },
              ticks: {
                display: false, // hide main x-axis line
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: false,
                beginAtZero: true
              }
            }
          ]
        },
        tooltips: {
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 14,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2
        }
      }
    });
  }
  /*======== 11. DOUGHNUT CHART ========*/
  var doughnut = document.getElementById("doChart");
  if (doughnut !== null) {
    var myDoughnutChart = new Chart(doughnut, {
      type: "doughnut",
      data: {
        labels: ["completed", "unpaid", "pending", "canceled"],
        datasets: [
          {
            label: ["completed", "unpaid", "pending", "canceled"],
            data: [4100, 2500, 1800, 2300],
            backgroundColor: ["#4c84ff", "#29cc97", "#8061ef", "#fec402"],
            borderWidth: 1
            // borderColor: ['#4c84ff','#29cc97','#8061ef','#fec402']
            // hoverBorderColor: ['#4c84ff', '#29cc97', '#8061ef', '#fec402']
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        cutoutPercentage: 75,
        tooltips: {
          callbacks: {
            title: function(tooltipItem, data) {
              return "Order : " + data["labels"][tooltipItem[0]["index"]];
            },
            label: function(tooltipItem, data) {
              return data["datasets"][0]["data"][tooltipItem["index"]];
            }
          },
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 14,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2
        }
      }
    });
  }
  /*======== 12. POLAR CHART ========*/
    var polar = document.getElementById("polar");
    if (polar !== null) {
      var configPolar = {
        data: {
          datasets: [
            {
              data: [43, 23, 53, 33, 55],
              backgroundColor: [
                "rgba(41,204,151,0.5)",
                "rgba(254,88,101,0.5)",
                "rgba(128,97,239,0.5)",
                "rgba(254,196,0,0.5)",
                "rgba(76,132,255,0.5)"
              ],
              label: "" // for legend
            }
          ],
          labels: ["Total Sales", "Rejected", "Completed", "Pending", "Reserve"]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "right",
            display: false
          },
          layout: {
            padding: {
              top: 10,
              bottom: 10,
              right: 10,
              left: 10
            }
          },
          title: {
            display: false,
            text: "Chart.js Polar Area Chart"
          },
          scale: {
            ticks: {
              beginAtZero: true,
              fontColor: "#1b223c",
              fontSize: 12,
              stepSize: 10,
              max: 60
            },
            reverse: false
          },
          animation: {
            animateRotate: false,
            animateScale: true
          },
          tooltips: {
            titleFontColor: "#888",
            bodyFontColor: "#555",
            titleFontSize: 12,
            bodyFontSize: 14,
            backgroundColor: "rgba(256,256,256,0.95)",
            displayColors: true,
            borderColor: "rgba(220, 220, 220, 0.9)",
            borderWidth: 2
          }
        }
      };
      window.myPolarArea = Chart.PolarArea(polar, configPolar);
    }

  /*======== 13. RADAR CHART ========*/
  var radar = document.getElementById("radar");
  if (radar !== null) {
    var myRadar = new Chart(radar, {
      type: "radar",
      data: {
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December"
        ],
        datasets: [
          {
            label: "Current Year",
            backgroundColor: "rgba(76,132,255,0.2)",
            borderColor: "#4c84ff",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointBorderColor: "rgba(76,132,255,1)",
            pointBackgroundColor: "#ffffff",
            data: [25, 31, 43, 48, 21, 36, 23, 12, 33, 36, 28, 55]
          },
          {
            label: "Previous Year",
            backgroundColor: "rgba(41, 204, 151, 0.2)",
            borderColor: "#29cc97",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointBorderColor: "#29cc97",
            pointBackgroundColor: "#ffffff",
            data: [45, 77, 22, 12, 56, 43, 71, 23, 54, 19, 32, 55]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        title: {
          display: false,
          text: "Chart.js Radar Chart"
        },
        layout: {
          padding: {
            top: 10,
            bottom: 10,
            right: 10,
            left: 10
          }
        },
        scale: {
          ticks: {
            beginAtZero: true,
            fontColor: "#1b223c",
            fontSize: 12,
            stepSize: 10,
            max: 60
          }
        },
        tooltips: {
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 14,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2
        }
      }
    });
  }
  /*======== 14. CURRENT USER BAR CHART ========*/
  var cUser = document.getElementById("currentUser");
  if (cUser !== null) {
    var myUChart = new Chart(cUser, {
      type: "bar",
      data: {
        labels: [
          "1h",
          "10 m",
          "50 m",
          "30 m",
          "40 m",
          "20 m",
          "30 m",
          "25 m",
          "20 m",
          "5 m",
          "10 m"
        ],
        datasets: [
          {
            label: "signup",
            data: [15, 30, 27, 43, 39, 18, 42, 25, 13, 18, 59],
            // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
            backgroundColor: "#4c84ff"
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: false,
              },
              ticks: {
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: false, // hide main x-axis line
                beginAtZero: true,
                callback: function(tick, index, array) {
                  return index % 2 ? "" : tick;
                }
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: true,
                color: "#eee",
                zeroLineColor: "#eee"
              },
              ticks: {
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true,
                beginAtZero: true
              }
            }
          ]
        },

        tooltips: {
          mode: "index",
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 15,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          xPadding: 10,
          yPadding: 7,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 6,
          caretPadding: 5
        }
      }
    });
  }
  /*======== 15. ANALYTICS - USER ACQUISITION ========*/
  var acquisition = document.getElementById("acquisition");
  if (acquisition !== null) {
    var acqData = [
      {
        first: [100, 180, 44, 75, 150, 66, 70],
        second: [144, 44, 177, 76, 23, 189, 12],
        third: [44, 167, 102, 123, 183, 88, 134]
      },
      {
        first: [144, 44, 110, 5, 123, 89, 12],
        second: [22, 123, 45, 130, 112, 54, 181],
        third: [55, 44, 144, 75, 155, 166, 70]
      },
      {
        first: [134, 80, 123, 65, 171, 33, 22],
        second: [44, 144, 77, 76, 123, 89, 112],
        third: [156, 23, 165, 88, 112, 54, 181]
      }
    ];

    var configAcq = {
      // The type of chart we want to create
      type: "line",

      // The data for our dataset
      data: {
        labels: [
          "4 Jan",
          "5 Jan",
          "6 Jan",
          "7 Jan",
          "8 Jan",
          "9 Jan",
          "10 Jan"
        ],
        datasets: [
          {
            label: "Referral",
            backgroundColor: "rgb(76, 132, 255)",
            borderColor: "rgba(76, 132, 255,0)",
            data: acqData[0].first,
            lineTension: 0.3,
            pointBackgroundColor: "rgba(76, 132, 255,0)",
            pointHoverBackgroundColor: "rgba(76, 132, 255,1)",
            pointHoverRadius: 3,
            pointHitRadius: 30,
            pointBorderWidth: 2,
            pointStyle: "rectRounded"
          },
          {
            label: "Direct",
            backgroundColor: "rgb(254, 196, 0)",
            borderColor: "rgba(254, 196, 0,0)",
            data: acqData[0].second,
            lineTension: 0.3,
            pointBackgroundColor: "rgba(254, 196, 0,0)",
            pointHoverBackgroundColor: "rgba(254, 196, 0,1)",
            pointHoverRadius: 3,
            pointHitRadius: 30,
            pointBorderWidth: 2,
            pointStyle: "rectRounded"
          },
          {
            label: "Social",
            backgroundColor: "rgb(41, 204, 151)",
            borderColor: "rgba(41, 204, 151,0)",
            data: acqData[0].third,
            lineTension: 0.3,
            pointBackgroundColor: "rgba(41, 204, 151,0)",
            pointHoverBackgroundColor: "rgba(41, 204, 151,1)",
            pointHoverRadius: 3,
            pointHitRadius: 30,
            pointBorderWidth: 2,
            pointStyle: "rectRounded"
          }
        ]
      },

      // Configuration options go here
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                display: false
              }
            }
          ],
          yAxes: [
            {
              gridLines: {
                display: true,
                color: "#eee",
                zeroLineColor: "#eee"
              },
              ticks: {
                beginAtZero: true,
                stepSize: 50,
                max: 200
              }
            }
          ]
        },
        tooltips: {
          mode: "index",
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 15,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          xPadding: 20,
          yPadding: 10,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 10,
          caretPadding: 15
        }
      }
    };

    var ctx = document.getElementById("acquisition").getContext("2d");
    var lineAcq = new Chart(ctx, configAcq);
    document.getElementById("acqLegend").innerHTML = lineAcq.generateLegend();

    var items = document.querySelectorAll(
      "#user-acquisition .nav-tabs .nav-item"
    );
    items.forEach(function (item, index) {
      item.addEventListener("click", function() {
        configAcq.data.datasets[0].data = acqData[index].first;
        configAcq.data.datasets[1].data = acqData[index].second;
        configAcq.data.datasets[2].data = acqData[index].third;
        lineAcq.update();
      });
    });
  }

  /*======== 16. ANALYTICS - ACTIVITY CHART ========*/
  var activity = document.getElementById("activity");
  if (activity !== null) {
    var activityData = [
      {
        first: [0, 65, 52, 115, 98, 165, 125],
        second: [45, 38, 100, 87, 152, 187, 85]
      },
      {
        first: [0, 65, 77, 33, 49, 100, 100],
        second: [88, 33, 20, 44, 111, 140, 77]
      },
      {
        first: [0, 40, 77, 55, 33, 116, 50],
        second: [55, 32, 20, 55, 111, 134, 66]
      },
      {
        first: [0, 44, 22, 77, 33, 151, 99],
        second: [60, 32, 120, 55, 19, 134, 88]
      }
    ];

    var config = {
      // The type of chart we want to create
      type: "line",
      // The data for our dataset
      data: {
        labels: [
          "4 Jan",
          "5 Jan",
          "6 Jan",
          "7 Jan",
          "8 Jan",
          "9 Jan",
          "10 Jan"
        ],
        datasets: [
          {
            label: "Active",
            backgroundColor: "transparent",
            borderColor: "rgb(82, 136, 255)",
            data: activityData[0].first,
            lineTension: 0,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointHoverBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            pointHoverRadius: 7,
            pointHoverBorderWidth: 1
          },
          {
            label: "Inactive",
            backgroundColor: "transparent",
            borderColor: "rgb(255, 199, 15)",
            data: activityData[0].second,
            lineTension: 0,
            borderDash: [10, 5],
            borderWidth: 1,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointHoverBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            pointHoverRadius: 7,
            pointHoverBorderWidth: 1
          }
        ]
      },
      // Configuration options go here
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                display: false,
              },
              ticks: {
                fontColor: "#8a909d", // this here
              },
            }
          ],
          yAxes: [
            {
              gridLines: {
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true,
                color: "#eee",
                zeroLineColor: "#eee"
              },
              ticks: {
                // callback: function(tick, index, array) {
                //   return (index % 2) ? "" : tick;
                // }
                stepSize: 50,
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif"
              }
            }
          ]
        },
        tooltips: {
          mode: "index",
          intersect: false,
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 15,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          xPadding: 10,
          yPadding: 7,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 6,
          caretPadding: 5
        }
      }
    };

    var ctx = document.getElementById("activity").getContext("2d");
    var myLine = new Chart(ctx, config);

    var items = document.querySelectorAll("#user-activity .nav-tabs .nav-item");
    items.forEach(function(item, index){
      item.addEventListener("click", function() {
        config.data.datasets[0].data = activityData[index].first;
        config.data.datasets[1].data = activityData[index].second;
        myLine.update();
      });
    });
  }

  /*======== 17. HORIZONTAL BAR CHART1 ========*/
  var hbar1 = document.getElementById("hbar1");
  if (hbar1 !== null) {
    var hbChart1 = new Chart(hbar1, {
      type: "horizontalBar",
      data: {
        labels: ["India", "USA", "Turkey"],
        datasets: [
          {
            label: "signup",
            data: [18, 13, 9.5],
            backgroundColor: "#4c84ff"
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: true,
                color: "#eee",
                zeroLineColor: "#eee",
                tickMarkLength: 3
              },
              ticks: {
                display: true, // false will hide main x-axis line
                beginAtZero: true,
                fontFamily: "Roboto, sans-serif",
                fontColor: "#8a909d",
                callback: function(value) {
                  return value + " %";
                }
              }
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: true,
                beginAtZero: false,
                fontFamily: "Roboto, sans-serif",
                fontColor: "#8a909d",
                fontSize: 14
              },
              barPercentage: 1.6,
              categoryPercentage: 0.2
            }
          ]
        },
        tooltips: {
          mode: "index",
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 15,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          xPadding: 10,
          yPadding: 7,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 6,
          caretPadding: 5
        }
      }
    });
  }
  /*======== 18. HORIZONTAL BAR CHART2 ========*/
  var hbar2 = document.getElementById("hbar2");
  if (hbar2 !== null) {
    var hbChart2 = new Chart(hbar2, {
      type: "horizontalBar",
      data: {
        labels: ["Florida", "Poland", "UK"],
        datasets: [
          {
            label: "signup",
            data: [7.5, 4.6, 4],
            backgroundColor: "#4c84ff"
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                display: true,
                color: "#eee",
                zeroLineColor: "#eee",
                tickMarkLength: 3
              },
              ticks: {
                display: true, // false will hide main x-axis line
                beginAtZero: true,
                fontFamily: "Roboto, sans-serif",
                fontColor: "#8a909d",
                max: 20,
                callback: function(value) {
                  return value + "%";
                }
              }
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: false, // hide main y-axis line
                display: false
              },
              ticks: {
                display: true,
                beginAtZero: false,
                fontFamily: "Roboto, sans-serif",
                fontColor: "#8a909d",
                fontSize: 14
              },
              barPercentage: 1.6,
              categoryPercentage: 0.2
            }
          ]
        },
        tooltips: {
          mode: "index",
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 15,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          xPadding: 10,
          yPadding: 7,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 6,
          caretPadding: 5
        }
      }
    });
  }

  /*======== 19. DEVICE - DOUGHNUT CHART ========*/
  var deviceChart = document.getElementById("deviceChart");
  if (deviceChart !== null) {
    var mydeviceChart = new Chart(deviceChart, {
      type: "doughnut",
      data: {
        labels: ["Desktop", "Tablet", "Mobile"],
        datasets: [
          {
            label: ["Desktop", "Tablet", "Mobile"],
            data: [60000, 15000, 25000],
            backgroundColor: [
              "rgba(76, 132, 255, 1)",
              "rgba(76, 132, 255, 0.85)",
              "rgba(76, 132, 255, 0.70)",
            ],
            borderWidth: 1
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        cutoutPercentage: 75,
        tooltips: {
          callbacks: {
            title: function(tooltipItem, data) {
              return data["labels"][tooltipItem[0]["index"]];
            },
            label: function(tooltipItem, data) {
              return (
                data["datasets"][0]["data"][tooltipItem["index"]] + " Sessions"
              );
            }
          },

          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 15,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          xPadding: 10,
          yPadding: 7,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 6,
          caretPadding: 5
        }
      }
    });
  }
});
/*======== 20. BAR CHART ========*/
var barX = document.getElementById("barChart");
if (barX !== null) {
  var myChart = new Chart(barX, {
    type: "bar",
    data: {
      labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
      ],
      datasets: [
        {
          label: "signup",
          data: [5, 6, 4.5, 5.5, 3, 6, 4.5, 6, 8, 3, 5.5, 4],
          // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
          backgroundColor: "#4c84ff"
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              drawBorder: false,
              display: false
            },
            ticks: {
              display: false, // hide main x-axis line
              beginAtZero: true
            },
            barPercentage: 1.8,
            categoryPercentage: 0.2
          }
        ],
        yAxes: [
          {
            gridLines: {
              drawBorder: false, // hide main y-axis line
              display: false
            },
            ticks: {
              display: false,
              beginAtZero: true
            }
          }
        ]
      },
      tooltips: {
        titleFontColor: "#888",
        bodyFontColor: "#555",
        titleFontSize: 12,
        bodyFontSize: 15,
        backgroundColor: "rgba(256,256,256,0.95)",
        displayColors: false,
        borderColor: "rgba(220, 220, 220, 0.9)",
        borderWidth: 2
      }
    }
  });
}
/*======== 21. BAR CHART1 ========*/
var bar1 = document.getElementById("barChart1");
if (bar1 !== null) {
  var myChart = new Chart(bar1, {
    type: "bar",
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
      datasets: [
        {
          label: "signup",
          data: [5, 7.5, 5.5, 6.5, 4, 9],
          // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
          backgroundColor: "#4c84ff"
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              drawBorder: false,
              display: false
            },
            ticks: {
              display: false, // hide main x-axis line
              beginAtZero: true
            },
            barPercentage: 1.8,
            categoryPercentage: 0.2
          }
        ],
        yAxes: [
          {
            gridLines: {
              drawBorder: false, // hide main y-axis line
              display: false
            },
            ticks: {
              display: false,
              beginAtZero: true
            }
          }
        ]
      },
      tooltips: {
        enabled: false
      }
    }
  });
}
/*======== 22. BAR CHART2 ========*/
var bar2 = document.getElementById("barChart2");
if (bar2 !== null) {
  var myChart2 = new Chart(bar2, {
    type: "bar",
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
      datasets: [
        {
          label: "signup",
          data: [5, 7.5, 5.5, 6.5, 4, 9],
          // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
          backgroundColor: "#ffffff"
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              drawBorder: false,
              display: false
            },
            ticks: {
              display: false, // hide main x-axis line
              beginAtZero: true
            },
            barPercentage: 1.8,
            categoryPercentage: 0.2
          }
        ],
        yAxes: [
          {
            gridLines: {
              drawBorder: false, // hide main y-axis line
              display: false
            },
            ticks: {
              display: false,
              beginAtZero: true
            }
          }
        ]
      },
      tooltips: {
        enabled: false
      }
    }
  });
}
/*======== 23. BAR CHART3 ========*/
var bar3 = document.getElementById("barChart3");
if (bar3 !== null) {
  var bar_Chart = new Chart(bar3, {
    type: "bar",
    data: {
      labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
      ],
      datasets: [
        {
          label: "signup",
          data: [5, 6, 4.5, 5.5, 3, 6, 4.5, 6, 8, 3, 5.5, 4],
          // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
          backgroundColor: "#ffffff"
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              drawBorder: false,
              display: false
            },
            ticks: {
              display: false, // hide main x-axis line
              beginAtZero: true
            },
            barPercentage: 1.8,
            categoryPercentage: 0.2
          }
        ],
        yAxes: [
          {
            gridLines: {
              drawBorder: false, // hide main y-axis line
              display: false
            },
            ticks: {
              display: false,
              beginAtZero: true
            }
          }
        ]
      },
      tooltips: {
        enabled: true
      }
    }
  });
}

/*======== 24. GRADIENT LINE CHART1 ========*/
var gline1 = document.getElementById("gline1");
if (gline1 !== null) {
  gline1 = gline1.getContext("2d");
  var gradientFill = gline1.createLinearGradient(0, 120, 0, 0);
  gradientFill.addColorStop(0, "rgba(41,204,151,0.10196)");
  gradientFill.addColorStop(1, "rgba(41,204,151,0.30196)");

  var lChart = new Chart(gline1, {
    type: "line",
    data: {
      labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
      datasets: [
        {
          label: "Rev",
          lineTension: 0,
          pointRadius: 0.1,
          pointBackgroundColor: "rgba(255,255,255,1)",
          pointBorderWidth: 2,
          fill: true,
          backgroundColor: gradientFill,
          borderColor: "#29cc97",
          borderWidth: 2,
          data: [0, 5.5, 4, 9, 4, 7, 4.7]
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              drawBorder: false,
              display: false
            },
            ticks: {
              display: false, // hide main x-axis line
              beginAtZero: true
            },
            barPercentage: 1.8,
            categoryPercentage: 0.2
          }
        ],
        yAxes: [
          {
            gridLines: {
              drawBorder: false, // hide main y-axis line
              display: false
            },
            ticks: {
              display: false,
              beginAtZero: true
            }
          }
        ]
      },
      tooltips: {
        enabled: false
      }
    }
  });
}
/*======== 25. GRADIENT LINE CHART2 ========*/
var gline2 = document.getElementById("gline2");
if (gline2 !== null) {
  gline2 = gline2.getContext("2d");
  var gradientFill = gline2.createLinearGradient(0, 90, 0, 0);
  gradientFill.addColorStop(0, "rgba(255,255,255,0.10196)");
  gradientFill.addColorStop(1, "rgba(255,255,255,0.30196)");

  var lChart2 = new Chart(gline2, {
    type: "line",
    data: {
      labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
      datasets: [
        {
          label: "Rev",
          lineTension: 0,
          pointRadius: 0.1,
          pointBackgroundColor: "rgba(255,255,255,1)",
          pointBorderWidth: 2,
          fill: true,
          backgroundColor: gradientFill,
          borderColor: "#ffffff",
          borderWidth: 2,
          data: [0, 5.5, 4, 9, 4, 7, 4.7]
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              drawBorder: false,
              display: false
            },
            ticks: {
              display: false, // hide main x-axis line
              beginAtZero: true
            },
            barPercentage: 1.8,
            categoryPercentage: 0.2
          }
        ],
        yAxes: [
          {
            gridLines: {
              drawBorder: false, // hide main y-axis line
              display: false
            },
            ticks: {
              display: false,
              beginAtZero: true
            }
          }
        ]
      },
      tooltips: {
        enabled: false
      }
    }
  });
}
/*======== 26. GRADIENT LINE CHART3 ========*/
var gline3 = document.getElementById("line3");
if (gline3 !== null) {
  gline3 = gline3.getContext("2d");
  var gradientFill = gline3.createLinearGradient(0, 90, 0, 0);
  gradientFill.addColorStop(0, "rgba(255,255,255,0.10196)");
  gradientFill.addColorStop(1, "rgba(255,255,255,0.30196)");

  var lChart3 = new Chart(gline3, {
    type: "line",
    data: {
      labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
      datasets: [
        {
          label: "Rev",
          lineTension: 0,
          pointRadius: 4,
          pointBackgroundColor: "#29cc97",
          pointBorderWidth: 2,
          fill: true,
          backgroundColor: gradientFill,
          borderColor: "#ffffff",
          borderWidth: 2,
          data: [0, 4, 3, 5.5, 3, 4.7, 1]
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: {
          right: 10
        }
      },
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              drawBorder: false,
              display: false
            },
            ticks: {
              display: false, // hide main x-axis line
              beginAtZero: true
            },
            barPercentage: 1.8,
            categoryPercentage: 0.2
          }
        ],
        yAxes: [
          {
            gridLines: {
              drawBorder: false, // hide main y-axis line
              display: false
            },
            ticks: {
              display: false,
              beginAtZero: true
            }
          }
        ]
      },
      tooltips: {
        enabled: true
      }
    }
  });
}
/*======== 27. ACQUISITION3 ========*/
var acquisition3 = document.getElementById("bar3");
if (acquisition3 !== null) {
  var acChart3 = new Chart(acquisition3, {
    // The type of chart we want to create
    type: "bar",

    // The data for our dataset
    data: {
      labels: ["4 Jan", "5 Jan", "6 Jan", "7 Jan", "8 Jan", "9 Jan", "10 Jan"],
      datasets: [
        {
          label: "Referral",
          backgroundColor: "rgb(76, 132, 255)",
          borderColor: "rgba(76, 132, 255,0)",
          data: [78, 90, 70, 75, 45, 52, 22],
          pointBackgroundColor: "rgba(76, 132, 255,0)",
          pointHoverBackgroundColor: "rgba(76, 132, 255,1)",
          pointHoverRadius: 3,
          pointHitRadius: 30
        },
        {
          label: "Direct",
          backgroundColor: "rgb(254, 196, 0)",
          borderColor: "rgba(254, 196, 0,0)",
          data: [88, 115, 80, 96, 65, 77, 38],
          pointBackgroundColor: "rgba(254, 196, 0,0)",
          pointHoverBackgroundColor: "rgba(254, 196, 0,1)",
          pointHoverRadius: 3,
          pointHitRadius: 30
        },
        {
          label: "Social",
          backgroundColor: "rgb(41, 204, 151)",
          borderColor: "rgba(41, 204, 151,0)",
          data: [103, 135, 102, 116, 83, 97, 55],
          pointBackgroundColor: "rgba(41, 204, 151,0)",
          pointHoverBackgroundColor: "rgba(41, 204, 151,1)",
          pointHoverRadius: 3,
          pointHitRadius: 30
        }
      ]
    },

    // Configuration options go here
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              display: false
            }
          }
        ],
        yAxes: [
          {
            gridLines: {
              display: true
            },
            ticks: {
              beginAtZero: true,
              stepSize: 50,
              fontColor: "#8a909d",
              fontFamily: "Roboto, sans-serif",
              max: 200
            }
          }
        ]
      },
      tooltips: {}
    }
  });
  document.getElementById("customLegend").innerHTML = acChart3.generateLegend();
}
/*======== 28. STATISTICS ========*/
var mstat = document.getElementById("mstat");
if (mstat !== null) {
  var msdChart = new Chart(mstat, {
    type: "line",
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
      datasets: [
        {
          label: "Old",
          pointRadius: 4,
          pointBackgroundColor: "rgba(255,255,255,1)",
          pointBorderWidth: 2,
          fill: true,
          lineTension: 0,
          backgroundColor: "rgba(66,208,163,0.2)",
          borderWidth: 2.5,
          borderColor: "#42d0a3",
          data: [10000, 17500, 2000, 11000, 19000, 10500, 18000]
        },
        {
          label: "New",
          pointRadius: 4,
          pointBackgroundColor: "rgba(255,255,255,1)",
          pointBorderWidth: 2,
          fill: true,
          lineTension: 0,
          backgroundColor: "rgba(76,132,255,0.2)",
          borderWidth: 2.5,
          borderColor: "#4c84ff",
          data: [2000, 11500, 10000, 14000, 11000, 16800, 14500]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              drawBorder: true,
              display: false
            },
            ticks: {
              display: true, // hide main x-axis line
              beginAtZero: true,
              fontFamily: "Roboto, sans-serif",
              fontColor: "#8a909d"
            }
          }
        ],
        yAxes: [
          {
            gridLines: {
              drawBorder: true, // hide main y-axis line
              display: true
            },
            ticks: {
              callback: function(value) {
                var ranges = [
                  { divider: 1e6, suffix: "M" },
                  { divider: 1e3, suffix: "k" }
                ];
                function formatNumber(n) {
                  for (var i = 0; i < ranges.length; i++) {
                    if (n >= ranges[i].divider) {
                      return (
                        (n / ranges[i].divider).toString() + ranges[i].suffix
                      );
                    }
                  }
                  return n;
                }
                return formatNumber(value);
              },
              stepSize: 5000,
              fontColor: "#8a909d",
              fontFamily: "Roboto, sans-serif",
              beginAtZero: true
            }
          }
        ]
      },
      tooltips: {
        enabled: true
      }
    }
  });
}
