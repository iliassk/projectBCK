window.onload = init;

function init() {

    var nbEntries = parseInt(document.getElementById("nbEntries").value);

     dates = [];
    estimCost = [];
    realCost = [];


    for ( i=0; i<nbEntries; i++){

        dates[i] = String(document.getElementById("entry" + String(i)).value);

        estimCost[i] = Math.round(parseFloat(document.getElementById("estim" + String(i)).value) * 100) /100;
        realCost[i] = Math.round(parseFloat(document.getElementById("real" + String(i)).value) * 100) / 100;

    }

    var bdc = createChart();
    document.getElementById("bdcLegend").innerHTML = bdc.generateLegend();

}

function createChart(){

    var totalCost = Math.round(parseFloat(document.getElementById("totalCost").value) * 100) /100;
    var ctx = document.getElementById("myChart").getContext("2d");
    var data = {
        labels: dates,
        datasets: [
            {
                label: "Estimated curve",
                fillColor: "rgba(0, 75, 178, 0.9)",
                strokeColor: "rgba(0, 75, 178, 0.9)",
                pointColor: "rgba(0, 75, 178, 0.9)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(0, 75, 178, 0.9)",
                data: estimCost
            },
            {
                label: "Actual curve",
                fillColor: "rgba(0, 113, 38, 0.9)",
                strokeColor: "rgba(0, 113, 38, 0.9)",
                pointColor: "rgba(0, 113, 38, 0.9)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(0, 113, 38, 0.9)",
                data: realCost
            }
        ]
    };

    var options = {
        bezierCurve : false,
        pointDot : true,
        animation : false,
        datasetFill : false,
       legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"color:<%=datasets[i].fillColor%>\"><%if(datasets[i].label){%><%=datasets[i].label%><%}%></span></li><%}%></ul>"

    }

    var myNewChart = new Chart(ctx).Line(data,options);
    return myNewChart;

}
