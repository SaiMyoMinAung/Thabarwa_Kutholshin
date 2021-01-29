<template>
  <div class="row">
    <loading
      :active.sync="isLoading"
      :can-cancel="true"
      :is-full-page="fullPage"
    ></loading>
    <div class="col-md-12 col-lg-12 row mb-1">
      <div class="col-md-3">
        <a
          :href="InternalDonatedItemModel.internalDonatedItemCreateUrl"
          class="btn btn-success"
          >Input Item</a
        >
      </div>
      <div class="col-md-3">
        <a
          class="btn btn-outline-primary"
          style="min-width: 250px"
          :href="InternalDonatedItemModel.internalDonatedItemIndexUrl"
          ><i class="fas fa-table"></i> Show Table</a
        >
      </div>
      <div class="col-md-6" v-if="edit">
        <div class="float-left mr-1">
          <add-unexpected-person-component />
        </div>
        <div class="float-left mr-1">
          <add-team-component />
        </div>
        <div class="float-left mr-1">
          <add-yogi-component />
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-6 col-centered">
      <div class="card border border-success" style="min-height: 550px">
        <div class="card-body row">
          <div class="col-md-12" v-if="edit">
            <h3>
              <span class="badge badge-success">
                {{ InternalDonatedItemModel.data.item_unique_id }}
              </span>

              <span class="badge badge-success">
                - {{ InternalDonatedItemModel.data.status }}
              </span>
            </h3>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="name"
                >Item Name <span class="text-danger">*</span></label
              >
              <input
                name="name"
                type="text"
                class="form-control"
                id="name"
                placeholder="Enter Name"
                v-model="InternalDonatedItemModel.data.name"
                :disabled="disabled"
                v-bind:class="{
                  'is-invalid':
                    InternalDonatedItemModel.InternalDonatedItemValidation
                      .name_hasError,
                  'is-valid':
                    InternalDonatedItemModel.InternalDonatedItemSubmited &&
                    !InternalDonatedItemModel.InternalDonatedItemValidation
                      .name_hasError,
                }"
              />

              <div
                class="invalid-feedback"
                v-if="
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .name_hasError
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .name_errorMessage
                }}
              </div>

              <div
                class="valid-feedback"
                v-if="
                  !InternalDonatedItemModel.InternalDonatedItemValidation
                    .name_hasError &&
                  InternalDonatedItemModel.InternalDonatedItemSubmited
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .name_successMessage
                }}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="package_qty"
                    >Package Qty <span class="text-danger">*</span></label
                  >
                  <input
                    name="package_qty"
                    id="package_qty"
                    type="text"
                    class="form-control only-number"
                    placeholder="Enter Package Qty"
                    v-model="InternalDonatedItemModel.data.package_qty"
                    :disabled="disabled"
                    v-bind:class="{
                      'is-invalid':
                        InternalDonatedItemModel.InternalDonatedItemValidation
                          .package_qty_hasError,
                      'is-valid':
                        InternalDonatedItemModel.InternalDonatedItemSubmited &&
                        !InternalDonatedItemModel.InternalDonatedItemValidation
                          .package_qty_hasError,
                    }"
                  />
                  <div
                    class="invalid-feedback"
                    v-if="
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .package_qty_hasError
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .package_qty_errorMessage
                    }}
                  </div>

                  <div
                    class="valid-feedback"
                    v-if="
                      !InternalDonatedItemModel.InternalDonatedItemValidation
                        .package_qty_hasError &&
                      InternalDonatedItemModel.InternalDonatedItemSubmited
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .package_qty_successMessage
                    }}
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="socket_qty"
                    >Socket Qty <span class="text-danger">*</span></label
                  >
                  <input
                    name="socket_qty"
                    id="socket_qty"
                    type="text"
                    class="form-control only-number"
                    placeholder="Enter Socket Qty"
                    v-model="InternalDonatedItemModel.data.socket_qty"
                    :disabled="disabled"
                    v-bind:class="{
                      'is-invalid':
                        InternalDonatedItemModel.InternalDonatedItemValidation
                          .socket_qty_hasError,
                      'is-valid':
                        InternalDonatedItemModel.InternalDonatedItemSubmited &&
                        !InternalDonatedItemModel.InternalDonatedItemValidation
                          .socket_qty_hasError,
                    }"
                  />
                  <div
                    class="invalid-feedback"
                    v-if="
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .socket_qty_hasError
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .socket_qty_errorMessage
                    }}
                  </div>

                  <div
                    class="valid-feedback"
                    v-if="
                      !InternalDonatedItemModel.InternalDonatedItemValidation
                        .socket_qty_hasError &&
                      InternalDonatedItemModel.InternalDonatedItemSubmited
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .socket_qty_successMessage
                    }}
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="socket_per_package"
                    >Socket Per Package
                    <span class="text-danger">*</span></label
                  >
                  <input
                    name="socket_per_package"
                    id="socket_per_package"
                    type="text"
                    class="form-control only-number"
                    placeholder="Enter Socket Per Package"
                    v-model="InternalDonatedItemModel.data.socket_per_package"
                    :disabled="disabled"
                    v-bind:class="{
                      'is-invalid':
                        InternalDonatedItemModel.InternalDonatedItemValidation
                          .socket_per_package_hasError,
                      'is-valid':
                        InternalDonatedItemModel.InternalDonatedItemSubmited &&
                        !InternalDonatedItemModel.InternalDonatedItemValidation
                          .socket_per_package_hasError,
                    }"
                  />
                  <div
                    class="invalid-feedback"
                    v-if="
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .socket_per_package_hasError
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .socket_per_package_errorMessage
                    }}
                  </div>

                  <div
                    class="valid-feedback"
                    v-if="
                      !InternalDonatedItemModel.InternalDonatedItemValidation
                        .socket_per_package_hasError &&
                      InternalDonatedItemModel.InternalDonatedItemSubmited
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .socket_per_package_successMessage
                    }}
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="unit"
                    >Unit <span class="text-danger">*</span></label
                  >
                  <select2
                    :url="InternalDonatedItemModel.fetchUnit"
                    placeholder="Select Unit"
                    :value="InternalDonatedItemModel.data.unit"
                    @input="InternalDonatedItemModel.selectedUnitBox($event)"
                    :selected-option="InternalDonatedItemModel.selectedUnit"
                    :disabled="disabled"
                    v-bind:class="{
                      'is-invalid':
                        InternalDonatedItemModel.InternalDonatedItemValidation
                          .unit_hasError,
                      'is-valid':
                        InternalDonatedItemModel.InternalDonatedItemSubmited &&
                        !InternalDonatedItemModel.InternalDonatedItemValidation
                          .unit_hasError,
                    }"
                  ></select2>
                  <div
                    class="invalid-feedback"
                    v-if="
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .unit_hasError
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .unit_errorMessage
                    }}
                  </div>

                  <div
                    class="valid-feedback"
                    v-if="
                      !InternalDonatedItemModel.InternalDonatedItemValidation
                        .unit_hasError &&
                      InternalDonatedItemModel.InternalDonatedItemSubmited
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .unit_successMessage
                    }}
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="unit"
                    >Item Type <span class="text-danger">*</span></label
                  >
                  <select2
                    :url="InternalDonatedItemModel.fetchItemType"
                    placeholder="Select Item Type"
                    :value="InternalDonatedItemModel.data.item_type"
                    @input="
                      InternalDonatedItemModel.selectedItemTypeBox($event)
                    "
                    :selected-option="InternalDonatedItemModel.selectedItemType"
                    :disabled="disabled"
                    v-bind:class="{
                      'is-invalid':
                        InternalDonatedItemModel.InternalDonatedItemValidation
                          .item_type_id_hasError,
                      'is-valid':
                        InternalDonatedItemModel.InternalDonatedItemSubmited &&
                        !InternalDonatedItemModel.InternalDonatedItemValidation
                          .item_type_id_hasError,
                    }"
                  ></select2>
                  <div
                    class="invalid-feedback"
                    v-if="
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .item_type_id_hasError
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .item_type_id_errorMessage
                    }}
                  </div>

                  <div
                    class="valid-feedback"
                    v-if="
                      !InternalDonatedItemModel.InternalDonatedItemValidation
                        .item_type_id_hasError &&
                      InternalDonatedItemModel.InternalDonatedItemSubmited
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .item_type_id_successMessage
                    }}
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Remark <span class="text-danger">*</span></label>
              <textarea
                name="remark"
                class="form-control"
                rows="3"
                placeholder="Enter Remark"
                :disabled="disabled"
                v-model="InternalDonatedItemModel.data.remark"
                v-bind:class="{
                  'is-invalid':
                    InternalDonatedItemModel.InternalDonatedItemValidation
                      .remark_hasError,
                  'is-valid':
                    InternalDonatedItemModel.InternalDonatedItemSubmited &&
                    !InternalDonatedItemModel.InternalDonatedItemValidation
                      .remark_hasError,
                }"
              ></textarea>

              <div
                class="invalid-feedback"
                v-if="
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .remark_hasError
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .remark_errorMessage
                }}
              </div>

              <div
                class="valid-feedback"
                v-if="
                  !InternalDonatedItemModel.InternalDonatedItemValidation
                    .remark_hasError &&
                  InternalDonatedItemModel.InternalDonatedItemSubmited
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .remark_successMessage
                }}
              </div>
            </div>

            <div class="row">
              <button
                type="submit"
                class="btn btn-success m-1"
                v-if="!disabled"
                @click="
                  edit
                    ? InternalDonatedItemModel.updateItem()
                    : InternalDonatedItemModel.saveItem()
                "
              >
                {{ edit ? "Update" : "Create" }}
              </button>
              <input
                type="submit"
                class="btn btn-danger m-1"
                :value="edit ? 'Update And Confirm' : 'Create And Confirm'"
                name="update_and_confirm"
                v-if="!disabled"
                @click="
                  edit
                    ? InternalDonatedItemModel.updateAndConfirm()
                    : InternalDonatedItemModel.confirmAndSaveItem()
                "
              />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-6 col-centered" v-if="showRequestControl">
      <div class="card border border-success" style="min-height: 550px">
        <div class="card-body row">
          <div class="col-md-12">
            <div
              class="form-group"
              v-if="InternalDonatedItemModel.data.status != 'Complete'"
            >
              <label>Request Control</label>
              <div
                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"
              >
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="is_left_item"
                  :checked="
                    InternalDonatedItemModel.data.status == 'Available'
                      ? true
                      : false
                  "
                  @click="InternalDonatedItemModel.controlAvailable()"
                />
                <label class="custom-control-label" for="is_left_item">{{
                  InternalDonatedItemModel.data.status
                }}</label>
              </div>
            </div>
          </div>
          <div
            class="row"
            v-if="InternalDonatedItemModel.data.status == 'Available'"
          >
            <div class="form-group col-md-6">
              <label for="requestable_type"
                >Requestable Type <span class="text-danger">*</span></label
              >
              <select2
                :url="InternalDonatedItemModel.getRequestableTypeUrl"
                placeholder="Select Requestable Type"
                :value="InternalDonatedItemModel.requestData.requestable_type"
                @input="
                  InternalDonatedItemModel.selectedRequestableTypeBox($event)
                "
                :selected-option="
                  InternalDonatedItemModel.selectedRequestableType
                "
                v-bind:class="{
                  'is-invalid':
                    InternalDonatedItemModel.InternalDonatedItemValidation
                      .requestable_type_hasError,
                  'is-valid':
                    InternalDonatedItemModel.InternalRequestSubmited &&
                    !InternalDonatedItemModel.InternalDonatedItemValidation
                      .requestable_type_hasError,
                }"
              ></select2>
              <div
                class="invalid-feedback"
                v-if="
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .requestable_type_hasError
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .requestable_type_errorMessage
                }}
              </div>

              <div
                class="valid-feedback"
                v-if="
                  !InternalDonatedItemModel.InternalDonatedItemValidation
                    .requestable_type_hasError &&
                  InternalDonatedItemModel.InternalRequestSubmited
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .requestable_type_successMessage
                }}
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="requestable_type"
                >Requestable Person <span class="text-danger">*</span></label
              >
              <select2
                :disabled="
                  InternalDonatedItemModel.requestData.requestable_type == ''
                    ? true
                    : false
                "
                :url="InternalDonatedItemModel.getRequestableTypeIdUrl"
                placeholder="Select Requestable Person"
                :value="InternalDonatedItemModel.requestData.requestable_id"
                @input="
                  InternalDonatedItemModel.selectedRequestableTypeIdBox($event)
                "
                :selected-option="
                  InternalDonatedItemModel.selectedRequestableTypeId
                "
                v-bind:class="{
                  'is-invalid':
                    InternalDonatedItemModel.InternalDonatedItemValidation
                      .requestable_id_hasError,
                  'is-valid':
                    InternalDonatedItemModel.InternalRequestSubmited &&
                    !InternalDonatedItemModel.InternalDonatedItemValidation
                      .requestable_id_hasError,
                }"
              ></select2>
              <div
                class="invalid-feedback"
                v-if="
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .requestable_id_hasError
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .requestable_id_errorMessage
                }}
              </div>

              <div
                class="valid-feedback"
                v-if="
                  !InternalDonatedItemModel.InternalDonatedItemValidation
                    .requestable_type_id_hasError &&
                  InternalDonatedItemModel.InternalRequestSubmited
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .requestable_type_id_successMessage
                }}
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="request_package_qty"
                >Package QTY <span class="text-danger">*</span></label
              >
              <input
                id="request_package_qty"
                type="text"
                class="form-control only-number"
                placeholder="Enter Package QTY"
                v-model="
                  InternalDonatedItemModel.requestData.request_package_qty
                "
                v-bind:class="{
                  'is-invalid':
                    InternalDonatedItemModel.InternalDonatedItemValidation
                      .request_package_qty_hasError,
                  'is-valid':
                    InternalDonatedItemModel.InternalRequestedItemSubmited &&
                    !InternalDonatedItemModel.InternalDonatedItemValidation
                      .request_package_qty_hasError,
                }"
              />
              <div
                class="invalid-feedback"
                v-if="
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .request_package_qty_hasError
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .request_package_qty_errorMessage
                }}
              </div>

              <div
                class="valid-feedback"
                v-if="
                  !InternalDonatedItemModel.InternalDonatedItemValidation
                    .request_package_qty_hasError &&
                  InternalDonatedItemModel.InternalRequestedItemSubmited
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .request_package_qty_successMessage
                }}
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="request_socket_qty"
                >Socket QTY <span class="text-danger">*</span></label
              >
              <input
                name="request_socket_qty"
                id="request_socket_qty"
                type="text"
                class="form-control only-number"
                placeholder="Enter Package QTY"
                v-model="
                  InternalDonatedItemModel.requestData.request_socket_qty
                "
                v-bind:class="{
                  'is-invalid':
                    InternalDonatedItemModel.InternalDonatedItemValidation
                      .request_socket_qty_hasError,
                  'is-valid':
                    InternalDonatedItemModel.InternalRequestedItemSubmited &&
                    !InternalDonatedItemModel.InternalDonatedItemValidation
                      .request_socket_qty_hasError,
                }"
              />
              <div
                class="invalid-feedback"
                v-if="
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .request_socket_qty_hasError
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .request_socket_qty_errorMessage
                }}
              </div>

              <div
                class="valid-feedback"
                v-if="
                  !InternalDonatedItemModel.InternalDonatedItemValidation
                    .request_socket_qty_hasError &&
                  InternalDonatedItemModel.InternalRequestedItemSubmited
                "
              >
                {{
                  InternalDonatedItemModel.InternalDonatedItemValidation
                    .request_socket_qty_successMessage
                }}
              </div>
            </div>

            <div class="col-md-12">
              <button
                class="btn btn-success"
                @click="InternalDonatedItemModel.saveRequest()"
              >
                Create Request
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div
        class="tab-pane fade show"
        id="box-list"
        role="tabpanel"
        aria-labelledby="box-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Type</th>
              <th scope="col">Package Qty</th>
              <th scope="col">Socket Qty</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(item, index) in InternalDonatedItemModel.listOfRequest
                .data"
              :key="item.uuid"
            >
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">{{ item.type.replace("App\\",'') }}</td>
              <td style="max-width: 20px">{{ item.package_qty }}</td>
              <td style="max-width: 20px">{{ item.socket_qty }}</td>

              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-danger"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-box-${item.uuid}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  Delete
                </button>
                <div :id="`collapse-box-${item.uuid}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="InternalDonatedItemModel.deleteRequest(item.uuid)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-box-${item.uuid}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="InternalDonatedItemModel.listOfRequest"
          align="center"
          v-on:pagination-change-page="
            InternalDonatedItemModel.getRequestResult
          "
        ></pagination>
      </div>
    </div>
  </div>
