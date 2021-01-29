<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-info"
      data-toggle="modal"
      data-target="#unexpectedPersonModel"
    >
      Create Unexpected Person
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="unexpectedPersonModel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="unexpectedPersonLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="unexpectedPersonLabel">
              Create Unexpected Person
            </h5>
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
              <label for="person_name"
                >Name <span class="text-danger">*</span></label
              >
              <input
                type="text"
                class="form-control"
                id="person_name"
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
              Create
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
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
      },
      submited: false,
      validation: {
        name_hasError: false,
        name_errorMessage: "",
        name_successMessage: "",
      },
    };
  },
  methods: {
    clearValidation() {
      this.name_hasError = false;
      this.name_errorMessage = "";
      this.name_successMessage = "";
    },
    create() {
      let self = this;
      let url = route("unexpected_persons.store");

      window.dashboard_app.$emit("startLoading");

      axios
        .post(url, this.data)
        .then((response) => {
          this.clearValidation();
          this.name = "";

          window.dashboard_app.$emit("success", response.data);
          window.dashboard_app.$toasted.show("Saving Success.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        })
        .catch(function (error) {
          // window.dashboard_app.$emit('failed')
          console.log(error.response);
          let verror = error.response.data.errors;
          if (verror.name) {
            self.validation.name_hasError = true;
            self.validation.name_errorMessage = verror.name[0];
            self.validation.name_successMessage = "Good Job";
          }

          window.dashboard_app.$toasted.show("Saving Failed.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        });
    },
  },
};
</script>