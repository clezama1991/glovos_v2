exports.install = function (Vue, options) {
    Vue.prototype.text1 = function () {// Función global 1
      alert ('Ejecución exitosa 1');
 };
      Vue.prototype.text2 = function () {// Función global 2
      alerta ('Ejecución exitosa 2');
 };
};