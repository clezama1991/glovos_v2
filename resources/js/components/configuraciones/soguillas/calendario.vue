<template>
  <div>
    <div class="card card-custom gutter-b">
      <div class="card-body body-calendario">
        <div class="row mb-5">
          <div class="col-md-12">

        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modelId">
         <i class="fa fa-user-plus" aria-hidden="true"></i> Agregar Soguilla al calendario
        </button>

          </div>
        </div>        
        
        <div class="alert alert-danger" role="alert">
            <strong>Para eliminar soguilla del calendario</strong> presione encima del calendario el soguilla que desea eliminar y confirme!
          </div>
          
        <FullCalendar :options="calendarOptions" />
      </div>
    </div>

    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar Soguillas a Calendario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
          <div class="modal-body">
             <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label for="soguillas_ids" class="requerido">Soguillas</label>
                    <v-select 
                    v-model="form.soguillas_ids"
                    class="w-100"
                    id="soguillas_ids" 
                    multiple
                    :reduce="full_name => full_name.id"
                    :options="Soguillas" 
                    label="full_name">            
                      <template #search="{ attributes, events }">
                          <input
                          class="vs__search"
                          :required="form.soguillas_ids.length==0"
                          v-bind="attributes"
                          v-on="events"
                          />
                      </template>
                    </v-select>
                  </div> 
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                    <label for="turnos_ids" class="requerido">Turnos</label>
                    <v-select 
                    v-model="form.turnos_ids"
                    class="w-100"
                    id="turnos_ids" 
                    multiple
                    :reduce="nombre => nombre.id"
                    :options="turnos" 
                    label="nombre">            
                      <template #search="{ attributes, events }">
                          <input
                          class="vs__search"
                          :required="form.turnos_ids.length==0"
                          v-bind="attributes"
                          v-on="events"
                          />
                      </template>
                    </v-select>
                  </div> 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="" class="requerido">Fecha Inicio</label>
                  <input type="date" required @change="form.fecha_fin = form.fecha_inicio" v-model="form.fecha_inicio"
                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="" class="requerido">Fecha Fin</label>
                  <input type="date" v-model="form.fecha_fin"
                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                </div>
              </div>
             </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
          
          <button
            type="submit"
            class="btn btn-primary mr-3 float-right"
            :disabled="GuardandoCambios"
          >
            <span v-if="GuardandoCambios">
              <i class="fas fa-spinner fa-spin"></i> Guardando...
            </span>
            <span v-else> <i class="fa fa-save"></i> Guardar </span>
          </button></div>

    </form>
        </div>
      </div>
    </div>


  </div>
</template>
      
    
<script>
    import "@fullcalendar/core/vdom"; // solves problem with Vite
    import FullCalendar from "@fullcalendar/vue";
    import dayGridPlugin from "@fullcalendar/daygrid";
    import timeGridPlugin from "@fullcalendar/timegrid";
    import interactionPlugin from "@fullcalendar/interaction";
    import esLocale from "@fullcalendar/core/locales/es";

    var todayDate = moment().startOf("day");
    var YM = todayDate.format("YYYY-MM");
    var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
    var TODAY = todayDate.format("YYYY-MM-DD");
    var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");
    import Editor from '@tinymce/tinymce-vue'

    export default {
    components: {
        FullCalendar, // make the <FullCalendar> tag available
                    'editor': Editor

    },
    
        data() {
          return {
            GuardandoCambios : false, 
            Soguillas: [],  
            recordsDisponibilida: [],  
            turnos: [],  
            form : {
              soguillas_ids : [],
              turnos_ids : [],
              fecha_inicio : '',
              fecha_fin : '',
            }
          }
        },
        mounted() {
          this.BuscarSoguillas();
          this.BuscarDisponibilida();
          this.BuscarTurnos();
        },
        methods: { 
          reset(){
              this.form = {
              soguillas_ids : [],
              turnos_ids : [],
              fecha_inicio : '',
              fecha_fin : '',
            };
            this.BuscarDisponibilida();
          },
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              
              let formData = new FormData();
  
              formData.append('soguillas_ids', this.form.soguillas_ids); 
              formData.append('turnos_ids', this.form.turnos_ids); 
              formData.append('fecha_inicio', this.form.fecha_inicio); 
              formData.append('fecha_fin', this.form.fecha_fin); 

               var url = '/admin/configuracion/soguillas_disponibilidad';

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Información Registrada Correctamente');                  
                  this.reset();
                }     


              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 
          DeleteRecord(id) {
              console.log('estamos borradno');
               var url = '/admin/configuracion/soguillas_disponibilidad/'+id;

              axios.delete(url,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Información Registrada Correctamente');                  
                  this.reset();
                }     


              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 
          BuscarDisponibilida() {
            var url = '/admin/configuracion/soguillas_disponibilidad';
                axios.get(url).then(response=>{
   
                    this.recordsDisponibilida = _(response.data.records)
                        .map(function (items) {

                        var nombre = items.asistente.full_name;
                         
                        if (screen.width < 1024) {
                            var nombre = items.asistente.nombre_corto;
                        }
            
                        return {
                            fullData: items,
                            allDay: true,
                            title: nombre,
                            start: items.fecha,
                            // backgroundColor: '#000',
                            // textColor: '#fff',
                            // className:'fa fa-home'
                        };
                        })
                        .value();
                        
                 }).catch(error => {
                    this.errors = error.response.data
                });
          },
          BuscarSoguillas() {
            var url = '/admin/listado_soguillas';
                axios.get(url).then(response=>{
                    this.Soguillas = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
          BuscarTurnos() {
            var url = '/admin/configuracion/turnos';
            axios.get(url).then(response=>{
                this.turnos = response.data.records;   
            }).catch(error => {
                this.errors = error.response.data
            });
          },
        },
  computed: {
    ListRecords: function () {
      var data = this.Records;
      return data.filter(
        (items) => items.fecha >= moment().format("YYYY-MM-DD")
      );
    },

    calendarOptions() {
      var _this = this;
      return {
        
        longPressDelay: 0,
        locale: esLocale,
        events: this.recordsDisponibilida,
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin],
        editable: false,
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        height: 800,
        contentHeight: 780,
        aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

        nowIndicator: true,
        now: TODAY + "T09:25:00", // just for demo

        views: {
          dayGridMonth: { buttonText: "month" },
          timeGridWeek: { buttonText: "week" },
          timeGridDay: { buttonText: "day" },
        },
        displayEventTime: false,
        initialView: "dayGridMonth",
        defaultAllDay: true,
        initialDate: TODAY,
        eventClick: function (info) {
          console.log(info.event.extendedProps.fullData);
          alert(info.event.title + " turno:" + (info.event.extendedProps.fullData.turno.nombre ?? null));

          if (confirm("Esta seguro que desea eliminar soguilla del calendario?")) {
            _this.DeleteRecord(info.event.extendedProps.fullData.id);
          }
 
        },
      };
    },
  },
    }
</script>