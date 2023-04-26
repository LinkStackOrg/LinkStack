(function (jQuery) {
  "use strict";

//chart-1
if(document.querySelectorAll('#chart-1').length){
  const options = {
    chart: {
        height: 80,
        type: 'area',
        sparkline: {
            enabled: true
        },
        group: 'sparklines',
  
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        width: 3,
        curve: 'smooth'
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.5,
            opacityTo: 0,
        }
    },
  
    series: [{
        name: 'series1',
        data: [60, 15, 50, 30, 70]
    }, ],
    colors: ['#344ed1'],
  
    xaxis: {
        type: 'datetime',
        categories: ["2018-08-19T00:00:00", "2018-09-19T01:30:00", "2018-10-19T02:30:00", "2018-11-19T01:30:00", "2018-12-19T01:30:00"],
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
  };
  const chart = new ApexCharts(
      document.querySelector("#chart-1"),
      options
  );
  chart.render();
  document.addEventListener('ColorChange', (e) => {
    const newOpt = {
      colors: [e.detail.detail1],
      fill: {
        type: 'gradient',
        gradient: {
            type: "vertical",
            inverseColors: true,
            gradientToColors: [e.detail.detail1],
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [0, 50, 60],
            colors: [e.detail.detail1],
        }
    },}
    chart.updateOptions(newOpt)
    })
}

//chart-2
if(document.querySelectorAll('#chart-2').length){
  const options = {
    chart: {
        height: 80,
        type: 'area',
        sparkline: {
            enabled: true
        },
        group: 'sparklines',
  
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        width: 3,
        curve: 'smooth'
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.5,
            opacityTo: 0,
        }
    },
    series: [{
        name: 'series1',
        data: [70, 40, 60, 30, 60]
    }, ],
    colors: ['#d48918'],
  
    xaxis: {
        type: 'datetime',
        categories: ["2018-08-19T00:00:00", "2018-09-19T01:30:00", "2018-10-19T02:30:00", "2018-11-19T01:30:00", "2018-12-19T01:30:00"],
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
  };
  const chart = new ApexCharts(
      document.querySelector("#chart-2"),
      options
  );

  chart.render();
}

/*--------------Widget Chart 3----------------*/
if(document.querySelectorAll('#chart-3').length){
  const options = {
    chart: {
        height: 80,
        type: 'area',
        sparkline: {
            enabled: true
        },
        group: 'sparklines',
  
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        width: 3,
        curve: 'smooth'
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.5,
            opacityTo: 0,
        }
    },
    series: [{
        name: 'series1',
        data: [60, 40, 60, 40, 70]
    }, ],
    colors: ['#07750b'],
  
    xaxis: {
        type: 'datetime',
        categories: ["2018-08-19T00:00:00", "2018-09-19T01:30:00", "2018-10-19T02:30:00", "2018-11-19T01:30:00", "2018-12-19T01:30:00"],
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
  };
  const chart = new ApexCharts(
      document.querySelector("#chart-3"),
      options
  );
  chart.render();
}

/*--------------Widget Chart 4----------------*/
if(document.querySelectorAll('#chart-4').length){
  const options = {
    chart: {
        height: 80,
        type: 'area',
        sparkline: {
            enabled: true
        },
        group: 'sparklines',
  
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        width: 3,
        curve: 'smooth'
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.5,
            opacityTo: 0,
        }
    },
    series: [{
        name: 'series1',
        data: [75, 30, 60, 35, 60]
    }, ],
    colors: ['#b91d12'],
  
    xaxis: {
        type: 'datetime',
        categories: ["2018-08-19T00:00:00", "2018-09-19T01:30:00", "2018-10-19T02:30:00", "2018-11-19T01:30:00", "2018-12-19T01:30:00"],
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
  };
  const chart = new ApexCharts(
      document.querySelector("#chart-4"),
      options
  );
  chart.render();
}

/*--------------Widget Box----------------*/

if(document.querySelectorAll('#iq-chart-box1').length){
  var options = {
    series: [{
      name: "Desktops",
      data: [10, 10, 35, 10]
  }],
    chart: {
      height: 60,
      width: 100,
      type: 'line',
    zoom: {
      enabled: false
    },
    sparkline: {
      enabled: true,
  }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr'],
  }
  };
  const chart = new ApexCharts(document.querySelector("#iq-chart-box1"), options);
  chart.render();
}
//box-chart-2
if(jQuery('#iq-chart-box2').length){
  var options = {
    series: [{
      name: "Desktops",
      data: [10, 10, 35, 10]
  }],
    chart: {
      height: 60,
      width: 100,
      type: 'line',
    zoom: {
      enabled: false
    },
    sparkline: {
      enabled: true,
  }
  },
  colors:['#ad2d1e'],
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr'],
  }
  };

  var chart = new ApexCharts(document.querySelector("#iq-chart-box2"), options);
  chart.render();
const body = document.querySelector('body')
if (body.classList.contains('dark')) {
  apexChartUpdate(chart, {
    dark: true
  })
}

document.addEventListener('ChangeColorMode', function (e) {
  apexChartUpdate(chart, e.detail)
})
}
//box-chart-3
if(document.querySelectorAll('#iq-chart-box3').length){
  var options = {
    series: [{
      name: "Desktops",
      data: [10, 10, 35, 10]
  }],
    chart: {
      height: 60,
      width: 100,
      type: 'line',
    zoom: {
      enabled: false
    },
    sparkline: {
      enabled: true,
  }
  },
  colors:['#17904b'],
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr'],
  }
  };

  const chart = new ApexCharts(document.querySelector("#iq-chart-box3"), options);
  chart.render();
}
//box-chart-4
if(document.querySelectorAll('#iq-chart-box4').length){
  var options = {
    series: [{
      name: "Desktops",
      data: [10, 10, 35, 10]
  }],
    chart: {
      height: 60,
      width: 100,
      type: 'line',
    zoom: {
      enabled: false
    },
    sparkline: {
      enabled: true,
  }
  },
  colors:['#d95f18'],
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr'],
  }
  };

  const chart = new ApexCharts(document.querySelector("#iq-chart-box4"), options);
  chart.render();
 
}


