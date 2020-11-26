<template>
  <div class="col-md-12">
    <!-- Modal -->
    <div
      class="modal fade"
      id="showDetailModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="showDetailModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showDetailModalLabel">
              Requested Person Detail
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
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Name - {{ getDetailData("name") }}
              </li>
              <li class="list-group-item">
                Email - {{ getDetailData("email") }}
              </li>
              <li class="list-group-item">
                Phone - {{ getDetailData("phone") }}
              </li>

              <!-- Location For Team Table -->
              <li class="list-group-item" v-if="hasDetailData('center')">
                Location - ({{ getDetailData("center").name }},
                {{
                  getDetailData("center").city
                    ? getDetailData("center").city.name
                    : "-"
                }})
              </li>

              <!-- Location For User Table -->
              <li class="list-group-item" v-if="hasDetailData('city')">
                Location - ({{ getDetailData("city").name }})
                {{ hasDetailData("ward") ? getDetailData("ward").name : "" }}
              </li>
            </ul>
          </div>
          <div class="modal-footer">
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
    <!-- end model -->
    <!--Start Header Section -->
    <div class="row">
      <div class="col-md-3 text-center">
        <button class="btn btn-outline-primary mb-1" @click="createRequest">
          Create Request
        </button>
      </div>
      <div class="col-md-3">
        <h4>
          Item Unique Id -
          <span class="badge badge-success">
            {{ model.donated_item.item_unique_id }}
          </span>
        </h4>
      </div>
      <div class="col-md-3">
        <h4>
          Item Unique Id -
          <span class="badge badge-success">
            {{ model.donated_item.about_item }}
          </span>
        </h4>
      </div>
      <div class="col-md-3">
        <h4>
          Donor Name -
          <span class="badge badge-primary">
            {{ model.donated_item.donor_name }}
          </span>
        </h4>
      </div>
    </div>
    <!-- End Header Section -->

    <!-- Start Create Request -->
    <div class="row" v-if="showCreate">
      <div class="col-md-6 card border border-success">
        <div class="card-body">
          <!-- Start Group Select box -->
          <div
            class="form-group"
            v-bind:class="{
              'has-error': create_request_item.requestable_type_hasError,
              'was-validated':
                create_request_item.requestable_type_successMessage &&
                !create_request_item.requestable_type_hasError,
            }"
          >
            <label for="delivered_volunteer">
              Select Group
              <span class="text-danger">*</span>
            </label>

            <select2
              :url="create_request_item.getRequestableTypeUrl"
              placeholder="Select Group"
              :value="create_request_item.data.requestable_type"
              :disabled="false"
              @input="create_request_item.selectedRequestableType($event)"
              :selected-option="create_request_item.requestable_type"
              v-bind:class="{
                'is-invalid':
                  create_request_item.validation.requestable_type_hasError,
              }"
            ></select2>

            <div class="invalid-feedback">
              {{ create_request_item.validation.requestable_type_errorMessage }}
            </div>
            <div class="valid-feedback" style="display: block">
              {{
                create_request_item.validation.requestable_type_successMessage
              }}
            </div>
          </div>
          <!-- End Group Select box -->

          <!-- Start User Select box -->
          <div
            class="form-group"
            v-bind:class="{
              'has-error':
                create_request_item.validation.requestable_id_hasError,
              'was-validated':
                create_request_item.validation.requestable_id_successMessage &&
                !create_request_item.validation.requestable_id_hasError,
            }"
          >
            <label for="delivered_volunteer">
              Select Requestable Person
              <span class="text-danger">*</span>
            </label>

            <select2
              :url="create_request_item.fetchUrl"
              :fetch="create_request_item.startFetchForRequestablePerson"
              placeholder="Select Team Or Person Or Yogi"
              :value="create_request_item.data.requestable_id"
              :disabled="false"
              @input="create_request_item.selectedRequestableId($event)"
              :selected-option="create_request_item.requestable"
              v-bind:class="{
                'is-invalid':
                  create_request_item.validation.requestable_id_hasError,
              }"
            ></select2>

            <div class="invalid-feedback">
              {{ create_request_item.validation.requestable_id_errorMessage }}
            </div>
            <div class="valid-feedback" style="display: block">
              {{ create_request_item.validation.requestable_id_successMessage }}
            </div>
          </div>
          <!-- End User Select box -->

          <!-- start qty -->
          <div
            class="form-group"
            v-bind:class="{
              'has-error': create_request_item.validation.qty_hasError,
              'was-validated':
                create_request_item.validation.validation != null &&
                !create_request_item.validation.qty_hasError,
            }"
          >
            <label for="qty">
              QTY
              <span class="text-danger">*</span>
            </label>
            <input
              id="qty"
              type="number"
              class="form-control"
              placeholder="qty"
              v-model="create_request_item.data.qty"
              v-bind:class="{
                'is-invalid': create_request_item.validation.qty_hasError,
              }"
            />
            <div class="invalid-feedback">
              {{ create_request_item.validation.qty_errorMessage }}
            </div>
            <div class="valid-feedback">
              {{ create_request_item.validation.qty_successMessage }}
            </div>
          </div>
          <!-- end qty -->

          <button class="btn btn-default" @click="cancelCreateRequestItem">
            Cancel
          </button>
          <button @click="saveRequestItem" class="btn btn-success">
            Create
          </button>
        </div>
      </div>
    </div>
    <!-- End Create Request -->

    <!-- Start Table -->
    <table
      class="table table-hover table-dark"
      cellpadding="0"
      cellspacing="0"
      v-if="showTable"
    >
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Request No</th>
          <th scope="col">Request Person</th>
          <th scope="col">Qty</th>
          <th scope="col">Delivered By</th>
          <th scope="col">State</th>
          <th scope="col">Manage</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in model.requested_items.data" :key="item.id">
          <th scope="row">{{ index + 1 }}</th>
          <td style="max-width: 20px">{{ item.request_no }}</td>
          <td style="max-width: 20px">
            <div class="float-left mr-3">
              {{ item.requested_user.name }}
            </div>
            <div class="float-left mr-3">
              <!-- Button trigger modal -->
              <button
                type="button"
                class="btn btn-outline-primary btn-xs"
                @click="showDetailModal(index)"
              >
                Show Detail
              </button>
            </div>
          </td>
          <td style="max-width: 20px">{{ item.qty }}</td>
          <td style="max-width: 20px">
            {{
              item.delivered_volunteer_id != null
                ? item.delivered_volunteer.name
                : "-"
            }}
          </td>
          <td style="min-width: 20px">
            <span class="badge badge-primary">{{ item.status }}</span>
          </td>
          <td style="min-width: 20px">
            <div class="float-left mr-3" v-if="!item.is_cancel">
              <yesno
                text="Manage"
                addClass="btn-outline-success"
                @confirmed="manageRequestItem(index)"
              ></yesno>
            </div>
            <div
              class="float-left"
              v-if="!item.is_cancel && item.delivered_volunteer_id == null"
            >
              <yesno
                text="Cancel"
                addClass="btn-outline-danger"
                @confirmed="cancelRequestItem(index)"
              ></yesno>
            </div>
            <div class="float-left" v-if="item.is_cancel">
              <yesno
                text="Recover"
                addClass="btn-outline-warning"
                @confirmed="recoverRequestItem(index)"
              ></yesno>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <pagination
      v-if="showTable"
      :data="model.requested_items"
      align="center"
      v-on:pagination-change-page="getRequestItemsResult"
    ></pagination>
    <!-- End Table -->

    <!-- Start Stepper -->
    <div v-if="showManage">
      <table
        class="table table-hover table-dark"
        cellpadding="0"
        cellspacing="0"
      >
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Request No</th>
            <th scope="col">Request Person</th>
            <th scope="col">Qty</th>
            <th scope="col">Delivered By</th>
            <th scope="col">State</th>
            <th scope="col">Show All</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td style="max-width: 20px">
              {{ manage.requested_item.request_no }}
            </td>
            <td style="max-width: 20px">
              {{ manage.requested_item.requested_user.name }}
            </td>
            <td style="max-width: 20px">{{ manage.requested_item.qty }}</td>
            <td style="max-width: 20px">
              {{
                manage.requested_item.delivered_volunteer_id != null
                  ? manage.requested_item.delivered_volunteer.name
                  : "-"
              }}
            </td>
            <td style="min-width: 20px">
              <span class="badge badge-primary">{{
                manage.requested_item.status
              }}</span>
            </td>
            <td style="max-width: 20px">
              <yesno
                text="Show All"
                addClass="btn-outline-primary"
                @confirmed="showAll"
              ></yesno>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="bs-stepper p-3 border border-primary rounded">
        <div class="bs-stepper-header">
          <div class="step" @click="changeStep('step1')">
            <button type="button" class="btn step-trigger">
              <span
                class="bs-stepper-circle"
                :class="{
                  'badge-primary': steps.step1,
                  'badge-success': manage.requested_item.is_done_delivering,
                }"
                >1</span
              >
              <span
                class="bs-stepper-label"
                :class="{
                  'text-primary': steps.step1,
                }"
                >Assign Deliver Volunteer Step</span
              >
            </button>
          </div>
          <!-- <div class="line"></div> -->
          <div class="step" @click="changeStep('step2')">
            <div class="btn step-trigger">
              <span
                class="bs-stepper-circle"
                :class="{
                  'badge-primary': steps.step2,
                  'badge-success': manage.requested_item.is_complete,
                }"
                >2</span
              >
              <span
                class="bs-stepper-label"
                :class="{ 'text-primary': steps.step2 }"
                >Assign Complete Step</span
              >
            </div>
          </div>
        </div>
        <div class="bs-stepper-content">
          <div class="content" :class="{ active: steps.step1 }">
            <div class="row rounded">
              <div class="col-md-6">
                <!-- start transition error -->
                <div
                  class="form-group"
                  v-bind:class="{
                    'has-error':
                      manage.step1.validation.transition_error_hasError,
                    'was-validated': !manage.step1.validation
                      .transition_error_hasError,
                  }"
                >
                  <input type="hidden" class="is-invalid" disabled />
                  <div class="invalid-feedback">
                    {{ manage.step1.validation.transition_error_errorMessage }}
                  </div>
                </div>
                <!-- end transition error -->

                <!-- Start Deliver Volunteer Select box -->
                <div
                  class="form-group"
                  v-bind:class="{
                    'has-error':
                      manage.step1.validation.delivered_volunteer_id_hasError,
                    'was-validated':
                      manage.step1.validation
                        .delivered_volunteer_id_successMessage &&
                      !manage.step1.validation.delivered_volunteer_id_hasError,
                  }"
                >
                  <label for="delivered_volunteer">
                    Assign Delivered Volunteer
                    <span class="text-danger">*</span>
                  </label>

                  <select2
                    :url="manage.step1.deliveredVolunteerUrl"
                    :placeholder="manage.step1.deliveredVolunteerPlaceholder"
                    :value="manage.step1.delivered_volunteer_id"
                    :disabled="manage.requested_item.is_delivering"
                    @input="manage.selectedDeliveredVolunteer($event)"
                    :selected-option="manage.step1.delivered_volunteer"
                    v-bind:class="{
                      'is-invalid':
                        manage.step1.validation.delivered_volunteer_id_hasError,
                    }"
                  ></select2>

                  <div class="invalid-feedback">
                    {{
                      manage.step1.validation
                        .delivered_volunteer_id_errorMessage
                    }}
                  </div>
                  <div class="valid-feedback" style="display: block">
                    {{
                      manage.step1.validation
                        .delivered_volunteer_id_successMessage
                    }}
                  </div>
                </div>
                <!-- End Deliver Volunteer Select box -->

                <div class="row">
                  <div
                    class="col-md-3"
                    v-if="!manage.requested_item.is_delivering"
                  >
                    <yesno
                      text="Assign"
                      addClass="btn-primary"
                      @confirmed="manage.assignDeliveredVolunteer()"
                    ></yesno>
                  </div>
                  <div
                    class="col-md-5"
                    v-if="
                      manage.requested_item.delivered_volunteer_id != null &&
                      !manage.requested_item.is_delivering
                    "
                  >
                    <yesno
                      text="Change Delivering State"
                      addClass="btn-danger"
                      @confirmed="manage.changeDeliveringState()"
                    ></yesno>
                  </div>

                  <div
                    class="col-md-4"
                    v-if="
                      manage.requested_item.delivered_volunteer_id != null &&
                      manage.requested_item.is_delivering &&
                      !manage.requested_item.is_done_delivering
                    "
                  >
                    <yesno
                      text="Done Delivering"
                      addClass="btn-success"
                      @confirmed="manage.changeDoneDeliveringState()"
                    ></yesno>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="content" :class="{ active: steps.step2 }">
            <div class="row rounded">
              <div class="col-md-6">
                <!-- start transition error -->
                <div
                  class="form-group"
                  v-bind:class="{
                    'has-error':
                      manage.step2.validation.transition_error_hasError,
                    'was-validated': !manage.step2.validation
                      .transition_error_hasError,
                  }"
                >
                  <input type="hidden" class="is-invalid" disabled />
                  <div class="invalid-feedback">
                    {{ manage.step2.validation.transition_error_errorMessage }}
                  </div>
                </div>
                <!-- end transition error -->

                <yesno
                  v-if="!manage.requested_item.is_complete"
                  text="Assign Complete"
                  addClass="btn-success"
                  @confirmed="manage.changeCompleteState()"
                ></yesno>

                <yesno
                  v-if="manage.requested_item.is_complete"
                  text="Assign InComplete"
                  addClass="btn-danger"
                  @confirmed="manage.changeIncompleteState()"
                ></yesno>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Stepper -->
  </div>
