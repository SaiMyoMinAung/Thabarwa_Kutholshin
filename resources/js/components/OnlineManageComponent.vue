<template>
  <div class="col-md-12">
    <loading
      :active.sync="isLoading"
      :can-cancel="true"
      :is-full-page="fullPage"
    ></loading>
    <h4>
      <span class="">{{ model.about_item }}</span>
      <span class="badge badge-primary">{{ model.statusName }}</span>
    </h4>
    <div class="bs-stepper">
      <div class="bs-stepper-header">
        <div class="step" @click="changeStep('step1')">
          <button type="button" class="btn step-trigger">
            <span
              class="bs-stepper-circle"
              :class="{
                'badge-primary': steps.step1,
                'badge-success': model.is_done_pickingup,
              }"
              >1</span
            >
            <span
              class="bs-stepper-label"
              :class="{
                'text-primary': steps.step1,
              }"
              >Assign Driver Step</span
            >
          </button>
        </div>
        <div class="line"></div>
        <div class="step" @click="changeStep('step2')">
          <div class="btn step-trigger">
            <span
              class="bs-stepper-circle"
              :class="{
                'badge-primary': steps.step2,
                'badge-success': model.is_done_storing,
              }"
              >2</span
            >
            <span
              class="bs-stepper-label"
              :class="{ 'text-primary': steps.step2 }"
              >Assign Store Keeper Step</span
            >
          </div>
        </div>
        <div class="line"></div>
        <div class="step" @click="changeStep('step3')">
          <button type="button" class="btn step-trigger">
            <span
              class="bs-stepper-circle"
              :class="{
                'badge-primary': steps.step3,
                'badge-success':
                  (model.is_required_repairing &&
                    model.is_done_repairing &&
                    model.repaired_volunteer_id != null) ||
                  (model.repaired_volunteer_id == null &&
                    !model.is_required_repairing),
              }"
              >3</span
            >
            <span
              class="bs-stepper-label"
              :class="{ 'text-primary': steps.step3 }"
              >Assign Repairer Step</span
            >
          </button>
        </div>
        <div class="line"></div>
        <div class="step" @click="changeStep('step4')">
          <button type="button" class="btn step-trigger">
            <span
              class="bs-stepper-circle"
              :class="{
                'badge-primary': steps.step4,
                'badge-success': model.is_complete,
              }"
              >4</span
            >
            <span
              class="bs-stepper-label"
              :class="{ 'text-primary': steps.step4 }"
              >Assign Complete Step</span
            >
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <div class="content" :class="{ active: steps.step1 }">
          <div class="row p-2 rounded">
            <div class="col-md-6">
              <div
                class="form-group"
                v-bind:class="{
                  'has-error': step1.validation.pickedup_volunteer_id_hasError,
                  'was-validated':
                    step1.validation.pickedup_volunteer_id_successMessage &&
                    !step1.validation.pickedup_volunteer_id_hasError,
                }"
              >
                <label for="pickedup_volunteer">
                  Assign Driver <span class="text-danger">*</span>
                </label>

                <select2
                  :url="step1.getVolunteerUrl"
                  :placeholder="step1.placeholder"
                  :value="step1.data.pickedup_volunteer_id"
                  @input="step1.selectedPickedupVolunteer($event)"
                  :selected-option="step1.pickedup_volunteer"
                  :disabled="model.is_pickingup"
                  v-bind:class="{
                    'is-invalid':
                      step1.validation.pickedup_volunteer_id_hasError,
                  }"
                ></select2>

                <div class="invalid-feedback">
                  {{ step1.validation.pickedup_volunteer_id_errorMessage }}
                </div>
                <div class="valid-feedback" style="display: block">
                  {{ step1.validation.pickedup_volunteer_id_successMessage }}
                </div>
              </div>

              <div class="row">
                <div class="col-md-2" v-if="!model.is_pickingup">
                  <yesno
                    text="Assign"
                    addClass="btn-primary"
                    @confirmed="step1.assignDriver()"
                  ></yesno>
                </div>
                <div
                  class="col-md-5"
                  v-if="
                    model.pickedup_volunteer_id != null && !model.is_pickingup
                  "
                >
                  <yesno
                    text="Change Pickingup State"
                    addClass="btn-danger"
                    @confirmed="step1.changePickingUpState()"
                  ></yesno>
                </div>
                <div
                  class="col-md-4"
                  v-if="
                    model.pickedup_volunteer_id != null &&
                    model.is_pickingup &&
                    !model.is_done_pickingup
                  "
                >
                  <yesno
                    text="Done Pickingup"
                    addClass="btn-success"
                    @confirmed="step1.changeDonePickingUpState()"
                  ></yesno>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content" :class="{ active: steps.step2 }">
          <div class="row p-2 rounded">
            <div class="col-md-6">
              <!-- start transition error -->
              <div
                class="form-group"
                v-bind:class="{
                  'has-error': step2.validation.transition_error_hasError,
                  'was-validated': !step2.validation.transition_error_hasError,
                }"
              >
                <input type="hidden" class="is-invalid" disabled />
                <div class="invalid-feedback">
                  {{ step2.validation.transition_error_errorMessage }}
                </div>
              </div>
              <!-- end transition error -->

              <!-- start store keeper select box -->
              <div
                class="form-group"
                v-bind:class="{
                  'has-error':
                    step2.validation.store_keeper_volunteer_id_hasError,
                  'was-validated':
                    step2.validation.store_keeper_volunteer_id_successMessage &&
                    !step2.validation.store_keeper_volunteer_id_hasError,
                }"
              >
                <label for="store_keeper_volunteer">
                  Assign Store Keeper <span class="text-danger">*</span>
                </label>

                <select2
                  :url="step2.getVolunteerUrl"
                  :placeholder="step2.placeholder"
                  :value="step2.data.store_keeper_volunteer_id"
                  :disabled="model.is_storing"
                  @input="step2.selectedStoreKeeperVolunteer($event)"
                  :selected-option="step2.store_keeper_volunteer"
                  v-bind:class="{
                    'is-invalid':
                      step2.validation.store_keeper_volunteer_id_hasError,
                  }"
                ></select2>

                <div class="invalid-feedback">
                  {{ step2.validation.store_keeper_volunteer_id_errorMessage }}
                </div>
                <div class="valid-feedback" style="display: block">
                  {{
                    step2.validation.store_keeper_volunteer_id_successMessage
                  }}
                </div>
              </div>
              <!-- end store keeper select box -->

              <!-- start store select box -->
              <div
                class="form-group"
                v-bind:class="{
                  'has-error': step2.validation.store_id_hasError,
                  'was-validated':
                    step2.validation.store_id_successMessage &&
                    !step2.validation.store_id_hasError,
                }"
              >
                <label> Select Store <span class="text-danger">*</span> </label>

                <select2
                  :url="step2.getStoreUrl"
                  :placeholder="step2.placeholderForStore"
                  :value="step2.data.store_id"
                  :disabled="model.is_storing"
                  @input="step2.selectedStore($event)"
                  :selected-option="step2.store"
                  v-bind:class="{
                    'is-invalid': step2.validation.store_id_hasError,
                  }"
                ></select2>

                <div class="invalid-feedback">
                  {{ step2.validation.store_id_errorMessage }}
                </div>
                <div class="valid-feedback" style="display: block">
                  {{ step2.validation.store_id_successMessage }}
                </div>
              </div>
              <!-- end store select box -->

              <!-- start box select box -->
              <div
                class="form-group"
                v-bind:class="{
                  'has-error': step2.validation.box_id_hasError,
                  'was-validated':
                    step2.validation.box_id_successMessage &&
                    !step2.validation.box_id_hasError,
                }"
              >
                <label> Select Box <span class="text-danger">*</span> </label>

                <select2
                  :url="step2.getBoxUrl"
                  :placeholder="step2.placeholderForBox"
                  :value="step2.data.box_id"
                  :disabled="model.is_storing"
                  @input="step2.selectedBox($event)"
                  :selected-option="step2.box"
                  v-bind:class="{
                    'is-invalid': step2.validation.box_id_hasError,
                  }"
                ></select2>

                <div class="invalid-feedback">
                  {{ step2.validation.box_id_errorMessage }}
                </div>
                <div class="valid-feedback" style="display: block">
                  {{ step2.validation.box_id_successMessage }}
                </div>
              </div>
              <!-- end box select box -->

              <div class="row">
                <div class="col-md-3" v-if="!model.is_storing">
                  <yesno
                    text="Assign"
                    addClass="btn-primary"
                    @confirmed="step2.assignStoreKeeper()"
                  ></yesno>
                </div>
                <div
                  class="col-md-5"
                  v-if="
                    model.store_keeper_volunteer_id != null && !model.is_storing
                  "
                >
                  <yesno
                    text="Change Storing State"
                    addClass="btn-danger"
                    @confirmed="step2.changeStoringState()"
                  ></yesno>
                </div>

                <div
                  class="col-md-4"
                  v-if="
                    model.store_keeper_volunteer_id != null &&
                    model.is_storing &&
                    !model.is_done_storing
                  "
                >
                  <yesno
                    text="Done Storing"
                    addClass="btn-success"
                    @confirmed="step2.changeDoneStoringState()"
                  ></yesno>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content" :class="{ active: steps.step3 }">
          <div class="row p-2 rounded">
            <div class="col-md-6">
              <!-- start transition error -->
              <div
                class="form-group"
                v-bind:class="{
                  'has-error': step3.validation.transition_error_hasError,
                  'was-validated': !step3.validation.transition_error_hasError,
                }"
              >
                <input type="hidden" class="is-invalid" disabled />
                <div class="invalid-feedback">
                  {{ step3.validation.transition_error_errorMessage }}
                </div>
              </div>
              <!-- end transition error -->

              <!-- start repairer select -->
              <div
                class="form-group"
                v-bind:class="{
                  'has-error': step3.validation.repairing_id_hasError,
                  'was-validated':
                    step3.validation.repairing_id_successMessage &&
                    !step3.validation.repairing_id_hasError,
                }"
                v-if="model.is_required_repairing || step3.showForm"
              >
                <label>
                  Select Repairer <span class="text-danger">*</span>
                </label>

                <select2
                  :url="step3.getVolunteerUrl"
                  :placeholder="step3.placeholder"
                  :value="step3.data.repaired_volunteer_id"
                  :disabled="model.is_repairing"
                  @input="step3.selectedRepairerVolunteer($event)"
                  :selected-option="step3.repaired_volunteer"
                  v-bind:class="{
                    'is-invalid':
                      step3.validation.repaired_volunteer_id_hasError,
                  }"
                ></select2>

                <div class="invalid-feedback">
                  {{ step3.validation.repaired_volunteer_id_errorMessage }}
                </div>
                <div class="valid-feedback" style="display: block">
                  {{ step3.validation.repaired_volunteer_id_successMessage }}
                </div>
              </div>
              <!-- end repairer select -->

              <div class="row">
                <div
                  class="col-md-2"
                  v-if="!model.is_repairing && model.is_required_repairing"
                >
                  <yesno
                    text="Assign"
                    addClass="btn-primary"
                    @confirmed="step3.assignRepairer()"
                  ></yesno>
                </div>

                <div
                  class="col-md-5"
                  v-if="
                    model.repaired_volunteer_id != null && !model.is_repairing
                  "
                >
                  <yesno
                    text="Change Repairing State"
                    addClass="btn-danger"
                    @confirmed="step3.changeRepairingState()"
                  ></yesno>
                </div>

                <div
                  class="col-md-5"
                  v-if="
                    model.repaired_volunteer_id != null &&
                    model.is_repairing &&
                    !model.is_done_repairing
                  "
                >
                  <yesno
                    text="Done Repairing"
                    addClass="btn-success"
                    @confirmed="step3.changeDoneRepairingState()"
                  ></yesno>
                </div>

                <div
                  class="col-md-4"
                  v-if="
                    !model.is_required_repairing &&
                    model.delivered_volunteer_id == null
                  "
                >
                  <yesno
                    text="Required To Repair"
                    addClass="btn-success"
                    @confirmed="step3.requiredRepairing()"
                  ></yesno>
                </div>

                <div
                  class="col-md-5"
                  v-if="
                    model.repaired_volunteer_id == null &&
                    model.delivered_volunteer_id == null
                  "
                >
                  <yesno
                    text="Not Required To Repair"
                    addClass="btn-warning"
                    @confirmed="step3.notRequiredRepairing()"
                  ></yesno>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content" :class="{ active: steps.step4 }">
          <div class="row p-2 rounded">
            <div class="col-md-6">
              <!-- start transition error -->
              <div
                class="form-group"
                v-bind:class="{
                  'has-error': step4.validation.transition_error_hasError,
                  'was-validated': !step4.validation.transition_error_hasError,
                }"
              >
                <input type="hidden" class="is-invalid" disabled />
                <div class="invalid-feedback">
                  {{ step4.validation.transition_error_errorMessage }}
                </div>
              </div>
              <!-- end transition error -->

              <yesno
                v-if="!model.is_complete"
                text="Change Complete And Publish"
                addClass="btn-success"
                @confirmed="step4.assignComplete()"
              ></yesno>
              <yesno
                v-if="model.is_complete"
                text="Change Incomplete And Undo"
                addClass="btn-danger"
                @confirmed="step4.assignIncomplete()"
              ></yesno>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import select2 from "./select2";
