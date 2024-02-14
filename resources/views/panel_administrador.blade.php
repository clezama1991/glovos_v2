@extends('layouts.app')

@section('content')

    <div id="msg-token-caduc" class="alert alert-success d-none" role="alert">
      <h4 class="alert-heading">Token Autenticación de Google Contacts ha caducado!</h4>
      <p></p>
      <p class="mb-0"> 
        Para reanudar la sincronización de los contactos con tu cuenta, renueva el token de autenticación en el siguiente botón.  
      </p>
      <a name="" id="authorize_button" onclick="handleAuthClick()" class="btn btn-primary" href="#" role="button">Autorizar</a>
    </div>


    <transition name="fade" mode="out-in">
        <router-view />
    </transition>
    <div class='d-none'>
 
    <pre id="content" style="white-space: pre-wrap;"></pre>
 
    </div>
@endsection

    
@section('script')

<script type="text/javascript">
  
  
  // notams.fetch([ 'PADK', 'PADU' ], { format: 'DOMESTIC' }).then(results => {
  //   console.log(JSON.stringify(results, null, 2))
  // })



  const CLIENT_ID = '{{$CLIENT_ID}}';   
  //const CLIENT_ID = '417049974242-6i1i7n3vl0n68lj86a8u9csj8qm9djnv.apps.googleusercontent.com';

  const API_KEY = '{{$API_KEY}}';   
  //const API_KEY = 'AIzaSyCJxgFVtwD8_WIGNkObqIKVX-leShgrY-Q';
  
  const ACCESS_TOKEN = '{{$ACCESS_TOKEN}}';   
  //const ACCESS_TOKEN = localStorage.getItem('token');
  
  

  var pedidos_sinc = <?php echo json_encode($pedidos_sinc); ?>;
    console.log(pedidos_sinc);


  const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/people/v1/rest';

  const SCOPES = 'https://www.googleapis.com/auth/contacts';

  let tokenClient;
  let gapiInited = false;
  let gisInited = false;

  document.getElementById('authorize_button').style.visibility = 'hidden';
  document.getElementById('signout_button').style.visibility = 'hidden';

  function gapiLoaded() {
    gapi.load('client', initializeGapiClient); 
  }
  
  function saludos(){
  console.log("Hola Mundo");
}
 
  async function initializeGapiClient() {
    await gapi.client.init({
      apiKey: API_KEY, 
      discoveryDocs: [DISCOVERY_DOC],
    });
    gapi.client.setToken({access_token:ACCESS_TOKEN}) 
    gapiInited = true;
    maybeEnableButtons();
    
    $.each(pedidos_sinc, function(i, field) {
        CreateContact(field['nombre_contacto'], field['telefono_contacto'], field['id']); 
    });

   }

  function gisLoaded() {
    tokenClient = google.accounts.oauth2.initTokenClient({
      client_id: CLIENT_ID,
      scope: SCOPES,
      callback: '',
    });
    gisInited = true;
    maybeEnableButtons();
  }

  function maybeEnableButtons() {
    if (gapiInited && gisInited) {
      document.getElementById('authorize_button').style.visibility = 'visible';
    }
  }

  function handleAuthClick() {
    tokenClient.callback = async (resp) => {
      if (resp.error !== undefined) {
        throw (resp);
      }
      
      RenovarTokensGoogle(gapi.client.getToken().access_token);
    };

    if (gapi.client.getToken() === null) {
      tokenClient.requestAccessToken({prompt: 'consent'});
    } else {
      tokenClient.requestAccessToken({prompt: ''});
    }
  }
  
  function handleSignoutClick() {
 
    if (token !== null) {
      google.accounts.oauth2.revoke(token.access_token);
      gapi.client.setToken('');
      document.getElementById('content').innerText = '';
      document.getElementById('authorize_button').innerText = 'Authorize';
      document.getElementById('signout_button').style.visibility = 'hidden';
    }
  }

  async function CreateContact(nombre, telefono, id) { 
    let response; 
    try {  
      response = await gapi.client.request({
        'method': "POST",
        'path': 'https://people.googleapis.com/v1/people:createContact',
        'datatype': 'jsonp',
        'parent': nombre,
        'body': {
            "names": [
                {
                    "givenName": nombre
                }
            ], 
            "phoneNumbers": [
                {
                    "value": telefono
                }
            ]
        }
    })
    requestSincGoogle(id); 
    } catch (err) {  
 
      $('#msg-token-caduc').removeClass('d-none');
      return;
    }
     


};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function requestSincGoogle(id) {
    $.ajax({
        url: '/admin/update_sinc_google/' + id,
        type: 'get',
        contentType: 'application/json',
        success: function(res) {
             
        },
        error: function(err) {
            done(err)
        }
    });
}


function RenovarTokensGoogle(token) {
   
  $.ajax({
      type: 'POST',
      url: '/admin/update_configs_by_key',
      data: {
          key: 'google_Account_ACCESS_TOKEN',
          valor: token,
          '_token': '{{ csrf_token() }}'
      },
      success: function(data) {
        location.reload();
      }
  });
}

</script>
<script async defer src='https://apis.google.com/js/api.js' onload='gapiLoaded()'></script>
<script async defer src='https://accounts.google.com/gsi/client' onload='gisLoaded()'></script>
@endsection
