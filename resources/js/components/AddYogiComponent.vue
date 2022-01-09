<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-info"
      data-toggle="modal"
      data-target="#yogiModel"
    >
      {{trans.get('button.create_yogi')}}
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="yogiModel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="yogiLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="yogiLabel">{{trans.get('button.create_yogi')}}</h5>
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
              <label for="yogi_name"
                >{{trans.get('input.name')}} <span class="text-danger">*</span></label
              >
              <input
                type="text"
                class="form-control"
                id="yogi_name"
                :placeholder="trans.get('input.name_placeholder')"
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
              <label for="yogi_phone">{{trans.get('input.phone')}} </label>
              <input
                type="text"
                class="form-control only-number"
                id="yogi_phone"
                :placeholder="trans.get('input.phone_placeholder')"
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
              <label for="ward">{{trans.get('input.select_ward')}} <span class="text-danger">*</span></label>
              <select2
                :url="fetchWard"
                placeholder="Select Ward"
                :value="data.ward_id"
                @input="selectedWardBox($event)"
                :selected-option="selectedWard"
                v-bind:class="{
                  'is-invalid': validation.ward_id_hasError,
                  'is-valid': submited && !validation.ward_id_hasError,
                }"
              ></select2>
              <div class="invalid-feedback" v-if="validation.ward_id_hasError">
                {{ validation.ward_id_errorMessage }}
              </div>

              <div
                class="valid-feedback"
                v-if="!validation.ward_id_hasError && submited"
              >
                {{ validation.ward_id_successMessage }}
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="create()">
              {{trans.get('button.create')}}
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              {{trans.get('button.close')}}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import select2 from "./select2";

export default {
  components: {
    select2,
  },
  data: function () {
    return {
      data: {
        name: "",
        phone: "",
        ward_id: "",
      },
      selectedWard: {},
      fetchWard: route("wards.fetch"),
      submited: false,
      validation: {
        name_hasError: false,
        name_errorMessage: "",
        name_successMessage: "",

        phone_hasError: false,
        phone_errorMessage: "",
        phone_successMessage: "",

        ward_id_hasError: false,
        ward_id_errorMessage: "",
        ward_id_successMessage: "",
      },
    };
  },
  methods: {
    create() {
      this.submited = true;
      let self = this;
      let url = route("yogis.store");

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
    selectedWardBox(event) {
      this.selectedWard = event;
      this.data.ward_id = event != null ? event.id : "";
    },
    clearValidation() {
      this.validation.name_hasError = false;
      this.validation.name_errorMessage = "";
      this.validation.name_successMessage = "";

      this.validation.phone_hasError = false;
      this.validation.phone_errorMessage = "";
      this.validation.phone_successMessage = "";

      this.validation.ward_id_hasError = false;
      this.validation.ward_id_errorMessage = "";
      this.validation.ward_id_successMessage = "";
    },
    constructValidation(validation) {
      if (validation.name) {
        this.validation.name_hasError = true;
        this.validation.name_errorMessage = validation.name[0];
        this.validation.name_successMessage = "Good Job";
      }

      if (validation.phone) {
        this.validation.phone_hasError = true;
        this.validation.phone_errorMessage = validation.phone[0];
        this.validation.phone_successMessage = "Good Job";
      }
      if (validation.ward_id) {
        this.validation.ward_id_hasError = true;
        this.validation.ward_id_errorMessage = validation.ward_id[0];
        this.validation.note_successMessage = "Good Job";
      }
    },
    clearData() {
      this.data.name = "";
      this.data.phone = "";
      this.data.ward_id = "";
      this.selectedWard = {};
      this.submited = false;
    },
  },
};
</script>