import yesno from "./yesno";
import step1 from "../models/online_manage_component/step1";
import step2 from "../models/online_manage_component/step2";
import step3 from "../models/online_manage_component/step3";
import step4 from "../models/online_manage_component/step4";
import Loading from "vue-loading-overlay";

export default {
  props: {
    model: {
      required: true,
    },
  },
  created() {
    let visitedStep = localStorage.getItem("visited-step");

    if (visitedStep != null) {
      this.makeActive(visitedStep);
    }

    console.log(this.model);
    this.step1 = new step1();
    this.step1.constructData(this.model);

    this.step2 = new step2();
    this.step2.constructData(this.model);

    this.step3 = new step3();
    this.step3.constructData(this.model);

    this.step4 = new step4();
    this.step4.constructData(this.model);

    this.$root.$on("startLoading", () => {
      this.isLoading = true;
    });
    this.$root.$on("endLoading", () => {
      this.isLoading = false;
    });

    this.$root.$on("success", (data) => {
      Object.assign(this.model, data);
    });

    this.$root.$on("failed", (data) => {
      this.step1.constructData(this.model);
    });
  },
  components: {
    select2,
    Loading,
    yesno,
  },
  data() {
    return {
      fullPage: false,
      isLoading: false,
      step1: null,
      step2: null,
      step3: null,
      step4: null,
      steps: {
        step1: true,
        step2: false,
        step3: false,
        step4: false,
      },
    };
  },
  methods: {
    changeStep(step) {
      this.makeActive(step);
      localStorage.setItem("visited-step", step);
    },
    makeActive(step) {
      const keys = Object.keys(this.steps);
      keys.forEach((key, index) => {
        key == step ? (this.steps[key] = true) : (this.steps[key] = false);
      });
    },
  },
};
</script>