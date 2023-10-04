<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-user text-dark"></i>
              Actualizar Contraseña
            </span>
          </h3>
        </div>

        <div class="card-body">
	
              <div class="d-flex flex-column-fluid"> 
                <div class="container">
                  <div class="row">
                    <div class="col-xl-12">                      
                      <div class="card card-custom gutter-b card-stretch">
                        <div class="card-header border-0 pt-5">
                          <div class="card-title">
                            <div class="card-label">
                              <div class="font-weight-bolder"> </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body d-flex flex-column p-0">                          
                         
								<div class="row d-flex justify-content-center">
									<div class="col-xl-8">
										<!--begin::Engage Widget 14-->
										<div class="card card-custom card-stretch gutter-b shadow-lg">
											<div class="card-body pb-20"> 
												  <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
          
												<div class="row mb-6">
													<!--begin::Info-->
													<div class="col-12 col-md-12">
														<div class="mb-8 d-flex flex-column">
															<span class="text-dark font-weight-bold mb-4">Ingrese Nueva Contraseña</span>
                              								<input type="password" class="form-control" autocomplete="false" style="font-size: larger;" v-model="form.pass1"  @input="password_check">
									                        <span class="form-text text-muted" v-if="form.pass1!='' && !passValidate">La Contraseña ingresada es debil</span>
														</div>
													</div> 
													<div class="col-12 col-md-12">
														<div class="mb-8 d-flex flex-column">
															<span class="text-dark font-weight-bold mb-4">Repita Nueva Contraseña</span>
                              								<input type="password" class="form-control" autocomplete="false" style="font-size: larger;" v-model="form.pass2">
														    <span class="form-text text-muted" v-if="form.pass1!=form.pass2">Contraseñas no coinciden</span>
													</div>
													</div>   
												
													<div class="col-12 col-md-6">
														<div class="mb-8 d-flex flex-column">
															<router-link :to="'/cuenta'" type="submit" class="btn btn-danger" :disabled="GuardandoCambios || !passValidate || form.pass1!=form.pass2">
																Cancelar
															</router-link> 
														</div>
													</div>   
												 
													<div class="col-12 col-md-6">
														<div class="mb-8 d-flex flex-column">
															<button type="submit" class="btn btn-primary" :disabled="GuardandoCambios || !passValidate || form.pass1!=form.pass2">
															<span v-if="GuardandoCambios">
																<i class="fas fa-spinner fa-spin"></i> Registrando...
															</span>
															<span v-else>
																Actualizar Contraseña
															</span>
															</button> 
														</div>
													</div>   
												 
												 
													<!--end::Info-->
												</div> 
												  </form>

								 
											</div>
										</div>
										<!--end::Engage Widget 14-->
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
                </div>
                </div>
</template>
   
<script>
    export default {
        data() {
          return { 
			GuardandoCambios : false,
        	passValidate : false,
            form : {
                pass1:'',
                pass2:''
            },
		  }
		},
        mounted() {
			this.Buscar();
            console.log('mmm');
        },
		methods:{
				
			password_check: function () {
				var number = /\d/.test(this.form.pass1);
				var has_lowercase = /[a-z]/.test(this.form.pass1);
				var has_uppercase = /[A-Z]/.test(this.form.pass1);
				var has_special = /[!@#\$%\^\&*\)\(+=._-]/.test(this.form.pass1);

				if(!number || !has_lowercase || !has_uppercase || !has_special){
					this.passValidate = false;
				}else{
					this.passValidate = true;
				} 
			},
            Buscar() {
                var url = '/cliente/cliente';
                axios.get(url).then(response=>{
                    this.form = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
            }, 
			

          RegistarForm(evt) {

            evt.preventDefault();
    
			this.GuardandoCambios = !this.GuardandoCambios;

			var url = '/admin/actualizar_password';

			axios.post(url,{
				id: this.form.user_id,                
				password: this.form.pass1,                
				token         :   this.token
			}).then(response=>{
			
			if(!response.data.result){
				Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
				this.$toasted.error('Ha ocurrido algún error!');           
			}else{                 
				this.$toasted.success('Registro Eliminado Correctamente');
				
			}

			this.GuardandoCambios = !this.GuardandoCambios;
			this.form = {
                pass1:'',
                pass2:''
            };
		
			}).catch(error => {
				console.log(error);
				this.errors = error.response
			});

        }, 


		}
    }
</script>