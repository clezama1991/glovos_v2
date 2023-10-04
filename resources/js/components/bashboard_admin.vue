<template>
  <div class="tabla-2020">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
      <div
        class="
          container-fluid
          d-flex
          align-items-center
          justify-content-between
          flex-wrap flex-sm-nowrap
        "
      >
        <div class="d-flex align-items-center flex-wrap mr-2">
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
        </div>
      </div>
    </div>
 
    <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container">


            <div class="row">



        <!--begin::Profile 4-->
        <div class="col-3">
          <a href="#" class="card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Home.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
                    </g>
                </svg><!--end::Svg Icon--></span>
                  <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5">{{estatisticas.total_empresas}} Empresas</div>
                    
                </div>
                <!--end::Body-->
          </a>


        </div>
        <div class="col-3">
          <a href="#" class="card card-custom bg-success bg-hover-state-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                     <span class="svg-icon svg-icon-white svg-icon-3x ml-n1"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span>       <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5"> {{estatisticas.nro_usuarios}} Usuarios</div>
                    
                </div>
                <!--end::Body-->
          </a>


        </div>
        <div class="col-3">
          <a href="#" class="card card-custom bg-info bg-hover-state-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                  <span class="svg-icon svg-icon-white svg-icon-3x ml-n1"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Clipboard-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
    </g>
</svg><!--end::Svg Icon--></span>

               <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5"> {{estatisticas.nro_polizas}} Pólizas</div> 
                </div>
                <!--end::Body-->
          </a>


        </div>
        <div class="col-3">
          <a href="#" class="card card-custom bg-info bg-hover-state-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                  <span class="svg-icon vg-icon-white svg-icon-3x ml-n1"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Dollar.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" opacity="0.3" x="11.5" y="2" width="2" height="4" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="11.5" y="16" width="2" height="5" rx="1"/>
        <path d="M15.493,8.044 C15.2143319,7.68933156 14.8501689,7.40750104 14.4005,7.1985 C13.9508311,6.98949895 13.5170021,6.885 13.099,6.885 C12.8836656,6.885 12.6651678,6.90399981 12.4435,6.942 C12.2218322,6.98000019 12.0223342,7.05283279 11.845,7.1605 C11.6676658,7.2681672 11.5188339,7.40749914 11.3985,7.5785 C11.2781661,7.74950085 11.218,7.96799867 11.218,8.234 C11.218,8.46200114 11.2654995,8.65199924 11.3605,8.804 C11.4555005,8.95600076 11.5948324,9.08899943 11.7785,9.203 C11.9621676,9.31700057 12.1806654,9.42149952 12.434,9.5165 C12.6873346,9.61150047 12.9723317,9.70966616 13.289,9.811 C13.7450023,9.96300076 14.2199975,10.1308324 14.714,10.3145 C15.2080025,10.4981676 15.6576646,10.7419985 16.063,11.046 C16.4683354,11.3500015 16.8039987,11.7268311 17.07,12.1765 C17.3360013,12.6261689 17.469,13.1866633 17.469,13.858 C17.469,14.6306705 17.3265014,15.2988305 17.0415,15.8625 C16.7564986,16.4261695 16.3733357,16.8916648 15.892,17.259 C15.4106643,17.6263352 14.8596698,17.8986658 14.239,18.076 C13.6183302,18.2533342 12.97867,18.342 12.32,18.342 C11.3573285,18.342 10.4263378,18.1741683 9.527,17.8385 C8.62766217,17.5028317 7.88033631,17.0246698 7.285,16.404 L9.413,14.238 C9.74233498,14.6433354 10.176164,14.9821653 10.7145,15.2545 C11.252836,15.5268347 11.7879973,15.663 12.32,15.663 C12.5606679,15.663 12.7949989,15.6376669 13.023,15.587 C13.2510011,15.5363331 13.4504991,15.4540006 13.6215,15.34 C13.7925009,15.2259994 13.9286662,15.0740009 14.03,14.884 C14.1313338,14.693999 14.182,14.4660013 14.182,14.2 C14.182,13.9466654 14.1186673,13.7313342 13.992,13.554 C13.8653327,13.3766658 13.6848345,13.2151674 13.4505,13.0695 C13.2161655,12.9238326 12.9248351,12.7908339 12.5765,12.6705 C12.2281649,12.5501661 11.8323355,12.420334 11.389,12.281 C10.9583312,12.141666 10.5371687,11.9770009 10.1255,11.787 C9.71383127,11.596999 9.34650161,11.3531682 9.0235,11.0555 C8.70049838,10.7578318 8.44083431,10.3968355 8.2445,9.9725 C8.04816568,9.54816454 7.95,9.03200304 7.95,8.424 C7.95,7.67666293 8.10199848,7.03700266 8.406,6.505 C8.71000152,5.97299734 9.10899753,5.53600171 9.603,5.194 C10.0970025,4.85199829 10.6543302,4.60183412 11.275,4.4435 C11.8956698,4.28516587 12.5226635,4.206 13.156,4.206 C13.9160038,4.206 14.6918294,4.34533194 15.4835,4.624 C16.2751706,4.90266806 16.9686637,5.31433061 17.564,5.859 L15.493,8.044 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>

               <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5"> Comisiones</div> 
                </div>
                <!--end::Body-->
          </a>


        </div>

            </div>


            <div class="row">


              <div class="col-4"> 

                  <div class="card card-custom gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Pólizas</span>
                        </h3>
                    </div>
 
                    <highcharts :options="chartOptions" ></highcharts>


                    <table class="table mb-6">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Pólizas</th>
                                <th scope="col" class="text-center">Total</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in estatisticas.polizas" :key="index">
                                <td scope="row">
                                  <span class="label label-lg label-inline w-100" :class="item.class">{{item.nombre}}</span>
                                </td>
                                <td class="text-center">
                                  {{item.total}} 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </div>

              <div class="col-8"> 

                  <div class="card card-custom gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Top 10 Aseguradoras</span>
                        </h3>
                    </div>

                    <div class="row">
                      
                      <div class="col-12"> 
                        <highcharts :options="chartOptionsTopAseguradoras" ></highcharts>
                      </div>
                         
                    </div>


                  </div>
                  <div class="card card-custom gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Top 10 Ramos</span>
                        </h3>
                    </div>

                    <div class="row">
                      
                      <div class="col-12"> 
                        <highcharts :options="chartOptionsTopRamos" ></highcharts>
                      </div>
                         
                    </div>


                  </div>

              </div>



              </div>
              </div> 

      </div>
      <!--end::Body-->
  </div>

 
  