</template>

<script>
import yesno from "./yesno";
import select2 from "./select2";
import NewManage from "../models/manage_request_component/new_manage.js";
import CreateRequestItem from "../models/manage_request_component/create_request_item.js";
import Loading from "vue-loading-overlay";
import CreateRequestItemValidation from "../models/manage_request_component/create_request_item_validation";

export default {
  components: {
    yesno,
    select2,
    Loading,
  },
  props: {
    data: {
      required: true,
    },
  },
  data() {
    return {
      showTable: true,
      showManage: false,
      showCreate: false,
      fullPage: false,
      isLoading: true,
      create_request_item: new CreateRequestItem(),
      requested_user_detail: {
        index: "",
      },
      page: 1,
      model: this.data,
      manage: new NewManage(),
      steps: {
        step1: true,
        step2: false,
      },
    };
  },
  created() {
    let visitedStep = localStorage.getItem("visited-step-on-manage-request");

    if (visitedStep != null) {
      this.makeActive(visitedStep);
    }

    this.$root.$on("startLoading", () => {
      this.isLoading = true;
    });

    this.$root.$on("endLoading", () => {
      this.isLoading = false;
    });

    this.$root.$on("success", (data) => {
      this.model.requested_items.data.forEach((item, index) => {
        if (item.uuid == data.uuid) {
          Object.assign(item, data);
        }
      });
      this.manage.constructData(data);
    });

    // this.$root.$on("failed", (data) => {
    //   this.step1.constructData(this.model);
    // });
  },
  methods: {
    createRequest() {
      this.showTable = false;
      this.showManage = false;
      this.showCreate = true;
    },
    cancelCreateRequestItem() {
      this.showTable = true;
      this.showManage = false;
      this.showCreate = false;
    },
    saveRequestItem() {
      let self = this;
      let url = route("requested_items.store", this.model.donated_item.uuid);
      axios
        .post(url, this.create_request_item.data)
        .then((response) => {
          console.log(response);
          Object.assign(this.model, response.data);
          this.create_request_item = new CreateRequestItem();
          self.create_request_item.validation = new CreateRequestItemValidation();
          console.log(this.showTable)
          this.showTable = true;
          this.showCreate = false;
          window.dashboard_app.$emit("success", response.data);
          window.dashboard_app.$toasted.show("Saving Success.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        })
        .catch(function (error) {
          self.create_request_item.validation = new CreateRequestItemValidation(
            error.response.data.errors
          );
          window.dashboard_app.$toasted.show("Saving Failed.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        });
    },
    containsKey(obj, key) {
      return Object.keys(obj).includes(key);
    },
    getDetailData(attribute) {
      if (this.requested_user_detail.index !== "") {
        return this.model.requested_items.data[this.requested_user_detail.index]
          .requested_user[attribute];
      }
    },
    hasDetailData(attribute) {
      if (this.requested_user_detail.index !== "") {
        let obj = this.model.requested_items.data[
          this.requested_user_detail.index
        ].requested_user;
        return this.containsKey(obj, attribute);
      }
    },
    showDetailModal(index) {
      this.requested_user_detail.index = index;
      $("#showDetailModal").modal("show");
    },
    showAll() {
      this.showTable = true;
      this.showManage = false;
    },
    manageRequestItem(index) {
      let manageRequestedItem = this.model.requested_items.data[index];

      this.manage.constructData(manageRequestedItem);

      this.showTable = false;
      this.showManage = true;
    },
    recoverRequestItem(index) {
      let recoverRequestedItem = this.model.requested_items.data[index];

      var self = this;
      var url = route(
        "requestedItem.recoverRequestedItem",
        recoverRequestedItem.uuid
      );

      window.dashboard_app.$emit("startLoading");

      axios
        .get(url)
        .then((response) => {
          console.log(response);
          Object.assign(this.model.requested_items.data[index], response.data);
          // self.step2.validation = new step2validation();
          window.dashboard_app.$emit("success", response.data);
          window.dashboard_app.$toasted.show("Saving Success.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        })
        .catch(function (error) {
          // window.dashboard_app.$emit('failed')
          console.log(error.response);
          // self.step2.validation = new step2validation(
          //   error.response.data.errors
          // );
          window.dashboard_app.$toasted.show("Saving Failed.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        });
    },
    cancelRequestItem(index) {
      let cancelRequestedItem = this.model.requested_items.data[index];

      var self = this;
      var url = route(
        "requestedItem.changeCancelState",
        cancelRequestedItem.uuid
      );

      window.dashboard_app.$emit("startLoading");

      axios
        .get(url)
        .then((response) => {
          console.log(response);
          Object.assign(this.model.requested_items.data[index], response.data);
          // self.step2.validation = new step2validation();
          window.dashboard_app.$emit("success", response.data);
          window.dashboard_app.$toasted.show("Saving Success.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        })
        .catch(function (error) {
          // window.dashboard_app.$emit('failed')
          console.log(error.response);
          // self.step2.validation = new step2validation(
          //   error.response.data.errors
          // );
          window.dashboard_app.$toasted.show("Saving Failed.", {
            icon: "save",
          });
          window.dashboard_app.$emit("endLoading");
        });
    },
    getRequestItemsResult(page) {
      this.page = page;

      if (typeof page === "undefined") {
        page = 1;
      }

      axios
        .get(
          route(
            "donated_items.requested_items.fetch",
            this.model.donated_item.uuid
          ) +
            "?page=" +
            page
        )
        .then((response) => (this.model = response.data));
    },
    changeStep(step) {
      this.makeActive(step);
      localStorage.setItem("visited-step-on-manage-request", step);
    },
    makeActive(step) {
      const keys = Object.keys(this.steps);
      keys.forEach((key, index) => {
        key == step ? (this.steps[key] = true) : (this.steps[key] = false);
      });
    },
  },
  mounted() {
    console.log(this.model);
  },
};
</script>