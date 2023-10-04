exports.install = function (Vue, options) {
    Vue.prototype.AddRegister = function (options) {

        var _this = this;
        var data_form = options.data;
        var form = options.form; 
        this.GuardandoCambios = !this.GuardandoCambios;
        axios.post(options.url,data_form).then(response=>{
            
            this.GuardandoCambios = !this.GuardandoCambios;
            
            if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                _this.$toasted.error('Ha ocurrido algún error!');      
            }else{                 
                _this.$toasted.success(response.data.mensaje);
                
                 Object.keys(_this.form).forEach(function(key,index) {
                    _this.form[key] = '';
                }); 
              
                _this.MountFiles();

            }

        }).catch(error => {
            console.log(error);
            this.errors = error.response
        }); 
  
    };

    Vue.prototype.DeleteRegister = function (options) {

        var _this = this;
        
        Swal.fire({
            title: "Confirmar!",
            text: "Confirme que desea Eliminar este Registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Confirmar!",
            cancelButtonText: "No, Cancelar!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {    
                axios.post(options.url,{
                    _method: 'delete',                
                }).then(response=>{
                    if(!response.data.result){
                    Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                    _this.$toasted.error('Ha ocurrido algún error!');      
                }else{                 
                    // Swal.fire("Proceos Exitoso!", response.data.mensaje , "success");
                    _this.$toasted.success(response.data.mensaje); 
                    _this.Buscar();
                    }                      
                }).catch(error => {
                    console.log(error);
                    this.errors = error.response
                });
            }
        });
  
    };
    
    Vue.prototype.UpdateSetStatus = function (options) {

        var _this = this; 
        var data_form = options.data;
        Swal.fire({
            title: "Confirmar!",
            text: "Confirme que desea Actualizar el Estatus de este Registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Confirmar!",
            cancelButtonText: "No, Cancelar!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {    
                axios.post(options.url,data_form).then(response=>{
                    if(!response.data.result){
                    Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                    _this.$toasted.error('Ha ocurrido algún error!');      
                }else{                 
                    // Swal.fire("Proceos Exitoso!", response.data.mensaje , "success");
                    _this.$toasted.success(response.data.mensaje); 
                    // _this.Buscar();
                    }                      
                }).catch(error => {
                    console.log(error);
                    this.errors = error.response
                });
            }
        });
  
    };
      
};