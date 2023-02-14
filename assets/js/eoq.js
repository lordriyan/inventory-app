initChart();
function data_changed(){
    arr = {
        R: parseInt($('#alpha_R').val()),
        P: parseInt($('#alpha_P').val()),
        C: parseInt($('#alpha_C').val()),
        H: parseInt($('#alpha_H').val()),
        L: parseInt($('#alpha_L').val()),
        Ls: $('#alpha_L_scale').val(),
        N: parseInt($('#alpha_N').val()),
        Ns: $('#alpha_N_scale').val(),
        K: parseInt($('#alpha_K').val())
    }

    if (arr.K > 0) {
        // If backorder available
        $('#q').html(find_Q_absen(arr)+" Unit");
        $('#j').html(find_J_absen(arr)+" Unit");
        $('#m').html(find_M_absen(arr)+" Unit");

        $('#f').html(find_F_absen(arr)+" Kali pesan");
        $('#v').html(find_V_absen(arr)+" "+arr.Ns);
        $('#b').html(find_B_absen(arr)+" Unit");

        $('#tc').html("Rp. "+find_TC_absen(arr)+",-");
    } else {
        $('#q').html(find_Q(arr)+" Unit");
        $('#j').html("- Unit");
        $('#m').html("- Unit");

        $('#f').html(find_F(arr)+" Kali pesan");
        $('#v').html(find_V(arr)+" "+arr.Ns);
        $('#b').html(find_B(arr)+" Unit");

        $('#tc').html("Rp. "+find_TC(arr)+",-");
    }

    
    

    

    updateChart(arr);

}
function find_TC_absen(arr){
    Q_absen = find_Q_absen(arr);
    M_absen = find_M_absen(arr);
    J_absen = find_J_absen(arr);

    if (typeof arr.H !== 'undefined') { H = arr.H; }
    else { H = arr.P * arr.T; }

    return ((arr.P * arr.R) + ((arr.C*arr.R)/Q_absen) + ((H*M_absen)/(2*Q_absen)) + ((arr.K*Math.pow(J_absen, 2))/(2*Q_absen))).toFixed(2);
}
function find_B_absen(arr){
    return Math.round(((arr.R * arr.L) / arr.N) - find_J_absen(arr));
}
function find_V_absen(arr){
    return Math.round((1 / find_F_absen(arr) * arr.N));
}
function find_F_absen(arr){
    return Math.round(arr.R / find_Q_absen(arr));
}
function find_M_absen(arr){
    return Math.round(find_Q_absen(arr) - find_J_absen(arr));
}
function find_J_absen(arr){
    if (typeof arr.H !== 'undefined') { H = arr.H; }
    else { H = arr.P * arr.T; }
    return Math.round((H * find_Q_absen(arr))/(H + arr.K));
}
function find_Q_absen(arr){
    if (typeof arr.H !== 'undefined') { H = arr.H; }
    else { H = arr.P * arr.T; }
    return Math.round(find_Q(arr) * Math.sqrt((H + arr.K)/arr.K));
}
function find_Q(arr){
    if (typeof arr.H !== 'undefined') {
        return Math.round(Math.sqrt((2*arr.C*arr.R)/arr.H));
    } else {
        return Math.round(Math.sqrt((2*arr.C*arr.R)/arr.P*arr.T));
    }
}
function find_F(arr){
    if (typeof arr.Q !== 'undefined') {
        return Math.round(arr.R/arr.Q);
    } else {
        return Math.round(Math.sqrt((arr.H * arr.R)/(2*arr.C)));
    }
}
function find_V(arr){
    if (typeof arr.Q !== 'undefined') {
        a = arr.Q/arr.R;
    } else if (typeof arr.F !== 'undefined'){
        a = 1/arr.F;
    } else {
        a = Math.sqrt((2*arr.C)/(arr.H * arr.R));
    }
    return Math.round(a * arr.N);
}
function find_B(arr){
    return Math.round((arr.R * arr.L)/arr.N);
}
function find_TC(arr){
    if (typeof arr.Q !== 'undefined') { Q = arr.Q; }
    else { Q = find_Q(arr); }
    if (typeof arr.H !== 'undefined') { H = arr.H; }
    else { H = arr.P * arr.T; }
    b = (arr.P * arr.R) + ((arr.C*arr.R)/Q) + ((H * Q)/2);
    return b.toFixed(2);
}
var myChart;
function initChart(){
var ctx = document.getElementById('myChart').getContext('2d');;
myChart = new Chart(ctx, {
    type: 'line',
    data: {
    labels: [],
    datasets: [{
        label: 'Ordering Cost',
        borderDash: [5, 5],
        data: [],
        lineTension: 0.4,
        backgroundColor: 'transparent',
        borderColor: '#03a9f4',
        borderWidth: 2,
        fill: false,
        pointHitRadius: 5,
        pointBackgroundColor: '#03a9f4'
    },
    {
        label: 'Carrying Cost',
        borderDash: [5, 5],
        data: [],
        lineTension: 0.4,
        backgroundColor: 'transparent',
        borderColor: '#4caf50',
        borderWidth: 2,
        fill: false,
        pointHitRadius: 5,
        pointBackgroundColor: '#4caf50'
    },
    {
        label: 'Total Biaya',
        data: [],
        lineTension: 0.4,
        backgroundColor: 'transparent',
        borderColor: '#e20c0c',
        borderWidth: 3,
        pointBackgroundColor: '#e20c0c'
    }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                scaleLabel: {
                    labelString: 'Cost (Rp.)',
                    display: true
                }
            }]
        },
        tooltips: {
            enabled: false,
            mode: 'index',
            intersect: false,
        },
        legend: {
            display: false
        }
    }
})
}
function updateChart(arr){
    if (typeof arr.H !== 'undefined') { H = arr.H; }
    else { H = arr.P * arr.T; }
    if (arr.K > 0) {
        F = find_F_absen(arr);
    } else {
        F = find_F(arr);
    }
    data = [];
    if (F > 10) {
        min = F - 10;
        step = 2;
    } else {
        min = 1;
        step = 1;
    }
    for (i = min; i < F+11; i=i+step) {
        data.push({
            frekuensi: i,
            jumlah_pemesanan: Math.round(arr.R / i),
            oc: i * arr.C,
            cc: (H * Math.round(arr.R / i))/2
        })
    }

    myChart.data.labels = [];
    myChart.data.datasets[0].data = [];
    myChart.data.datasets[1].data = [];
    myChart.data.datasets[2].data = [];

    for (let z = 0; z < data.length; z++) {
        myChart.data.labels.push(["Q : "+data[z].jumlah_pemesanan, "F : "+data[z].frekuensi]);
        myChart.data.datasets[0].data.push(data[z].oc);
        myChart.data.datasets[1].data.push(data[z].cc);
        myChart.data.datasets[2].data.push(data[z].oc + data[z].cc);
    }

    myChart.update()
}