// use <input v-model="my_input" v-init="'Hi!'" />
Vue.directive('init', {
  bind: function(el, binding, vnode) {
    vnode.context[binding.arg] = binding.value;
  }
});




Vue.directive('numero', {
    bind(el, binding, vnode) {
      let handlerInput = (e) => {
        const hasNumberRgx = /^[0-9.]*$/;
        const numberRgx = /[^0-9.]/g;
        if (hasNumberRgx.test(e.target.value) === false) {
          const start = e.target.selectionStart;
          const end = e.target.selectionEnd;
          e.target.value = e.target.value.replace(numberRgx, '');
          e.target.setSelectionRange(start, end);
          e.target.dispatchEvent(new CustomEvent('input'))
        }
      };
      el.addEventListener('input', handlerInput);
    }
  })

  Vue.directive('alfabeto', {
    bind(el, binding, vnode) {
      let handlerInput = (e) => {
        const hasAlphabeticRgx = /^[A-Za-z]+$/;
        const alphabeticRgx = /[^a-zA-Z]+/g;
        if (hasAlphabeticRgx.test(e.target.value) === false) {
          const start = e.target.selectionStart;
          const end = e.target.selectionEnd;
          e.target.value = e.target.value.replace(alphabeticRgx, '');
          e.target.setSelectionRange(start, end);
          e.target.dispatchEvent(new CustomEvent('input'))
        }
      };
      el.addEventListener('input', handlerInput);
    }
  })

  Vue.directive('max-length', {
    bind: function(el, binding) {
      let max_chars = binding.expression;
      let handlerInput = (e) => {
        if (e.target.value.length > max_chars) {
          e.target.value = e.target.value.substr(0, max_chars);
          e.target.dispatchEvent(new CustomEvent('input'))
        }
      };
      el.addEventListener('input', handlerInput);
    }
  })

  Vue.directive('mayuscula', {
    bind(el, binding, vnode) {
      let handlerInput = (e) => {
        const hasLowercaseRgx = /[a-z]/;
        if (hasLowercaseRgx.test(e.target.value) === true) {
          const start = e.target.selectionStart;
          const end = e.target.selectionEnd;
          e.target.value = e.target.value.toUpperCase()
          e.target.setSelectionRange(start, end);
          e.target.dispatchEvent(new CustomEvent('input'))
        }
      };
      el.addEventListener('input', handlerInput);
    }
  })

  Vue.directive('minuscula', {
    bind(el, binding, vnode) {
      let handlerInput = (e) => {
        const hasUppercaseRgx = /[A-Z]/;
        if (hasUppercaseRgx.test(e.target.value) === true) {
          const start = e.target.selectionStart;
          const end = e.target.selectionEnd;
          e.target.value = e.target.value.toLowerCase()
          e.target.setSelectionRange(start, end);
          e.target.dispatchEvent(new CustomEvent('input'))
        }
      };
      el.addEventListener('input', handlerInput);
    }
  })