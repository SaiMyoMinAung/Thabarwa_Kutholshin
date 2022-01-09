<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-sm btn-info"
      data-toggle="modal"
      data-target="#almsRoundModel"
    >
      +
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="almsRoundModel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="almsRoundLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="almsRoundLabel">{{trans.get("title.create_alms_round")}}</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name"
                >{{trans.get('input.alms_round')}} <span class="text-danger">*</span></label
              >
              <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Enter Name"
                v-model="data.name"
                v-bind:class="{
                  'is-invalid': validation.name_hasError,
                  'is-valid': submited && !validation.name_hasError,
                }"
              />

              <div class="invalid-feedback" v-if="validation.name_hasError">
                {{ validation.name_errorMessage }}
              </div>

              <div
                class="valid-feedback"
                v-if="!validation.name_hasError && submited"
              >
                {{ validation.name_successMessage }}
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="create()">
              {{trans.get("button.create")}}
            </button>
            <button
              type="button"
              id="almsRoundclose"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
             {{trans.get("button.close")}}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      data: {
        name: "",
        center_id: "",
      },
      submited: false,
      validation: {
        name_hasError: false,
        name_errorMessage: "",
        name_successMessage: "",
      },
    };
  },
  mounted() {
    let url = route("auth.admin.information");
    $.get(url)
      .then((response) => {
        this.data.center_id = response.center.id;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    create() {
      this.submited = true;
      let self = this;
      let url = route("alms_rounds.store");
      
      window.dashboard_app.$emit("startLoading");

      axios
        .post(url, this.data)
        .then((response) => {
          this.clearValidation();
          this.clearData();

          window.dashboard_app.$emit("almsRoundSuccess", response.data);
          window.dashboard_app.$toasted.show("Saving Success.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
          document.getElementById('almsRoundclose').click();
        })
        .catch(function (error) {
          // window.dashboard_app.$emit('failed')
          console.log(error.response);
          self.clearValidation();
          if(error.response.data){
            self.constructValidation(error.response.data.errors);
          }

          window.dashboard_app.$toasted.show("Saving Failed.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        });
    },
    clearValidation() {
      this.validation.name_hasError = false;
      this.validation.name_errorMessage = "";
      this.validation.name_successMessage = "";
    },
    constructValidation(validation) {
      if (validation.name) {
        this.validation.name_hasError = true;
        this.validation.name_errorMessage = validation.name[0];
      } else {
        this.validation.name_successMessage = "Good Job";
      }
    },
    clearData() {
      this.data.name = "";
      this.submited = false;
    },
  },
};
</script>