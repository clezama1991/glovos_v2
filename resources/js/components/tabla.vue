<template>
    <div class="tabla-2020">

        <div class="row">
            <div class="col-6 col-sm-5 col-md-2 col-lg-2">              
                <div class="datatable-pager-info">
                    <b-form-select
                v-model="perPage"
                id="perPageSelect"
                class="form-control form-control-sm"
                :options="pageOptions"
                ></b-form-select>   
                </div>
            </div>
            <div class="col-3" v-if="exportar_datos">  
                <b-dropdown id="dropdown-1" text="Exportar" variant="primary" class="">
                    <b-dropdown-item @click="ExportarExcel()"> 
                        <i class="la la-file-excel-o"></i> Excel
                    </b-dropdown-item> 
                    <b-dropdown-item @click="exportPDF()"> 
                        <i class="la la-file-pdf-o"></i> PDF
                    </b-dropdown-item> 
                </b-dropdown>                 
            </div>
            <div class="col-6 col-sm-5 col-md-3 col-lg-3 ml-auto">  
            <div class="form-group">
                <div class="input-group ">
                <input type="text" class="form-control form-control-sm" placeholder="Buscar..." v-model="filter">
                <div class="input-group-append">
                    <button  class="btn btn-light-primary btn-icon btn-sm" type="button">
                        <i class="flaticon-close"></i>
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>      
        
        <b-button v-if="selected_tabla" size="sm" @click="selectAllRows" class="mb-3">
            <span v-if="selected_all">Desmarcar Todos</span>
            <span v-else>Marcar Todos</span> 
        </b-button>

        
        <b-table
            :busy.sync="isBusy"
            id="table-transition-example"
             responsive
            thead-tr-class="bg-primary text-white"
            show-empty
            hover
            :striped="striped"
            bordered
            outlined 
            stacked="md"
            :fields="fields"
            :items="listados"
            :current-page="currentPage"
            :per-page="perPage"
            :filter="filter"   
            @filtered="onFiltered"  
            @row-clicked="onRowClicked"  
            empty-filtered-text="No hay coincidencias con tu busqueda"
            empty-text="No existen Registros"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            > 
            <template #table-busy>
                <div class="text-center text-danger my-2">
                <b-spinner class="align-middle"></b-spinner>
                <strong>Cargando...</strong>
                </div>
            </template>


            <template #cell(seleccion)="row">             
               <label class="checkbox checkbox-inline">
                    <input type="checkbox" @change="Seleccion()" v-model="selected" :value="row.item.id">
                    <span></span>
                </label>
            </template>
 
            <template #cell(img)="row">             
                <img :src="row.item.logo" :alt="row.item.logo" style="max-width: 80px;">
            </template>

            <template #cell(contactos)="row">             
                <span v-html="row.value"> </span>
            </template>

            <template #cell(rol)="row">             
                <ul>
                    <li v-for="(item, index) in row.value" :key="index"> {{item}} </li>
                </ul>
            </template>
 
            <template #cell(nombres)="row">             
                <span v-html="row.value"> </span>
            </template>
 
            <template #cell(nombre_contacto)="row">             
                <span v-html="row.value"> </span>
            </template>

            <template #cell(orden_wordpress)="row">             
                <span v-html="row.value"> </span>
            </template>
 
            <template #cell(set_status)="row" nowrap>  
                {{(row.item.activo==1)?'Activo':'Inactivo'}}
            </template>
 
            <template #cell(edit_status)="row" nowrap>  
                <span v-if="can('pilots-update')"> 
                  <b-form-checkbox @change="SetStatus(row.item.id,row.item.activo)" switch size="lg" value="1" unchecked-value="0" v-model="row.item.activo"></b-form-checkbox>
                </span>
                <span v-else>
                    {{row.item.activo ? 'Activo' : 'Inactivo'}}
                </span>
            </template>
 
            <template #cell(edit_peso_extra)="row" nowrap>  
                  <b-form-checkbox v-if="row.item.hanvolado==null && can_editar" @change="SetStatus(row.item.id,row.item.peso_extra)" switch size="lg" value="1" unchecked-value="0" v-model="row.item.peso_extra"></b-form-checkbox>
                <span v-else>
                    {{(row.value)?'SI':'NO'}}
                </span>
            </template>
            
            <template #cell(btn_pdf)="row">
                 <a :href="row.item.pdf" v-b-tooltip target="_blank" class="btn btn-sm btn-icon" style="background:#187de4;" title="Descargar PDF">
                    <i class="flaticon-download" style="color:#fff"></i>
                </a>                                      
            </template>
             
            <template #cell(btn_actions)="row">

                <!-- sm == show modal / ver en modal -->
                <!-- sp == show page / ver en pagina -->

                <button v-b-tooltip v-if="acciones_tabla.includes('sp-view')" class="btn btn-sm btn-icon btn-warning" @click="ButtonGo(row.item)"  :title="'Ver '+titulo">
                    <i class="flaticon-search"></i>
                </button>
                
                <button v-b-tooltip v-if="acciones_tabla.includes('sp-delete')" class="btn btn-danger btn-sm btn-icon"  @click="ButtonDelete(row.item)"  :title="'Cancelar '+titulo">
                        <i class="flaticon-close"></i>
                </button>
            </template>
             
            <template #cell(actions)="row">
            
                <div class="text-nowrap">
                    <button v-b-tooltip v-if="can_editar" class="btn btn-sm btn-icon btn-warning" @click="ButtonEdit(row.item)" data-toggle="modal" :data-target="'#Edit'+titulo" :title="'Editar '+titulo">
                        <i class="flaticon-search"></i>
                    </button>

                    <button v-b-tooltip v-if="can_eliminar" class="btn btn-danger btn-sm btn-icon"  @click="ButtonDelete(row.item)"  :title="'Eliminar '+titulo">
                        <i class="flaticon-close"></i>
                    </button>
                </div>
            </template>

            <template #cell(actions_go)="row" class="text-nowrap">
                    
                <div class="text-nowrap">
 
                    <button  v-b-tooltip v-if="can_editar || can_ver" class="btn btn-sm btn-warning btn-hover-warning p-2" @click="ButtonGo(row.item)" :title="'Editar '+titulo">
                        <i class="fas fa-search p-0"></i>
                    </button>

                    <button v-b-tooltip v-if="can_eliminar" class="btn btn-sm btn-danger btn-hover-danger p-2"  @click="ButtonDelete(row.item)"  :title="'Eliminar '+titulo">
                        <i class="fas fa-trash p-0"></i>
                    </button> 
                </div>
            </template>

            <!-- solo para el listado de pilotos, un boton que redirige a los fomularios -->
            <template #cell(actions_formularios)="row" class="text-nowrap">
                    
                <div class="text-nowrap">
 
                    <button v-b-tooltip v-if="can_editar || can_ver"  class="btn btn-sm btn-primary p-2" @click="ButtonGoForm(row.item)" :title="'Ir A Formularios'">
                        <i class="fas fa-file p-0"></i>
                    </button>
 
                    <button v-if="can_editar || can_ver" class="btn btn-sm btn-warning btn-hover-warning p-2" @click="ButtonGo(row.item)" :title="'Editar '+titulo">
                        <i class="fas fa-search p-0"></i>
                    </button>

                    <button v-b-tooltip v-if="can_eliminar" class="btn btn-sm btn-danger btn-hover-danger p-2"  @click="ButtonDelete(row.item)"  :title="'Eliminar '+titulo">
                        <i class="fas fa-trash p-0"></i>
                    </button> 
                </div>
            </template>

            <template #cell(actions_go_show)="row" class="text-nowrap">
                    
                <div class="text-nowrap">
 
                    <button v-b-tooltip v-if="can_editar"  class="btn btn-sm btn-primary btn-hover-primary p-2" @click="ButtonEdit(row.item)" data-toggle="modal" :data-target="'#VerVuelo'" :title="'Ver Vuelo'">
                        <i class="fas fa-eye p-0"></i>
                    </button>
 
                    <button v-b-tooltip v-if="can_editar || can_ver"   class="btn btn-sm btn-warning btn-hover-warning p-2" @click="ButtonGo(row.item)" :title="'Editar '+titulo">
                        <i class="fas fa-search p-0"></i>
                    </button>

                    <button v-b-tooltip v-if="can_eliminar" class="btn btn-sm btn-danger btn-hover-danger p-2"  @click="ButtonDelete(row.item)"  :title="'Eliminar '+titulo">
                        <i class="fas fa-trash p-0"></i>
                    </button> 
                </div>
            </template>

            <template #cell(actions_go_show_gallery)="row" class="text-nowrap">
                    
                <div class="text-nowrap">
 
                    <button v-b-tooltip v-if="can_ver" class="btn btn-sm btn-primary btn-hover-primary p-2" @click="ButtonEdit(row.item)" data-toggle="modal" :data-target="'#VerVuelo'" :title="'Ver Vuelo'">
                        <i class="fas fa-eye p-0"></i>
                    </button>
 
                    <button  v-b-tooltip v-if="can_editar || can_ver"  class="btn btn-sm btn-warning btn-hover-warning p-2" @click="ButtonGo(row.item)" :title="'Editar '+titulo">
                        <i class="fas fa-search p-0"></i>
                    </button>

                    <button v-b-tooltip v-if="can_eliminar" class="btn btn-sm btn-danger btn-hover-danger p-2"  @click="ButtonDelete(row.item)"  :title="'Eliminar '+titulo">
                        <i class="fas fa-trash p-0"></i>
                    </button> 

                    <button v-b-tooltip v-if="can_especial" class="btn btn-sm btn-info p-2 symbol symbol-100 mr-5" :class="{'disabled':(row.item.multimedias && row.item.multimedias.length==0)}"  
                    @click="ButtonMultimedia(row.item)" 
                    :title="row.item.estado_multimedia"> 
                        <span>
                            <i class="fa fa-picture-o p-0" aria-hidden="true"></i> 
                            <i class="symbol-badge" :class="{
                                'bg-success':(row.item.estado_multimedia=='No se ha registrado Multimedias' || row.item.estado_multimedia=='Multimedia No Habilitado'),
                                'bg-info':(row.item.estado_multimedia=='Multimedia Descargado'),
                                'bg-warning':(row.item.estado_multimedia=='Multimedia Disponible'),
                                'bg-danger':(row.item.estado_multimedia=='Multimedia Caducado')}
                            "></i>
                        </span>

                        <i class="fa fa-envelope" aria-hidden="true" v-if="row.item.multimedia_notification_pedidos"></i>



                    </button>
                    
                </div>
            </template>
            
            <template #cell(only_show)="row">            
                <button  v-b-tooltip v-if="can_editar || can_ver"  class="btn btn-sm btn-icon btn-warning" @click="ButtonEdit(row.item)" data-toggle="modal" :data-target="'#Edit'+titulo" :title="'Ver '+titulo">
                    <i class="flaticon-search"></i>
                </button> 
            </template>
            
            <template #cell(checked_show)="row">
                <span v-if="can_editar">
                    <button v-b-tooltip v-if="row.item.vuelo==null" class="btn btn-sm btn-icon btn-warning" title="Pedido Sin Vuelo">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>    
                    </button>
                    <button v-b-tooltip v-else-if="row.item.hanvolado==null" class="btn btn-sm btn-icon btn-success" @click="ButtonChecked(row.item)" :title="'Vuelo Realizado Hoy'">
                        <i class="fa fa-check"></i>
                    </button>
                    <span v-else>
                        {{row.item.hanvolado | formatDate}}
                    </span>
                </span>
                <span v-else> 
                    <span v-if="row.item.hanvolado!=null">{{row.item.hanvolado | formatDate}}</span>    
                    <span v-else>No</span>    
                </span> 
            </template>

            <template #cell(_globos)="row">
             
                <ul v-if="row.item.globos"  class="text-left">
                    <li v-for="(item,index) in row.item.globos" :key="index">
                        {{item.nombre}}
                    </li>
                </ul>
                <span v-else> - </span>   
 
            </template>
            <template #cell(_botella)="row">             
                <ul v-if="row.item.botellas"  class="text-left">
                    <li v-for="(item,index) in row.item.botellas" :key="index">
                        {{item.modelo}}
                    </li>
                </ul>
                <span v-else> - </span>    
            </template>

        </b-table>
    
        <div class="datatable-pager datatable-paging-loaded mt-10">

            <div class="row">

                <div class="col-6 col-sm-5 col-md-3 col-lg-3"> 
                    <div class="datatable-pager-info">

                    <span class="datatable-pager-detail">
                        Total de Registros {{ totalRows }}
                    </span>

                    </div>
                </div>

                <div class="col-6 col-sm-5 col-md-3 col-lg-3 ml-auto">
                    <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="fill"               
                    ></b-pagination>
                </div>

            </div>

        </div>

    </div>
