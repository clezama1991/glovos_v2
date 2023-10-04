<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-exclamation-triangle text-dark"></i>
                Consultar Riesgo
              </span>
          </h3>

        </div>
 
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
    

          <div class="card card-custom gutter-b">


              <div class="card-header bg-primary">
												<div class="card-title">
													<h3 class="card-label">Comunicación de riesgos / peligros </h3>
												</div>
                        
											</div>
 
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="codigo">Id</label>
                  <input v-model="form.codigo" id="codigo" type="text" v-numero class="form-control" required>
                </div> 
              </div> 
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="formfecha">Fecha</label>
                  <input v-model="form.fecha" id="formfecha" type="date" class="form-control" required>
                </div> 
              </div> 
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="estado">Estado</label>                  
                  <select v-model="form.estado" id="estado"  class="form-control">
                    <option value="Abierto">Abierto</option>
                    <option value="Completado">completado</option>
                    <option value="Seguimiento">Seguimiento</option>
                    <option value="Seguimiento fecha vencida">Seguimiento fecha vencida </option>
                    <option value="Cerrado">Cerrado</option>
                  </select>
                </div> 
              </div> 
            </div>               
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="nombres_notificante">Nombre</label>
                  <input v-model="form.nombres_notificante" id="nombres_notificante" type="text" class="form-control" required>
                </div> 
              </div> 
              
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="cargo_responsabilidad_notificante">Cargo / Responsabilidad</label>
                  <input v-model="form.cargo_responsabilidad_notificante" id="cargo_responsabilidad_notificante" type="text" class="form-control" required>
                </div> 
              </div> 
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="url_firma_notificante">Firma</label>
                  <a :href="form.url_firma_notificante" v-if="form.url_firma_notificante!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                
                    <b-form-file 
                      id="url_firma_notificante"
                      ref="url_firma_notificante"
                      placeholder="Buscar Firma..."
                      drop-placeholder="Suelta el archivo aquí..."
                    ></b-form-file>
                </div> 
              </div>
              
              
              
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="descripción_suceso">Descripción del Suceso</label>
                  <textarea v-model="form.descripción_suceso" id="descripción_suceso" class="form-control">
                  </textarea>
                </div> 
              </div> 
                
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="medidas_correctivas">Medidas Correctoras Aplicables</label>
                  <textarea v-model="form.medidas_correctivas" id="medidas_correctivas" class="form-control">
                  </textarea>
                </div> 
              </div> 
                
            </div>               
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="nombres_responsable">Nombre Responsable</label>
                  <input v-model="form.nombres_responsable" id="nombres_responsable" type="text" class="form-control" required>
                </div> 
              </div> 
               
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="url_firma_responsable">Firma</label>
                  <a :href="form.url_firma_responsable" v-if="form.url_firma_responsable!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                
                    <b-form-file 
                      id="url_firma_responsable"
                      ref="url_firma_responsable"
                      placeholder="Buscar Firma..."
                      drop-placeholder="Suelta el archivo aquí..."
                    ></b-form-file>
                </div> 
              </div>
              
            </div>                
            <div class="row">
              
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="url_documentos_sucesos">Otros Documentos</label>
                  <a :href="form.url_documentos_sucesos" v-if="form.url_documentos_sucesos!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                    <b-form-file 
                      id="url_documentos_sucesos"
                      ref="url_documentos_sucesos"
                      placeholder="Buscar Documentos..."
                      drop-placeholder="Suelta el archivo aquí..."
                    ></b-form-file>
                </div> 
              </div>
            </div>
            
          </div>
        </div>



          <div class="card card-custom gutter-b">


              <div class="card-header bg-primary" v-b-toggle.collapse-1>
												<div class="card-title">
													<h3 class="card-label">Evaluación de Riegos</h3>
												</div>
												<div class="card-toolbar">
													<a class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
														<i class="ki ki-menu"></i>
													</a>
												</div>
											</div>
 
            <div class="card-body">
              
              <b-collapse visible  id="collapse-1">

                <div class="row">
                  
                <div class="col-md-4 mb-3">
                  <div class="form-group">
                    <label>Origen Metodo</label>
                    <div>
                      <input v-model="eval_form.origen_metodo" type="radio" name="origen_metodo" id="Proactivo" value="Proactivo"> <label for="Proactivo">Proactivo</label>
                      <input v-model="eval_form.origen_metodo" type="radio" name="origen_metodo" id="Reactivo" value="Reactivo"> <label for="Reactivo">Reactivo</label>
                    </div>
                </div> 
                </div>
                </div>
                
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h4 class="font-weight-bolder">Peligro</h4>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label for="eval_formfecha">Fecha</label>
                      <input v-model="eval_form.fecha" id="eval_formfecha" type="date" class="form-control" required>
                    </div> 
                  </div> 
                  
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label for="descripcion">Descripción</label>
                      <textarea v-model="eval_form.descripcion" id="descripcion" class="form-control">
                      </textarea>
                    </div> 
                  </div> 
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label for="naturaleza">Naturaleza</label>
                      <input v-model="eval_form.naturaleza" id="naturaleza" type="text" class="form-control" required>
                    </div> 
                  </div> 
                  
                    
                </div>
                
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h4 class="font-weight-bolder">Riesgo Inicial</h4>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label>Probabilidad <i class="fa fa-question text-warning" role="button" data-toggle="modal" data-target="#VerProbabilidades"  title="Ver ayuda"></i></label>
                      <select v-model="eval_form.ri_probabilidad" id="ri_probabilidad"  class="form-control">
                        <option :value="item.valor" v-for="(item, index) in probabilidades" :key="index"> {{item.valor}} - {{item.nombre}}</option>
                      </select>
                    </div> 
                  </div> 
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label>Severidad <i class="fa fa-question text-warning" role="button" data-toggle="modal" data-target="#VerSeveridades"  title="Ver ayuda"></i></label>
                      <select v-model="eval_form.ri_severidad" id="ri_severidad"  class="form-control">
                        <option :value="item.valor" v-for="(item, index) in severidades" :key="index"> {{item.valor}} - {{item.nombre}}</option>
                      </select>
                    </div> 
                  </div> 
                    
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label>Valor 1  <i class="fa fa-question text-warning" role="button" data-toggle="modal" data-target="#VerValores"  title="Ver ayuda"></i></label>
                      <input id="ri_valor1" disabled readonly type="text" :value="(ResultadoCombinacion)?ResultadoCombinacion.combinacion:null" class="form-control" required>
                    </div> 
                  </div> 
                    
                    
                </div>
                
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h4 class="font-weight-bolder">Medidas de Mitigación</h4>
                  </div>
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="medidas_mitigacion">Medidas</label>
                      <textarea v-model="eval_form.medidas_mitigacion" id="medidas_mitigacion" class="form-control">
                      </textarea>
                    </div> 
                  </div> 
                  
                    
                </div>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h4 class="font-weight-bolder">Riesgo Final</h4>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label>Probabilidad <i class="fa fa-question text-warning" role="button" data-toggle="modal" data-target="#VerProbabilidades"  title="Ver ayuda"></i></label>
                      <select v-model="eval_form.rf_probabilidad" id="rf_probabilidad"  class="form-control">
                        <option :value="item.valor" v-for="(item, index) in probabilidades" :key="index"> {{item.valor}} - {{item.nombre}}</option>
                      </select>
                    </div> 
                  </div> 
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label>Severidad <i class="fa fa-question text-warning" role="button" data-toggle="modal" data-target="#VerSeveridades"  title="Ver ayuda"></i></label>
                      <select v-model="eval_form.rf_severidad" id="rf_severidad"  class="form-control">
                        <option :value="item.valor" v-for="(item, index) in severidades" :key="index"> {{item.valor}} - {{item.nombre}}</option>
                      </select>
                    </div> 
                  </div> 
                    
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label>Valor 1  <i class="fa fa-question text-warning" role="button" data-toggle="modal" data-target="#VerValores"  title="Ver ayuda"></i></label>
                      <input id="rf_valor1" disabled readonly type="text" :value="(Resultado2Combinacion)?Resultado2Combinacion.combinacion:null" class="form-control" required>
                    </div> 
                  </div>  
                  
                </div>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h4 class="font-weight-bolder">Seguimientos</h4>
                  </div>
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="fecha_efectividad">Fecha de Efectividad de las medidas</label>
                      <input v-model="eval_form.fecha_efectividad" id="fecha_efectividad" type="date" class="form-control" required>
                    </div> 
                  </div> 
                  
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="fecha_implementacion">Fecha de Implementación</label>
                      <input v-model="eval_form.fecha_implementacion" id="fecha_implementacion" type="date" class="form-control" required>
                    </div> 
                  </div> 
                  
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="fecha_seguimiento_control">Fecha Seguimiento/control</label>
                      <input v-model="eval_form.fecha_seguimiento_control" id="fecha_seguimiento_control" type="date" class="form-control">
                      <span class="text-muted"> Dejar vacio sino aplica </span>
                    </div> 
                  </div> 
                  
                  
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="responsable">Responsable</label>
                      <input v-model="eval_form.responsable" id="responsable" type="text" class="form-control" required>
                    </div> 
                  </div> 
                  
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="ref_documentacion">Ref Documentación</label>
                      <textarea v-model="eval_form.ref_documentacion" id="ref_documentacion" class="form-control">
                      </textarea>
                    </div> 
                  </div> 
                    
                  
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="nota">Medidas Adicionales / Comentarios</label>
                      <textarea v-model="eval_form.notas" id="nota" class="form-control">
                      </textarea>
                    </div> 
                  </div> 
                    
                </div>
                  
              </b-collapse>
            </div>   
          </div>   


          <div class="card card-custom gutter-b">


              <div class="card-header bg-primary" v-b-toggle.collapse-2>
												<div class="card-title">
													<h3 class="card-label">Lista de verificación de cambios</h3>
												</div>
												<div class="card-toolbar">
													<a class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
														<i class="ki ki-menu"></i>
													</a>
												</div>
											</div>

 
            <div class="card-body">
              <b-collapse id="collapse-2">
                
                <div class="row"> 
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label for="fecha">Fecha</label>
                      <input v-model="verif_form.fecha" id="fecha" type="date" class="form-control">
                    </div> 
                  </div> 
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label for="nro_informe">Nº de Informe</label>
                      <input v-model="verif_form.nro_informe" id="nro_informe" type="text" class="form-control">
                    </div> 
                  </div> 
                    
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label for="nro_referencia">Nº de Referencia</label>
                      <input v-model="verif_form.nro_referencia" id="nro_referencia" type="text" class="form-control">
                    </div> 
                  </div>  
                </div>

                <div class="row"> 
                  <div class="col-md-12 mb-3">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="70%">Verificar</th>
                          <th width="15%" class="text-center">Si</th>
                          <th width="15%" class="text-center">No</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>¿Se ha efectuado el cambio?</td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_efectuo_cambio" value="1"></td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_efectuo_cambio" value="0"></td>
                        </tr>
                        <tr>
                          <td>¿La evaluación al impacto se mantiene?</td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_impacto_se_mantiene" value="1"></td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_impacto_se_mantiene" value="0"></td>
                        </tr>
                        <tr>
                          <td>¿Se ha realizado la comunicación del cambio?</td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_comunicacion_cambio" value="1"></td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_comunicacion_cambio" value="0"></td>
                        </tr>
                        <tr>
                          <td>¿Ha sido efectiva la medida de mitigación?</td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_medida_mitigacion" value="1"></td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_medida_mitigacion" value="0"></td>
                        </tr>
                      </tbody>
                    </table>

                  </div>

                </div>


                <div class="row"> 
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="observaciones">Observaciones</label>
                      <textarea v-model="verif_form.observaciones" id="observaciones" class="form-control">
                      </textarea>
                    </div> 
                  </div> 
                </div>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h4 class="font-weight-bolder">Verificado por</h4>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="verificado_responsable">Responsable</label>
                      <input v-model="verif_form.verificado_responsable" id="verificado_responsable" type="text" class="form-control">
                    </div> 
                  </div> 
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="verificado_cargo_responsable">Cargo</label>
                      <input v-model="verif_form.verificado_cargo_responsable" id="verificado_cargo_responsable" type="text" class="form-control">
                    </div> 
                  </div> 
                </div>
              </b-collapse>
            </div>
          </div>

          <div class="card card-custom gutter-b" v-if="verif_form.nro_informe_rev_2!=null || (eval_form.fecha_seguimiento_control != null && eval_form.fecha_seguimiento_control <= dateNow)">


              <div class="card-header bg-danger" v-b-toggle.collapse-3>
												<div class="card-title">
													<h3 class="card-label">Lista de verificación de cambios - Revisión 2</h3>
												</div>
												<div class="card-toolbar">
													<a class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
														<i class="ki ki-menu"></i>
													</a>
												</div>
											</div>

 
            <div class="card-body">
              <b-collapse id="collapse-3">
                
                <div class="row"> 
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label for="fecha_rev_2">Fecha</label>
                      <input v-model="verif_form.fecha_rev_2" id="fecha_rev_2" type="date" class="form-control">
                    </div> 
                  </div> 
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label for="nro_informe_rev_2">Nº de Informe</label>
                      <input v-model="verif_form.nro_informe_rev_2" id="nro_informe_rev_2" type="text" class="form-control">
                    </div> 
                  </div> 
                    
                  <div class="col-md-4 mb-3">
                    <div class="form-group">
                      <label for="nro_referencia_rev_2">Nº de Referencia</label>
                      <input v-model="verif_form.nro_referencia_rev_2" id="nro_referencia_rev_2" type="text" class="form-control">
                    </div> 
                  </div>  
                </div>

                <div class="row"> 
                  <div class="col-md-12 mb-3">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="70%">Verificar</th>
                          <th width="15%" class="text-center">Si</th>
                          <th width="15%" class="text-center">No</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>¿Se ha efectuado el cambio?</td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_efectuo_cambio_rev_2" value="1"></td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_efectuo_cambio_rev_2" value="0"></td>
                        </tr>
                        <tr>
                          <td>¿La evaluación al impacto se mantiene?</td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_impacto_se_mantiene_rev_2" value="1"></td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_impacto_se_mantiene_rev_2" value="0"></td>
                        </tr>
                        <tr>
                          <td>¿Se ha realizado la comunicación del cambio?</td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_comunicacion_cambio_rev_2" value="1"></td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_comunicacion_cambio_rev_2" value="0"></td>
                        </tr>
                        <tr>
                          <td>¿Ha sido efectiva la medida de mitigación?</td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_medida_mitigacion_rev_2" value="1"></td>
                          <td class="text-center"><input type="radio" v-model="verif_form.validacion_medida_mitigacion_rev_2" value="0"></td>
                        </tr>
                      </tbody>
                    </table>

                  </div>

                </div>


                <div class="row"> 
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="observaciones">Observaciones</label>
                      <textarea v-model="verif_form.observaciones_rev_2" id="observaciones" class="form-control">
                      </textarea>
                    </div> 
                  </div> 
                </div>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h4 class="font-weight-bolder">Verificado por</h4>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="verificado_responsable_rev_2">Responsable</label>
                      <input v-model="verif_form.verificado_responsable_rev_2" id="verificado_responsable_rev_2" type="text" class="form-control">
                    </div> 
                  </div> 
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="verificado_cargo_responsable_rev_2">Cargo</label>
                      <input v-model="verif_form.verificado_cargo_responsable_rev_2" id="verificado_cargo_responsable_rev_2" type="text" class="form-control">
                    </div> 
                  </div> 
                </div>
              </b-collapse>
            </div>
          </div>















        </div>

        
        <div class="card-footer">
          <router-link to="/comunicacion_riesgos" class="btn btn-secondary mr-2">
            <i class="fa fa-undo"></i> Volver
          </router-link>

          <button
          v-if="can('risk_assessments-update')"
            type="submit"
            class="btn btn-primary mr-3 float-right"
            :disabled="GuardandoCambios"
          >
            <span v-if="GuardandoCambios">
              <i class="fas fa-spinner fa-spin"></i> Guardando...
            </span>
            <span v-else> <i class="fa fa-save"></i> Guardar </span>
          </button>
        </div>


           </form>
 

       
      </div>

    </div>

      <div class="modal fade" id="VerProbabilidades" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Probabilidad del Evento
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
               
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      
                    <table class="table table-bordered">
                      <thead class="bg-primary text-white">
                        <tr>
                          <th class="text-center">Definición Cualitativa</th>
                          <th class="text-center">Significado</th>
                          <th class="text-center">Valor</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in probabilidades" :key="index">
                          <td class="text-center">{{item.nombre}}</td>
                          <td>{{item.significado}}</td>
                          <td class="text-center">{{item.valor}}</td>
                        </tr>
                      </tbody>
                    </table>

                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                </div>
                
            </div>
        </div>
      </div>

      <div class="modal fade" id="VerValores" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Tabla de Valores
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
               
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      
                      <img src="/images/tabla_valores.png" alt="" class="img-fluid">
                 
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                </div>
                
            </div>
        </div>
      </div>

      <div class="modal fade" id="VerSeveridades" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Severidad del Evento
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
               
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      
                    <table class="table table-bordered">
                      <thead class="bg-primary text-white">
                        <tr>
                          <th class="text-center">Definición Cualitativa</th>
                          <th class="text-center">Significado</th>
                          <th class="text-center">Valor</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in severidades" :key="index">
                          <td class="text-center">{{item.nombre}}</td>
                          <td>{{item.significado}}</td>
                          <td class="text-center">{{item.valor}}</td>
                        </tr>
                      </tbody>
                    </table>

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


