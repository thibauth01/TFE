function getStats(file) {
    var toReturn;
    $.ajax({
        url: 'php/' + file,
        method: 'post',
        success: function(data) {
            toReturn = JSON.parse(data);
        },
        async: false

    });
    return toReturn;
}






$(document).ready(function() {

    var dataType = getStats('getTotalTypeWorker.php');
    new Chart(document.getElementById("typeTravauxWorker"), {
        type: 'doughnut',
        data: {
            labels: dataType.labels,
            datasets: [{
                label: "",
                backgroundColor: ["#E08DAC", "#6A7FDB", "#61B1E0", "#57E2E5", "#4ED7B5", "#45CB85", "#2D7E5B", "#153131", "#2A4444"],
                data: dataType.data
            }]
        },
        options: {
            legend: {
                display: false
            }
        }
    });


    var dataPlaces = getStats('getPlacesWorker.php');
    new Chart(document.getElementById("placesTravauxWorker"), {
        type: 'horizontalBar',
        data: {
            labels: dataPlaces.labels,
            datasets: [{
                label: "",
                backgroundColor: ["#28536B", "#75747B", "#9C8483", "#C2948A", "#A09EA4", "#7EA8BE", "#BACCD6", "#F6F0ED", "#D9D1C0", "#BBB193"],
                data: dataPlaces.data
            }]
        },
        options: {
            legend: { display: false },
            scales: {
                xAxes: [{
                    display: 0,
                    gridLines: 0,
                    ticks: {
                        min: 0,
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }]
            }

        }
    });

    chartColor = "#FFFFFF";

    // General configuration for the charts with Line gradientStroke
    gradientChartOptionsConfiguration = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
        },
        responsive: 1,
        scales: {
            yAxes: [{
                display: 0,
                gridLines: 0,
                ticks: {
                    display: false
                },
                gridLines: {
                    zeroLineColor: "transparent",
                    drawTicks: false,
                    display: false,
                    drawBorder: false
                }
            }],
            xAxes: [{
                display: 0,
                gridLines: 0,
                ticks: {
                    display: false
                },
                gridLines: {
                    zeroLineColor: "transparent",
                    drawTicks: false,
                    display: false,
                    drawBorder: false
                }
            }]
        },
        layout: {
            padding: { left: 0, right: 0, top: 15, bottom: 15 }
        }
    };

    gradientChartOptionsConfigurationWithNumbersAndGrid = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
        },
        responsive: true,
        scales: {
            yAxes: [{
                gridLines: 0,
                gridLines: {
                    zeroLineColor: "transparent",
                    drawBorder: false
                }
            }],
            xAxes: [{
                display: 0,
                gridLines: 0,
                ticks: {
                    display: false
                },
                gridLines: {
                    zeroLineColor: "transparent",
                    drawTicks: false,
                    display: false,
                    drawBorder: false
                }
            }]
        },
        layout: {
            padding: { left: 0, right: 0, top: 15, bottom: 15 }
        }
    };

    var ctx = document.getElementById('salary').getContext("2d");

    var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "€",
                borderColor: chartColor,
                pointBorderColor: chartColor,
                pointBackgroundColor: "#1e3d60",
                pointHoverBackgroundColor: "#1e3d60",
                pointHoverBorderColor: chartColor,
                pointBorderWidth: 1,
                pointHoverRadius: 7,
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                fill: true,
                backgroundColor: gradientFill,
                borderWidth: 2,
                data: getStats('getSalaryWorker.php')
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 0,
                    bottom: 0
                }
            },
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            legend: {
                position: "bottom",
                fillStyle: "#FFF",
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: "rgba(255,255,255,0.4)",
                        fontStyle: "bold",
                        beginAtZero: true,
                        maxTicksLimit: 5,
                        padding: 10
                    },
                    gridLines: {
                        drawTicks: true,
                        drawBorder: false,
                        display: true,
                        color: "rgba(255,255,255,0.1)",
                        zeroLineColor: "transparent"
                    }

                }],
                xAxes: [{
                    gridLines: {
                        zeroLineColor: "transparent",
                        display: false,

                    },
                    ticks: {
                        padding: 10,
                        fontColor: "rgba(255,255,255,0.4)",
                        fontStyle: "bold"
                    }
                }]
            }
        }
    });

    var cardStatsMiniLineColor = "#fff",
        cardStatsMiniDotColor = "#fff";

    ctx = document.getElementById('totalTravauxWorker').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

    myChart = new Chart(ctx, {
        type: 'line',
        responsive: true,
        data: {
            labels: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Travaux",
                borderColor: "#f96332",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#f96332",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                fill: true,
                backgroundColor: gradientFill,
                borderWidth: 2,
                data: getStats('getTotalWorksWorker.php')
            }]
        },
        options: gradientChartOptionsConfiguration
    });



    ctx = document.getElementById('totalTravauxRequester').getContext("2d");
    console.log(getStats('getTotalWorksRequester.php'));
    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

    myChart = new Chart(ctx, {
        type: 'line',
        responsive: true,
        data: {
            labels: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Travaux",
                borderColor: "#f96332",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#f96332",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                fill: true,
                backgroundColor: gradientFill,
                borderWidth: 2,
                data: getStats('getTotalWorksRequester.php')
            }]
        },
        options: gradientChartOptionsConfiguration
    });



});