</template>

<script>

// import XLSX from 'xlsx'
 import jsPDF from 'jspdf';
import 'jspdf-autotable';

    export default {

        props: [
            'can_ver', 'can_editar', 'can_eliminar','can_especial',
            'sortBy','sortDesc','striped','listado','fields','titulo','exportar_datos','return_array_id','acciones_tabla','isBusy','selected_tabla'],
        data() {
            return {  
                transProps: {
                // Transition name
                name: 'flip-list'
                },
                perPage:10,            
                currentPage : 1,
                totalRows : 0,            
                filter: null,
                pageOptions: [5, 10, 25, 50],
                selected:[],
                selected_all:false
            }
        }, 
        mounted() { 
  
        },
        methods: {
        
        exportPDF() {
            var vm = this
            var columns = [ 
                { title: 'Id', dataKey : 'Id' },
                { title: 'Zona', dataKey : 'Zona'},
                { title: 'Fecha', dataKey : 'Fecha'},
                { title: 'H. Desp.', dataKey : 'H. Desp.'},
                { title: 'H. Ate.', dataKey : 'H. Ate.'},
                { title: 'Piloto', dataKey : 'Piloto'},
                { title: 'Globo', dataKey : 'Globo'},
                { title: 'NumPAX', dataKey : 'NumPAX'},
                { title: 'Estado', dataKey : 'Estado'} 
            ];
            console.log(columns);
            var doc = new jsPDF({
                orientation: 'l', // landscape
                unit: 'pt', // points, pixels won't work properly        
            });
            doc.text('Listado de Vuelos', 40, 40);
            doc.autoTable(columns, vm.listadosExport, {
                margin: {top: 60},
            });
            doc.save('Listado de Vuelos.pdf');
        },
        ExportarExcel() {  
            import('xlsx').then(XLSX => {
                const data = XLSX.utils.json_to_sheet(this.listadosExport);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, data, 'data');
                XLSX.writeFile(wb,'vuelos.xlsx');
            })
        },
    
        SetStatus(id,estatus) { 
            this.$emit("ButtonSetStatus", { id:id, estatus:estatus } );
        },
    
        onRowClicked(data) { 
            this.$emit("onRowClicked", { data:data } );
        },
        ButtonGo(data) {
            this.$emit("ButtonGo", { data:data } );
        },
        ButtonGoForm(data) {
            this.$emit("ButtonGoForm", { data:data } );
        },
        ButtonMultimedia(data) {
            this.$emit("ButtonMultimedia", { data:data } );
        },
        ButtonDelete(data) {
            this.$emit("ButtonDelete", { data:data } );
        },
        ButtonEdit(data) {
            this.$emit("ButtonEdit", { data:data } );
        },
        ButtonChecked(data) {
            this.$emit("ButtonChecked", { data:data } );
        },
        Seleccion() {
             this.$emit("Seleccion", { data:this.selected } );
        },
        selectAllRows() {
            var vm = this
            var list = []
            if(!this.selected_all){
                this.listados.map(function(value, key) {
                    list.push(value['id']); 
                });              
            }
                this.selected_all = !this.selected_all;  
            vm.$emit("Seleccion", { data:list } );
            vm.selected = list;
        },

        onFiltered(data) {
              this.totalRows = data.length
              this.currentPage = 1
              if(this.return_array_id){
                  
                    this.$emit("returnArrayIds", { data:data.map(object => object.id) } );
   
              }
        },  
    }, 
    computed:{    
        KyePrimary() {
            var fields = this.fields; 
            return fields[0]['key'];
        }, 
        listados() {
            var listado = this.listado;
            this.onFiltered(listado);
            return listado;
        }, 
        listadosExport() {
            var listado = this.listados;     
            return _(listado)
              .map(function(items) { 
                console.log(items);
                return { 
                    Id: items.id,
                    Zona: (items.zona)?items.zona.nombre:'',
                    Fecha: moment(items.vuelo.fecha).format('DD/MM/YYYY'),
                    'H. Desp.': (items.vuelo)?items.vuelo.hora_despegue:'',
                    'H. Ate.': (items.vuelo)?items.vuelo.hora_aterrizaje:'',
                    Piloto: (items.piloto)?items.piloto.nombres+''+items.piloto.apellidos:'',
                    Globo: (items.globo)?items.globo.nombre:'',
                    NumPAX: (items.pasajeros)?items.pasajeros.length:'',
                    // 'Carga Total': items.vuelo.carga_total,
                    Estado: items.vuelo.estatus,
                };
              })
              .value();  
        } 
    }

  };
</script>