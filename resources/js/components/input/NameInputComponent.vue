<template>
  <div>
    <b-form-group
      id="name"
      label="Name"
      label-cols-sm="3"
      label-for="name"
      :invalid-feedback="invalidFeedback"
      :valid-feedback="validFeedback"
      :state="state"
    >
      <b-form-input id="name" v-model="name" :state="state" :maxlength="max" trim></b-form-input>
    </b-form-group>
  </div>
</template>

<script>
  export default {
    computed: {
      state() {
        if(this.name.length > 10 && this.name.length < 20){
            return true;
        } else if(this.name.length > 40 ){
            return false;
        } else {
            return null;
        }
        
      },
      invalidFeedback() {
        return this.state === false ? 'Too Long!' : '';
      },
      validFeedback() {
        return this.state === true ? 'Success' : '';
      }
    },
    data() {
      return {
        max: 50,
        name: ''
      }
    }
  }
</script>