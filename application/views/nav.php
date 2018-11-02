
<script type="text/javascript">
    var chart1;
    jQuery(document).ready(function()
    {
        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'saisie',
                type: 'pie'
            },
            title: {
                text: 'Saisie'
            },
            exporting: { enabled: false },
            subtitle: {
                text: 'Toatal:15                    | Non traité:0                    | En cours:0                    | Fini:15'
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y:.1f}%'
                    }
                }

            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> Par rapport au total <br/>'
            },
            series: [{"name":"Informations","colorByPoint":"true","data":[{"name":"En cours","y":0,"drilldown":"En cours"},{"name":"Fini","y":100,"drilldown":"Fini"},{"name":"Non trait\u00e9","y":0,"drilldown":"Non trait\u00e9"}]}]
        });
    });
</script>