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
          >Add New Item To Store</a
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
    </div>
    <div class="col-md-6 col-lg-6 col-centered">
      <div class="card border border-success" style="min-height: 550px">
        <div class="card-body row">
          <div class="col-md-9" v-if="edit">
            <h3>
              <span
                v-bind:class="{
                  'badge badge-danger':
                    InternalDonatedItemModel.data.status === 'Lost',
                  'badge badge-success':
                    InternalDonatedItemModel.data.status === 'Available',
                }"
              >
                {{ InternalDonatedItemModel.data.item_unique_id }}
              </span>
              -
              <span
                v-bind:class="{
                  'badge badge-danger':
                    InternalDonatedItemModel.data.status === 'Lost',
                  'badge badge-success':
                    InternalDonatedItemModel.data.status === 'Available',
                }"
              >
                {{ InternalDonatedItemModel.data.status }}
              </span>
            </h3>
          </div>
          <div class="col-md-3">
            <div class="" v-if="showRequestControl">
              <div
                class="form-group"
                v-if="InternalDonatedItemModel.data.status != 'Complete'"
              >
                <div
                  class="
                    custom-control
                    custom-switch
                    custom-switch-off-danger
                    custom-switch-on-success
                  "
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
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="almsRound"
                    >Alms Round <span class="text-danger">*</span></label
                  >
                  <select2
                    :url="InternalDonatedItemModel.fetchAlmsRound"
                    placeholder="Select Alms Round"
                    :value="InternalDonatedItemModel.data.alms_round_id"
                    @input="
                      InternalDonatedItemModel.selectedAlmsRoundBox($event)
                    "
                    :selected-option="
                      InternalDonatedItemModel.selectedAlmsRound
                    "
                    :disabled="disabled"
                    v-bind:class="{
                      'is-invalid':
                        InternalDonatedItemModel.InternalDonatedItemValidation
                          .alms_round_id_hasError,
                      'is-valid':
                        InternalDonatedItemModel.InternalDonatedItemSubmited &&
                        !InternalDonatedItemModel.InternalDonatedItemValidation
                          .alms_round_id_hasError,
                    }"
                  ></select2>
                  <div
                    class="invalid-feedback"
                    v-if="
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .alms_round_id_hasError
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .alms_round_id_errorMessage
                    }}
                  </div>

                  <div
                    class="valid-feedback"
                    v-if="
                      !InternalDonatedItemModel.InternalDonatedItemValidation
                        .alms_round_id_hasError &&
                      InternalDonatedItemModel.InternalDonatedItemSubmited
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .alms_round_id_successMessage
                    }}
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="item_type"
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
              <div class="col-md-6">
                <div class="form-group">
                  <label for="itemSubType"
                    >Item Sub Type <span class="text-danger">*</span></label
                  >
                  <select2
                    :url="InternalDonatedItemModel.fetchItemSubType"
                    placeholder="Select Item Sub Type"
                    :value="InternalDonatedItemModel.data.item_sub_type_id"
                    @input="
                      InternalDonatedItemModel.selectedItemSubTypeBox($event)
                    "
                    :selected-option="
                      InternalDonatedItemModel.selectedItemSubType
                    "
                    :disabled="itemSubTypeDisabled"
                    :fetch="InternalDonatedItemModel.itemSubTypeFetch"
                    v-bind:class="{
                      'is-invalid':
                        InternalDonatedItemModel.InternalDonatedItemValidation
                          .item_sub_type_id_hasError,
                      'is-valid':
                        InternalDonatedItemModel.InternalDonatedItemSubmited &&
                        !InternalDonatedItemModel.InternalDonatedItemValidation
                          .item_sub_type_id_hasError,
                    }"
                  ></select2>
                  <div
                    class="invalid-feedback"
                    v-if="
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .item_sub_type_id_hasError
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .item_sub_type_id_errorMessage
                    }}
                  </div>

                  <div
                    class="valid-feedback"
                    v-if="
                      !InternalDonatedItemModel.InternalDonatedItemValidation
                        .item_sub_type_id_hasError &&
                      InternalDonatedItemModel.InternalDonatedItemSubmited
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .item_sub_type_id_successMessage
                    }}
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="unit"
                    >Unit <span class="text-danger">*</span></label
                  >
                  <select2
                    :url="InternalDonatedItemModel.fetchUnit"
                    placeholder="Select Unit"
                    :value="InternalDonatedItemModel.data.unit_id"
                    @input="InternalDonatedItemModel.selectedUnitBox($event)"
                    :selected-option="InternalDonatedItemModel.selectedUnit"
                    :disabled="disabled"
                    v-bind:class="{
                      'is-invalid':
                        InternalDonatedItemModel.InternalDonatedItemValidation
                          .unit_id_hasError,
                      'is-valid':
                        InternalDonatedItemModel.InternalDonatedItemSubmited &&
                        !InternalDonatedItemModel.InternalDonatedItemValidation
                          .unit_id_hasError,
                    }"
                  ></select2>
                  <div
                    class="invalid-feedback"
                    v-if="
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .unit_id_hasError
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .unit_id_errorMessage
                    }}
                  </div>

                  <div
                    class="valid-feedback"
                    v-if="
                      !InternalDonatedItemModel.InternalDonatedItemValidation
                        .unit_id_hasError &&
                      InternalDonatedItemModel.InternalDonatedItemSubmited
                    "
                  >
                    {{
                      InternalDonatedItemModel.InternalDonatedItemValidation
                        .unit_id_successMessage
                    }}
                  </div>
                </div>
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
                    >Sacket Qty <span class="text-danger">*</span></label
                  >
                  <input
                    name="socket_qty"
                    id="socket_qty"
                    type="text"
                    class="form-control only-number"
                    placeholder="Enter Sacket Qty"
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
                    >Sacket Per Package
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
  </div>
</template>

<script>
import InternalDonatedItem from "../models/internal_donated_item/internal_donated_item";
import select2 from "./select2";
import Loading from "vue-loading-overlay";

export default {
  components: {
    select2,
    Loading
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
    itemSubTypeDisabled() {
      return (
        this.InternalDonatedItemModel.data.is_confirmed ||
        this.InternalDonatedItemModel.data.item_type_id === ""
      );
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

    if (this.InternalDonatedItemModel.data.item_type_id !== "") {
      this.InternalDonatedItemModel.fetchItemSubType =
        route("item_sub_types.fetch") +
        this.InternalDonatedItemModel.data.item_type_id;
      this.InternalDonatedItemModel.itemSubTypeFetch++;
      console.log(this.InternalDonatedItemModel.data.item_type_id);
    }
  },
};
</script>