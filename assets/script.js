document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById("myChart");

    if (ctx) {
        var myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [
                    "Minggu",
                    "Senin",
                    "Selasa",
                    "Rabu",
                    "Kamis",
                    "Jumat",
                    "Sabtu",
                ],
                datasets: [
                    {
                        data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                        lineTension: 0,
                        backgroundColor: "transparent",
                        borderColor: "#007bff",
                        borderWidth: 4,
                        pointBackgroundColor: "#007bff",
                    },
                ],
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Nilai Y'
                        },
                        // Properti lainnya jika diperlukan
                    }],
                },
                legend: {
                    display: false,
                },
            },
        });
    } else {
        console.error("Elemen dengan ID 'myChart' tidak ditemukan.");
    }
});
