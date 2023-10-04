<div class="d-none onyl-desktop">
    
    <div class="d-flex d-flex justify-content-end"> 

        <a href="{{ url($url_back) }}" class="btn-icon btn-circle btn bg-secondary float-right">                
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
           </a> 
    </div>
    <div class="p-1 px-5 my-2 bg-white d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap bg-white" 
    style="background-image: url('{{$bg_image ?? null}}'); background-repeat: round;">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h4 class="text-dark font-weight-bold mt-2 mb-2 mr-5 text-capitalize">
                <i class="{{$fa_icon}}" aria-hidden="true"></i>
                {{$name_modulo}}
            </h4>                
        </div>
    </div>
</div>

<div class="bg-white d-none onyl-mobile p-3 bg-white mb-3" >
    <div class="d-flex align-items-center justify-content-between flex-wrap mr-2">
        <a href="{{ url($url_back) }}" class="btn-link btn-sm">                
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
           </a>  
        <h4 class="text-dark font-weight-bold mt-2 mb-2 text-capitalize">
            <i class="{{$fa_icon}}" aria-hidden="true"></i>
            {{$name_modulo}}
        </h4>   
        <button type="button" data-toggle="collapse" data-target="#contentSubMenu" aria-expanded="false"
        aria-controls="contentSubMenu" class="btn btn-icon btn-light-success   btn-sm mr-2">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button> 
    </div>
</div>

