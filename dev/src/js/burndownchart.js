window.onload = init;

function init() {

    var chart = createChart();

    var nbEntries = parseInt(document.getElementById("nbEntries").value);

    for ( i=0; i<nbEntries; i++){

        var date = String(document.getElementById("entry" + String(i)).value);

        var estimCost = Math.round(parseFloat(document.getElementById("estim" + String(i)).value) * 100) /100;
        var realCost = Math.round(parseFloat(document.getElementById("real" + String(i)).value) * 100) / 100;


        chart.addData([estimCost, realCost], date);

    }

    /*
    chart.addData([40,60], "j6");
    chart.addData([40,60], "j7");
    chart.addData([20,2], "j8");
    */

}

function createChart(){
    var ctx = document.getElementById("myChart").getContext("2d");
    var data = {
        labels: [],
        datasets: [
            {
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                data: []
            },
            {
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                data: []
            }
        ]
    }

    var options = {
        bezierCurve : false,
        pointDot : true,
        datasetFill : false
    }


    var myNewChart = new Chart(ctx).Line(data,options);
    return myNewChart;
}
