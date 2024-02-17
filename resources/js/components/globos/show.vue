<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-lightbulb text-dark"></i>
              Consultar Globo
              </span>
          </h3>

        </div>
 
    <form @submit="ActualizarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
               
          <div class="row" v-if="form.logo">
            <div class="col-md-12 mb-3 text-center">
              <div class="form-group">
                  <img :src="form.logo" alt="" style="max-width: 200px;">
              </div> 
            </div> 
            <div class="col-md-12 mb-3">
              <hr>
            </div>
          </div> 
          <div class="row">
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="nombres">Nombre</label>
                <input v-model="form.nombre" id="nombres" type="text" class="form-control" required>
              </div> 
            </div>  
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="matricula">Matricula</label>
                <input v-model="form.matricula" id="matricula" type="text" class="form-control" required>
              </div> 
            </div> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="peso_globo">Peso Globo KGS</label>
                <input v-model="form.peso_globo" id="peso_globo" type="text" v-numero class="form-control" required> 
              </div> 
            </div> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="mtom">Foto</label>
                  <a :href="form.logo" v-if="form.logo!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar ARC Digital"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="foto"
                    v-model="form_foto"
                    placeholder="Buscar FOTO..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="modelo_id">Modelo</label>
                <select class="form-control" id="selectpicker_modelos" required data-live-search="true" v-model="form.modelo_id">
                  <option value="" selected disabled>Seleccione</option>
                  <option v-for="(item, index) in modelos" :key="index" :value="item.id">{{item.modelo_globo}}</option>
                </select>
               </div> 
            </div>   
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="fabricante">Fabricante</label>
                <input v-model="form.fabricante" disabled id="fabricante" type="text" class="form-control">
              </div> 
            </div> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="mtom">MTOM KGS</label>
                <input v-model="form.mtom" disabled v-numero id="mtom" type="tel" class="form-control" required>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="min_mtom">Min. MTOM KGS</label>
                <input v-model="form.min_mtom" disabled id="min_mtom" type="text" class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="hora_total_vuelo">Hora Total Vuelo</label>
                <input v-model="form.hora_total_vuelo" id="hora_total_vuelo" type="text" class="form-control"> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="bottom_end_id">Bottom Ends</label>                  
                <select class="form-control" id="selectpicker_bottom_end"  data-live-search="true" v-model="form.bottom_end_id">
                  <option value="" selected disabled>Seleccione</option>
                  <option v-for="(item, index) in BottomEndCompatibles" :key="index" :value="item.id" :disabled="item._rowVariant">{{item.bottom_end}}</option>
                  </select>
               </div> 
            </div> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="peso_cesta">Peso Cesta KGS</label>
                <input v-model="form.peso_cesta" disabled id="peso_cesta" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="peso_botellas">Peso Botellas KGS</label>
                <input v-model="form.peso_botellas" disabled id="peso_botellas" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="peso_quemador">Peso Quemador KGS</label>
                <input v-model="form.peso_quemador" disabled id="peso_quemador" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            

            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="cert_matricula">Certificado de Matricula</label>
                <a :href="form.cert_matricula" v-if="form.cert_matricula!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Certificado de Matricula"> Descargar</a>
                <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="cert_matricula"
                    v-model="form_cert_matricula"
                    placeholder="Buscar Certificado..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="seguro">Seguro</label>
                  <a :href="form.seguro" v-if="form.seguro!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Seguro"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="seguro"
                    v-model="form_seguro"
                    placeholder="Buscar Seguro..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="arc_doc">ARC Digital</label>
                  <a :href="form.arc_doc" v-if="form.arc_doc!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar ARC Digital"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="arc_doc"
                    v-model="form_arc_doc"
                    placeholder="Buscar ARC..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>  
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="arc">ARC</label>
                <input v-model="form.arc" id="arc" type="date" class="form-control" required 
                                :class="{'bg-danger':form.arc!='' && form.arc<dateNow}">                
                <span class="form-text text-muted" v-if="form.arc!='' && form.arc<dateNow">
                  La fecha del arc esta caducada
                </span> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="form_certiricado_aeronavegabilidad_doc">Certificado de Aeronavegabilidad</label>
                  <a :href="form.certiricado_aeronavegabilidad_doc" v-if="form.certiricado_aeronavegabilidad_doc!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar ARC Digital"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="form_certiricado_aeronavegabilidad_doc"
                    v-model="form_certiricado_aeronavegabilidad_doc"
                    placeholder="Buscar Certificado de Aeronavegabilidad..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>  
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="habilitacion_nivel">Catégorias de Habilitación </label>
                  <select class="form-control" id="selectpicker_Habilitacion" title="Seleccione" data-live-search="true" v-model="form.habilitacion_nivel" required>
                    <option value="" selected disabled></option>
                    <option v-for="(item, index) in Habilitacion" :value="item" :key="index">{{item}}</option>
                  </select>
              </div> 
            </div> 
            
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="volumen">Volúmen(ft3)</label>
                <input v-model="form.volumen" id="volumen" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="y_cuadriculas">Cuadriculas Columnas</label>
                <input :disabled="actualizar_cuadriculas!='1'" v-model="form.y_cuadriculas" @input="form.x_cuadriculas = form.y_cuadriculas" id="y_cuadriculas" type="text" v-numero class="form-control" required> 
                <input type="checkbox" value="1" v-model="actualizar_cuadriculas"> actualizar_cuadriculas

              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="x_cuadriculas">Cuadriculas Filas</label>
                <input :disabled="actualizar_cuadriculas!='1'" v-model="form.x_cuadriculas" id="x_cuadriculas" type="text" v-numero class="form-control" required> 
                <small id="emailHelpId" class="form-text text-muted">No cuentas las filas de la Corona y Nomex</small>


              </div> 
            </div>
            <div class="col-md-12 mb-3">
              <div class="form-group">
                <label for="nota">Notas</label>
                <textarea v-model="form.notas" id="nota" type="text" class="form-control">
                </textarea>
              </div> 
            </div> 
          </div> 
          
        </div>

        
        <div class="card-footer">
          <router-link to="/globos" class="btn btn-secondary mr-2">
            <i class="fa fa-undo"></i> Volver
          </router-link>

          <button
            v-if="can('balloons-update')"
            type="submit"
            class="btn btn-warning mr-3 float-right"
            :disabled="GuardandoCambios"
          >
            <span v-if="GuardandoCambios">
              <i class="fas fa-spinner fa-spin"></i> Actualizando...
            </span>
            <span v-else> <i class="fa fa-save"></i> Actualizar </span>
          </button>
          <button
            v-if="can('balloons-update')"
            type="submit"
            class="btn btn-warning mr-3 float-right"
            :disabled="GuardandoCambios"
            @click="accion_actualizar='salir'"
          >
            <span v-if="GuardandoCambios">
              <i class="fas fa-spinner fa-spin"></i> Actualizando...
            </span>
            <span v-else> <i class="fa fa-save"></i> Actualizar y Salir </span>
          </button>
        </div>


           </form>
 

       
      </div>


      <div class="row">
      
        <div class="col-md-12">
          <div class="card card-info mb-5">  
            <header_card icon="fa fa-envelope" titulo="Diferidos" tipo="sub"></header_card> 
            <div class="card-body">
              
            <div class="row d-flex justify-content-end">
                <div class="col-2">
                    <button id="zoom-out" class="btn btn-sepanka2 btn-block">
                       <i class="fas fa-search-minus"></i>
                    </button>
                </div>
                <div class="col-2">
                    <button id="zoom-in" class="btn btn-sepanka2 btn-block">
                        <i class="fas fa-search-plus"></i>
                     </button>
                </div>
            </div>
            <div class="row mb-5 scroll" id="accordionExample">
                
                <div class="col-md-12">
                  <div class="card card-info mb-5">  
                    <header_card icon=" " titulo="Cuadriculas" tipo="sub"></header_card> 
                    <div class="card-body">
                      <div class="row">  
                        <div class="col-md-12 d-flex justify-content-center organigrama table-responsive">
                          <table class="table-bordered table-cuadricula" id="child">
                            <tbody>
                              <tr v-for="(x, indexx) in form.mapa_cuadricula" :key="indexx">
                                <td  
                                  v-for="(y, indexy) in x" 
                                  :key="indexy" 
                                  @click="BuscarDiferidos(y['id']), cuadricula_title=y['title']"                                    
                                  style="width: 30px; height: 30px;"
                                  v-b-popover.hover.html="y['diferido'] ? y['detalle'] : 'No hay registro'" :title="y['diferido'] ? 'Ultimo Diferido' : 'Sin Diferido'"
                                  >
                                  <span class="round-button" :class="['nivel'+y['fondo']]" >
                                    {{ y['title'] }}
                                  </span>                                    
                                </td>
                              </tr>
                            </tbody>
                          </table> 
                        </div> 
                      </div> 
                    </div> 
                  </div> 
                </div>  


                <div class="col-md-12"  v-if="cuadricula_id==null"> 
                  <div class="card card-info mb-5">  
                    <header_card icon=" " titulo="Todos Los Diferidos del Globo" tipo="sub"></header_card>   <div class="card-body">
                      <div class="table-responsive">

                      <table class="table table-bordered table-striped table-bordere table-hover">
                          <thead>
                              <tr>
                                  <th scope="col" class="text-center">Seccion</th>
                                  <th scope="col" class="text-center">Nivel</th>
                                  <th scope="col" class="text-center">Detalle</th>
                                  <th scope="col" class="text-center">Estatus</th>
                                  <th scope="col" class="text-center">Fecha</th>
                                  <th scope="col" class="text-center">Opciones</th>
                              </tr> 
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in all_diferidos" :key="index">
                              <td>
                                <span class="badge badge-pill h6" :class="['nivel'+item.fondo]" @click="diferido = item, globo_cuadricula_id = item.globo_cuadricula_id" data-toggle="modal" :data-target="'#notaPedido'">
                                {{item.globo_cuadricula.title??null}}
                                </span>
                              </td>
                              <td>
                                <span class="badge" :class="['nivel'+item.fondo]" @click="diferido = item, globo_cuadricula_id = item.globo_cuadricula_id" data-toggle="modal" :data-target="'#notaPedido'">

                                  {{item.gravedad}}
                                </span>
                              </td>
                              <td>
                                <span v-html="item.detalle"></span>
                              </td>
                              <td>
                                {{ item.solucionado ? 'Solucionado' : 'Reportado' }}
                              </td>
                              <td>
                                {{ item.created_at | formatDate }} 
                              </td>
                              <td nowrap>
                                <button class="btn btn-sm btn-icon btn-warning" @click="diferido = item, globo_cuadricula_id = item.globo_cuadricula_id" data-toggle="modal" :data-target="'#notaPedido'" title="Editar">
                                    <i class="flaticon-search"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-icon"  @click="BorrarDiferido(item.id)"  :title="'Eliminar'">
                                    <i class="flaticon-close"></i>
                                </button>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                    </div> 
                    </div> 
                  </div>
                </div>
                <div class="col-md-12" v-else> 
                  <div class="card card-info mb-5">  
                    <header_card icon=" " :titulo="'Diferidos de la seccion '+cuadricula_title" tipo="sub"></header_card> 
                    <div class="card-body">
                      <div class="row ">
                        <div class="col-12 pb-5 d-flex justify-content-between">
                          <button class="btn btn-danger btn-sm" @click="cuadricula_id=null" >
                            Mostrar Todos
                          </button>
                          <button class="btn btn-primary btn-sm"   data-toggle="modal" data-target="#notaPedido" >
                            Agregar
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">

                   
                      <table class="table table-bordered table-striped table-bordere table-hover">
                          <thead>
                              <tr>
                                  <th scope="col" class="text-center">Nivel</th>
                                  <th scope="col" class="text-center">Detalle</th>
                                  <th scope="col" class="text-center">Estatus</th>
                                  <th scope="col" class="text-center">Fecha</th>
                                  <th scope="col" class="text-center">Opciones</th>
                              </tr> 
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in diferidos" :key="index">
                              <td>
                                {{item.gravedad}}
                              </td>
                              <td>
                                <span v-html="item.detalle"></span>
                              </td>
                              <td>
                                {{ item.solucionado ? 'Solucionado' : 'Reportado' }}
                              </td>
                              <td>
                                {{ item.created_at | formatDate }} 
                              </td>
                              <td nowrap>
                                <button class="btn btn-sm btn-icon btn-warning" @click="diferido = item" data-toggle="modal" :data-target="'#notaPedido'" title="Editar">
                                    <i class="flaticon-search"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-icon"  @click="BorrarDiferido(item.id)"  :title="'Eliminar'">
                                    <i class="flaticon-close"></i>
                                </button>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                    </div> 
                    </div> 
                  </div> 
                </div> 




              </div> 
            </div> 
          </div>  
        </div>
      </div>

    </div>

    <div class="modal fade" id="notaPedido" role="dialog" aria-labelledby="asdasdasda" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centereds modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar Diferido para la cuadricula {{ cuadricula_title }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
            <form @submit="AddDiferido" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
                
                      <div class="modal-body"> 
                        <div class="row">

                          <div :class="{'col-md-12':diferido.id==null,'col-md-6':diferido.id!=null}">

                          <div class="row"> 
                            <div class="col-md-12" >
                              <div class="form-group">
                                <label>Nivel</label>
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" v-model="diferido.gravedad"  name="gravedad" value="Visual">
                                        <span></span>
                                        Visual
                                    </label>
                                    <label class="radio">
                                        <input type="radio" v-model="diferido.gravedad"  name="gravedad" value="Leve">
                                        <span></span>
                                        Leve
                                    </label>
                                    <label class="radio">
                                        <input type="radio" v-model="diferido.gravedad"  name="gravedad" value="Grave">
                                        <span></span>
                                        Grave
                                    </label>
                                </div>
                            </div> 
                              </div>
                            <div class="col-md-12 mb-5"> 
                              <label class="" for="detalle">
                                  Detalle
                              </label>
                              <editor
                                  :api-key="api_key"
                                  cloud-channel="5-dev"
                                  :init="option" 
                                  v-model="diferido.detalle" id="detalle"
                                /> 
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="adjunto1">Adjunto 1</label>
                                <b-form-file 
                                  id="adjunto1"
                                  v-model="adjunto1"
                                  placeholder="Adjuntar Evidencia..."
                                  drop-placeholder="Suelta el archivo aquí..."
                                ></b-form-file> 
                                <img v-if="diferido.adjunto1!=null" :src="diferido.adjunto1" alt="diferido.adjunto1" class="img-fluid mt-5">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="adjunto2">Adjunto 2</label>
                                <b-form-file 
                                  id="adjunto2"
                                  v-model="adjunto2"
                                  placeholder="Adjuntar Evidencia..."
                                  drop-placeholder="Suelta el archivo aquí..."
                                ></b-form-file> 
                                <img v-if="diferido.adjunto2!=null" :src="diferido.adjunto2" alt="diferido.adjunto1" class="img-fluid mt-5">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="adjunto1">Adjunto 3</label>
                                <b-form-file 
                                  id="adjunto3"
                                  v-model="adjunto3"
                                  placeholder="Adjuntar Evidencia..."
                                  drop-placeholder="Suelta el archivo aquí..."
                                ></b-form-file> 
                                <img v-if="diferido.adjunto3!=null"  :src="diferido.adjunto3" alt="diferido.adjunto3" class="img-fluid mt-5">
                              </div>
                            </div>

                          </div> 
                          
                        </div> 

                            <div class="col-md-6" v-if="diferido.id!=null">
                              <div class="row  bg-light-danger rounded shadow">
                                <div class="col-md-12 ">
                                  <div class="form-group">
                                    <label>Solucionado</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" v-model="diferido.solucionado"  name="solucionado" value="1">
                                            <span></span>
                                            Si
                                        </label>
                                        <label class="radio">
                                            <input type="radio" v-model="diferido.solucionado"  name="solucionado" value="0">
                                            <span></span>
                                            No
                                        </label>
                                    </div>
                                </div> 
                              </div>
                            <div class="col-md-12 mb-5"> 
                              <label class="" for="detalle">
                                  Detalle
                              </label>
                              <editor
                                  :api-key="api_key"
                                  cloud-channel="5-dev"
                                  :init="option" 
                                  v-model="diferido.solucionado_detalle" id="solucionado_detalle"
                                /> 
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="solucionadoadjunto1">Adjunto 1</label>
                                <b-form-file 
                                  id="solucionadoadjunto1"
                                  v-model="solucionadoadjunto1"
                                  placeholder="Adjuntar Evidencia..."
                                  drop-placeholder="Suelta el archivo aquí..."
                                ></b-form-file> 
                                <img  v-if="diferido.solucionadoadjunto1!=null" :src="diferido.solucionadoadjunto1" alt="diferido.solucionadoadjunto1" class="img-fluid mt-5">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="solucionadoadjunto2">Adjunto 2</label>
                                <b-form-file 
                                  id="solucionadoadjunto2"
                                  v-model="solucionadoadjunto2"
                                  placeholder="Adjuntar Evidencia..."
                                  drop-placeholder="Suelta el archivo aquí..."
                                ></b-form-file> 
                                <img v-if="diferido.solucionadoadjunto2!=null" :src="diferido.solucionadoadjunto2" alt="diferido.solucionadoadjunto2" class="img-fluid mt-5">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="solucionadoadjunto3">Adjunto 3</label>
                                <b-form-file 
                                  id="solucionadoadjunto3"
                                  v-model="solucionadoadjunto3"
                                  placeholder="Adjuntar Evidencia..."
                                  drop-placeholder="Suelta el archivo aquí..."
                                ></b-form-file> 
                                <img v-if="diferido.solucionadoadjunto3!=null"  :src="diferido.solucionadoadjunto3" alt="diferido.solucionadoadjunto3" class="img-fluid mt-5">
                              </div>
                            </div>
                          </div>


                            </div>
                            </div>










                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>

                        <button type="submi" class="btn btn-primary font-weight-bold">
                          <span v-if="diferido.id==null">Agregar</span>
                          <span v-else="">Actualizar</span>
                          </button>
                      </div>
            </form>
        </div>
      </div>
    </div>
</div>
</template>
<script>
    
    import Editor from '@tinymce/tinymce-vue'     
    export default {
      components: {
          'editor': Editor
      },
      props : ['id'],
        data() {
          return {
            api_key:'4uqg5bfl6an0lmdfdghkap4yfejy8ovqglkfaahssobrd8mv',
            option:{
                height: 150,
                menubar: false,
                plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
                ],
                toolbar:
                'undo redo | formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat | help'
            }, 
            accion_actualizar : 'mantener',
            GuardandoCambios : false,
            doc_licencia:false,
            form:{          
              volumen : '',
              nombre : '',
              matricula : '',
              fabricante : '',              
              modelo_id : 3,
              modelo : '',
              mtom : '',
              min_mtom : '',
              hora_total_vuelo : '',
              arc : '',
              peso_cesta : '',
              peso_globo : '',
              peso_botellas : '',
              peso_quemador : '',
              notas : '',
              habilitacion_nivel : '',
              bottom_end_id : '',
              x_cuadriculas : '',
              y_cuadriculas : '',
            },
            actualizar_cuadriculas : false,
            form_arc_doc : null,
            form_cert_matricula : null,
            form_seguro : null,
            form_certiricado_aeronavegabilidad_doc : null,
            form_foto : null,
            Habilitacion : ['A','B','C','D'],
            modelos : [],
            botom_ends : [],
            cuadricula_title : null,
            cuadricula_id : null,
            all_diferidos : [],
            diferidos : [],
            
            diferido:{          
              id : null,
              detalle : '',
              gravedad : 'Visual',
              solucionado : 0,
              solucionado_detalle : null,
            },
            adjunto1 :null,
            adjunto2 :null,
            adjunto3 :null,
            solucionadoadjunto1 :null,
            solucionadoadjunto2 :null,
            solucionadoadjunto3 :null,
          }




        },

 
        mounted(){
          this.Buscar();
          this.BuscarModelos();
          this.BuscarBottomEnd();
          this.ValidarPermisos('balloons-update');
        },
        methods: { 
 
          BuscarDiferidos(id) {
            this.cuadricula_id = id;
            var url = '/admin/buscar_diferidos/'+id;
            axios.get(url).then(response=>{
                this.diferidos = response.data.records;   
            }).catch(error => {
                this.errors = error.response.data
            });
          },

          AddDiferido(evt) {

            evt.preventDefault();

            this.GuardandoCambios = !this.GuardandoCambios;
            var porc = 0;
            
            var adjunto1 = this.adjunto1;
            var adjunto2 = this.adjunto2;
            var adjunto3 = this.adjunto3;

            var solucionadoadjunto1 = this.solucionadoadjunto1;
            var solucionadoadjunto2 = this.solucionadoadjunto2;
            var solucionadoadjunto3 = this.solucionadoadjunto3;

            let formData = new FormData();

            formData.append('detalle', this.diferido.detalle);
            formData.append('gravedad', this.diferido.gravedad);
            formData.append('solucionado', this.diferido.solucionado);
            formData.append('solucionado_detalle', this.diferido.solucionado_detalle);
            formData.append('adjunto1', adjunto1);
            formData.append('adjunto2', adjunto2);
            formData.append('adjunto3', adjunto3);
            formData.append('solucionadoadjunto1', solucionadoadjunto1);
            formData.append('solucionadoadjunto2', solucionadoadjunto2);
            formData.append('solucionadoadjunto3', solucionadoadjunto3);
            
            if(this.diferido.id != null){
              formData.append('_method', 'PUT');
              var url = '/admin/edit_diferido/'+this.diferido.id;
            }else{
              formData.append('globo_cuadricula_id', this.cuadricula_id);
              var url = '/admin/add_diferido';
            }


            axios.post(url, formData,{
              headers: {
                  'Content-Type': 'multipart/form-data'
              }, 
            }).then(response=>{ 

                this.GuardandoCambios = !this.GuardandoCambios;
                if(!response.data.result){
                  this.$toastr.error('Ocurrio un error al registrar', 'Error en Proceso...');       
                }else{     
                  
                  this.$toasted.success('Diferido Agregado Correctamente');                  
                  this.reset();
                  this.Buscar();
                  this.BuscarDiferidos(this.cuadricula_id); 
                  
                  $("#notaPedido .close").click(); 
                  $("#notaPedido .close2").click(); 
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();

                }     


            }).catch(error => {
                this.errors = error.response.data
            });                

          }, 
        BorrarDiferido(id) {
          
            var _this = this;
            var registro = id;

             Swal.fire({
                title: "Confirmar!",
                text: "Confirme que desea Eliminar este Registro",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/delete_diferido/'+registro;

                    axios.post(url,{                
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Registro Eliminado Correctamente');
                        
                      }

                      _this.Buscar();
                      _this.BuscarDiferidos(_this.cuadricula_id); 
                                   
                    }).catch(error => {
                        console.log(error);
                        this.errors = error.response
                    });
                }
              });

        },  


          ValidarPermisos(permiso) {
            if(!this.can(permiso)){
              $(":input").prop("disabled", true);
            }
          },
          BuscarBottomEnd() {
            var url = '/admin/listado_globo_bottom_end';
            axios.get(url).then(response=>{
                this.botom_ends = response.data.records;   
            }).catch(error => {
                this.errors = error.response.data
            });
          },
          BuscarModelos() {
            var url = '/admin/listado_tabla_carga';
                axios.get(url).then(response=>{
                    this.modelos = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
          reset() { 
            this.form_arc_doc = null;
            this.form_cert_matricula = null;
            this.form_seguro = null;
            this.form_foto = null;
            this.form_certiricado_aeronavegabilidad_doc = null; 

            this.adjunto1 = null;
            this.adjunto2 = null;
            this.adjunto3 = null;

            this.solucionadoadjunto1 = null;
            this.solucionadoadjunto2 = null;
            this.solucionadoadjunto3 = null;

            this.diferido = {          
              detalle : '',
              gravedad : 'Visual',
              solucionado : 0,
              solucionado_detalle : null,
            };

          },
          Buscar() {
            var url = '/admin/globos/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.form = response.data.record; 
                this.all_diferidos = response.data.record.GloboDiferidos; 

            }).catch(error => {
                this.errors = error.response.data
            });
          },

          ActualizarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var form_arc_doc = this.form_arc_doc;
              var form_cert_matricula = this.form_cert_matricula;
              var form_seguro = this.form_seguro;
              var form_foto = this.form_foto;
              var form_certiricado_aeronavegabilidad_doc = this.form_certiricado_aeronavegabilidad_doc;

              let formData = new FormData();
  
              formData.append('form_arc_doc', form_arc_doc);
              formData.append('form_cert_matricula', form_cert_matricula);
              formData.append('form_seguro', form_seguro);
              formData.append('form_foto', form_foto);
              formData.append('form_certiricado_aeronavegabilidad_doc', form_certiricado_aeronavegabilidad_doc);

              formData.append('volumen', this.form.volumen);
              formData.append('nombre', this.form.nombre);
              formData.append('matricula', this.form.matricula);
              formData.append('fabricante', this.form.fabricante);
              formData.append('modelo_id', this.form.modelo_id);
              formData.append('mtom', this.form.mtom);
              formData.append('min_mtom', this.form.min_mtom);
              formData.append('hora_total_vuelo', this.form.hora_total_vuelo);
              formData.append('arc', this.form.arc);
              formData.append('peso_cesta', this.form.peso_cesta);
              formData.append('peso_globo', this.form.peso_globo);
              formData.append('peso_botellas', this.form.peso_botellas);
              formData.append('peso_quemador', this.form.peso_quemador);
              formData.append('notas', this.form.notas);
              formData.append('habilitacion_nivel', this.form.habilitacion_nivel);
              formData.append('bottom_end_id', this.form.bottom_end_id);
              formData.append('x_cuadriculas', this.form.x_cuadriculas);
              formData.append('y_cuadriculas', this.form.y_cuadriculas);
              formData.append('actualizar_cuadriculas', this.actualizar_cuadriculas);
              formData.append('_method', 'put');
  
  
               var url = '/admin/globos/'+this.$route.params.id;

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al actualizar Globo', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Globo Actualizado Correctamente');                  
                  this.reset();
                  this.Buscar();
                  if (this.accion_actualizar=='salir') {
                    window.location.href = '/dashboard#/globos';
                    
                  }
                  
                }     
              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 

      },
      
  
      computed: { 
 
          dateNow(){
            return moment().format('YYYY-MM-DD');
          },  
          BottomEndCompatibles(){
            var botom_ends = this.botom_ends; 
            var modelo_id = this.form.id; 
            const results = _.filter(botom_ends, (item) => {
              return item.compatibilidad_globos_ids.includes(modelo_id);
            }); 
            return results;
           },   
      }, 
      watch: {
        BottomEndCompatibles: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_bottom_end').selectpicker('refresh'); });
        },
        modelos: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_modelos').selectpicker('refresh'); });
        },
        Habilitacion: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_Habilitacion').selectpicker('refresh'); });
        },
        'form.modelo_id': function (id) {        
            var modelos = this.modelos; 
            var model = _.find(modelos, ['id', id]);
            if(model){
              this.form.fabricante = model['fabricante'];     
              this.form.mtom = model['mtom'];    
              this.form.min_mtom = model['min_mtom'];    
            }
        },
        'form.bottom_end_id': function (id) {        
            var botom_ends = this.botom_ends; 
            var model = _.find(botom_ends, ['id', id]);
            if(model){
              this.form.peso_quemador = model['peso_quemador'];    
              this.form.peso_cesta = model['peso_cesta'];    
              this.form.peso_botellas = model['peso_botellas'];  
            }
        },
      },


      };
    </script>