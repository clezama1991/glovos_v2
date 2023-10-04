<template>
   <div 
    class="card-header flex-wrap border-0" 
    :class="{'pt-6 pb-0 bg-light-danger':tipo!='sub','p-4 bg-light-primary':tipo=='sub'}">
        <h6 
            class="card-title align-items-start flex-column " 
            :class="{'mb-0':tipo=='sub'}">
            <span class="card-label font-weight-bolder text-dark">
                <i :class="icon" class="text-dark" aria-hidden="true"></i>
                <span v-html="titulo"></span>
            </span>
        </h6>
    </div>
</template>
<script>
export default {
    props : ['icon','titulo','tipo']
}
</script>