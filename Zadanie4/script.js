function makeGraph(xData,yData,divId,title){


    var layout = {
        automargin:true,
        title: title
    };
    var data = [
        {
            x: xData,
            y: yData,
            height:"5vw",
            type: 'bar',
            orientation:'h'
        }
    ];
    var config = {responsive: true};
    Plotly.newPlot(divId, data,layout,config);

}

function makeGraph4(xData,yData1,yData2,yData3,divId,title){


    var trace1 = {
        x: xData,
        y: yData1,
        type: 'scatter',
        name: 'Nakazení'
    };

    var trace2 = {
        x: xData,
        y: yData2,
        type: 'scatter',
        name: 'Vyliečení'
    };
    var trace3 = {
        x: xData,
        y: yData3,
        type: 'scatter',
        name: 'Úmrtia'
    };

    var layout = {
        automargin:true,
        title: title
    };

    var config = {responsive: true};
    var data = [trace1,trace2,trace3];

    Plotly.newPlot(divId, data,layout,config);

}