</template>

<script>
import InternalDonatedItem from "../models/internal_donated_item/internal_donated_item";
import select2 from "./select2";
import Loading from "vue-loading-overlay";
import AddUnexpectedPersonComponent from "./AddUnexpectedPersonComponent.vue";
import AddTeamComponent from "./AddTeamComponent.vue";
import AddYogiComponent from "./AddYogiComponent.vue";

export default {
  components: {
    select2,
    Loading,
    AddUnexpectedPersonComponent,
    AddTeamComponent,
    AddYogiComponent,
  },
  props: {
    internal_donated_item: { type: Object, default: () => ({}) },
  },
  data: function () {
    return {
      fullPage: false,
      isLoading: false,
      InternalDonatedItemModel: new InternalDonatedItem(
        this.internal_donated_item
      ),
    };
  },
  mounted() {
    //
  },
  computed: {
    edit() {
      return this.InternalDonatedItemModel.data.uuid != "";
    },
    disabled() {
      return this.InternalDonatedItemModel.data.is_confirmed;
    },
    showRequestControl() {
      return (
        this.InternalDonatedItemModel.data.is_confirmed &&
        this.InternalDonatedItemModel.data.status != "Complete"
      );
    },
  },
  created() {
    this.$root.$on("startLoading", () => {
      this.isLoading = true;
    });

    this.$root.$on("endLoading", () => {
      this.isLoading = false;
    });

    this.$root.$on("success", (data) => {
      //
    });

    this.InternalDonatedItemModel.getRequestResult();
  },
};
</script>