</template>
<script>
    
    export default {
      props : ['id'],
        data() {
          return {
            GuardandoCambios : false, 
            // url_firma_notificante : false, 
            url_firma_responsable : false, 
            url_documentos_sucesos : false, 
            form:{         
              codigo : '',
              fecha : '',
              estado : '',
              nombres_notificante : '',
              cargo_responsabilidad_notificante : '',
              url_firma_notificante : '',
              descripción_suceso : '',
              medidas_correctivas : '',
              nombres_responsable : '',
              url_firma_responsable : '',
              url_documentos_sucesos : '',
            },
            eval_form:{         
              origen_metodo : '',
              fecha : '',
              descripcion : '',
              naturaleza : '',
              ri_probabilidad : '',
              ri_severidad : '',
              ri_valor1 : '',
              medidas_mitigacion : '',
              rf_probabilidad : '',
              rf_severidad : '',
              rf_valor1 : '',
              fecha_efectividad : '',
              fecha_implementacion : '',
              fecha_seguimiento_control : '',
              responsable : '',
              ref_documentacion : '',
              notas : '',
            },
            verif_form:{         
              fecha : '',
              nro_informe : '',
              nro_referencia : '',
              validacion_efectuo_cambio : '',
              validacion_impacto_se_mantiene : '',
              validacion_comunicacion_cambio : '',
              validacion_medida_mitigacion : '',
              observaciones : '',
              verificado_responsable : '',
              verificado_cargo_responsable : '',
              fecha_rev_2 : '',
              nro_informe_rev_2 : '',
              nro_referencia_rev_2 : '',
              validacion_efectuo_cambio_rev_2 : '',
              validacion_impacto_se_mantiene_rev_2 : '',
              validacion_comunicacion_cambio_rev_2 : '',
              validacion_medida_mitigacion_rev_2 : '',
              observaciones_rev_2 : '',
              verificado_responsable_rev_2 : '',
              verificado_cargo_responsable_rev_2 : '',
            },
            probabilidades : [
              {
                nombre : 'Frecuente',
                significado : 'Probablemente ocurra  muchas veces (ha ocurrido frecuentemente)',
                valor : 5,
              },
              {
                nombre : 'Ocasional',
                significado : 'Probable que ocurra alguna vez (ha ocurrido infrecuentemente)',
                valor : 4,
              },
              {
                nombre : 'Remoto',
                significado : 'Improbable, pero es posible que ocurra (ocurre raramente)',
                valor : 3,
              },
              {
                nombre : 'Improbable',
                significado : 'Muy improbable que ocurra (no se conoce que haya ocurrido)',
                valor : 2,
              },
              {
                nombre : 'Extemadamente improbable',
                significado : 'Casi inconcebible que ocurra',
                valor : 1,
              },              
            ],
            severidades : [
              {
                nombre : 'Catastrófico',
                significado : 'Destrucción de equipamiento, múltiples muertes',
                valor : 'A',
              },
              {
                nombre : 'Peligroso',
                significado : 'Reducción importante de los márgenes de seguridad, daño físico o una carga de trabajo tal que los operadores no puedan desempeñar sus tareas de forma completa y precisa. Lesiones serias. Daños mayores al equipamiento.',
                valor : 'B',
              },
              {
                nombre : 'Mayor',
                significado : 'Reducción importante de los márgenes de seguridad, una reducción en la habilidad del operador a responder a condiciones operativas adversas como resultado del Incremento de trabajo o como resultado de condiciones que impiden su eficiencia. Incidente serio. Lesiones a personas.',
                valor : 'C',
              },
              {
                nombre : 'Menor',
                significado : 'Interferencias. Limitaciones operativas. Utilización de procedimientos de emergencia. Incidentes menores.',
                valor : 'D',
              },
              {
                nombre : 'Insignificante',
                significado : 'Consecuencias leves.',
                valor : 'E',
              },              
            ],
            Combinations:[
              {
                combinacion:'5A',
                color:'#ff0000',
                color_text:'#fff',
                descripcion:'Riesgo Alto No Tolerable',
                medidas:'Cese o disminuya la operación oportunamente si fuera necesario. Realice la mitigación de riesgos de prioridad para garantizar que haya controles preventivos adicionales o mejorados implementados para reducir el índice de riesgos al rango moderado o bajo'
              },              
              {
                combinacion:'5B',
                color:'#ff0000',
                color_text:'#fff',
                descripcion:'Riesgo Alto No Tolerable',
                medidas:'Cese o disminuya la operación oportunamente si fuera necesario. Realice la mitigación de riesgos de prioridad para garantizar que haya controles preventivos adicionales o mejorados implementados para reducir el índice de riesgos al rango moderado o bajo'
              },              
              {
                combinacion:'5C',
                color:'#ff0000',
                color_text:'#fff',
                descripcion:'Riesgo Alto No Tolerable',
                medidas:'Cese o disminuya la operación oportunamente si fuera necesario. Realice la mitigación de riesgos de prioridad para garantizar que haya controles preventivos adicionales o mejorados implementados para reducir el índice de riesgos al rango moderado o bajo'
              },              
              {
                combinacion:'4A',
                color:'#ff0000',
                color_text:'#fff',
                descripcion:'Riesgo Alto No Tolerable',
                medidas:'Cese o disminuya la operación oportunamente si fuera necesario. Realice la mitigación de riesgos de prioridad para garantizar que haya controles preventivos adicionales o mejorados implementados para reducir el índice de riesgos al rango moderado o bajo'
              },              
              {
                combinacion:'4B',
                color:'#ff0000',
                color_text:'#fff',
                descripcion:'Riesgo Alto No Tolerable',
                medidas:'Cese o disminuya la operación oportunamente si fuera necesario. Realice la mitigación de riesgos de prioridad para garantizar que haya controles preventivos adicionales o mejorados implementados para reducir el índice de riesgos al rango moderado o bajo'
              },              
              {
                combinacion:'3A',
                color:'#ff0000',
                color_text:'#000',
                descripcion:'Riesgo Alto No Tolerable',
                medidas:'Cese o disminuya la operación oportunamente si fuera necesario. Realice la mitigación de riesgos de prioridad para garantizar que haya controles preventivos adicionales o mejorados implementados para reducir el índice de riesgos al rango moderado o bajo'
              },              
              {
                combinacion:'5D',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'5E',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'4C',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'4D',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'4E',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'3B',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'3C',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'3D',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'2A',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'2B',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'2C',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'1A',
                color:'#efef01',
                color_text:'#000',
                descripcion:'Riesgo Moderado Tolerable',
                medidas:'Programe el performance de una evaluación de seguridad operacional para reducir el índice de riesgos hasta el rango bajo, si fuera factible'
              },              
              {
                combinacion:'3E',
                color:'#42b342',
                color_text:'#fff',
                descripcion:'Riesgo Bajo Aceptable',
                medidas:'Aceptable tal cual. No necesita una mitigación de riesgos posterior'
              },                  
              {
                combinacion:'2D',
                color:'#42b342',
                color_text:'#fff',
                descripcion:'Riesgo Bajo Aceptable',
                medidas:'Aceptable tal cual. No necesita una mitigación de riesgos posterior'
              },                  
              {
                combinacion:'2E',
                color:'#42b342',
                color_text:'#fff',
                descripcion:'Riesgo Bajo Aceptable',
                medidas:'Aceptable tal cual. No necesita una mitigación de riesgos posterior'
              },                  
              {
                combinacion:'1B',
                color:'#42b342',
                color_text:'#fff',
                descripcion:'Riesgo Bajo Aceptable',
                medidas:'Aceptable tal cual. No necesita una mitigación de riesgos posterior'
              },                  
              {
                combinacion:'1C',
                color:'#42b342',
                color_text:'#fff',
                descripcion:'Riesgo Bajo Aceptable',
                medidas:'Aceptable tal cual. No necesita una mitigación de riesgos posterior'
              },                  
              {
                combinacion:'1D',
                color:'#42b342',
                color_text:'#fff',
                descripcion:'Riesgo Bajo Aceptable',
                medidas:'Aceptable tal cual. No necesita una mitigación de riesgos posterior'
              },                  
              {
                combinacion:'1E',
                color:'#42b342',
                color_text:'#fff',
                descripcion:'Riesgo Bajo Aceptable',
                medidas:'Aceptable tal cual. No necesita una mitigación de riesgos posterior'
              },                  
            ] 

          }
        },
        mounted() {
          this.Buscar();
          this.ValidarPermisos('risk_assessments-update');
        },
        methods: { 
 
          ValidarPermisos(permiso) {
            if(!this.can(permiso)){
              $(":input").prop("disabled", true);
            } 
          },
          Buscar() {
              var url = '/admin/riesgos/'+this.$route.params.id;
              axios.get(url).then(response=>{
                  this.form = response.data.record; 
                  this.eval_form = response.data.eval_form; 
                  this.verif_form = response.data.verif_form;
                  this.verif_form = response.data.verif_form;
              }).catch(error => {
                  this.errors = error.response.data
              });
          },
          reset() { 

             this.form = {         
              fecha : '',
              estado : '',
              nombres_notificante : '',
              cargo_responsabilidad_notificante : '',
              url_firma_notificante : '',
              descripción_suceso : '',
              medidas_correctivas : '',
              nombres_responsable : '',
              url_firma_responsable : '',
              url_documentos_sucesos : '',
            };

            this.eval_form = {         
              origen_metodo : '',
              fecha : '',
              descripcion : '',
              naturaleza : '',
              ri_probabilidad : '',
              ri_severidad : '',
              ri_valor1 : '',
              medidas_mitigacion : '',
              rf_probabilidad : '',
              rf_severidad : '',
              rf_valor1 : '',
              fecha_efectividad : '',
              fecha_implementacion : '',
              fecha_seguimiento_control : '',
              responsable : '',
              ref_documentacion : '',
              notas : '',
            };

            this.verif_form ={         
              fecha : '',
              nro_informe : '',
              nro_referencia : '',
              validacion_efectuo_cambio : '',
              validacion_impacto_se_mantiene : '',
              validacion_comunicacion_cambio : '',
              validacion_medida_mitigacion : '',
              observaciones : '',
              verificado_responsable : '',
              verificado_cargo_responsable : '',
              fecha_rev_2 : '',
              nro_informe_rev_2 : '',
              nro_referencia_rev_2 : '',
              validacion_efectuo_cambio_rev_2 : '',
              validacion_impacto_se_mantiene_rev_2 : '',
              validacion_comunicacion_cambio_rev_2 : '',
              validacion_medida_mitigacion_rev_2 : '',
              observaciones_rev_2 : '',
              verificado_responsable_rev_2 : '',
              verificado_cargo_responsable_rev_2 : '',
            };

            this.$refs['url_firma_notificante'].reset();
            this.$refs['url_firma_responsable'].reset();
            this.$refs['url_documentos_sucesos'].reset();

          },
 
 
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var url_firma_notificante = this.$refs.url_firma_notificante.files[0];
              var url_firma_responsable = this.$refs.url_firma_responsable.files[0];
              var url_documentos_sucesos = this.$refs.url_documentos_sucesos.files[0];

              let formData = new FormData();
  
              formData.append('url_firma_notificante', url_firma_notificante);
              formData.append('url_firma_responsable', url_firma_responsable);
              formData.append('url_documentos_sucesos', url_documentos_sucesos);
              
              formData.append('codigo', this.form.codigo);
              formData.append('fecha', this.form.fecha);
              formData.append('estado', this.form.estado);
              formData.append('nombres_notificante', this.form.nombres_notificante);
              formData.append('cargo_responsabilidad_notificante', this.form.cargo_responsabilidad_notificante);
              formData.append('descripción_suceso', this.form.descripción_suceso);
              formData.append('medidas_correctivas', this.form.medidas_correctivas);
              formData.append('nombres_responsable', this.form.nombres_responsable);        
                    
              formData.append('origen_metodo', this.eval_form.origen_metodo);              
              formData.append('fecha', this.eval_form.fecha);              
              formData.append('descripcion', this.eval_form.descripcion);              
              formData.append('naturaleza', this.eval_form.naturaleza);              
              formData.append('ri_probabilidad', this.eval_form.ri_probabilidad);              
              formData.append('ri_severidad', this.eval_form.ri_severidad);              
              formData.append('ri_valor1', (this.ResultadoCombinacion)?this.ResultadoCombinacion.combinacion:null);              
              formData.append('medidas_mitigacion', this.eval_form.medidas_mitigacion);              
              formData.append('rf_probabilidad', this.eval_form.rf_probabilidad);              
              formData.append('rf_severidad', this.eval_form.rf_severidad);        
              formData.append('rf_valor1', (this.Resultado2Combinacion)?this.Resultado2Combinacion.combinacion:null);              
              formData.append('fecha_efectividad', this.eval_form.fecha_efectividad);              
              formData.append('fecha_implementacion', this.eval_form.fecha_implementacion);              
              formData.append('fecha_seguimiento_control', this.eval_form.fecha_seguimiento_control);              
              formData.append('responsable', this.eval_form.responsable);              
              formData.append('ref_documentacion', this.eval_form.ref_documentacion);              
              formData.append('notas', this.eval_form.notas); 

              formData.append('fecha', this.verif_form.fecha);              
              formData.append('nro_informe', this.verif_form.nro_informe);              
              formData.append('nro_referencia', this.verif_form.nro_referencia);              
              formData.append('validacion_efectuo_cambio', this.verif_form.validacion_efectuo_cambio);              
              formData.append('validacion_impacto_se_mantiene', this.verif_form.validacion_impacto_se_mantiene);              
              formData.append('validacion_comunicacion_cambio', this.verif_form.validacion_comunicacion_cambio);              
              formData.append('validacion_medida_mitigacion', this.verif_form.validacion_medida_mitigacion);              
              formData.append('observaciones', this.verif_form.observaciones);              
              formData.append('verificado_responsable', this.verif_form.verificado_responsable);              
              formData.append('verificado_cargo_responsable', this.verif_form.verificado_cargo_responsable);              
                 
              formData.append('fecha_rev_2', this.verif_form.fecha_rev_2);              
              formData.append('nro_informe_rev_2', this.verif_form.nro_informe_rev_2);              
              formData.append('nro_referencia_rev_2', this.verif_form.nro_referencia_rev_2);              
              formData.append('validacion_efectuo_cambio_rev_2', this.verif_form.validacion_efectuo_cambio_rev_2);              
              formData.append('validacion_impacto_se_mantiene_rev_2', this.verif_form.validacion_impacto_se_mantiene_rev_2);              
              formData.append('validacion_comunicacion_cambio_rev_2', this.verif_form.validacion_comunicacion_cambio_rev_2);              
              formData.append('validacion_medida_mitigacion_rev_2', this.verif_form.validacion_medida_mitigacion_rev_2);              
              formData.append('observaciones_rev_2', this.verif_form.observaciones_rev_2);              
              formData.append('verificado_responsable_rev_2', this.verif_form.verificado_responsable_rev_2);              
              formData.append('verificado_cargo_responsable_rev_2', this.verif_form.verificado_cargo_responsable_rev_2);              
                 
              formData.append('_method', 'put'); 

               var url = '/admin/riesgos/'+this.$route.params.id; 

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al actualizar', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Riesgo Actualizado Correctamente'); 
                  this.Buscar();
                  
                  window.location.href = '/dashboard#/comunicacion_riesgos';
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
        ResultadoCombinacion() {
            var Combinations = this.Combinations;
            var combinacion = this.eval_form.ri_probabilidad+''+this.eval_form.ri_severidad;
            return _.find(Combinations, { 'combinacion': combinacion }); 
        },

        Resultado2Combinacion() {
            var Combinations = this.Combinations;
            var combinacion = this.eval_form.rf_probabilidad+''+this.eval_form.rf_severidad;
            return _.find(Combinations, { 'combinacion': combinacion }); 
        },
 
    },
    watch: {
      '$route.params.id': function (id) {
        this.Buscar()
      }
    },

      };
    </script>