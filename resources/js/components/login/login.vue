<template>
 
          <!--begin::Content body-->
        <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
            <!--begin::Signin-->
            <div class="login-form login-signin">
                <div class="text-center mb-10 mb-lg-20 text-white">
                                          <img src="assets/media/logos/logo-letter-1.png" class="w-75" alt="" />

                    <!-- <h3 class="font-size-h1">Iniciar sesión</h3>
                    <p class="text-muted font-weight-bold">Ingrese su email y contraseña</p> -->
                </div>

                <!--begin::Form-->
                <form @submit="onLogin" @reset="onReset" method="POST" enctype="multipart/form-data" class="form" id="kt_login_signin_form">
                  <p class="text-muted font-weight-bold text-center">Ingrese su email y contraseña</p>

                  <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-3 px-6 bg-white rounded-pill" type="text" placeholder="Email" name="username" autocomplete="off" v-model="login.email" required :class="{'is-invalid':!result_response_login}"/>
                    
                        <div class="col-md-12 text-left" v-if="!result_response_login">
                          <span role="alert">
                              <strong class="opacity-40">Email o Contraseña incorrecto</strong>
                          </span>
                        </div> 
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-3 px-6 bg-white rounded-pill" type="password" placeholder="Contraseña" name="password" autocomplete="off"  v-model="login.password" required :class="{'is-invalid':!result_response_login}"/>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="login.remember" id="remember">
                                <label class="form-check-label" for="remember">
                                   Rercordarme
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!--begin::Action-->
                    <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                      <button id="kt_login_signin_submit" class="btn btn-pill btn-primary btn-block opacity-90 px-15 py-3" :class="{'disabled':ini_sesion}" :disabled="disabled">
                        <span v-if="ini_sesion"> 
                          <i class="fa fa-spinner fa-spin"></i>
                          Iniciando Sesión
                        </span>
                        <span v-else>
                          Ingresar s
                        </span>
                      </button>  
                    </div>
                    
                    <a href="/auth/google" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">
                      <strong>Login With Google</strong>
                    </a> 
                    
                    <!--end::Action-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Signin-->
  
        </div> 
         

</template>


<script>
  export default {
    data() {
      return {
        ini_sesion : false,
        token   : csrf_token,
        login: {
          email: '',
          password: '',
          remember:false
        },
        result_response_login:true
      }
    },
    methods: {
  
        onLogin(evt) {
            evt.preventDefault();
            this.ini_sesion = true;
            var url = '/login-user';
            axios.post(url,{
              email        :   this.login.email,
              password   :   this.login.password,
              remember   :   this.login.remember,
              token         :   this.token
            }).then(response=>{ 
                this.result_response_login = response.data.registrado;

              if(!response.data.registrado){
                Vue.swal({
                  title: 'Error al ingresar...',
                  text: 'Email o Contraseña incorrecto!', 
                }); 
              }


                if(response.data.registrado && response.data.verificado){
                  localStorage.rol = response.data.usuario.rol; 
                  window.location.href = '/dashboard';
                }
                this.ini_sesion = false;

            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });

      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.login.email = '';
        this.login.password = '';
        this.login.remember = '';
        this.register.email = '';
        this.register.password = '';
        this.register.user = '';
      }

    },
    computed: {

      disabled: function(){
        return this.ini_sesion;
      }

    },
    
  }
</script>