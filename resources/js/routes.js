module.exports = {

    routes: function () {
const routes = [
  { path: '/', redirect: '/clientes_alta', component: require('./components/clientes/layout.vue').default },
  { path: '/clientes_alta', component: require('./components/clientes/layout.vue').default },
  { path: '/clientes_baja', redirect: '/clientes_baja/todos', component: require('./components/clientes/layout.vue').default },
  { path: '/clientes_baja/todos', component: require('./components/clientes/layout.vue').default },
  { path: '/clientes_baja/competencias', component: require('./components/clientes/layout.vue').default },
  { path: '/clientes_baja/cierre', component: require('./components/clientes/layout.vue').default },
  { path: '/clientes_baja/impagos', component: require('./components/clientes/layout.vue').default },
  { path: '/clientes_contrato', component: require('./components/clientes/layout.vue').default },
  { path: '/clientes_presupuesto', component: require('./components/clientes/layout.vue').default },
  { path: '/registrar_cliente', component: require('./components/clientes/registrar_cliente/layout.vue').default },
  { path: '/consultar_cliente/:id', component: require('./components/clientes/consultar_cliente/layout.vue').default },

  { path: '/bandeja_avisos', redirect: '/bandeja_avisos/nuevos', component: require('./components/clientes/layout.vue').default },
  { path: '/bandeja_avisos/nuevos', component: require('./components/bandeja_avisos/layout.vue').default },
  { path: '/bandeja_avisos/no_impresos', component: require('./components/bandeja_avisos/layout.vue').default },
  { path: '/bandeja_avisos/automaticos', component: require('./components/bandeja_avisos/layout.vue').default },
  { path: '/bandeja_avisos/estimados', component: require('./components/bandeja_avisos/layout.vue').default },
  { path: '/bandeja_avisos/desprogramados', component: require('./components/bandeja_avisos/layout.vue').default },
  { path: '/bandeja_avisos/programados', component: require('./components/bandeja_avisos/layout.vue').default },

  { path: '/newsletter', component: require('./components/newsletter/layout.vue').default },
  { path: '/informes', component: require('./components/informes/layout.vue').default },
  { path: '/documentacion', component: require('./components/documentacion/layout.vue').default },

  { path: '/admin_usuarios', component: require('./components/administrador/usuarios/layout.vue').default },
  { path: '/admin_usuarios/:id', component: require('./components/administrador/usuarios/consultar/layout.vue').default },

  { path: '/admin_administracion', component: require('./components/administrador/administracion/layout.vue').default },

  //facturacion
  { path: '/productos', component: require('./components/facturacion/productos/layout.vue').default },
  { path: '/producto/:id', component: require('./components/facturacion/productos/consultar/body.vue').default },
  { path: '/registar_producto', component: require('./components/facturacion/productos/registrar/body.vue').default },

  { path: '/albaran', component: require('./components/facturacion/albaran/body.vue').default },
  { path: '/registar_albaran', component: require('./components/facturacion/albaran/registrar/body.vue').default },
]



    }
}