//extra-widget

if($('#chart').length) {
  const options = {
    series: [{
    name: 'Net Profit',
    data: [44, 55, 57, 56, 61, 58,35,50,56]
  }, {
    name: 'Revenue',
    data: [76, 85, 101, 98, 87, 105,98,100,90]
  }, ],
    chart: {
    type: 'bar',
    height: 270,
    width:700,
    sparkline:{
      enabled:true
    }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      endingShape: 'rounded',
      borderRadius: 10,
      
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    curve: 'smooth',
    width: 2,
    colors: ['transparent']
    
  },
  xaxis: {
    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
  },
  yaxis: {
    title: {
      text: '$ (thousands)'
    }
  },
  fill: {
    opacity: 1,
    colors: ['#fce3d2', '#d48918',]
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands"
      }
    }
  },
  responsive: [
    {
      breakpoint: 1000,
      options: {
        chart: {
          width:250,
        },
      }
    }
  ]
  };
  const chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
}
//chart 2
if($('#extrachart').length) {
  const options = {
    series: [{
    name: 'Net Profit',
    data: [44, 55, 57, 56, 61, 58]
  }, {
    name: 'Revenue',
    data: [76, 85, 101, 98, 87, 105]
  }, {
    name: 'Free Cash Flow',
    data: [35, 41, 36, 26, 45, 48]
  }],
    chart: {
    type: 'bar',
    height: 250,
    sparkline:{
      enabled:true
    }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      borderRadius: 5,
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    curve: 'smooth',
    colors: ['transparent']
  },
  xaxis: {
    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
  },
  yaxis: {
    title: {
      text: '$ (thousands)'
    }
  },
  fill: {
    opacity: 1,
    colors:['#344ed1', '#b91d12', '#d48918']
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands"
      }
    }
  }
  };  
  const chart = new ApexCharts(document.querySelector("#extrachart"), options);
  chart.render();
}
/*-------------- Service Chart ----------------*/
if (document.querySelectorAll("#service-chart-01").length) {
  const options = {
    series: [{
    name: 'series1',
    data: [25, 30, 22, 29]
  }],
  colors: ["#344ed1"],
    chart: {
    height: 65,
    width: 140,
    type: 'area',
    sparkline: {
          enabled: true,
      }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    type: 'datetime',
    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z"]
  },
  tooltip: {
    enabled: false,
  },
  };

  const chart = new ApexCharts(document.querySelector("#service-chart-01"), options);
  chart.render();
  document.addEventListener('ColorChange', (e) => {
  const newOpt = {
    colors: [e.detail.detail1],
    fill: {
      type: 'gradient',
      gradient: {
          type: "vertical",
          inverseColors: true,
          colors: [e.detail.detail1],
      }
  },}
  chart.updateOptions(newOpt)
  });
const body = document.querySelector('body')
if (body.classList.contains('dark')) {
  apexChartUpdate(chart, {
    dark: true
  })
}

document.addEventListener('ChangeColorMode', function (e) {
  apexChartUpdate(chart, e.detail)
})
}
if (document.querySelectorAll("#service-chart-02").length) {
  const options = {
    series: [{
    name: 'series1',
    data: [25, 23, 28, 26]
  }],
  colors: ["#b91d12"],
    chart: {
    height: 65,
    width: 140,
    type: 'area',
    sparkline: {
          enabled: true,
      }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    type: 'datetime',
    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z"]
  },
  tooltip: {
    enabled: false,
  },
  };

  const chart = new ApexCharts(document.querySelector("#service-chart-02"), options);
  chart.render();
const body = document.querySelector('body')
if (body.classList.contains('dark')) {
  apexChartUpdate(chart, {
    dark: true
  })
}

document.addEventListener('ChangeColorMode', function (e) {
  apexChartUpdate(chart, e.detail)
})
}
if (document.querySelectorAll("#service-chart-03").length) {
  const options = {
    series: [{
    name: 'series1',
    data: [25, 23, 28, 23]
  }],
  colors: ["#d48918"],
    chart: {
    height: 65,
    width: 140,
    type: 'area',
    sparkline: {
          enabled: true,
      }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    type: 'datetime',
    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z"]
  },
  tooltip: {
    enabled: false,
  },
  };

  const chart = new ApexCharts(document.querySelector("#service-chart-03"), options);
  chart.render();
const body = document.querySelector('body')
if (body.classList.contains('dark')) {
  apexChartUpdate(chart, {
    dark: true
  })
}

document.addEventListener('ChangeColorMode', function (e) {
  apexChartUpdate(chart, e.detail)
})
}
if (document.querySelectorAll("#service-chart-04").length) {
  const options = {
    series: [{
    name: 'series1',
    data: [25, 27, 24, 26]
  }],
  colors: ["#07750b"],
    chart: {
    height: 65,
    width: 140,
    type: 'area',
    sparkline: {
          enabled: true,
      }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    type: 'datetime',
    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z"]
  },
  tooltip: {
    enabled: false,
  },
  };

  const chart = new ApexCharts(document.querySelector("#service-chart-04"), options);
  chart.render();
const body = document.querySelector('body')
if (body.classList.contains('dark')) {
  apexChartUpdate(chart, {
    dark: true
  })
}

document.addEventListener('ChangeColorMode', function (e) {
  apexChartUpdate(chart, e.detail)
})
}

