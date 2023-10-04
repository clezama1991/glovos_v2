<template>
    <div class="tabla-2020">
        <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

                <div class="d-flex align-items-center flex-wrap mr-2">
         
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                        Mis Polizas                            
                    </h5>

                </div>

            </div>
        </div>


       <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container">
        <div class="row">
    <div class="col-12">
            <div class="card card-custom">

              <div class="card-header flex-wrap p-3 bg-light card-header-section">

                  <div class="card-title mb-0">
                      <h3 class="card-label">
                        Listado de Pólizas
                      </h3>
                  </div>
              </div>

              <div class="card-body">

 

                      <div class="row">
                        <div class="col-12">
                           
                          <tabla-component :striped="true"
                            :fields="fieldsPoliza" 
                            :listado="polizas" 
                            titulo="Polizas"
                            @ButtonDelete="ButtonDelete"
                            @ButtonEdit="ButtonEdit"
                          ></tabla-component>


                        </div>
                      </div>

              </div>

            </div>
            </div>


    <!--end::Body--> 
    </div>

    

            <div class="row pt-5">


              <div class="col-3"> 

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
            </div>

    </div>

      <div class="modal fade" id="EditPolizas" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Ver Póliza
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">                    
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="numero"># Póliza</label>
                        <input :value="form.numero" id="numero" type="text" class="form-control" disabled="disabled">
                      </div> 
                    </div> 
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="endoso">Endoso</label>
                        <input :value="form.endoso" id="endoso" type="text" class="form-control" disabled="disabled">
                      </div> 
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="vigencia_desde">Vigencia desde</label>
                        <input :value="form.vigencia_desde | formatDate" id="vigencia_desde" type="text" class="form-control" disabled="disabled">
                      </div> 
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="vigencia_hasta">Vigencia hasta</label>
                        <input :value="form.vigencia_hasta | formatDate" id="vigencia_hasta" type="text" class="form-control" disabled="disabled">
                      </div> 
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="estado">Estado</label>
                        <input :value="form.estado" id="estado" type="text" class="form-control" disabled="disabled">
                      </div> 
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="aseguradora">Aseguradora</label> 
                        <input :value="(form.aseguradora)?form.aseguradora.nombre:null" id="aseguradora" type="text" class="form-control" disabled="disabled">
                      </div> 
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="ramo">Ramo</label>
                        <input :value="(form.ramo)?form.ramo.nombre:null" id="ramo" type="text" class="form-control" disabled="disabled">
                      </div> 
                    </div>
                    <div class="col-md-12 mb-3" v-if="form.ramo && form.ramo.finanzas">
                      <div class="form-group">
                        <label for="beneficiario">Beneficiario</label>
                        <input :value="form.beneficiario" id="beneficiario" type="number" class="form-control" disabled="disabled">
                      </div> 
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
      </div>


    </div>
    </div>
</template>

<script>
    
  export default {

    data() {
      return {  

          fieldsPoliza: [
            { key: 'numero', label: '# póliza', sortable: true, sortDirection: 'desc' },
            { key: 'endoso', label: 'Endoso', sortable: true, sortDirection: 'desc' },
            { key: 'vigencia_desde', label: 'Vigencia desde', sortable: true, sortDirection: 'desc' },
            { key: 'vigencia_hasta', label: 'Vigencia hasta', sortable: true, sortDirection: 'desc' },
            { key: 'ramo.nombre', label: 'Ramo', sortable: true, sortDirection: 'desc' },
            { key: 'aseguradora.nombre', label: 'Aseguradora', sortable: true, sortDirection: 'desc' },
            { key: 'estado_set', label: 'Estado', sortable: true, sortDirection: 'desc' },
            { key: 'btn_pdf', label: 'PDF', sortable: true, sortDirection: 'desc' },
            { key: 'only_show', label: 'Opciones' }
          ], 
          
          series : [],
          title : '',
          polizas : [],
          my_enterprise : '',
          form : '',
      }
    },
    mounted() { 

    this.MisDatos();

    },
    methods: {
    

        ButtonDelete(data) {
          this.BorrarPoliasForm(data);
        },
        ButtonEdit(data) {
          this.form = data.data;
        },
         
        MisDatos() {
            var url = '/mis_polizas';
            var polizas = [];
            var un_mes_despues = moment().add(1, 'months').format('YYYY-MM-DD');
            var hoy = moment().format('YYYY-MM-DD');
       
            var nro_polizas_activas = 0;
            var nro_polizas_renovar = 0;
            var nro_polizas_caducadas = 0;
            var nro_polizas_anuladas = 0;
            var nro_polizas_cancelada = 0;

            axios.get(url).then(response=>{
            
              this.my_enterprise = response.data.my_enterprise;
              this.polizas = response.data.my_enterprise.polizas;

              $.each(response.data.my_enterprise.polizas, function(key, poliza) {

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
        
              this.series = [
                  {   name: 'Total',
                      innerSize: '50%',
                      data: polizas
                  },
              ];



            }).catch(error => {
                this.errors = error.response.data
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
    estatisticas(){

      var un_mes_despues = moment().add(1, 'months').format('YYYY-MM-DD');
      var hoy = moment().format('YYYY-MM-DD');
      var apolizas = this.polizas;
      var nro_polizas_activas = 0;
      var nro_polizas_renovar = 0;
      var nro_polizas_caducadas = 0;
      var nro_polizas_anuladas = 0;
      var nro_polizas_cancelada = 0;

      var polizas = [];


        $.each(apolizas, function(key, poliza) {

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
        polizas : polizas
      }


    }
    }

  };
</script>