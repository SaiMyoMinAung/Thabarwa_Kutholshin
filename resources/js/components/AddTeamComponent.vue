<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-info"
      data-toggle="modal"
      data-target="#teamModel"
    >
      Create Team
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="teamModel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="teamLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="teamLabel">Create Team</h5>
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
              <label for="team_name"
                >Name <span class="text-danger">*</span></label
              >
              <input
                type="text"
                class="form-control"
                id="team_name"
                placeholder="Enter Team Name"
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
            <div class="form-group">
              <label for="team_email">Email</label>
              <input
                type="email"
                class="form-control"
                id="team_email"
                placeholder="Enter Team Name"
                v-model="data.email"
                v-bind:class="{
                  'is-invalid': validation.email_hasError,
                  'is-valid': submited && !validation.email_hasError,
                }"
              />

              <div class="invalid-feedback" v-if="validation.email_hasError">
                {{ validation.email_errorMessage }}
              </div>

              <div
                class="valid-feedback"
                v-if="!validation.email_hasError && submited"
              >
                {{ validation.email_successMessage }}
              </div>
            </div>
            <div class="form-group">
              <label for="team_phone"
                >Team Phone <span class="text-danger">*</span></label
              >
              <input
                type="text"
                class="form-control only-number"
                id="team_phone"
                placeholder="Enter Team Phone"
                v-model="data.phone"
                v-bind:class="{
                  'is-invalid': validation.phone_hasError,
                  'is-valid': submited && !validation.phone_hasError,
                }"
              />

              <div class="invalid-feedback" v-if="validation.phone_hasError">
                {{ validation.phone_errorMessage }}
              </div>

              <div
                class="valid-feedback"
                v-if="!validation.phone_hasError && submited"
              >
                {{ validation.phone_successMessage }}
              </div>
            </div>
            <div class="form-group">
              <label>Note</label>
              <textarea
                name="note"
                class="form-control"
                rows="3"
                placeholder="Enter Note"
                v-model="data.note"
                v-bind:class="{
                  'is-invalid': validation.note_hasError,
                  'is-valid': submited && !validation.note_hasError,
                }"
              ></textarea>

              <div class="invalid-feedback" v-if="validation.note_hasError">
                {{ validation.note_errorMessage }}
              </div>

              <div
                class="valid-feedback"
                v-if="!validation.note_hasError && submited"
              >
                {{ validation.note_successMessage }}
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
        email: "",
        phone: "",
        note: "",
        center_id: "",
      },
      submited: false,
      validation: {
        name_hasError: false,
        name_errorMessage: "",
        name_successMessage: "",

        email_hasError: false,
        email_errorMessage: "",
        email_successMessage: "",

        phone_hasError: false,
        phone_errorMessage: "",
        phone_successMessage: "",

        note_hasError: false,
        note_errorMessage: "",
        note_successMessage: "",
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
      let url = route("teams.store");

      window.dashboard_app.$emit("startLoading");

      axios
        .post(url, this.data)
        .then((response) => {
          this.clearValidation();
          this.clearData();

          window.dashboard_app.$emit("success", response.data);
          window.dashboard_app.$toasted.show("Saving Success.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        })
        .catch(function (error) {
          // window.dashboard_app.$emit('failed')
          console.log(error.response);
          self.constructValidation(error.response.data.errors);

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

      this.validation.email_hasError = false;
      this.validation.email_errorMessage = "";
      this.validation.email_successMessage = "";

      this.validation.phone_hasError = false;
      this.validation.phone_errorMessage = "";
      this.validation.phone_successMessage = "";

      this.validation.note_hasError = false;
      this.validation.note_errorMessage = "";
      this.validation.note_successMessage = "";
    },
    constructValidation(validation) {
      if (validation.name) {
        this.validation.name_hasError = true;
        this.validation.name_errorMessage = validation.name[0];
        this.validation.name_successMessage = "Good Job";
      }
      if (validation.email) {
        this.validation.email_hasError = true;
        this.validation.email_errorMessage = validation.email[0];
        this.validation.email_successMessage = "Good Job";
      }
      if (validation.phone) {
        this.validation.phone_hasError = true;
        this.validation.phone_errorMessage = validation.phone[0];
        this.validation.phone_successMessage = "Good Job";
      }
      if (validation.note) {
        this.validation.note_hasError = true;
        this.validation.note_errorMessage = validation.note[0];
        this.validation.note_successMessage = "Good Job";
      }
      if (validation.center_id) {
        this.validation.center_id_hasError = true;
        this.validation.center_id_errorMessage = validation.center_id[0];
        this.validation.center_id_successMessage = "Good Job";
      }
    },
    clearData() {
      this.data.name = "";
      this.data.email = "";
      this.data.phone = "";
      this.data.note = "";
      this.submited = false;
    },
  },
};
</script>