</template>

<script> 

export default {
  data() {
    return {
      clientes : [],
      series : [ ],
      title : '',
      porct:'Pólizas',



      seriesAseguradoras : [ ],
      seriesRamos : [ ],


    };
  },
  mounted() {
    this.getData();
  },
  methods: { 
    getData(){

        var un_mes_despues = moment().add(1, 'months').format('YYYY-MM-DD');
        var hoy = moment().format('YYYY-MM-DD');
        var polizas = [];

        var aseguradoras_top = 1;
        var aseguradoras_all = [];
        var aseguradoras = [];

        var ramos_top = 1;
        var ramos_all = [];
        var ramos = [];

        var nro_polizas_activas = 0;
        var nro_polizas_renovar = 0;
        var nro_polizas_caducadas = 0;
        var nro_polizas_anuladas = 0;
        var nro_polizas_cancelada = 0;

        var url = '/buscarClientes';

        axios.get(url).then(response => {
          
          this.clientes = response.data.records;

          $.each(response.data.records, function(key, value) {

            $.each(value.polizas, function(key, poliza) {

              if(poliza.estado=='Activa'){

                if(hoy>poliza.vigencia_hasta){
                  nro_polizas_caducadas++;
                }else{
                  if(un_mes_despues>poliza.vigencia_hasta){
                    nro_polizas_renovar++;
                  }else{
                    nro_polizas_activas++;
                  }
                }

              }else if(poliza.estado=='Anulada'){
                nro_polizas_anuladas++;
              }else if(poliza.estado=='Caducada'){
                nro_polizas_caducadas++;
              }else if(poliza.estado=='Cancelada'){
                nro_polizas_cancelada++;
              }

              aseguradoras_all.push({
                nombre: (poliza.aseguradora)?poliza.aseguradora.nombre:null
              });

              ramos_all.push({
                nombre: (poliza.ramo)?poliza.ramo.nombre:null
              });

            });

          });


          var aseguradoras_all_group = _(aseguradoras_all)
            .groupBy('nombre')
            .map(function(items, nombre) { 
              return { nombre: nombre, count: items.length };
          }).value();

          var ramos_all_group = _(ramos_all)
            .groupBy('nombre')
            .map(function(items, nombre) { 
              return { nombre: nombre, count: items.length };
          }).value();
  
          var aseguradoras_all_order = _.orderBy(aseguradoras_all_group, ['count', 'nombre'], ['desc', 'desc']);

          var ramos_all_order = _.orderBy(ramos_all_group, ['count', 'nombre'], ['desc', 'desc']);
 
          $.each(aseguradoras_all_order, function(key, value) { 
            if(aseguradoras_top<=10){
              aseguradoras.push({
                name: value.nombre,
                y: value.count
              });
            }
          });

          $.each(ramos_all_order, function(key, value) { 
            if(ramos_top<=10){
              ramos.push({
                name: value.nombre,
                y: value.count
              });
            }
          });
 
          polizas.push({
            name: 'Activas',
            y: nro_polizas_activas,
            color:'#3699FF'
          });

          polizas.push({
            name: 'Por Renovar',
            y: nro_polizas_renovar,
            color:'#FFA800'

          });

          polizas.push({
            name: 'Caducadas',
            y: nro_polizas_caducadas ,
            color:'#F64E60'
          });

          polizas.push({
            name: 'Anuladas',
            y: nro_polizas_anuladas ,
            color:'#1BC5BD'
          });
     
          polizas.push({
            name: 'Cancelada',
            y: nro_polizas_cancelada ,
            color:'#8950FC'
          });

          this.seriesAseguradoras = aseguradoras;
          this.seriesRamos = ramos;
          this.series = [
              {   name: 'Total',
                  innerSize: '50%',
                  data: polizas
              },
          ];




        });
    }, 

  },
  computed: {


        chartOptions() { 
            return {
                chart: {  type: 'pie'},
                title: {  text: this.title  },
                series: this.series,                    
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: false
                    }
                },
                title: {
                    text: this.porct,
                    align: 'center',
                    verticalAlign: 'middle',
                    y: 10
                },
            }
        },
        chartOptionsTopAseguradoras() { 
            return { 
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Aseguradoras en Pólizas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
                },
                series: [{
                  name: "Aseguradoras",
                  colorByPoint: true,
                  data: this.seriesAseguradoras
                }]
            }
        },
        chartOptionsTopRamos() { 
            return { 
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Ramos en Pólizas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
                },
                series: [{
                  name: "Ramos",
                  colorByPoint: true,
                  data: this.seriesRamos
                }]
            }
        },


    estatisticas(){

      var un_mes_despues = moment().add(1, 'months').format('YYYY-MM-DD');
      var hoy = moment().format('YYYY-MM-DD');
      var lista = this.clientes;
      var nro_usuarios = 0;
      var nro_polizas = 0;
      var nro_polizas_activas = 0;
      var nro_polizas_renovar = 0;
      var nro_polizas_caducadas = 0;
      var nro_polizas_anuladas = 0;
      var nro_polizas_cancelada = 0;

      var polizas = [];

      $.each(lista, function(key, value) {
        nro_usuarios += value.empleados.length
        nro_polizas += value.polizas.length 

        $.each(value.polizas, function(key, poliza) {

          if(poliza.estado=='Activa'){

            if(hoy>poliza.vigencia_hasta){
              nro_polizas_caducadas++;
            }else{
              if(un_mes_despues>poliza.vigencia_hasta){
                nro_polizas_renovar++;
              }else{
                nro_polizas_activas++;
              }
            }

          }else if(poliza.estado=='Anulada'){
            nro_polizas_anuladas++;
          }else if(poliza.estado=='Caducada'){
            nro_polizas_caducadas++;
          }else if(poliza.estado=='Cancelada'){
            nro_polizas_cancelada++;
          }

        });

      });
 
      polizas.push({
        nombre: 'Activas',
        total: nro_polizas_activas ,
        class: 'label-primary' 
      });

      polizas.push({
        nombre: 'Por Renovar',
        total: nro_polizas_renovar ,
        class: 'label-warning' 
      });

      polizas.push({
        nombre: 'Caducadas',
        total: nro_polizas_caducadas ,
        class: 'label-danger' 
      });

      polizas.push({
        nombre: 'Anuladas',
        total: nro_polizas_anuladas ,
        class: 'label-success' 
      });

      polizas.push({
        nombre: 'Cancelada',
        total: nro_polizas_cancelada ,
        class: 'label-info' 
      });
 
      return {
        total_empresas : lista.length,
        nro_usuarios : nro_usuarios,
        nro_polizas : nro_polizas,
        polizas : polizas
      }


    }


  },
};
</script>