/*-------------- Ethernet Chart ----------------*/
if (document.querySelectorAll("#ethernet-chart-01").length) { 
  const options = {
    series: [{
      name: "Desktops",
       data: [5, 30, 6, 20, 5, 18, 10]
  }],
  colors: ["#3a57e8"],
    chart: {
    height: 60,
    sparkline: {
      enabled: true
    },
    type: 'line',
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false
  },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: 3
  },
  legend: {
    show: false
  },
  grid: {
    show:false,
  },
  xaxis: {
    labels: {
      show: false,
    },

  },
  yaxis: {
    labels: {
      show: false,
    },
  }
  };
  var chart = new ApexCharts(document.querySelector("#ethernet-chart-01"), options);
  chart.render();
  document.addEventListener('ColorChange', (e) => {
    const newOpt = {
      colors: [e.detail.detail1],
    }
    chart.updateOptions(newOpt)
    })
}
if (document.querySelectorAll("#ethernet-chart-02").length) { 
  const options = {
    series: [{
      name: "Desktops",
       data: [5, 30, 6, 20, 5, 18, 10]
  }],
  colors: ["#17904b"],
    chart: {
    height: 60,
    sparkline: {
      enabled: true
    },
    type: 'line',
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false
  },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: 3
  },
  legend: {
    show: false
  },
  grid: {
    show:false,
  },
  xaxis: {
    labels: {
      show: false,
    },

  },
  yaxis: {
    labels: {
      show: false,
    },
  }
  };
  var chart = new ApexCharts(document.querySelector("#ethernet-chart-02"), options);
  chart.render();
  document.addEventListener('ColorChange', (e) => {
    const newOpt = {
      colors: [e.detail.detail2],
    }
    chart.updateOptions(newOpt)
    })
}
if (document.querySelectorAll("#ethernet-chart-03").length) { 
  const options = {
    series: [{
      name: "Desktops",
       data: [5, 30, 6, 20, 5, 18, 10]
  }],
  colors: ["#ad2d1e"],
    chart: {
    height: 60,
    sparkline: {
      enabled: true
    },
    type: 'line',
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false
  },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: 3
  },
  legend: {
    show: false
  },
  grid: {
    show:false,
  },
  xaxis: {
    labels: {
      show: false,
    },

  },
  yaxis: {
    labels: {
      show: false,
    },
  }
  };
  var chart = new ApexCharts(document.querySelector("#ethernet-chart-03"), options);
  chart.render();
  document.addEventListener('ColorChange', (e) => {
    const newOpt = {
      colors: [e.detail.detail1],
    }
    chart.updateOptions(newOpt)
    })
}
if (document.querySelectorAll("#ethernet-chart-04").length) { 
  const options = {
    series: [{
      name: "Desktops",
       data: [5, 30, 6, 20, 5, 18, 10]
  }],
  colors: ["#d95f18"],
    chart: {
    height: 60,
    sparkline: {
      enabled: true
    },
    type: 'line',
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false
  },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: 3
  },
  legend: {
    show: false
  },
  grid: {
    show:false,
  },
  xaxis: {
    labels: {
      show: false,
    },

  },
  yaxis: {
    labels: {
      show: false,
    },
  }
  };
  var chart = new ApexCharts(document.querySelector("#ethernet-chart-04"), options);
  chart.render();
  document.addEventListener('ColorChange', (e) => {
    const newOpt = {
      colors: [e.detail.detail1],
    }
    chart.updateOptions(newOpt)
    })
}
/*-------------- Ethernet Chart End ----------------*/
if (document.querySelectorAll("#chart-9").length) {
  const options = {
    series: [{
    name: 'series1',
    data: [25, 27, 24, 26]
  }],
  colors: ["#07750b"],
    chart: {
    height: 65,
    width: 140,
    type: 'area',
    sparkline: {
          enabled: true,
      }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    type: 'datetime',
    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z"]
  },
  tooltip: {
    enabled: false,
  },
  };

  const chart = new ApexCharts(document.querySelector("#chart-9"), options);
  chart.render();
const body = document.querySelector('body')
if (body.classList.contains('dark')) {
  apexChartUpdate(chart, {
    dark: true
  })
}

document.addEventListener('ChangeColorMode', function (e) {
  apexChartUpdate(chart, e.detail)
})
}

})(jQuery)