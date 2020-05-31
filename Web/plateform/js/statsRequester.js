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

    var dataType = getStats('getTotalTypeRequester.php');
    new Chart(document.getElementById("typeTravauxRequester"), {
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







    //OTHER

    ctx = document.getElementById('lineChartExampleWithNumbersAndGrid').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#18ce0f');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, hexToRGB('#18ce0f', 0.4));

    myChart = new Chart(ctx, {
        type: 'line',
        responsive: true,
        data: {
            labels: ["12pm,", "3pm", "6pm", "9pm", "12am", "3am", "6am", "9am"],
            datasets: [{
                label: "Email Stats",
                borderColor: "#18ce0f",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#18ce0f",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                fill: true,
                backgroundColor: gradientFill,
                borderWidth: 2,
                data: [40, 500, 650, 700, 1200, 1250, 1300, 1900]
            }]
        },
        options: gradientChartOptionsConfigurationWithNumbersAndGrid
    });

    var e = document.getElementById("typeWorks").getContext("2d");

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

    var a = {
        type: "pie",
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "Active Countries",
                backgroundColor: gradientFill,
                borderColor: "#2CA8FF",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#2CA8FF",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                fill: true,
                borderWidth: 1,
                data: [80, 99, 86, 96, 123, 85, 100, 75, 88, 90, 123, 155]
            }]
        },
        options: gradientChartOptionsConfiguration
    };




    var viewsChart = new Chart(e, a);

});