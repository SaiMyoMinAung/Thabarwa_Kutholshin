<template>
    <div class="container">
        <NavbarComponent />
        
        <div class="main-body__container pt-5 mx-auto" style="width: 80%;">
            <router-view name="Content"></router-view>
        </div>
        
    </div>
</template>

<script type="text/javascript">
  import NavbarComponent from './NavbarComponent.vue'
  
  export default{
    components:{
      NavbarComponent
    },
    
  }

</script>